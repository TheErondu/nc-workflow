<?php

namespace App\Http\Controllers;

use App\Models\GraphicsLogs;
use App\Models\User;
use Illuminate\Http\Request;
use App\Events\RecordCreatedEvent;
use App\Events\RecordUpdatedEvent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class GraphicsLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $graphics_logs = GraphicsLogs::all();
        return view('dashboard.reports.graphics.news.index', compact('graphics_logs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $users = User::all();
        return view('dashboard.reports.graphics.news.create',compact('users'));
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
            // 'segment'             => 'required',
            // 'rundown_in'             => 'required',
            // 'script_in'             => 'required',
            // 'director'           => 'required',
            // 'graphics'           => 'required',
            // 'producer'         => 'required',
            // 'engineer'         => 'required',
            // 'pa'             => 'required',
            // 'challenges'             => 'required'
        ]);

        $user = auth()->user();
        $graphics_logs = new GraphicsLogs();
        $graphics_logs->segment = $request->input('segment');
        $graphics_logs->start =  date('Y-m-d H:i:s');
        $graphics_logs->end = date('Y-m-d H:i:s');
        $background_colors = array('#028336', '#ad2323', '#b1a514');
        $rand_background = $background_colors[array_rand($background_colors)];
        $graphics_logs->color = $rand_background;
        $graphics_logs->title = $request->input('segment');
        $graphics_logs->tags_in = $request->input('tags_in');
        $graphics_logs->anchor = $request->input('anchor');
        $graphics_logs->director = $request->input('director');
        $graphics_logs->host = $request->input('host');
        $graphics_logs->graphics = $request->input('graphics');
        $graphics_logs->producer = $request->input('producer');
        $graphics_logs->engineer = $request->input('engineer');
        $graphics_logs->pa = $request->input('pa');
        $graphics_logs->challenges = $request->input('challenges');
        $graphics_logs->segment2 = $request->input('segment2');
        $graphics_logs->tags_in2 = $request->input('tags_in2');
        $graphics_logs->anchor2 = $request->input('anchor2');
        $graphics_logs->director2 = $request->input('director2');
        $graphics_logs->host2 = $request->input('host2');
        $graphics_logs->graphics2 = $request->input('graphics2');
        $graphics_logs->producer2 = $request->input('producer2');
        $graphics_logs->engineer2 = $request->input('engineer2');
        $graphics_logs->pa2 = $request->input('pa2');
        $graphics_logs->challenges2 = $request->input('challenges2');
        $graphics_logs->segment3 = $request->input('segment3');
        $graphics_logs->tags_in3= $request->input('tags_in3');
        $graphics_logs->anchor3 = $request->input('anchor3');
        $graphics_logs->director3 = $request->input('director3');
        $graphics_logs->host3 = $request->input('host3');
        $graphics_logs->graphics3 = $request->input('graphics3');
        $graphics_logs->producer3 = $request->input('producer3');
        $graphics_logs->engineer3 = $request->input('engineer3');
        $graphics_logs->pa3 = $request->input('pa3');
        $graphics_logs->challenges2 = $request->input('challenges3');
        $graphics_logs->user_id = $user->id;
        $graphics_logs->save();
        $cc_emails = DB::select('SELECT email from users WHERE department_id = 11 OR department_id = 7 OR department_id = 13');
        $details = [
            'email' => $graphics_logs->user->email,
            'title' => $graphics_logs->segment,
            'status' =>  $graphics_logs->segment,
            'body' =>  $graphics_logs->challenges,
            'model' =>  'Prompter Logs',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y'),
            'cc_emails' => $cc_emails
        ];
        Event::dispatch(new RecordCreatedEvent($details));
        $request->session()->flash('message', 'Successfully created Log');
        return redirect()->route('graphics-news.index');
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
        $graphics_logs = GraphicsLogs::all()->find($id);
        $users = User::all();
        return view('dashboard.reports.graphics.news.edit', compact('graphics_logs','users'));
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
            // 'segment'             => 'required',
            // 'rundown_in'             => 'required',
            // 'script_in'             => 'required',
            // 'director'           => 'required',
            // 'graphics'           => 'required',
            // 'producer'         => 'required',
            // 'engineer'         => 'required',
            // 'pa'             => 'required',
            // 'challenges'             => 'required'
        ]);
        $user = auth()->user();
        $graphics_logs = GraphicsLogs::find($id);
        $graphics_logs->segment = $request->input('segment');
        $graphics_logs->start =  $graphics_logs->start;
        $graphics_logs->end = $graphics_logs->end;
        $background_colors = array('#028336', '#ad2323', '#b1a514');
        $rand_background = $background_colors[array_rand($background_colors)];
        $graphics_logs->color = $rand_background;
        $graphics_logs->title = $request->input('segment');
        $graphics_logs->tags_in = $request->input('tags_in');
        $graphics_logs->anchor = $request->input('anchor');
        $graphics_logs->director = $request->input('director');
        $graphics_logs->host = $request->input('host');
        $graphics_logs->graphics = $request->input('graphics');
        $graphics_logs->producer = $request->input('producer');
        $graphics_logs->engineer = $request->input('engineer');
        $graphics_logs->pa = $request->input('pa');
        $graphics_logs->challenges = $request->input('challenges');
        $graphics_logs->segment2 = $request->input('segment2');
        $graphics_logs->tags_in2 = $request->input('tags_in2');
        $graphics_logs->anchor2 = $request->input('anchor2');
        $graphics_logs->director2 = $request->input('director2');
        $graphics_logs->host2 = $request->input('host2');
        $graphics_logs->graphics2 = $request->input('graphics2');
        $graphics_logs->producer2 = $request->input('producer2');
        $graphics_logs->engineer2 = $request->input('engineer2');
        $graphics_logs->pa2 = $request->input('pa2');
        $graphics_logs->challenges2 = $request->input('challenges2');
        $graphics_logs->segment3 = $request->input('segment3');
        $graphics_logs->tags_in3= $request->input('tags_in3');
        $graphics_logs->anchor3 = $request->input('anchor3');
        $graphics_logs->director3 = $request->input('director3');
        $graphics_logs->host3 = $request->input('host3');
        $graphics_logs->graphics3 = $request->input('graphics3');
        $graphics_logs->producer3 = $request->input('producer3');
        $graphics_logs->engineer3 = $request->input('engineer3');
        $graphics_logs->pa3 = $request->input('pa3');
        $graphics_logs->challenges2 = $request->input('challenges3');
        $graphics_logs->user_id =  $graphics_logs->user_id;
        $graphics_logs->save();
        $cc_emails = DB::select('SELECT email from users WHERE department_id = 11 OR department_id = 7 OR department_id = 13');
        $details = [
            'cc_emails' => $cc_emails,
            'email' => $graphics_logs->user->email,
            'title' => $graphics_logs->segment,
            'status' =>  $graphics_logs->segment,
            'body' =>  $graphics_logs->challenges,
            'model' =>  'Graphics Logs (News)',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y')
        ];
        Event::dispatch(new RecordUpdatedEvent($details));
        $request->session()->flash('message', 'Successfully Edited Log');
        return redirect()->route('graphics-news.index');
    }

   /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $graphics_logs = GraphicsLogs::find($id);
        if($graphics_logs){
            $graphics_logs->delete();
        }
        return redirect()->route('graphics.index')->with('message', 'Successfully Deleted Log');

    }
}
