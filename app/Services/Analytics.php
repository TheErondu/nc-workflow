<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Session\SessionManager;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class Analytics
{
    public function GetDepartmentInfo()
    {
        $departments = Department::where('id', '>', 0)->pluck('name');
        $all_departments = Department::all();
        $departmentInfo = collect(
            [
                'departments' => $departments,
                'all_departments' => $all_departments
            ]);
        return $departmentInfo;
    }
    public function GetEngineerStats(){

        $most_active =  DB::select("SELECT fixed_by as 'name', COUNT(*) as 'stats'
        FROM issues WHERE status = 'CLOSED'
        GROUP BY fixed_by
        ORDER BY 2 DESC LIMIT 3;");
        $active_engineers_stats = collect($most_active)->pluck('stats');
        $active_engineers = collect($most_active)->pluck('name');

        $least_active =  DB::select("SELECT fixed_by as 'name', COUNT(*) as 'stats'
        FROM issues WHERE status = 'CLOSED'
        GROUP BY fixed_by
        ORDER BY 2 ASC LIMIT 3;");
         $inactive_engineers_stats = collect($least_active)->pluck('stats');
         $inactive_engineers = collect($least_active)->pluck('name');

        $engineerStats = collect([
            'active_engineers_stats' => $active_engineers_stats,
            'active_engineers' => $active_engineers,
            'inactive_engineers_stats' => $inactive_engineers_stats,
            'inactive_engineers' => $inactive_engineers

        ]);

        return $engineerStats;

    }
    public function GetBorrowerStats(){
        $most_borrower_query =  DB::select("SELECT username as 'users', COUNT(*) as 'stats'
        FROM store_requests

        JOIN users
        on store_requests.user_id = users.id
        GROUP BY user_id
        ORDER BY 2 DESC LIMIT 3;");

            $most_borrowers_stats= collect($most_borrower_query)->pluck('stats');

            $most_borrowers = collect($most_borrower_query)->pluck('users');
            $borrower_stats = collect([
                'most_borrowers_stats' => $most_borrowers_stats,
                'most_borrowers' => $most_borrowers
            ]);
            return $borrower_stats;

    }
    public function GetProducerStats()
    {
        $query =  DB::select("SELECT name as 'users', COUNT(*) as 'stats'
        FROM production_show_logs

        JOIN users
        on production_show_logs.user_id = users.id
        GROUP BY user_id
        ORDER BY 2 DESC LIMIT 3;");

            $producers_count= collect($query)->pluck('stats');

            $producers_list = collect($query)->pluck('users');
            $producer_stats = collect([
                'producer_stats' => $producers_count,
                'producers_list' => $producers_list
            ]);
            return $producer_stats;
    }
    public function GetDirectorStats()
    {
        $query =  DB::select("SELECT name as 'users', COUNT(*) as 'stats'
        FROM reports

        JOIN users
        on reports.user_id = users.id
        GROUP BY user_id
        ORDER BY 2 DESC LIMIT 3;");

            $directors_count= collect($query)->pluck('stats');

            $directors_list = collect($query)->pluck('users');
            $director_stats = collect([
                'directors_count' => $directors_count,
                'directors_list' => $directors_list
            ]);
            return $director_stats;
    }
}
