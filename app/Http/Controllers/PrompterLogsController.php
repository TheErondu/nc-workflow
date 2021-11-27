<?php

namespace App\Http\Controllers;

use App\Models\PrompterLogs;
use App\Models\User;
use Illuminate\Http\Request;
use App\Events\RecordCreatedEvent;
use App\Events\RecordUpdatedEvent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class PrompterLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prompter_logs = PrompterLogs::all();
        return view('dashboard.reports.prompter.news.index', compact('prompter_logs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $users = User::all();
        return view('dashboard.reports.prompter.news.create',compact('users'));
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
        $prompter_logs = new PrompterLogs();
        $prompter_logs->segment = $request->input('segment');
        $prompter_logs->start =  date('Y-m-d H:i:s');
        $prompter_logs->end = date('Y-m-d H:i:s');
        $background_colors = array('#028336', '#ad2323', '#b1a514');
        $rand_background = $background_colors[array_rand($background_colors)];
        $prompter_logs->color = $rand_background;
        $prompter_logs->title = $request->input('segment');
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
        $prompter_logs->segment2 = $request->input('segment2');
        $prompter_logs->rundown_in2 = $request->input('rundown_in2');
        $prompter_logs->script_in2 = $request->input('script_in2');
        $prompter_logs->anchor2 = $request->input('anchor2');
        $prompter_logs->director2 = $request->input('director2');
        $prompter_logs->host2 = $request->input('host2');
        $prompter_logs->graphics2 = $request->input('graphics2');
        $prompter_logs->producer2 = $request->input('producer2');
        $prompter_logs->engineer2 = $request->input('engineer2');
        $prompter_logs->pa2 = $request->input('pa2');
        $prompter_logs->challenges2 = $request->input('challenges2');
        $prompter_logs->segment3 = $request->input('segment3');
        $prompter_logs->rundown_in3 = $request->input('rundown_in3');
        $prompter_logs->script_in3 = $request->input('script_in3');
        $prompter_logs->anchor3 = $request->input('anchor3');
        $prompter_logs->director3 = $request->input('director3');
        $prompter_logs->host3 = $request->input('host3');
        $prompter_logs->graphics3 = $request->input('graphics3');
        $prompter_logs->producer3 = $request->input('producer3');
        $prompter_logs->engineer3 = $request->input('engineer3');
        $prompter_logs->pa3 = $request->input('pa3');
        $prompter_logs->challenges3 = $request->input('challenges3');
        $prompter_logs->user_id = $user->id;
        $prompter_logs->save();
        $cc_emails = DB::select('SELECT email from users WHERE department_id = 11 OR department_id = 7 OR department_id = 13');
        $details = [
            'email' => $prompter_logs->user->email,
            'title' => $prompter_logs->segment,
            'status' =>  $prompter_logs->segment,
            'body' =>  $prompter_logs->challenges,
            'model' =>  'Prompter Logs',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y'),
            'cc_emails' => $cc_emails
        ];
        Event::dispatch(new RecordCreatedEvent($details));
        $request->session()->flash('message', 'Successfully created Log');
        return redirect()->route('prompter-news.index');
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
        $users = User::all();
        return view('dashboard.reports.prompter.news.edit', compact('prompter_logs','users'));
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
        $prompter_logs = PrompterLogs::find($id);
        $prompter_logs->segment = $request->input('segment');
        $prompter_logs->start =  $prompter_logs->start;
        $prompter_logs->end = $prompter_logs->end;
        $background_colors = array('#028336', '#ad2323', '#b1a514');
        $rand_background = $background_colors[array_rand($background_colors)];
        $prompter_logs->color = $rand_background;
        $prompter_logs->title = $request->input('segment');
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
        $prompter_logs->segment2 = $request->input('segment2');
        $prompter_logs->rundown_in2 = $request->input('rundown_in2');
        $prompter_logs->script_in2 = $request->input('script_in2');
        $prompter_logs->anchor2 = $request->input('anchor2');
        $prompter_logs->director2 = $request->input('director2');
        $prompter_logs->host2 = $request->input('host2');
        $prompter_logs->graphics2 = $request->input('graphics2');
        $prompter_logs->producer2 = $request->input('producer2');
        $prompter_logs->engineer2 = $request->input('engineer2');
        $prompter_logs->pa2 = $request->input('pa2');
        $prompter_logs->challenges2 = $request->input('challenges2');
        $prompter_logs->segment3 = $request->input('segment3');
        $prompter_logs->rundown_in3 = $request->input('rundown_in3');
        $prompter_logs->script_in3 = $request->input('script_in3');
        $prompter_logs->anchor3 = $request->input('anchor3');
        $prompter_logs->director3 = $request->input('director3');
        $prompter_logs->host3 = $request->input('host3');
        $prompter_logs->graphics3 = $request->input('graphics3');
        $prompter_logs->producer3 = $request->input('producer3');
        $prompter_logs->engineer3 = $request->input('engineer3');
        $prompter_logs->pa3 = $request->input('pa3');
        $prompter_logs->challenges3 = $request->input('challenges3');
        $prompter_logs->user_id = $user->id;
        $prompter_logs->save();
        $cc_emails = DB::select('SELECT email from users WHERE department_id = 11 OR department_id = 7 OR department_id = 13');
        $details = [
            'cc_emails' => $cc_emails,
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
        return redirect()->route('prompter-news.index');
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
        return redirect()->route('prompter-news.index')->with('message', 'Successfully Deleted Log');

    }
}
