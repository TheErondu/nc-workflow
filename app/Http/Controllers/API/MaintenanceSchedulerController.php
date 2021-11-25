<?php

namespace App\Http\Controllers\API;

use App\Models\MaintenanceScheduler;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;


class MaintenanceSchedulerController extends ApiController
{

    public function index(Request $request)
    {
            // $data = SalesSchedule::where('country','KENYA')->whereDate('start', '>=', $request->start)
            // ->whereDate('end',   '<=', $request->end)
            //     ->get(['id', 'title','start', 'end']);
                $data = QueryBuilder::for(MaintenanceScheduler::class)
                ->allowedFilters('status')->whereDate('start', '>=', $request->start)
                ->whereDate('end',   '<=', $request->end)
                    ->get(['id', 'title','start', 'notes','end']);

            return response()->json($data);

    }
}
