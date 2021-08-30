<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\User;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers = User::all()->where('department','drivers');
        $vehicles = Vehicle::all();
        return view('dashboard.logistics.vehicles.index',compact('vehicles', 'drivers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $drivers = User::all()->where('department','drivers');
        return view('dashboard.logistics.vehicles.create',compact('drivers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'number_plate'             => 'required|unique:vehicles',
            'vehicle_make'           => 'required',
            'purpose'           => 'required',
            'vehicle_colour'           => 'required',
            'assigned_driver'           => ''
        ]);

        $vehicle = new Vehicle();
        $vehicle->number_plate     = $request->input('number_plate');
        $vehicle->vehicle_make = $request->input('vehicle_make');
        $vehicle->purpose = $request->input('purpose');
        $vehicle->vehicle_colour = $request->input('vehicle_colour');
        $vehicle->assigned_driver = $request->input('assigned_driver');
        $vehicle->save();
        $request->session()->flash('message', 'Successfully added vehicle');

        return redirect()->route('vehicles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   $vehicle = Vehicle::all()->find($id);
        $drivers = User::all()->where('department','drivers');
        return view('dashboard.logistics.vehicles.edit', compact('drivers','vehicle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {   $validatedData = $request->validate([
        'number_plate'             => 'required',
        'vehicle_make'           => 'required',
        'purpose'           => 'required',
        'vehicle_colour'           => 'required',
        'assigned_driver'           => 'required'
    ]);

        $vehicle->number_plate     = $request->input('number_plate');
        $vehicle->vehicle_make = $request->input('vehicle_make');
        $vehicle->purpose = $request->input('purpose');
        $vehicle->vehicle_colour = $request->input('vehicle_colour');
        $vehicle->assigned_driver = $request->input('assigned_driver');
        $vehicle->save();
        $request->session()->flash('message', 'Successfully Updated vehicle');
        return redirect()->route('vehicles.index');
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $vehicle = Vehicle::find($id);
        if($vehicle){
            $vehicle->delete();
        }

        return redirect()->route('vehicles.index')->with('message', 'vehicle deleted!');;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id){
        $vehicle = Vehicle::find($id);
        return view('dashboard.logistics.vehicles.delete', compact('vehicle'));

    }

}
