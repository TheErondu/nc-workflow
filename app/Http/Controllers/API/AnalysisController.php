<?php

namespace App\Http\Controllers\API;

use App\Models\Analysis;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnalysisController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = array(
        //     "Speed", "Reliability", "Comfort", "Safety", "Efficiency"
        // );
        $departments = Department::where('id', '>', 0)->pluck('name');
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

        $most_borrower_query =  DB::select("SELECT username as 'users', COUNT(*) as 'stats'
        FROM store_requests

        JOIN users
        on store_requests.user_id = users.id
        GROUP BY user_id
        ORDER BY 2 DESC LIMIT 3;");

            $most_borrowers_stats= collect($most_borrower_query)->pluck('stats');

            $most_borrowers = collect($most_borrower_query)->pluck('users');

        $all_departments = Department::all();
        return response()->json(  compact('departments','all_departments',
        'active_engineers_stats','active_engineers',
        'inactive_engineers_stats','inactive_engineers',
        'most_borrowers_stats','most_borrowers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Analysis  $analysis
     * @return \Illuminate\Http\Response
     */
    public function show(Analysis $analysis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Analysis  $analysis
     * @return \Illuminate\Http\Response
     */
    public function edit(Analysis $analysis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Analysis  $analysis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Analysis $analysis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Analysis  $analysis
     * @return \Illuminate\Http\Response
     */
    public function destroy(Analysis $analysis)
    {
        //
    }
}
