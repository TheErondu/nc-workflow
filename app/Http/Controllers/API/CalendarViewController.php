<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\EditorLogs;
use App\Models\GraphicsLogs;
use App\Models\GraphicsLogShows;
use App\Models\McrLogs;
use App\Models\OBlogs;
use App\Models\ProductionShowLogs;
use App\Models\PrompterLogs;
use App\Models\PrompterLogShows;
use App\Models\Reports;
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
    public function DirectorReports(Request $request)
    {
        $data = Reports::whereDate('start', '>=', $request->start)
        ->whereDate('end',   '<=', $request->end)
        ->get(['id', 'title', 'start','end','color','comment']);

        return response()->json($data);
    }
    public function McrLogs(Request $request)
    {
        $data = McrLogs::whereDate('start', '>=', $request->start)
        ->whereDate('end',   '<=', $request->end)
        ->get(['id', 'title', 'start','end','color','remarks']);

        return response()->json($data);
    }
    public function EditorLogs(Request $request)
    {
        $data = EditorLogs::whereDate('start', '>=', $request->start)
        ->whereDate('end',   '<=', $request->end)
        ->get(['id', 'title', 'start','end','color','third_interval']);

        return response()->json($data);
    }
    public function ObLogs(Request $request)
    {
        $data = OBlogs::whereDate('start', '>=', $request->start)
        ->whereDate('end',   '<=', $request->end)
        ->get(['id', 'title', 'start','end','color','comment']);

        return response()->json($data);
    }
    public function GraphicsLogs(Request $request)
    {
        $data = GraphicsLogs::whereDate('start', '>=', $request->start)
        ->whereDate('end',   '<=', $request->end)
        ->get(['id', 'title', 'start','end','color','challenges']);

        return response()->json($data);
    }
    public function GraphicsLogShows(Request $request)
    {
        $data = GraphicsLogShows::whereDate('start', '>=', $request->start)
        ->whereDate('end',   '<=', $request->end)
        ->get(['id', 'title', 'start','end','color','challenges']);

        return response()->json($data);
    }
    public function PrompterLogs(Request $request)
    {
        $data = PrompterLogs::whereDate('start', '>=', $request->start)
        ->whereDate('end',   '<=', $request->end)
        ->get(['id', 'title', 'start','end','color','challenges']);

        return response()->json($data);
    }
    public function PrompterLogShows(Request $request)
    {
        $data = PrompterLogShows::whereDate('start', '>=', $request->start)
        ->whereDate('end',   '<=', $request->end)
        ->get(['id', 'title', 'start','end','color','challenges']);

        return response()->json($data);
    }

    public function getAppointments(Request $request)
    {
        $data = Appointment::whereDate('start', '>=', $request->start)
        ->whereDate('end',   '<=', $request->end)
        ->get(['id', 'title', 'start', 'email','phone','photo', 'description','status']);
    return response()->json($data);
    }

}
