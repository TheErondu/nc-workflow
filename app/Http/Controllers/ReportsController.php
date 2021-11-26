<?php

namespace App\Http\Controllers;

use App\Events\RecordCreatedEvent;
use App\Events\RecordUpdatedEvent;
use App\Models\Reports;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $directors_report = Reports::all();
        if (request()->query("view") === 'table' ){
            return view('dashboard.reports.directors.table', compact('directors_report'));
        }
        else
        return view('dashboard.reports.directors.index', compact('directors_report'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $users = User::all();
        return view('dashboard.reports.directors.create', compact('users'));
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

            // 'bulletin'             => 'required',
            // 'dts_in'             => 'required',
            // 'actual_in'           => 'required',
            // 'variance1'           => 'required',
            // 'dts_out'           => 'required',
            // 'actual_out'           => 'required',
            // 'variance2'         => 'required',
            // 'comment'         => 'required'

            // 'b2bulletin'             => 'required',
            // 'b2dts_in'             => 'required',
            // 'b2actual_in'           => 'required',
            // 'b2variance1'           => 'required',
            // 'b2dts_out'           => 'required',
            // 'b2actual_out'           => 'required',
            // 'b2variance2'         => 'required',
            // 'b2comment'         => 'required',
        ]);

        $user = auth()->user();
        $reports = new Reports();

        $reports->producer = $request->input('producer');
        $reports->director = $request->input('director');
        $reports->anchor = $request->input('anchor');
        $reports->start = date('Y-m-d');
        $reports->end = date('Y-m-d');
        $background_colors = array('#028336', '#ad2323', '#b1a514');
        $rand_background = $background_colors[array_rand($background_colors)];
        $reports->color = $rand_background;
        $reports->vision_mixer = $request->input('vision_mixer');
        $reports->engineer = $request->input('engineer');
        $reports->sound_technician = $request->input('sound_technician');
        $reports->camera_operator = $request->input('camera_operator');
        $reports->autocue = $request->input('autocue');
        $reports->graphics = $request->input('graphics');
        $reports->tx = $request->input('tx');
        $reports->bulletin = $request->input('bulletin');
        $reports->title = $request->input('bulletin');
        $reports->dts_in = $request->input('dts_in');
        $reports->actual_in = $request->input('actual_in');
        $reports->variance1 = $request->input('variance1');
        $reports->dts_out = $request->input('dts_out');
        $reports->actual_out = $request->input('actual_out');
        $reports->variance2 = $request->input('variance2');
        $reports->comment = $request->input('comment');
        $reports->b2bulletin = $request->input('b2bulletin');
        $reports->b2dts_in = $request->input('b2dts_in');
        $reports->b2actual_in = $request->input('b2actual_in');
        $reports->b2variance1 = $request->input('b2variance1');
        $reports->b2dts_out = $request->input('b2dts_out');
        $reports->b2actual_out = $request->input('b2actual_out');
        $reports->b2variance2 = $request->input('b2variance2');
        $reports->b2comment = $request->input('b2comment');
        $reports->user_id = $user->id;
        $reports->save();
        $cc_emails = DB::select('SELECT email from users WHERE department_id = 11 OR department_id = 7 OR department_id = 13');
        $details = [
            'email' => $reports->user->email,
            'title' => $reports->bulletin,
            'status' =>  $reports->dts_in,
            'body' =>  $reports->comment,
            'model' =>  'Director Reports',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y'),
            'cc_emails' => $cc_emails
        ];
        Event::dispatch(new RecordCreatedEvent($details));
        $request->session()->flash('message', 'Successfully created Report');
        return redirect()->route('reports.index');
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
        $reports = Reports::all()->find($id);
        $users = User::all();
        return view('dashboard.reports.directors.edit', compact('reports', 'users'));
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
            // 'bulletin'             => 'required',
            // 'dts_in'             => 'required',
            // 'actual_in'           => 'required',
            // 'variance1'           => 'required',
            // 'dts_out'           => 'required',
            // 'actual_out'           => 'required',
            // 'variance2'         => 'required',
            // 'comment'         => 'required',
            // 'b2bulletin'             => 'required',
            // 'b2dts_in'             => 'required',
            // 'b2actual_in'           => 'required',
            // 'b2variance1'           => 'required',
            // 'b2dts_out'           => 'required',
            // 'b2actual_out'           => 'required',
            // 'b2variance2'         => 'required',
            // 'b2comment'         => 'required',
        ]);
        $user = auth()->user();
        $reports = Reports::find($id);
        $reports->producer = $request->input('producer');
        $reports->director = $request->input('director');
        $reports->anchor = $request->input('anchor');
        $reports->start = Carbon::createFromFormat('Y-m-d H:i:s', $reports->created_at)->format('Y-m-d');
        $reports->end =  Carbon::createFromFormat('Y-m-d H:i:s', $reports->created_at)->format('Y-m-d');
        $background_colors = array('#028336', '#ad2323', '#b1a514');
        $rand_background = $background_colors[array_rand($background_colors)];
        $reports->color = $rand_background;
        $reports->vision_mixer = $request->input('vision_mixer');
        $reports->engineer = $request->input('engineer');
        $reports->sound_technician = $request->input('sound_technician');
        $reports->camera_operator = $request->input('camera_operator');
        $reports->autocue = $request->input('autocue');
        $reports->graphics = $request->input('graphics');
        $reports->tx = $request->input('tx');
        $reports->bulletin = $request->input('bulletin');
        $reports->title = $request->input('bulletin');
        $reports->dts_in = $request->input('dts_in');
        $reports->actual_in = $request->input('actual_in');
        $reports->variance1 = $request->input('variance1');
        $reports->dts_out = $request->input('dts_out');
        $reports->actual_out = $request->input('actual_out');
        $reports->variance2 = $request->input('variance2');
        $reports->comment = $request->input('comment');
        $reports->b2bulletin = $request->input('b2bulletin');
        $reports->b2dts_in = $request->input('b2dts_in');
        $reports->b2actual_in = $request->input('b2actual_in');
        $reports->b2variance1 = $request->input('b2variance1');
        $reports->b2dts_out = $request->input('b2dts_out');
        $reports->b2actual_out = $request->input('b2actual_out');
        $reports->b2variance2 = $request->input('b2variance2');
        $reports->b2comment = $request->input('b2comment');
        $reports->user_id = $user->id;
        $reports->save();
        $cc_emails = DB::select('SELECT email from users WHERE department_id = 11 OR department_id = 7 OR department_id = 13');
        $details = [
            'email' => $reports->user->email,
            'title' => $reports->bulletin,
            'status' =>  $reports->dts_in,
            'body' =>  $reports->comment,
            'model' =>  'Directors Report',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y'),
            'cc_emails' => $cc_emails
        ];
        Event::dispatch(new RecordUpdatedEvent($details));
        $request->session()->flash('message', 'Successfully Edited Report');
        return redirect()->route('reports.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reports = Reports::find($id);
        if ($reports) {
            $reports->delete();
        }
        return redirect()->route('reports.index')->with('message', 'Successfully Deleted Report');
    }
}
