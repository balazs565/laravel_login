<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = \App\Models\Service::withCount('timeslots')->get();

        if(request()->is('admin/*')) {
            return view('admin.services.index', ['services' => $services]);
        }

        return view('services.index', ['services' => $services]);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated=$request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
        ]);
    Service::create($validated);

    return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
           return view('admin.services.edit',['service' => $service]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $validated=$request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
        ]);
        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Serviciu reactualizat cu succes.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
    $service->delete();
    return redirect()->route('admin.services.index')->with('success','Sters cu succes.');
    }
}
