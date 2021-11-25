<?php

namespace App\Http\Controllers;

use App\Events\RecordCreatedEvent;
use App\Events\RecordUpdatedEvent;
use App\Models\MaintenanceScheduler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class MaintenanceSchedulerController extends Controller
{

    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = MaintenanceScheduler::whereDate('start_date', '>=', $request->start)
                ->whereDate('end_date',   '<=', $request->end)
                ->get(['id', 'name', 'start_date', 'end_date', 'type']);
            return response()->json($data);
        }
        return view('dashboard.maintenance_scheduler.index');
    }


    public function create()
    {
        $schedule_status = array(
            'Started','In Progress','Completed'
        );
        $priorities = array(
            'Routine', 'Urgent','Critical',
        );
        return view('dashboard.maintenance_scheduler.create',compact('schedule_status','priorities'));
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

        ]);
        $user = auth()->user();
        $schedule = new MaintenanceScheduler();
        $schedule->title = $request->input('title');
        $schedule->start = $request->input('start');
        $schedule->end = $request->input('end');
        $schedule->status = $request->input('status');
        $schedule->priority = $request->input('priority');
        $schedule->notes = $request->input('notes');
        $schedule->user_id = $user->id;
        $schedule->save();
        $cc_emails = DB::select('SELECT email from users WHERE department_id = 11');
        $details = [
            'cc_emails' => $cc_emails,
            'email' => $schedule->user->email,
            'title' => $schedule->title,
            'status' =>  $schedule->status,
            'body' =>  $schedule->priority,
            'model' =>  'Maintenance Schedule',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y')
        ];
        Event::dispatch(new RecordCreatedEvent($details));
        $request->session()->flash('message', 'Successfully created Maintenance Schedule!');
        return redirect()->route('maintenance-schedule.index');
    }

   /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){

        $schedule = MaintenanceScheduler::all()->find($id);

        return view('dashboard.maintenance_scheduler.show', [ 'schedule' => $schedule ]);



    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $schedule = MaintenanceScheduler::all()->find($id);

        $schedule_status = array(
            'Started','In Progress','Completed'
        );
        $priorities = array(
            'Routine', 'Urgent','Critical',
        );
        return view('dashboard.maintenance_scheduler.edit',compact('schedule_status','schedule','priorities'));
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
        $validatedData = $request->validate([
            'title'             => 'required',
            // 'sales_exec_ext'           => 'required',
            // 'client_cell'           => 'required',
            // 'start'           => 'required',
            // 'brief_in_time'           => 'required',
            // 'end'           => 'required',
            // 'sales_exec_name'           => 'required',
            // 'type_of_production'           => 'required',
            // 'production_requirements'           => 'required',
            // 'production_period'           => 'required',
            // 'status'           => 'required',
            // 'approved_by'           => 'required',
            // 'product'           => 'required',
            // 'approval_comments'           => 'required',

        ]);
        $user = auth()->user();
        $schedule = MaintenanceScheduler::find($id);
        $schedule->title = $request->input('title');
        $schedule->start = $request->input('start');
        $schedule->end = $request->input('end');
        $schedule->status = $request->input('status');
        $schedule->priority = $request->input('priority');
        $schedule->user_id = $user->id;
        $schedule->save();
        $cc_emails = DB::select('SELECT email from users WHERE department_id = 11');
        $details = [
            'cc_emails' => $cc_emails,
            'email' => $schedule->user->email,
            'title' => $schedule->title,
            'status' =>  $schedule->status,
            'body' =>  $schedule->priority,
            'model' =>  'Maintenance Schedule',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y')
        ];
        Event::dispatch(new RecordUpdatedEvent($details));
        $request->session()->flash('message', 'Successfully Updated Maintenance Schedule!');

        return redirect()->route('maintenance-schedule.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $schedule = MaintenanceScheduler::find($id);
        if($schedule){
            $schedule->delete();
        }
        return redirect()->route('maintenance-schedule.index')->with('message', 'Schedule Deleted');

    }
}
