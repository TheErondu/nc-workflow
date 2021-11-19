<?php

namespace App\Http\Controllers\API;

use App\Models\Facility;
use App\Models\FacilityType;
use Illuminate\Http\Request;

class FacilityController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facilities = Facility::all();
        return view('dashboard.facility.index', compact('facilities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $facility_type = FacilityType::all();
        return view('dashboard.facility.create', compact('facility_type'));
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
            'name'             => 'required',
            'type'             => 'required'
        ]);

        $user = auth()->user();
        $facility = new Facility();
        $facility->name = $request->input('name');
        $facility->type = $request->input('type');
        $facility->type = $request->input('loaction');
        $facility->save();
        $request->session()->flash('message', 'Facility Added!');
        return redirect()->route('facility.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function show(Facility $facility)
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
    {
        $facility = Facility::find($id);
        $facility_type = FacilityType::all();
        return view('dashboard.facility.edit',compact('facility','facility_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name'             => 'required',
            'type'             => 'required'
        ]);

        $facility = Facility::find($id);
        $facility->name = $request->input('name');
        $facility->type = $request->input('type');
        $facility->location = $request->input('location');
        $facility->save();
        $request->session()->flash('message','Succesfully Updated Facility!');
        return redirect()->route('facility.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facility $facility)
    {
        $facility = Facility::find($facility);
        if($facility){
            $facility->delete();
        }
        return redirect()->route('facilty.index')->with('message', 'Successfully Deleted facility');

    }
}
