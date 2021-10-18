<?php

namespace App\Http\Controllers;

use App\Models\FacilityType;
use Illuminate\Http\Request;

class FacilityTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.facility.types.create');
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
        ]);
        $type = new FacilityType();
        $type->name = $request->input('name');
        $type->save();
        $request->session()->flash('message', 'Successfully created type');
        return redirect()->route('facility.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FacilityType  $facilityType
     * @return \Illuminate\Http\Response
     */
    public function show(FacilityType $facilityType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FacilityType  $facilityType
     * @return \Illuminate\Http\Response
     */
    public function edit(FacilityType $facilityType)
    {
        $facilityType = FacilityType::find($facilityType);
        return view('dashboard.facility.types.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FacilityType  $facilityType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FacilityType $facilityType)
    {
        $validatedData = $request->validate([
            'name'             => 'required',
        ]);
        $type = FacilityType::find($facilityType);
        $type->name = $request->input('name');
        $type->save();
        $request->session()->flash('message', 'Successfully created type');
        return redirect()->route('facility.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FacilityType  $facilityType
     * @return \Illuminate\Http\Response
     */
    public function destroy(FacilityType $facilityType)
    {
        //
    }
}
