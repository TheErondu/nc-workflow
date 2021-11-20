<?php

namespace App\Http\Controllers\API;

use App\Models\Humans;
use Illuminate\Http\Request;

class HumansController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.humans.index');
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
     * @param  \App\Models\Humans  $humans
     * @return \Illuminate\Http\Response
     */
    public function show(Humans $humans)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Humans  $humans
     * @return \Illuminate\Http\Response
     */
    public function edit(Humans $humans)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Humans  $humans
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Humans $humans)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Humans  $humans
     * @return \Illuminate\Http\Response
     */
    public function destroy(Humans $humans)
    {
        //
    }
}
