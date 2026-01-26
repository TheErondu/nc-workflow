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
use App\Models\ManualReport;
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

    public function ManualReports(Request $request)
    {
        $query = ManualReport::query();

        if ($request->has('start') && $request->has('end')) {
            $query->whereDate('report_date', '>=', $request->start)
                  ->whereDate('report_date', '<=', $request->end);
        }

        if ($request->filled('type')) {
            $query->where('report_type', $request->type);
        }

        $data = $query->get()->map(function ($report) {
            $colors = [
                'director' => '#3788d8',
                'vision_mixer' => '#28a745',
                'graphics' => '#dc3545',
                'sto' => '#ffc107',
                'audio' => '#6f42c1',
            ];

            return [
                'id' => $report->id,
                'title' => $report->title,
                'start' => $report->report_date->format('Y-m-d'),
                'end' => $report->report_date->format('Y-m-d'),
                'color' => $colors[$report->report_type] ?? '#6c757d',
                'extendedProps' => [
                    'report_type' => $report->report_type_label,
                ],
            ];
        });

        return response()->json($data);
    }

}
