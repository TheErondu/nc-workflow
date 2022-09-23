<?php

namespace App\Http\Controllers;

use App\Models\Dutylogger;
use Illuminate\Http\Request;

class DutyloggerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.dutylogger.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dutylogger  $dutylogger
     * @return \Illuminate\Http\Response
     */
    public function show(Dutylogger $dutylogger)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dutylogger  $dutylogger
     * @return \Illuminate\Http\Response
     */
    public function edit(Dutylogger $dutylogger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dutylogger  $dutylogger
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dutylogger $dutylogger)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dutylogger  $dutylogger
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dutylogger $dutylogger)
    {
        //
    }
}
