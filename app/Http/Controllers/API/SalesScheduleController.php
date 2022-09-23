<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Models\SalesSchedule;
use Spatie\QueryBuilder\QueryBuilder;


class SalesScheduleController extends ApiController
{

    public function index(Request $request)
    {
            // $data = SalesSchedule::where('country','KENYA')->whereDate('start', '>=', $request->start)
            // ->whereDate('end',   '<=', $request->end)
            //     ->get(['id', 'title','start', 'end']);
                $data = QueryBuilder::for(SalesSchedule::class)
                ->allowedFilters('status')->whereDate('start', '>=', $request->start)
                ->whereDate('end',   '<=', $request->end)
                    ->get(['id', 'title','start', 'end']);

            return response()->json($data);

    }
}
