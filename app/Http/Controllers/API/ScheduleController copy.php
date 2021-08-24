<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Schedule;

class ScheduleController extends Controller
{

    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Schedule::whereDate('start_date', '>=', $request->start)
                ->whereDate('end_date',   '<=', $request->end)
                ->get(['id', 'name', 'start_date', 'end_date']);
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
}
