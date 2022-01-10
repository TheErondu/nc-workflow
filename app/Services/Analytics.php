<?php

namespace App\Services;
use App\Models\Department;
use Illuminate\Support\Facades\DB;

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
        $most_active =  DB::select("SELECT name as 'users', COUNT(*) as 'stats'
        FROM production_show_logs

        JOIN users
        on production_show_logs.user_id = users.id
        GROUP BY user_id
        ORDER BY 2 DESC LIMIT 3;");

            $producers_count= collect($most_active)->pluck('stats');

            $producers_list = collect($most_active)->pluck('users');
         $least_active =  DB::select("SELECT name as 'users', COUNT(*) as 'stats'
         FROM production_show_logs

         JOIN users
         on production_show_logs.user_id = users.id
         GROUP BY user_id
         ORDER BY 2 ASC LIMIT 3;");
          $least_producers_count= collect($least_active)->pluck('stats');

          $least_producers_list = collect($least_active)->pluck('users');

            $producer_stats = collect([
                'producer_stats' => $producers_count,
                'producers_list' => $producers_list,
                'least_producers_count' =>$least_producers_count,
                'least_producers_list' =>$least_producers_list
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

        $query =  DB::select("SELECT name as 'users', COUNT(*) as 'stats'
        FROM reports

        JOIN users
        on reports.user_id = users.id
        GROUP BY user_id
        ORDER BY 2 ASC LIMIT 3;");
          $least_directors_count= collect($query)->pluck('stats');

          $least_directors_list = collect($query)->pluck('users');

            $director_stats = collect([
                'directors_count' => $directors_count,
                'directors_list' => $directors_list,
                'least_directors_count' => $least_directors_count,
                'least_directors_list' => $least_directors_list
            ]);
            return $director_stats;
    }
    public function GetVideoEditorStats()
    {
        $query =  DB::select("SELECT name as 'users', COUNT(*) as 'stats'
        FROM editor_logs

        JOIN users
        on editor_logs.user_id = users.id
        GROUP BY user_id
        ORDER BY 2 DESC LIMIT 3;");

            $editors_count= collect($query)->pluck('stats');

            $editors_list = collect($query)->pluck('users');

        $query =  DB::select("SELECT name as 'users', COUNT(*) as 'stats'
        FROM editor_logs

        JOIN users
        on editor_logs.user_id = users.id
        GROUP BY user_id
        ORDER BY 2 ASC LIMIT 3;");

          $least_editors_count= collect($query)->pluck('stats');

          $least_editors_list = collect($query)->pluck('users');

            $editor_stats = collect([
                'editors_count' => $editors_count,
                'editors_list' => $editors_list,
                'least_editors_count' => $least_editors_count,
                'least_editors_list' => $least_editors_list
            ]);
            return $editor_stats;
    }
    public function GetOBLogStats()
    {
        $query =  DB::select("SELECT name as 'users', COUNT(*) as 'stats'
        FROM o_blogs

        JOIN users
        on o_blogs.user_id = users.id
        GROUP BY user_id
        ORDER BY 2 DESC LIMIT 3;");

            $oblogs_count= collect($query)->pluck('stats');

            $oblogs_list = collect($query)->pluck('users');

        $query =  DB::select("SELECT name as 'users', COUNT(*) as 'stats'
        FROM o_blogs

        JOIN users
        on o_blogs.user_id = users.id
        GROUP BY user_id
        ORDER BY 2 ASC LIMIT 3;");

          $least_oblogs_count= collect($query)->pluck('stats');

          $least_oblogs_list = collect($query)->pluck('users');

            $oblogs_stats = collect([
                'oblogs_count' => $oblogs_count,
                'oblogs_list' => $oblogs_list,
                'least_oblogs_count' => $least_oblogs_count,
                'least_oblogs_list' => $least_oblogs_list
            ]);
            return $oblogs_stats;
    }
    public function GetGraphicslogStats()
    {
        $query =  DB::select("SELECT name as 'users', COUNT(*) as 'stats'
        FROM graphics_logs

        JOIN users
        on graphics_logs.user_id = users.id
        GROUP BY user_id
        ORDER BY 2 DESC LIMIT 3;");

            $graphics_logs_count= collect($query)->pluck('stats');

            $graphics_logs_list = collect($query)->pluck('users');

        $query =  DB::select("SELECT name as 'users', COUNT(*) as 'stats'
        FROM graphics_logs

        JOIN users
        on graphics_logs.user_id = users.id
        GROUP BY user_id
        ORDER BY 2 ASC LIMIT 3;");

          $least_graphics_logs_count= collect($query)->pluck('stats');

          $least_graphics_logs_list = collect($query)->pluck('users');

          $query =  DB::select("SELECT name as 'users', COUNT(*) as 'stats'
          FROM graphics_logs

          JOIN users
          on graphics_logs.user_id = users.id
          GROUP BY user_id
          ORDER BY 2 DESC LIMIT 3;");

              $graphics_logs_shows_count= collect($query)->pluck('stats');

              $graphics_logs_shows_list = collect($query)->pluck('users');

          $query =  DB::select("SELECT name as 'users', COUNT(*) as 'stats'
          FROM graphics_log_shows

          JOIN users
          on graphics_log_shows.user_id = users.id
          GROUP BY user_id
          ORDER BY 2 ASC LIMIT 3;");

            $least_graphics_logs_shows_count= collect($query)->pluck('stats');

            $least_graphics_logs_shows_list = collect($query)->pluck('users');

            $graphics_logs_show_stats = collect([
                'graphics_logs_count' => $graphics_logs_count,
                'graphics_logs_list' => $graphics_logs_list,
                'least_graphics_logs_count' => $least_graphics_logs_count,
                'least_graphics_logs_list' => $least_graphics_logs_list,
                'graphics_logs_shows_count' => $graphics_logs_shows_count,
                'graphics_logs_shows_list' => $graphics_logs_shows_list

            ]);
            return $graphics_logs_show_stats;
    }
}
