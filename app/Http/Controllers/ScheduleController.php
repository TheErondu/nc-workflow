<?php

namespace App\Http\Controllers;

use App\Events\RecordCreatedEvent;
use App\Events\RecordUpdatedEvent;
use Illuminate\Http\Request;

use App\Models\Schedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class ScheduleController extends Controller
{

    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Schedule::whereDate('start_date', '>=', $request->start)
                ->whereDate('end_date',   '<=', $request->end)
                ->get(['id', 'name', 'start_date', 'end_date', 'type']);
            return response()->json($data);
        }
        return view('dashboard.schedule.index');
    }


    public function calendarEvents(Request $request)
    {

        switch ($request->type) {
           case 'create':
              $event = Schedule::create([
                  'name' => $request->name,
                  'start_date' => $request->start_date,
                  'end_date' => $request->end_date,
              ]);

              return response()->json($event);
             break;

           case 'edit':
              $event = Schedule::find($request->id)->update([
                  'name' => $request->name,
                  'start_date' => $request->start_date,
                  'end_date' => $request->end_date,
              ]);

              return response()->json($event);
             break;

           case 'delete':
              $event = Schedule::find($request->id)->delete();

              return response()->json($event);
             break;

           default:
             # ...
             break;
        }
    }

    public function create()
    {
        $schedules = Schedule::all();
        return view('dashboard.schedule.create',[ 'schedules' => $schedules ]);
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
            'title'             => 'required',
            'start'           => 'required',
            'end'           => 'required',
            'start'           => 'required',
            'status'           => 'required',
            'producer1'           => 'required',
            'producer2'           => 'required',
            'dop1'           => 'required',
            'dop2'           => 'required',
            'dop3'           => 'required',
            'dop4'           => 'required',

        ]);
        $user = auth()->user();
        $schedule = new Schedule();
        $schedule->title     = $request->input('title');
        $schedule->start = $request->input('start');
        $schedule->end = $request->input('end');
        $schedule->status = $request->input('status');
        $schedule->producer1 = $request->input('producer1');
        $schedule->producer2 = $request->input('producer2');
        $schedule->dop1 = $request->input('dop1');
        $schedule->dop2 = $request->input('dop2');
        $schedule->dop3 = $request->input('dop3');
        $schedule->dop4 = $request->input('dop4');
        $schedule->description = $request->input('description');
        $schedule->type = $request->input('type');
        $schedule->user_id = $user->id;
        $schedule->save();
        $cc_emails = DB::select('SELECT email from users WHERE department_id = 11');
        $details = [
            'cc_emails' => $cc_emails,
            'email' => $schedule->user->email,
            'title' => $schedule->title,
            'status' =>  $schedule->status,
            'body' =>  $schedule->description,
            'model' =>  'Schedule',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y')
        ];
        Event::dispatch(new RecordCreatedEvent($details));
        $request->session()->flash('message', 'Successfully created schedule');
        return redirect()->route('schedule.create');
    }

   /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){

        $schedule = Schedule::all()->find($id);

        return view('dashboard.schedule.show', [ 'schedule' => $schedule ]);



    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $schedule = Schedule::all()->find($id);
        return view('dashboard.schedule.edit', [ 'schedule' => $schedule,]);
    }

       /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //var_dump('bazinga');
        //die();
        $validatedData = $request->validate([
            'title'             => 'required',
            'start'           => 'required',
            'end'           => 'required',
            'start'           => 'required',
            'status'           => 'required',
            'producer1'           => 'required',
            'producer2'           => 'required',
            'dop1'           => 'required',
            'dop2'           => 'required',
            'dop3'           => 'required',
            'dop4'           => 'required',

        ]);
        $schedule = Schedule::find($id);
        $schedule->title     = $request->input('title');
        $schedule->start = $request->input('start');
        $schedule->end = $request->input('end');
        $schedule->status = $request->input('status');
        $schedule->producer1 = $request->input('producer1');
        $schedule->producer2 = $request->input('producer2');
        $schedule->dop1 = $request->input('dop1');
        $schedule->dop2 = $request->input('dop2');
        $schedule->dop3 = $request->input('dop3');
        $schedule->dop4 = $request->input('dop4');
        $schedule->description = $request->input('description');
        $schedule->type = $request->input('type');
        $schedule->save();
        $cc_emails = DB::select('SELECT email from users WHERE department_id = 11');
        $details = [
            'cc_emails' => $cc_emails,
            'email' => $schedule->user->email,
            'title' => $schedule->title,
            'status' =>  $schedule->status,
            'body' =>  $schedule->description,
            'model' =>  'Schedule',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y')
        ];
        Event::dispatch(new RecordUpdatedEvent($details));
        $request->session()->flash('message', 'Successfully created schedule');
        return redirect()->route('schedule.edit',$schedule->id);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        //
    }
}

