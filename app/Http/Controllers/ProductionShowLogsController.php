<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ProductionShowLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use App\Events\RecordUpdatedEvent;
use App\Events\RecordCreatedEvent;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductionShowLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
            $production_logs = ProductionShowLogs::all();
        return view('dashboard.reports.production_logs.index', compact('production_logs'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $users = User::all();
        return view('dashboard.reports.production_logs.create', compact('users'));
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
            'show_name'             => 'required',
            // 'location'             => 'required',
            // 'producer1'           => 'required',
            // 'producer2'           => 'required',
            // 'director'           => 'required',
            // 'vision_mixer'           => 'required',
            // 'engineer'         => 'required',
            // 'sound_technician'         => 'required',
            // 'camera_operator1'           => 'required',
            // 'camera_operator2'           => 'required',
            // 'host'           => 'required',
            // 'graphics'         => 'required',
            // 'digital'         => 'required',
            // 'transmission'           => 'required',
            // 'transmission_time'           => 'required'
        ]);

        $user = Auth::user();
        $production_logs = new ProductionShowLogs();
        $production_logs->show_name = $request->input('show_name');
        $production_logs->date = $request->input('date');
        $production_logs->start =  $request->input('date');
        $production_logs->end = $request->input('date');
        $background_colors = array('#028336', '#ad2323', '#b1a514');
        $rand_background = $background_colors[array_rand($background_colors)];
        $production_logs->color = $rand_background;
        $production_logs->title = $request->input('show_name');
        $production_logs->location = $request->input('location');
        $production_logs->producer1 = $request->input('producer1');
        $production_logs->producer2 = $request->input('producer2');
        $production_logs->director = $request->input('director');
        $production_logs->vision_mixer = $request->input('vision_mixer');
        $production_logs->engineer = $request->input('engineer');
        $production_logs->sound_technician = $request->input('sound_technician');
        $production_logs->camera_operator1 = $request->input('camera_operator1');
        $production_logs->camera_operator2 = $request->input('camera_operator2');
        $production_logs->host = $request->input('host');
        $production_logs->graphics = $request->input('graphics');
        $production_logs->digital = $request->input('digital');
        $production_logs->transmission = $request->input('transmission');
        $production_logs->transmission_time = $request->input('transmission_time');
        $production_logs->comment = $request->input('comment');
        $production_logs->user_id = $user->id;
        $production_logs->save();

        $cc_emails = DB::select('SELECT email from users WHERE department_id = 11 OR department_id = 7 OR department_id = 13');
        $details = [
            'email' => $production_logs->user->email,
            'title' => $production_logs->show_name,
            'status' =>  $production_logs->producer1,
            'body' =>  $production_logs->location,
            'model' =>  'Production Show Logs',
            'user' => $user->name,
            'time' => date('d-m-Y'),
            'cc_emails' => $cc_emails
        ];
        Event::dispatch(new RecordCreatedEvent($details));
        $request->session()->flash('message', 'Successfully created Report');
        return redirect()->route('production.index');
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\Production_logs  $production_logs
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Production_logs $production_logs)
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
        $users = User::all();
        $production_logs = ProductionShowLogs::all()->find($id);
        return view('dashboard.reports.production_logs.edit', compact('production_logs', 'users'));
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
            'show_name'             => 'required',
            // 'producer1'           => 'required',
            // 'producer2'           => 'required',
            // 'director'           => 'required',
            // 'vision_mixer'           => 'required',
            // 'engineer'         => 'required',
            // 'sound_technician'         => 'required',
            // 'camera_operator1'           => 'required',
            // 'camera_operator2'           => 'required',
            // 'host'           => 'required',
            // 'graphics'         => 'required',
            // 'digital'         => 'required',
            // 'transmission'           => 'required',
            // 'transmission_time'           => 'required'
        ]);
        $user = Auth::user();
        $production_logs = ProductionShowLogs::find($id);
        $production_logs->show_name = $request->input('show_name');
        $production_logs->date = $request->input('date');
        $production_logs->start = $request->input('date');
        $production_logs->end = $request->input('date');
        $background_colors = array('#028336', '#ad2323', '#b1a514');
        $rand_background = $background_colors[array_rand($background_colors)];
        $production_logs->color = $rand_background;
        $production_logs->location = $request->input('location');
        $production_logs->producer1 = $request->input('producer1');
        $production_logs->producer2 = $request->input('producer2');
        $production_logs->director = $request->input('director');
        $production_logs->title = $request->input('show_name');
        $production_logs->vision_mixer = $request->input('vision_mixer');
        $production_logs->engineer = $request->input('engineer');
        $production_logs->sound_technician = $request->input('sound_technician');
        $production_logs->camera_operator1 = $request->input('camera_operator1');
        $production_logs->camera_operator2 = $request->input('camera_operator2');
        $production_logs->host = $request->input('host');
        $production_logs->graphics = $request->input('graphics');
        $production_logs->digital = $request->input('digital');
        $production_logs->transmission = $request->input('transmission');
        $production_logs->transmission_time = $request->input('transmission_time');
        $production_logs->comment = $request->input('comment');
        $production_logs->user_id =  $production_logs->user_id;
        $production_logs->save();
        $cc_emails = DB::select('SELECT email from users WHERE department_id = 11 OR department_id = 7 OR department_id = 13');
        $details = [
            'email' => $production_logs->user->email,
            'title' => $production_logs->date,
            'status' =>  $production_logs->producer1,
            'body' =>  $production_logs->location,
            'model' =>  'Production Show Logs',
            'user' => $user->name,
            'time' => date('d-m-Y'),
            'cc_emails' => $cc_emails
        ];
        Event::dispatch(new RecordUpdatedEvent($details));
        $request->session()->flash('message', 'Successfully Edited Log');
        return redirect()->route('production.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $production_logs = ProductionShowLogs::find($id);
        if ($production_logs) {
            $production_logs->delete();
        }
        return redirect()->route('production.index')->with('message', 'Successfully Deleted log');
    }
}
