<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Models\Booking;
use Spatie\QueryBuilder\QueryBuilder;


class BookingController extends ApiController
{

    public function index(Request $request)
    {
            // $data = Booking::where('country','KENYA')->whereDate('start', '>=', $request->start)
            // ->whereDate('end',   '<=', $request->end)
            //     ->get(['id', 'title','start', 'end']);
                $data = QueryBuilder::for(Booking::class)
                ->allowedFilters('type')->whereDate('start', '>=', $request->start)
                ->whereDate('end',   '<=', $request->end)
                    ->get(['id', 'title','start', 'end']);

            return response()->json($data);

    }

    public function GetNigeriaEvents(Request $request)
    {
        $data = Booking::where('country','Nigeria')->whereDate('start', '>=', $request->start)
        ->whereDate('end',   '<=', $request->end)
            ->get(['id', 'title','start', 'end']);

        return response()->json($data);

    }

    public function GetSouthAfricaEvents(Request $request)
    {
        $data = Booking::where('country','SOUTH AFRICA')->whereDate('start', '>=', $request->start)
        ->whereDate('end',   '<=', $request->end)
            ->get(['id', 'title','start', 'end']);

        return response()->json($data);

    }



    public function calendarEvents(Request $request)
    {

        switch ($request->type) {
           case 'create':
              $event = Booking::create([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);

              return response()->json($event);
             break;

           case 'edit':
              $event = Booking::find($request->id)->update([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);

              return response()->json($event);
             break;

           case 'delete':
              $event = Booking::find($request->id)->delete();

              return response()->json($event);
             break;

           default:
             # ...
             break;
        }
    }
}
