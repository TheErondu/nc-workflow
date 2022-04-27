<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Models\Schedule;

class ScheduleController extends ApiController
{

    public function index(Request $request)
    {
        $data = Schedule::where('type','preproduction')->whereDate('start', '>=', $request->start)
        ->whereDate('end',   '<=', $request->end)
        ->get(['id', 'title', 'start', 'end' ,'description','allDay','color','type']);

            return response()->json($data);

    }


    public function GetVideoEditorsEvents(Request $request)
    {
            $data = Schedule::where('type','editors')->whereDate('start', '>=', $request->start)
                ->whereDate('end',   '<=', $request->end)
                ->get(['id', 'title', 'start', 'end' ,'description','allDay','color','type']);

            return response()->json($data);

    }

    public function GetGraphicEditorsEvents(Request $request)
    {
            $data = Schedule::where('type','graphics')->whereDate('start', '>=', $request->start)
                ->whereDate('end',   '<=', $request->end)
                ->get(['id', 'title', 'start', 'end' ,'allDay','description','color','type']);

            return response()->json($data);

    }

    public function GetDigitalEvents(Request $request)
    {
            $data = Schedule::where('type','digital')->whereDate('start', '>=', $request->start)
                ->whereDate('end',   '<=', $request->end)
                ->get(['id', 'title', 'start', 'end' ,'allDay','description','color','type']);

            return response()->json($data);

    }



    public function calendarEvents(Request $request)
    {

        switch ($request->type) {
           case 'create':
              $event = Schedule::create([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);

              return response()->json($event);
             break;

           case 'edit':
              $event = Schedule::find($request->id)->update([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
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
