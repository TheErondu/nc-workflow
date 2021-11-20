<?php

namespace App\Http\Controllers\API;
use App\Models\User;
use App\Models\McrLogs;
use Illuminate\Http\Request;
use App\Events\RecordCreatedEvent;
Use App\Events\RecordUpdatedEvent;
use Illuminate\Support\Facades\Event;


class McrLogsController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mcr_logs = McrLogs::all();
        return response()->json(compact('mcr_logs'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $users = User::all();
        return view('dashboard.reports.mcrlogs.create',compact('users'));
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
            'sto'             => 'required',
            'timing'             => 'required',
            'programmes'           => 'required',
            'remarks'           => 'required',
            'squeezbacks'           => 'required',
            'tc'           => 'required',
            'traffic'         => 'required',
            'handed_over_to'         => 'required',
        ]);

        $user = auth()->user();
        $mcr_logs = new McrLogs();
        $mcr_logs->sto = $request->input('sto');
        $mcr_logs->timing = $request->input('timing');
        $mcr_logs->programmes = $request->input('programmes');
        $mcr_logs->remarks = $request->input('remarks');
        $mcr_logs->squeezbacks = $request->input('squeezbacks');
        $mcr_logs->tc = $request->input('tc');
        $mcr_logs->traffic = $request->input('traffic');
        $mcr_logs->handed_over_to = $request->input('handed_over_to');
        $mcr_logs->user_id = $user->id;
        $mcr_logs->save();
        $request->session()->flash('message', 'Successfully created Report');
        return redirect()->route('mcr.index');
        $details = [
            'title' => $mcr_logs->remarks,
            'status' =>  $mcr_logs->handed_over_to,
            'body' =>  $mcr_logs->deescription,
            'model' =>  'MCR Logs',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y')
        ];
        Event::dispatch(new RecordCreatedEvent($details));
    }

    /**
     * Show the form for editing the specified resource.
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
        $mcr_logs = McrLogs::all()->find($id);
        $users = User::all();
        return view('dashboard.reports.mcrlogs.edit', compact('mcr_logs','users'));
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
            'sto'             => 'required',
            'timing'             => 'required',
            'programmes'           => 'required',
            'remarks'           => 'required',
            'squeezbacks'           => 'required',
            'tc'           => 'required',
            'traffic'         => 'required',
            'handed_over_to'         => 'required',
        ]);
        $user = auth()->user();
        $mcr_logs = McrLogs::find($id);
        $mcr_logs->sto = $request->input('sto');
        $mcr_logs->timing = $request->input('timing');
        $mcr_logs->programmes = $request->input('programmes');
        $mcr_logs->remarks = $request->input('remarks');
        $mcr_logs->squeezbacks = $request->input('squeezbacks');
        $mcr_logs->tc = $request->input('tc');
        $mcr_logs->traffic = $request->input('traffic');
        $mcr_logs->handed_over_to = $request->input('handed_over_to');
        $mcr_logs->user_id = $user->id;

        $mcr_logs->save();
        $details = [
            'email' => $mcr_logs->user->email,
            'title' => $mcr_logs->remarks,
            'status' =>  $mcr_logs->handed_over_to,
            'body' =>  $mcr_logs->description,
            'model' =>  'MCR Logs',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y')
        ];
        Event::dispatch(new RecordUpdatedEvent($details));
        $request->session()->flash('message', 'Successfully Edited Log');

        return redirect()->route('mcr.index');

    }

   /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $mcr_logs = McrLogs::find($id);
        if($mcr_logs){
            $mcr_logs->delete();
        }
        return redirect()->route('mcrlogs.index')->with('message', 'Successfully Deleted Report');

    }
}
