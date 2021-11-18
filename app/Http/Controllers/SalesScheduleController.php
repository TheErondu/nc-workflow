<?php

namespace App\Http\Controllers;

use App\Events\RecordCreatedEvent;
use App\Events\RecordUpdatedEvent;
use Illuminate\Http\Request;

use App\Models\SalesSchedule;
use App\Models\Country;
use Illuminate\Support\Facades\Event;

class SalesScheduleController extends Controller
{

    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = SalesSchedule::whereDate('start_date', '>=', $request->start)
                ->whereDate('end_date',   '<=', $request->end)
                ->get(['id', 'name', 'start_date', 'end_date', 'type']);
            return response()->json($data);
        }
        return view('dashboard.sales_scheduler.index');
    }


    public function calendarEvents(Request $request)
    {

        switch ($request->type) {
           case 'create':
              $event = SalesSchedule::create([
                  'name' => $request->name,
                  'start_date' => $request->start_date,
                  'end_date' => $request->end_date,
              ]);

              return response()->json($event);
             break;

           case 'edit':
              $event = SalesSchedule::find($request->id)->update([
                  'name' => $request->name,
                  'start_date' => $request->start_date,
                  'end_date' => $request->end_date,
              ]);

              return response()->json($event);
             break;

           case 'delete':
              $event = SalesSchedule::find($request->id)->delete();

              return response()->json($event);
             break;

           default:
             # ...
             break;
        }
    }

    public function create()
    {
        $client_types = array(
            'Direct','Agency',
        );
        $schedule_status = array(
            'Aprroved','Pending','Rejected'
        );
        $production_type = array(
            'SPONSORBOARD', 'TVC','INFOMERCIAL',
            'INHOUSE PROMO','FEATURE','VINGNETTE',
            'INNOVATION','AGENCY',
        );
        return view('dashboard.sales_scheduler.create',compact('client_types','schedule_status','production_type'));
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
            'client_type'             => 'required',
            'client_name'           => 'required',
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
        $content = new SalesSchedule();
        $content->client_type = $request->input('client_type');
        $content->title = $request->input('client_name');
        $content->sales_exec_ext = $request->input('sales_exec_ext');
        $content->client_cell = $request->input('client_cell');
        $content->start = \Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $request->input('end'))->format('Y-m-d');
        $content->brief_in_time = $request->input('brief_in_time');
        $content->end = \Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $request->input('end'))->format('Y-m-d');
        $content->sales_exec_name = $request->input('sales_exec_name');
        $content->type_of_production = $request->input('type_of_production');
        $content->production_requirements = $request->input('production_requirements');
        $content->production_period = $request->input('production_period');
        $content->status = $request->input('status');
        $content->approved_by = $request->input('approved_by');
        $content->product = $request->input('product');
        $content->approval_comments = $request->input('approval_comments');
        $content->resolved_date = $request->input('resolved_date');
        $content->user_id = $user->id;
        $content->save();
        $details = [
            'email' => $content->user->email,
            'title' => $content->title,
            'status' =>  $content->status,
            'body' =>  $content->production_requirements,
            'model' =>  'Sales Production Schedule',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y')
        ];
        Event::dispatch(new RecordCreatedEvent($details));
        $request->session()->flash('message', 'Successfully created Sales Schedule!');
        return redirect()->route('sales-production.index');
    }

   /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){

        $content = SalesSchedule::all()->find($id);

        return view('dashboard.content.show', [ 'content' => $content ]);



    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sales_schedule = SalesSchedule::all()->find($id);

        $client_types = array(
            'Direct','Agency',
        );
        $schedule_status = array(
            'Aprroved','Pending','Rejected'
        );
        $production_type = array(
            'SPONSORBOARD', 'TVC','INFOMERCIAL',
            'INHOUSE PROMO','FEATURE','VINGNETTE',
            'INNOVATION','AGENCY',
        );
        return view('dashboard.sales_scheduler.edit',compact('sales_schedule','client_types','schedule_status','production_type'));
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
            'client_type'             => 'required',
            'client_name'           => 'required',
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
        $content = SalesSchedule::find($id);
        $content->client_type = $request->input('client_type');
        $content->title = $request->input('client_name');
        $content->sales_exec_ext = $request->input('sales_exec_ext');
        $content->client_cell = $request->input('client_cell');
        $content->start = $request->input('end');
        $content->brief_in_time = $request->input('brief_in_time');
        $content->end = $request->input('end');
        $content->sales_exec_name = $request->input('sales_exec_name');
        $content->type_of_production = $request->input('type_of_production');
        $content->production_requirements = $request->input('production_requirements');
        $content->production_period = $request->input('production_period');
        $content->status = $request->input('status');
        $content->approved_by = $request->input('approved_by');
        $content->product = $request->input('product');
        $content->approval_comments = $request->input('approval_comments');
        $content->resolved_date = $request->input('resolved_date');
        $content->user_id = $user->id;
        $content->save();
        $details = [
            'email' => $content->user->email,
            'title' => $content->title,
            'status' =>  $content->status,
            'body' =>  $content->production_requirements,
            'model' =>  'Sales Production Schedule',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y')
        ];
        Event::dispatch(new RecordUpdatedEvent($details));
        $request->session()->flash('message', 'Successfully Updated Sales Schedule!');

        return redirect()->route('sales-production.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $content = SalesSchedule::find($id);
        if($content){
            $content->delete();
        }
        return redirect()->route('content.index')->with('message', 'Project Deleted');

    }
}

