<?php

namespace App\Http\Controllers\API;

use App\Models\PrompterLogs;
use App\Models\User;
use Illuminate\Http\Request;
use App\Events\RecordCreatedEvent;
use App\Events\RecordUpdatedEvent;
use Illuminate\Support\Facades\Event;

class PrompterLogsController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prompter_logs = PrompterLogs::all();
        return response()->json( compact('prompter_logs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $users = User::all();
        return view('dashboard.reports.prompter.create',compact('users'));
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
            'segment'             => 'required',
            'rundown_in'             => 'required',
            'script_in'             => 'required',
            'director'           => 'required',
            'graphics'           => 'required',
            'producer'         => 'required',
            'engineer'         => 'required',
            'pa'             => 'required',
            'challenges'             => 'required'
        ]);

        $user = auth()->user();
        $prompter_logs = new PrompterLogsController();
        $prompter_logs->segment = $request->input('segment');
        $prompter_logs->rundown_in = $request->input('rundown_in');
        $prompter_logs->script_in = $request->input('script_in');
        $prompter_logs->anchor = $request->input('anchor');
        $prompter_logs->director = $request->input('director');
        $prompter_logs->host = $request->input('host');
        $prompter_logs->graphics = $request->input('graphics');
        $prompter_logs->producer = $request->input('producer');
        $prompter_logs->engineer = $request->input('engineer');
        $prompter_logs->pa = $request->input('pa');
        $prompter_logs->challenges = $request->input('challenges');
        $prompter_logs->user_id = $user->id;
        $prompter_logs->save();
        $details = [
            'email' => $prompter_logs->user->email,
            'title' => $prompter_logs->segment,
            'status' =>  $prompter_logs->segment,
            'body' =>  $prompter_logs->challenges,
            'model' =>  'Prompter Logs',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y')
        ];
        Event::dispatch(new RecordCreatedEvent($details));
        $request->session()->flash('message', 'Successfully created Log');
        return redirect()->route('prompter.index');
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
        $prompter_logs = PrompterLogs::all()->find($id);
        return view('dashboard.reports.prompter.edit', compact('prompter_logs'));
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
            'segment'             => 'required',
            'rundown_in'             => 'required',
            'script_in'             => 'required',
            'director'           => 'required',
            'graphics'           => 'required',
            'producer'         => 'required',
            'engineer'         => 'required',
            'pa'             => 'required',
            'challenges'             => 'required'
        ]);
        $user = auth()->user();
        $prompter_logs = PrompterLogs::find($id);
        $prompter_logs->segment = $request->input('segment');
        $prompter_logs->rundown_in = $request->input('rundown_in');
        $prompter_logs->script_in = $request->input('script_in');
        $prompter_logs->anchor = $request->input('anchor');
        $prompter_logs->director = $request->input('director');
        $prompter_logs->host = $request->input('host');
        $prompter_logs->graphics = $request->input('graphics');
        $prompter_logs->producer = $request->input('producer');
        $prompter_logs->engineer = $request->input('engineer');
        $prompter_logs->pa = $request->input('pa');
        $prompter_logs->challenges = $request->input('challenges');
        $prompter_logs->user_id = $user->id;
        $prompter_logs->save();
        $details = [
            'email' => $prompter_logs->user->email,
            'title' => $prompter_logs->segment,
            'status' =>  $prompter_logs->segment,
            'body' =>  $prompter_logs->challenges,
            'model' =>  'Prompter Logs',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y')
        ];
        Event::dispatch(new RecordUpdatedEvent($details));
        $request->session()->flash('message', 'Successfully Edited Log');
        return redirect()->route('prompter.index');
    }

   /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $prompter_logs = PrompterLogs::find($id);
        if($prompter_logs){
            $prompter_logs->delete();
        }
        return redirect()->route('prompter.index')->with('message', 'Successfully Deleted Log');

    }
}
