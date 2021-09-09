<?php

namespace App\Http\Controllers;

use App\Models\TripLogger;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class TripLoggerController extends Controller
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
        $triploggers = Triplogger::all();
        return view('dashboard.logistics.triplogger.index',compact('vehicles','triploggers', 'drivers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehicles = Vehicle::all();
        $drivers = User::all()->where('department','drivers');
        return view('dashboard.logistics.triplogger.create',compact('drivers','vehicles'));
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
            'number_plate'             => 'required',
            'assigned_driver'           => 'required',
            'production_name'           => 'required',
            'trip_date'           => 'required',
            'odometer_start'           => 'required',
            'odometer_stop'           => 'required',
            'trip_information'           => 'required',
            'trip_distance'           => 'required',
            'fuel_station'           => 'required'
        ]);

        $triplogger = new Triplogger();
        $triplogger->number_plate     = $request->input('number_plate');
        $triplogger->production_name = $request->input('production_name');
        $triplogger->trip_date = $request->input('trip_date');
        $triplogger->assigned_driver = $request->input('assigned_driver');
        $triplogger->odometer_start = $request->input('odometer_start');
        $triplogger->odometer_stop = $request->input('odometer_stop');
        $triplogger->trip_information = $request->input('trip_information');
        $triplogger->trip_distance = $request->input('trip_distance');
        $triplogger->fuel_station = $request->input('fuel_station');
        $triplogger->save();
        $request->session()->flash('message', 'Successfully added triplogger');

        return redirect()->route('triplogger.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Triplogger  $triplogger
     * @return \Illuminate\Http\Response
     */
    public function show(Triplogger $triplogger)
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
    {   $triplogger = Triplogger::all()->find($id);
        $drivers = User::all()->where('department','drivers');
        $vehicles = Vehicle::all();
        return view('dashboard.logistics.triplogger.edit', compact('drivers','triplogger','vehicles'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Triplogger  $triplogger
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Triplogger $triplogger)
    {   $validatedData = $request->validate([
        'number_plate'             => 'required',
        'production_name'           => 'required',
        'trip_date'           => 'required',
        'assigned_driver'           => 'required',
        'odometer_start'           => 'required',
        'odometer_stop'           => 'required',
        'trip_information'           => 'required',
        'trip_distance'           => 'required',
        'fuel_station'           => 'required'
    ]);

    $triplogger->number_plate     = $request->input('number_plate');
    $triplogger->production_name = $request->input('production_name');
    $triplogger->trip_date = $request->input('trip_date');
    $triplogger->assigned_driver = $request->input('assigned_driver');
    $triplogger->odometer_start = $request->input('odometer_start');
    $triplogger->odometer_stop = $request->input('odometer_stop');
    $triplogger->trip_information = $request->input('trip_information');
    $triplogger->trip_distance = $request->input('trip_distance');
    $triplogger->fuel_station = $request->input('fuel_station');
    $triplogger->save();
    $request->session()->flash('message', 'Successfully added Trip Log');

    return redirect()->route('triplogger.index');
    }
     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $triplogger = TripLogger::find($id);
        if($triplogger){
            $triplogger->delete();
        }
        return redirect()->route('triplogger.index')->with('message', 'Successfully Deleted trip Log');

    }
}
