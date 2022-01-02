<?php

namespace App\Http\Controllers;
use App\Services\Analytics;
use App\Models\Analysis;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
class AnalysisController extends Controller
{

    protected $analytics;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(Analytics $analytics)
    {
        $this->analytics = $analytics;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|Response
     * @throws Exception
     */
    public function index()
    {
       $departmentData = $this->analytics->GetDepartmentInfo();
       $engineerData = $this->analytics->GetEngineerStats();
       $borrowerData = $this->analytics->GetBorrowerStats();
       $producerData = $this->analytics->GetProducerStats();
       $directorData = $this->analytics->GetDirectorStats();
       $editorData = $this->analytics->GetVideoEditorStats();



        return view('dashboard.analytics.main',
        compact('departmentData','engineerData',
        'borrowerData','producerData','directorData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Analysis  $analysis
     * @return Response
     */
    public function show(Analysis $analysis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Analysis  $analysis
     * @return Response
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
     * @return Response
     */
    public function update(Request $request, Analysis $analysis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Analysis  $analysis
     * @return Response
     */
    public function destroy(Analysis $analysis)
    {
        //
    }
}
