<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ProductionShowLogs;
use Illuminate\Http\Request;

class CalendarViewController extends ApiController
{
    public function ProductionShowlogs(Request $request)
    {
        $data = ProductionShowLogs::whereDate('start', '>=', $request->start)
        ->whereDate('end',   '<=', $request->end)
        ->get(['id', 'title', 'start','end','color','comment']);

        return response()->json($data);
    }
}
