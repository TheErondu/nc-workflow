<?php

namespace App\Http\Controllers;

use App\Models\OBlogs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use App\Events\RecordCreatedEvent;
use App\Events\RecordUpdatedEvent;

class OBlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {   $oblogs = OBlogs::all();
        return view('dashboard.reports.oblogs.index', compact('oblogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('dashboard.reports.oblogs.create', compact('users'));
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
            'event_name'             => 'required',
            'event_date'             => 'required',
            'location'           => 'required',
            // 'producer'           => 'required',
            // 'director'           => 'required',
            // 'vision_mixer'           => 'required',
            // 'sound'         => 'required',
            // 'engineer'         => 'required',
            // 'dop'             => 'required',
            // 'reporter'             => 'required',
            // 'digital'           => 'required',
            'transmission_time'           => 'required',
            'comment'           => 'required',
        ]);

        $user = auth()->user();
        $oblogs = new OBlogs();
        $oblogs->event_name = $request->input('event_name');
        $oblogs->event_date = $request->input('event_date');
        $oblogs->location = $request->input('location');
        $oblogs->producer = $request->input('producer');
        $oblogs->director = $request->input('director');
        $oblogs->vision_mixer = $request->input('vision_mixer');
        $oblogs->sound = $request->input('sound');
        $oblogs->engineer = $request->input('engineer');
        $oblogs->dop = $request->input('dop');
        $oblogs->reporter = $request->input('reporter');
        $oblogs->digital = $request->input('digital');
        $oblogs->transmission_time = $request->input('transmission_time');
        $oblogs->comment = $request->input('comment');
        $oblogs->user_id = $user->id;
        $oblogs->save();
        $details = [
            'email' => $oblogs->user->email,
            'title' => $oblogs->event_name,
            'status' =>  $oblogs->event_date,
            'body' =>  $oblogs->comment,
            'model' =>  'OB Logs',
            'user' => $oblogs->user->name,
            'time' => date('d-m-Y')
        ];
        Event::dispatch(new RecordCreatedEvent($details));
        $request->session()->flash('message', 'Log added Successfully!');
        return redirect()->route('oblogs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OBlogs  $oBlogs
     * @return \Illuminate\Http\Response
     */
    public function show(OBlogs $oBlogs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $oblogs = OBlogs::all()->find($id);
        $users = User::all();
        return view('dashboard.reports.oblogs.edit', compact('oblogs','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $validatedData = $request->validate([
            'event_name'             => 'required',
            'event_date'             => 'required',
            'location'           => 'required',
            // 'producer'           => 'required',
            // 'director'           => 'required',
            // 'vision_mixer'           => 'required',
            // 'sound'         => 'required',
            // 'engineer'         => 'required',
            // 'dop'             => 'required',
            // 'reporter'             => 'required',
            // 'digital'           => 'required',
            'transmission_time'           => 'required',
            'comment'           => 'required',
        ]);
        $oblogs = OBlogs::find($id);
        $user = auth()->user();
        $oblogs->event_name = $request->input('event_name');
        $oblogs->event_date = $request->input('event_date');
        $oblogs->location = $request->input('location');
        $oblogs->producer = $request->input('producer');
        $oblogs->director = $request->input('director');
        $oblogs->vision_mixer = $request->input('vision_mixer');
        $oblogs->sound = $request->input('sound');
        $oblogs->engineer = $request->input('engineer');
        $oblogs->dop = $request->input('dop');
        $oblogs->reporter = $request->input('reporter');
        $oblogs->digital = $request->input('digital');
        $oblogs->transmission_time = $request->input('transmission_time');
        $oblogs->comment = $request->input('comment');
        $oblogs->user_id = $user->id;
        $oblogs->save();
        $details = [
            'email' => $oblogs->user->email,
            'title' => $oblogs->event_name,
            'status' =>  $oblogs->event_date,
            'body' =>  $oblogs->comment,
            'model' =>  'OB Logs',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y')
        ];
        Event::dispatch(new RecordUpdatedEvent($details));
        $request->session()->flash('message', 'Log added Successfully!');
        return redirect()->route('oblogs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $oblogs = OBlogs::find($id);
        if($oblogs){
            $oblogs->delete();
        }
        return redirect()->route('oblogs.index')->with('message', 'Successfully Deleted Log!');

    }

}
