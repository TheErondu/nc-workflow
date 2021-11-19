<?php

namespace App\Http\Controllers\API;

use App\Models\TransmissionReport;
use App\Models\User;
use Illuminate\Http\Request;

class TransmissionReportController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tx_reports = TransmissionReport::all();
        return view('dashboard.reports.transmission.index', compact('tx_reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $users = User::all();
        return view('dashboard.reports.transmission.create',compact('users'));
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
            'tc_on_duty'                 => 'required',
            'first_interval'             => 'required',
            'second_interval'             => 'required',
            'third_interval'           => 'required',
            'closed_at'           => 'required'
        ]);

        $user = auth()->user();
        $tx_reports = new TransmissionReport();
        $tx_reports->tc_on_duty = $request->input('tc_on_duty');
        $tx_reports->first_interval = $request->input('first_interval');
        $tx_reports->second_interval = $request->input('second_interval');
        $tx_reports->third_interval = $request->input('third_interval');
        $tx_reports->remarks = $request->input('remarks');
        $tx_reports->closed_at = $request->input('closed_at');
        $tx_reports->user_id = $user->id;
        $tx_reports->save();
        $request->session()->flash('message', 'Successfully created Report');
        return redirect()->route('transmission.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reports  $reports
     * @return \Illuminate\Http\Response
     */
    public function show(Reports $reports)
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
        $tx_reports = TransmissionReport::all()->find($id);
        return view('dashboard.reports.transmission.edit', compact('tx_reports'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tc_on_duty'                 => 'required',
            'first_interval'             => 'required',
            'second_interval'             => 'required',
            'third_interval'           => 'required',
            'closed_at'           => 'required'
        ]);
        $user = auth()->user();
        $tx_reports = TransmissionReport::find($id);
        $tx_reports->tc_on_duty = $request->input('tc_on_duty');
        $tx_reports->first_interval = $request->input('first_interval');
        $tx_reports->second_interval = $request->input('second_interval');
        $tx_reports->third_interval = $request->input('third_interval');
        $tx_reports->remarks = $request->input('remarks');
        $tx_reports->closed_at = $request->input('closed_at');
        $tx_reports->user_id = $user->id;
        $tx_reports->save();
        $request->session()->flash('message', 'Successfully Edited Report');
        return redirect()->route('transmission.index');
    }

   /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $tx_reports = TransmissionReport::find($id);
        if($tx_reports){
            $tx_reports->delete();
        }
        return redirect()->route('transmission.index')->with('message', 'Successfully Deleted Report');

    }
}
