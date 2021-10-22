<?php

namespace App\Http\Controllers;

use App\Models\Tracker;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;

class TrackerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $vehicles = Vehicle::all();

        $last_odometer_reading = DB::table('trackers')->orderBy('id', 'DESC')->first('odometer_reading');
        return view('dashboard.logistics.tracker.index', compact('vehicles','last_odometer_reading'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehicles = Vehicle::all();
        $mileage_trackers = Tracker::all();
        return view('dashboard.logistics.tracker.create', compact('vehicles','mileage_trackers'));
    }

   /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {
     $validatedData = $request->validate([
            'vehicle_id'             => 'required',
            'odometer_reading'             => 'required',
            'refuel_date'           => 'required',
            'fuel_added'           => 'required',
            'fuel_cost'           => 'required',
        ]);

        $user = auth()->user();
        $tracker = new Tracker();
        $tracker->vehicle_id = $request->input('vehicle_id');
        $tracker->odometer_reading = $request->input('odometer_reading');
        $tracker->refuel_date = $request->input('refuel_date');
        $tracker->fuel_added = $request->input('fuel_added');
        $tracker->fuel_cost = $request->input('fuel_cost');
        $tracker->last_odometer_reading = $request->input('last_odometer_reading');
        // if (Tracker::all()->count() === 0){
        // $tracker->kilometres =$request->input('odometer_reading');
        // }
        // if (Tracker::where('vehicle_id',$request->input('vehicle_id'))->count() === 0){
        //     $tracker->kilometres =$request->input('odometer_reading');
        //     }
        // if (Tracker::where('vehicle_id',$request->input('vehicle_id'))->count() > 0){
        // $tracker->kilometres =$request->input('odometer_reading') - $last_odometer_reading;
        // }
        // $tracker->cost_per_litre =$request->input('fuel_cost') / $request->input('fuel_added');
        // $tracker->mileage = $tracker->kilometres / $tracker->fuel_added;
        // $tracker->cost_per_km =$request->input('fuel_cost') / $tracker->kilometres;
        $tracker->user_id = $user->id;
        $tracker->save();
        $request->session()->flash('message', 'Mileage Tracker added Successfully!');
        return redirect()->route('tracker.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tracker  $tracker
     * @return \Illuminate\Http\Response
     */
    public function show(Tracker $tracker)
    {
        //
    }

   /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   $tracker = Tracker::all()->find($id);
        $vehicles = Vehicle::all();
        return view('dashboard.logistics.tracker.edit',compact('vehicles','tracker'));
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function track($id)
    {
        $vehicle = Vehicle::all()->find($id);
        $vehicles = Vehicle::all();
        $tracker = Tracker::all()->find($id);
        $last_odometer_reading = DB::table('trackers')->orderBy('id', 'DESC')->first('odometer_reading');
        $mileage_trackers = Tracker::where('vehicle_id',$vehicle->id)->get();
        $dates = Tracker::where('vehicle_id',$vehicle->id)->pluck('refuel_date');
        $cost_per_km = Tracker::where('vehicle_id',$vehicle->id)->pluck('cost_per_km');
        $cost_per_litre = Tracker::where('vehicle_id',$vehicle->id)->pluck('cost_per_litre');
        $mileage =  Tracker::where('vehicle_id',$vehicle->id)->pluck('mileage');

        return view('dashboard.logistics.tracker.track',compact('vehicle','vehicles','tracker','mileage_trackers','dates','mileage','cost_per_km','cost_per_litre'));
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {

        $validatedData = $request->validate([
            'vehicle_id'             => 'required',
            'odometer_reading'             => 'required',
            'refuel_date'           => 'required',
            'fuel_added'           => 'required',
            'fuel_cost'           => 'required',
        ]);
        $tracker = Tracker::find($id);
        $user = auth()->user();
        $tracker->vehicle_id = $request->input('vehicle_id');
        $tracker->odometer_reading = $request->input('odometer_reading');
        $tracker->refuel_date = $request->input('refuel_date');
        $tracker->fuel_added = $request->input('fuel_added');
        $tracker->fuel_cost = $request->input('fuel_cost');
        $tracker->user_id = $user->id;
        $tracker->save();
        $request->session()->flash('message', 'Tracker Updated!');
        return redirect()->route('tracker.index');
    }

   /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $tracker = Tracker::find($id);
        if($tracker){
            $tracker->delete();
        }
        return redirect()->route('tracker.index')->with('message', 'Successfully Deleted Tracker!');

    }

}
