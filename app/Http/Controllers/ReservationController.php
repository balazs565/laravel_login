<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    if (auth()->user()->role === 'admin') {
        $reservations = \App\Models\Reservation::with(['user', 'service', 'timeslot'])->get();
        return view('admin.reservations.index', compact('reservations'));
    }

    
    $reservations = \App\Models\Reservation::with(['service', 'timeslot'])
        ->where('user_id', auth()->id())
        ->get();

    return view('reservations.index', compact('reservations'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
        'timeslot_id' => 'required|integer|exists:timeslots,id',
    ]);

    $reservation = \DB::transaction(function () use ($data) {
        $timeslot = \App\Models\Timeslot::where('id', $data['timeslot_id'])->lockForUpdate()->firstOrFail();

        if ($timeslot->booked) {
            throw new \RuntimeException('Timeslot already booked.');
        }

        $userId = auth()->id();

        $exists = \App\Models\Reservation::where('user_id', $userId)
            ->where('timeslot_id', $timeslot->id)
            ->exists();

        if ($exists) {
            throw new \RuntimeException('You have already booked this timeslot.');
        }

        return \App\Models\Reservation::create([
            'user_id' => $userId,
            'service_id' => $timeslot->service_id,
            'timeslot_id' => $timeslot->id,
            'status' => 'pending',  
        ]);
    });

    return redirect('/services')->with('status', 'Rezervarea a fost creată și este în așteptare.');
}

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
          $data = $request->validate([
        'status' => 'required|in:confirmed,canceled',
    ]);

    if ($data['status'] === 'confirmed') {
        $reservation->status = 'confirmed';
        $reservation->timeslot->booked = true;
        $reservation->timeslot->save();
        $reservation->save();
    } elseif ($data['status'] === 'canceled') {
        
        $reservation->timeslot->booked = false;
        $reservation->timeslot->save();

        $reservation->delete(); 
    }

    return redirect()->back()->with('status', 'Rezervarea a fost actualizată.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        if($reservation->user_id !== auth()->id()){
            abort(403,'Actiune interzisă.');

        }

        $reservation->timeslot->booked=false;
        $reservation->timeslot->save();
        $reservation->delete();
        return redirect()->back()->with('status', 'Rezervarea a fost anulata!');
    }
}
