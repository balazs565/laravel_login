<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Timeslot;
use Illuminate\Http\Request;

class TimeslotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $timeslots = Timeslot::with('service')->get();

        if(request()->is('admin/*')) {
            return view('admin.timeslots.index', ['timeslots' => $timeslots]);
        }

        return view('timeslots.index', ['timeslots' => $timeslots]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services=Service::all();
        return view('admin.timeslots.create');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'service_id' => 'required|exists:services,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'booked' => 'sometimes|boolean',
        ]);
        $data['booked'] = $request->has('booked') ? true : false;
        Timeslot::create($data);

        return redirect()->route('admin.timeslots.index')->with('success','Ai creat un nou interval orar cu succes!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Timeslot $timeslot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Timeslot $timeslot)
    {
        $services=Service::all();
        return view('admin.timeslots.edit',compact('timeslot','services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Timeslot $timeslot)
    {
        $data=$request->validate([
            'service_id' => 'required|exists:services,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'booked' => 'sometimes|boolean',
        ]);
        $data['booked'] = $request->has('booked') ? true : false;
        $timeslot->update($data);

        return redirect()->route('admin.timeslots.index')->with('success','Intervalul orar a fost actualizat cu succes!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Timeslot $timeslot)
    {
        $timeslot->delete();
        return redirect()->route('admin.timeslots.index')->with('success','Intervalul orar a fost sters cu succes!');
    }
}
