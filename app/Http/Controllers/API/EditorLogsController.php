<?php

namespace App\Http\Controllers\API;

use App\Models\EditorLogs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use App\Events\RecordCreatedEvent;
use App\Events\RecordUpdatedEvent;

class EditorLogsController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $editors_logs = EditorLogs::all();
        return response()->json( compact('editors_logs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $users = User::all();
        return view('dashboard.reports.editors.create',compact('users'));
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
            'first_interval'             => 'required',
            'second_interval'             => 'required',
            'third_interval'           => 'required',
            'closed_at'           => 'required'
        ]);

        $user = auth()->user();
        $editors_logs = new EditorLogs();
        $editors_logs->first_interval = $request->input('first_interval');
        $editors_logs->second_interval = $request->input('second_interval');
        $editors_logs->third_interval = $request->input('third_interval');
        $editors_logs->closed_at = $request->input('closed_at');
        $editors_logs->user_id = $user->id;
        $editors_logs->save();
        $details = [
            'title' => $editors_logs->title,
            'status' =>  $editors_logs->status,
            'body' =>  $editors_logs->deescription,
            'model' =>  'Editor Logs',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y')
        ];
        Event::dispatch(new RecordCreatedEvent($details));
        $request->session()->flash('message', 'Successfully created Report');
        return redirect()->route('editors.index');
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\Reports  $reports
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Reports $reports)
    // {
    //     //
    // }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editors_logs = EditorLogs::all()->find($id);
        return view('dashboard.reports.editors.edit', compact('editors_logs'));
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
            'first_interval'             => 'required',
            'second_interval'             => 'required',
            'third_interval'           => 'required',
            'closed_at'           => 'required'
        ]);
        $user = auth()->user();
        $editors_logs = EditorLogs::find($id);
        $editors_logs->first_interval = $request->input('first_interval');
        $editors_logs->second_interval = $request->input('second_interval');
        $editors_logs->third_interval = $request->input('third_interval');
        $editors_logs->closed_at = $request->input('closed_at');
        $editors_logs->user_id = $user->id;
        $editors_logs->save();
        $request->session()->flash('message', 'Successfully Edited Log');
        return redirect()->route('editors.index');
        $details = [
            'title' => $editors_logs->title,
            'status' =>  $editors_logs->status,
            'body' =>  $editors_logs->deescription,
            'model' =>  'Editor Logs',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y')
        ];
        Event::dispatch(new RecordCreatedEvent($details));
    }

   /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $editors_logs = EditorLogs::find($id);
        if($editors_logs){
            $editors_logs->delete();
        }
        return redirect()->route('editors.index')->with('message', 'Successfully Deleted Report');

    }
}
