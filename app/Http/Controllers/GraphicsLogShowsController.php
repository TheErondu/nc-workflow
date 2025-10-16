<?php

namespace App\Http\Controllers;

use App\Models\GraphicsLogShows;
use App\Models\User;
use Illuminate\Http\Request;
use App\Events\RecordCreatedEvent;
use App\Events\RecordUpdatedEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class GraphicsLogShowsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $graphics_log_shows = GraphicsLogShows::all();
        return view('dashboard.reports.graphics.shows.index', compact('graphics_log_shows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $users = User::all();
        return view('dashboard.reports.graphics.shows.create',compact('users'));
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

        $user = Auth::user();
        $graphics_log_shows = new GraphicsLogShows();
        $graphics_log_shows->segment = $request->input('segment');
        $graphics_log_shows->start =  date('Y-m-d H:i:s');
        $graphics_log_shows->end = date('Y-m-d H:i:s');
        $background_colors = array('#028336', '#ad2323', '#b1a514');
        $rand_background = $background_colors[array_rand($background_colors)];
        $graphics_log_shows->color = $rand_background;
        $graphics_log_shows->title = $request->input('segment');
        $graphics_log_shows->tags_in = $request->input('tags_in');
        $graphics_log_shows->anchor = $request->input('anchor');
        $graphics_log_shows->director = $request->input('director');
        $graphics_log_shows->host = $request->input('host');
        $graphics_log_shows->graphics = $request->input('graphics');
        $graphics_log_shows->producer = $request->input('producer');
        $graphics_log_shows->engineer = $request->input('engineer');
        $graphics_log_shows->pa = $request->input('pa');
        $graphics_log_shows->challenges = $request->input('challenges');
        $graphics_log_shows->segment2 = $request->input('segment2');
        $graphics_log_shows->tags_in2 = $request->input('tags_in2');
        $graphics_log_shows->anchor2 = $request->input('anchor2');
        $graphics_log_shows->director2 = $request->input('director2');
        $graphics_log_shows->host2 = $request->input('host2');
        $graphics_log_shows->graphics2 = $request->input('graphics2');
        $graphics_log_shows->producer2 = $request->input('producer2');
        $graphics_log_shows->engineer2 = $request->input('engineer2');
        $graphics_log_shows->pa2 = $request->input('pa2');
        $graphics_log_shows->challenges2 = $request->input('challenges2');
        $graphics_log_shows->segment3 = $request->input('segment3');
        $graphics_log_shows->tags_in3= $request->input('tags_in3');
        $graphics_log_shows->anchor3 = $request->input('anchor3');
        $graphics_log_shows->director3 = $request->input('director3');
        $graphics_log_shows->host3 = $request->input('host3');
        $graphics_log_shows->graphics3 = $request->input('graphics3');
        $graphics_log_shows->producer3 = $request->input('producer3');
        $graphics_log_shows->engineer3 = $request->input('engineer3');
        $graphics_log_shows->pa3 = $request->input('pa3');
        $graphics_log_shows->challenges2 = $request->input('challenges3');
        $graphics_log_shows->user_id = $user->id;
        $graphics_log_shows->save();
        $cc_emails = DB::select('SELECT email from users WHERE department_id = 11 OR department_id = 7 OR department_id = 13');
        $details = [
            'email' => $graphics_log_shows->user->email,
            'title' => $graphics_log_shows->segment,
            'status' =>  $graphics_log_shows->segment,
            'body' =>  $graphics_log_shows->challenges,
            'model' =>  'Prompter Logs',
            'user' => $user->name,
            'time' => date('d-m-Y'),
            'cc_emails' => $cc_emails
        ];
        Event::dispatch(new RecordCreatedEvent($details));
        $request->session()->flash('message', 'Successfully created Log');
        return redirect()->route('graphics-shows.index');
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
        $graphics_log_shows = GraphicsLogShows::all()->find($id);
        $users = User::all();
        return view('dashboard.reports.graphics.shows.edit', compact('graphics_log_shows','users'));
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
        $user = Auth::user();
        $graphics_log_shows = GraphicsLogShows::find($id);
        $graphics_log_shows->segment = $request->input('segment');
        $graphics_log_shows->start =  $graphics_log_shows->start;
        $graphics_log_shows->end = $graphics_log_shows->end;
        $background_colors = array('#028336', '#ad2323', '#b1a514');
        $rand_background = $background_colors[array_rand($background_colors)];
        $graphics_log_shows->color = $rand_background;
        $graphics_log_shows->title = $request->input('segment');
        $graphics_log_shows->tags_in = $request->input('tags_in');
        $graphics_log_shows->anchor = $request->input('anchor');
        $graphics_log_shows->director = $request->input('director');
        $graphics_log_shows->host = $request->input('host');
        $graphics_log_shows->graphics = $request->input('graphics');
        $graphics_log_shows->producer = $request->input('producer');
        $graphics_log_shows->engineer = $request->input('engineer');
        $graphics_log_shows->pa = $request->input('pa');
        $graphics_log_shows->challenges = $request->input('challenges');
        $graphics_log_shows->segment2 = $request->input('segment2');
        $graphics_log_shows->tags_in2 = $request->input('tags_in2');
        $graphics_log_shows->anchor2 = $request->input('anchor2');
        $graphics_log_shows->director2 = $request->input('director2');
        $graphics_log_shows->host2 = $request->input('host2');
        $graphics_log_shows->graphics2 = $request->input('graphics2');
        $graphics_log_shows->producer2 = $request->input('producer2');
        $graphics_log_shows->engineer2 = $request->input('engineer2');
        $graphics_log_shows->pa2 = $request->input('pa2');
        $graphics_log_shows->challenges2 = $request->input('challenges2');
        $graphics_log_shows->segment3 = $request->input('segment3');
        $graphics_log_shows->tags_in3= $request->input('tags_in3');
        $graphics_log_shows->anchor3 = $request->input('anchor3');
        $graphics_log_shows->director3 = $request->input('director3');
        $graphics_log_shows->host3 = $request->input('host3');
        $graphics_log_shows->graphics3 = $request->input('graphics3');
        $graphics_log_shows->producer3 = $request->input('producer3');
        $graphics_log_shows->engineer3 = $request->input('engineer3');
        $graphics_log_shows->pa3 = $request->input('pa3');
        $graphics_log_shows->challenges2 = $request->input('challenges3');
        $graphics_log_shows->user_id = $graphics_log_shows->user_id;
        $graphics_log_shows->save();
        $cc_emails = DB::select('SELECT email from users WHERE department_id = 11 OR department_id = 7 OR department_id = 13');
        $details = [
            'cc_emails' => $cc_emails,
            'email' => $graphics_log_shows->user->email,
            'title' => $graphics_log_shows->segment,
            'status' =>  $graphics_log_shows->segment,
            'body' =>  $graphics_log_shows->challenges,
            'model' =>  'Prompter Logs',
            'user' => $user->name,
            'time' => date('d-m-Y')
        ];
        Event::dispatch(new RecordUpdatedEvent($details));
        $request->session()->flash('message', 'Successfully Edited Log');
        return redirect()->route('graphics-shows.index');
    }

   /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $graphics_log_shows = GraphicsLogShows::find($id);
        if($graphics_log_shows){
            $graphics_log_shows->delete();
        }
        return redirect()->route('graphics-shows.index')->with('message', 'Successfully Deleted Log');

    }
}
