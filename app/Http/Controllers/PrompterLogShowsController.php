<?php

namespace App\Http\Controllers;

use App\Models\PrompterLogShows;
use App\Models\User;
use Illuminate\Http\Request;
use App\Events\RecordCreatedEvent;
use App\Events\RecordUpdatedEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class PrompterLogShowsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prompter_logs_shows = PrompterLogShows::all();
        return view('dashboard.reports.prompter.shows.index', compact('prompter_logs_shows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $users = User::all();
        return view('dashboard.reports.prompter.shows.create',compact('users'));
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
        $prompter_logs_shows = new PrompterLogShows();
        $prompter_logs_shows->segment = $request->input('segment');
        $prompter_logs_shows->start =  date('Y-m-d H:i:s');
        $prompter_logs_shows->end = date('Y-m-d H:i:s');
        $background_colors = array('#028336', '#ad2323', '#b1a514');
        $rand_background = $background_colors[array_rand($background_colors)];
        $prompter_logs_shows->color = $rand_background;
        $prompter_logs_shows->title = $request->input('segment');
        $prompter_logs_shows->rundown_in = $request->input('rundown_in');
        $prompter_logs_shows->script_in = $request->input('script_in');
        $prompter_logs_shows->anchor = $request->input('anchor');
        $prompter_logs_shows->director = $request->input('director');
        $prompter_logs_shows->host = $request->input('host');
        $prompter_logs_shows->graphics = $request->input('graphics');
        $prompter_logs_shows->producer = $request->input('producer');
        $prompter_logs_shows->engineer = $request->input('engineer');
        $prompter_logs_shows->pa = $request->input('pa');
        $prompter_logs_shows->challenges = $request->input('challenges');
        $prompter_logs_shows->segment2 = $request->input('segment2');
        $prompter_logs_shows->rundown_in2 = $request->input('rundown_in2');
        $prompter_logs_shows->script_in2 = $request->input('script_in2');
        $prompter_logs_shows->anchor2 = $request->input('anchor2');
        $prompter_logs_shows->director2 = $request->input('director2');
        $prompter_logs_shows->host2 = $request->input('host2');
        $prompter_logs_shows->graphics2 = $request->input('graphics2');
        $prompter_logs_shows->producer2 = $request->input('producer2');
        $prompter_logs_shows->engineer2 = $request->input('engineer2');
        $prompter_logs_shows->pa2 = $request->input('pa2');
        $prompter_logs_shows->challenges2 = $request->input('challenges2');
        $prompter_logs_shows->user_id = $user->id;
        $prompter_logs_shows->save();
        $cc_emails = DB::select('SELECT email from users WHERE department_id = 11 OR department_id = 7 OR department_id = 13');
        $details = [
            'email' => $prompter_logs_shows->user->email,
            'title' => $prompter_logs_shows->segment,
            'status' =>  $prompter_logs_shows->segment,
            'body' =>  $prompter_logs_shows->challenges,
            'model' =>  'Prompter Logs',
            'user' => $user->name,
            'time' => date('d-m-Y'),
            'cc_emails' => $cc_emails
        ];
        Event::dispatch(new RecordCreatedEvent($details));
        $request->session()->flash('message', 'Successfully created Log');
        return redirect()->route('prompter-shows.index');
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
        $prompter_logs_shows = PrompterLogShows::all()->find($id);
        $users = User::all();
        return view('dashboard.reports.prompter.shows.edit', compact('prompter_logs_shows','users'));
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
        $prompter_logs_shows = PrompterLogShows::find($id);
        $prompter_logs_shows->segment = $request->input('segment');
        $prompter_logs_shows->start =  $prompter_logs_shows->start;
        $prompter_logs_shows->end = $prompter_logs_shows->end;
        $background_colors = array('#028336', '#ad2323', '#b1a514');
        $rand_background = $background_colors[array_rand($background_colors)];
        $prompter_logs_shows->color = $rand_background;
        $prompter_logs_shows->title = $request->input('segment');
        $prompter_logs_shows->rundown_in = $request->input('rundown_in');
        $prompter_logs_shows->script_in = $request->input('script_in');
        $prompter_logs_shows->anchor = $request->input('anchor');
        $prompter_logs_shows->director = $request->input('director');
        $prompter_logs_shows->host = $request->input('host');
        $prompter_logs_shows->graphics = $request->input('graphics');
        $prompter_logs_shows->producer = $request->input('producer');
        $prompter_logs_shows->engineer = $request->input('engineer');
        $prompter_logs_shows->pa = $request->input('pa');
        $prompter_logs_shows->challenges = $request->input('challenges');
        $prompter_logs_shows->segment2 = $request->input('segment2');
        $prompter_logs_shows->rundown_in2 = $request->input('rundown_in2');
        $prompter_logs_shows->script_in2 = $request->input('script_in2');
        $prompter_logs_shows->anchor2 = $request->input('anchor2');
        $prompter_logs_shows->director2 = $request->input('director2');
        $prompter_logs_shows->host2 = $request->input('host2');
        $prompter_logs_shows->graphics2 = $request->input('graphics2');
        $prompter_logs_shows->producer2 = $request->input('producer2');
        $prompter_logs_shows->engineer2 = $request->input('engineer2');
        $prompter_logs_shows->pa2 = $request->input('pa2');
        $prompter_logs_shows->challenges2 = $request->input('challenges2');
        $prompter_logs_shows->user_id = $user->id;
        $prompter_logs_shows->save();
        $cc_emails = DB::select('SELECT email from users WHERE department_id = 11 OR department_id = 7 OR department_id = 13');
        $details = [
            'cc_emails' => $cc_emails,
            'email' => $prompter_logs_shows->user->email,
            'title' => $prompter_logs_shows->segment,
            'status' =>  $prompter_logs_shows->segment,
            'body' =>  $prompter_logs_shows->challenges,
            'model' =>  'Prompter Logs',
            'user' => $user->name,
            'time' => date('d-m-Y')
        ];
        Event::dispatch(new RecordUpdatedEvent($details));
        $request->session()->flash('message', 'Successfully Edited Log');
        return redirect()->route('prompter-shows.index');
    }

   /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $prompter_logs_shows = PrompterLogShows::find($id);
        if($prompter_logs_shows){
            $prompter_logs_shows->delete();
        }
        return redirect()->route('prompter-shows.index')->with('message', 'Successfully Deleted Log');

    }
}
