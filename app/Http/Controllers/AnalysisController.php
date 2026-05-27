<?php

namespace App\Http\Controllers;

use App\Services\Analytics;
use Illuminate\Http\Request;

class AnalysisController extends Controller
{
    public function __construct(protected Analytics $analytics) {}

    public function index()
    {
        $summary        = $this->analytics->GetSummaryStats();
        $trend          = $this->analytics->GetIssuesTrend();
        $topEquipment   = $this->analytics->GetTopEquipment();
        $departments    = $this->analytics->GetDepartmentInfo();
        $engineers      = $this->analytics->GetEngineerStats();
        $borrowers      = $this->analytics->GetBorrowerStats();
        $producers      = $this->analytics->GetProducerStats();
        $editors        = $this->analytics->GetVideoEditorStats();
        $oblogs         = $this->analytics->GetOBLogStats();
        $graphics       = $this->analytics->GetGraphicslogStats();

        return view('dashboard.analytics.main', compact(
            'summary', 'trend', 'topEquipment', 'departments',
            'engineers', 'borrowers', 'producers', 'editors', 'oblogs', 'graphics'
        ));
    }

    public function create() {}
    public function store(Request $request) {}
    public function show($id) {}
    public function edit($id) {}
    public function update(Request $request, $id) {}
    public function destroy($id) {}
}
