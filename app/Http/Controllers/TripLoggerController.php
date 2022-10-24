<?php

namespace App\Http\Controllers;

use App\Events\RecordCreatedEvent;
use App\Models\Schedule;
use App\Models\TripLogger;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class TripLoggerController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers = User::all()->where('department_id',21);
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

        $driver = Auth::user()->name;
        $vehicles =  DB::select("SELECT * FROM `vehicles` WHERE assigned_driver = '$driver' ");
        $today = date('Y-m-d');
       // dd($today);
        $drivers = User::all()->where('department_id',21);
        $assignedProductions = DB::select("SELECT * FROM `schedules` WHERE driver = '$driver' AND start LIKE '%$today%'");
        return view('dashboard.logistics.triplogger.create',compact('drivers','vehicles','assignedProductions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


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
        $cc_emails = DB::select('SELECT email from users WHERE department_id = 21');
        $details = [
            'cc_emails' => $cc_emails,
            'email' => $triplogger->user->email,
            'title' => $triplogger->production_name,
            'status' =>  $triplogger->status,
            'body' =>  $triplogger->trip_information,
            'model' =>  'Trip logger ',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y')
        ];
        Event::dispatch(new RecordCreatedEvent($details));
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
        $driver = Auth::user()->name;
        $vehicles =  DB::select("SELECT * FROM `vehicles` WHERE assigned_driver = '$driver' ");
        return view('dashboard.logistics.triplogger.edit', compact('driver','triplogger','vehicles'));
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
    $cc_emails = DB::select('SELECT email from users WHERE department_id = 21');
        $details = [
            'cc_emails' => $cc_emails,
        'email' => $triplogger->user->email,
        'title' => $triplogger->production_name,
        'status' =>  $triplogger->status,
        'body' =>  $triplogger->trip_information,
        'model' =>  'Trip logger ',
        'user' => auth()->user()->name,
        'time' => date('d-m-Y')
    ];
    Event::dispatch(new RecordCreatedEvent($details));
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
