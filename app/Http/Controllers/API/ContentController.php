<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Models\Content;
use Spatie\QueryBuilder\QueryBuilder;


class ContentController extends ApiController
{

    public function index(Request $request)
    {
            // $data = Content::where('country','KENYA')->whereDate('start', '>=', $request->start)
            // ->whereDate('end',   '<=', $request->end)
            //     ->get(['id', 'title','start', 'end']);
                $data = QueryBuilder::for(Content::class)
                ->allowedFilters('country')->whereDate('start', '>=', $request->start)
                ->whereDate('end',   '<=', $request->end)
                    ->get(['id', 'title','start', 'end']);

            return response()->json($data);

    }

    public function GetNigeriaEvents(Request $request)
    {
        $data = Content::where('country','Nigeria')->whereDate('start', '>=', $request->start)
        ->whereDate('end',   '<=', $request->end)
            ->get(['id', 'title','start', 'end']);

        return response()->json($data);

    }

    public function GetSouthAfricaEvents(Request $request)
    {
        $data = Content::where('country','SOUTH AFRICA')->whereDate('start', '>=', $request->start)
        ->whereDate('end',   '<=', $request->end)
            ->get(['id', 'title','start', 'end']);

        return response()->json($data);

    }



    public function calendarEvents(Request $request)
    {

        switch ($request->type) {
           case 'create':
              $event = Content::create([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);

              return response()->json($event);
             break;

           case 'edit':
              $event = Content::find($request->id)->update([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);

              return response()->json($event);
             break;

           case 'delete':
              $event = Content::find($request->id)->delete();

              return response()->json($event);
             break;

           default:
             # ...
             break;
        }
    }
}
