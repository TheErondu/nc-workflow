<?php

namespace App\Services;

use App\Models\Department;
use App\Models\Issue;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Analytics
{
    public function GetSummaryStats(): array
    {
        $totalIssues   = Issue::count();
        $openIssues    = Issue::where('status', 'OPEN')->count();
        $closedIssues  = Issue::where('status', 'CLOSED')->count();
        $monthIssues   = Issue::whereYear('created_at', now()->year)
                              ->whereMonth('created_at', now()->month)
                              ->count();
        $pendingStore  = DB::table('store_requests')->where('status', 'Pending')->count();
        $prodLogs      = DB::table('production_show_logs')->count();
        $activeStaff   = User::where('status', 'active')->count();

        return compact(
            'totalIssues', 'openIssues', 'closedIssues',
            'monthIssues', 'pendingStore', 'prodLogs', 'activeStaff'
        );
    }

    public function GetIssuesTrend(): array
    {
        $labels = [];
        $raised = [];
        $closed = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $labels[] = $date->format('M Y');
            $raised[] = Issue::whereYear('created_at', $date->year)
                             ->whereMonth('created_at', $date->month)
                             ->count();
            $closed[] = Issue::where('status', 'CLOSED')
                             ->whereYear('created_at', $date->year)
                             ->whereMonth('created_at', $date->month)
                             ->count();
        }

        return compact('labels', 'raised', 'closed');
    }

    public function GetTopEquipment(): array
    {
        $rows = Issue::select('item_name', DB::raw('COUNT(*) as total'))
            ->whereNotNull('item_name')
            ->where('item_name', '!=', '')
            ->groupBy('item_name')
            ->orderByDesc('total')
            ->limit(8)
            ->get();

        return [
            'names'  => $rows->pluck('item_name')->toArray(),
            'counts' => $rows->pluck('total')->toArray(),
        ];
    }

    public function GetDepartmentInfo(): array
    {
        $departments = Department::withCount('employees')->get();

        return [
            'names'  => $departments->pluck('name')->toArray(),
            'counts' => $departments->pluck('employees_count')->toArray(),
        ];
    }

    public function GetEngineerStats(): array
    {
        $top = DB::select("SELECT fixed_by AS name, COUNT(*) AS stats
            FROM issues WHERE status = 'CLOSED' AND fixed_by IS NOT NULL AND fixed_by != ''
            GROUP BY fixed_by ORDER BY stats DESC LIMIT 5");

        $bottom = DB::select("SELECT fixed_by AS name, COUNT(*) AS stats
            FROM issues WHERE status = 'CLOSED' AND fixed_by IS NOT NULL AND fixed_by != ''
            GROUP BY fixed_by ORDER BY stats ASC LIMIT 5");

        return [
            'top_names'    => collect($top)->pluck('name')->toArray(),
            'top_stats'    => collect($top)->pluck('stats')->toArray(),
            'bottom_names' => collect($bottom)->pluck('name')->toArray(),
            'bottom_stats' => collect($bottom)->pluck('stats')->toArray(),
        ];
    }

    public function GetBorrowerStats(): array
    {
        $rows = DB::select("SELECT users.name AS user, COUNT(*) AS stats
            FROM store_requests
            JOIN users ON store_requests.user_id = users.id
            GROUP BY store_requests.user_id
            ORDER BY stats DESC LIMIT 5");

        return [
            'names' => collect($rows)->pluck('user')->toArray(),
            'stats' => collect($rows)->pluck('stats')->toArray(),
        ];
    }

    public function GetProducerStats(): array
    {
        $top = DB::select("SELECT users.name AS user, COUNT(*) AS stats
            FROM production_show_logs
            JOIN users ON production_show_logs.user_id = users.id
            GROUP BY production_show_logs.user_id
            ORDER BY stats DESC LIMIT 5");

        $bottom = DB::select("SELECT users.name AS user, COUNT(*) AS stats
            FROM production_show_logs
            JOIN users ON production_show_logs.user_id = users.id
            GROUP BY production_show_logs.user_id
            ORDER BY stats ASC LIMIT 5");

        return [
            'top_names'    => collect($top)->pluck('user')->toArray(),
            'top_stats'    => collect($top)->pluck('stats')->toArray(),
            'bottom_names' => collect($bottom)->pluck('user')->toArray(),
            'bottom_stats' => collect($bottom)->pluck('stats')->toArray(),
        ];
    }

    public function GetVideoEditorStats(): array
    {
        $top = DB::select("SELECT users.name AS user, COUNT(*) AS stats
            FROM editor_logs
            JOIN users ON editor_logs.user_id = users.id
            GROUP BY editor_logs.user_id
            ORDER BY stats DESC LIMIT 5");

        $bottom = DB::select("SELECT users.name AS user, COUNT(*) AS stats
            FROM editor_logs
            JOIN users ON editor_logs.user_id = users.id
            GROUP BY editor_logs.user_id
            ORDER BY stats ASC LIMIT 5");

        return [
            'top_names'    => collect($top)->pluck('user')->toArray(),
            'top_stats'    => collect($top)->pluck('stats')->toArray(),
            'bottom_names' => collect($bottom)->pluck('user')->toArray(),
            'bottom_stats' => collect($bottom)->pluck('stats')->toArray(),
        ];
    }

    public function GetOBLogStats(): array
    {
        $top = DB::select("SELECT users.name AS user, COUNT(*) AS stats
            FROM o_blogs
            JOIN users ON o_blogs.user_id = users.id
            GROUP BY o_blogs.user_id
            ORDER BY stats DESC LIMIT 5");

        $bottom = DB::select("SELECT users.name AS user, COUNT(*) AS stats
            FROM o_blogs
            JOIN users ON o_blogs.user_id = users.id
            GROUP BY o_blogs.user_id
            ORDER BY stats ASC LIMIT 5");

        return [
            'top_names'    => collect($top)->pluck('user')->toArray(),
            'top_stats'    => collect($top)->pluck('stats')->toArray(),
            'bottom_names' => collect($bottom)->pluck('user')->toArray(),
            'bottom_stats' => collect($bottom)->pluck('stats')->toArray(),
        ];
    }

    public function GetGraphicslogStats(): array
    {
        $top = DB::select("SELECT users.name AS user, COUNT(*) AS stats
            FROM graphics_logs
            JOIN users ON graphics_logs.user_id = users.id
            GROUP BY graphics_logs.user_id
            ORDER BY stats DESC LIMIT 5");

        $bottom = DB::select("SELECT users.name AS user, COUNT(*) AS stats
            FROM graphics_logs
            JOIN users ON graphics_logs.user_id = users.id
            GROUP BY graphics_logs.user_id
            ORDER BY stats ASC LIMIT 5");

        // graphics_log_shows — separate table (was duplicated from graphics_logs previously)
        $showsTop = DB::select("SELECT users.name AS user, COUNT(*) AS stats
            FROM graphics_log_shows
            JOIN users ON graphics_log_shows.user_id = users.id
            GROUP BY graphics_log_shows.user_id
            ORDER BY stats DESC LIMIT 5");

        return [
            'top_names'       => collect($top)->pluck('user')->toArray(),
            'top_stats'       => collect($top)->pluck('stats')->toArray(),
            'bottom_names'    => collect($bottom)->pluck('user')->toArray(),
            'bottom_stats'    => collect($bottom)->pluck('stats')->toArray(),
            'shows_top_names' => collect($showsTop)->pluck('user')->toArray(),
            'shows_top_stats' => collect($showsTop)->pluck('stats')->toArray(),
        ];
    }
}
