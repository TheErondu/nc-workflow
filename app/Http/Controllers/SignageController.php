<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class SignageController extends Controller
{

    public function showBookings()
    {
        $display = request()->get('display')??0;
        $today = Carbon::today()->isoFormat('YYYY-MM-DD hh:mm:ss');
        $schedules = Schedule::where('id', '>',0)->paginate(6);
        switch($display){
            case 1:
                return view('dashboard.signage.display1', compact('schedules'));
            case 2:
                return view('dashboard.signage.display2', compact('schedules'));
            default:
            return view('dashboard.signage.display1', compact('schedules'));
        }
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
