@extends('layouts.app')
@section('content')
<div class="container-fluid">

    <div class="header">
        <h1 class="header-title">Analytics</h1>
        <p class="header-subtitle text-muted">Operational overview — updated on every page load</p>
    </div>

    {{-- ── Key stat cards ─────────────────────────────────────────── --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3 col-xl">
            <div class="card-opaque h-100">
                <div class="card-body py-3">
                    <div class="text-muted mb-1" style="font-size:.72rem;text-transform:uppercase;letter-spacing:.06em;">Open Issues</div>
                    <div style="font-size:1.9rem;font-weight:700;color:#c0392b;">{{ $summary['openIssues'] }}</div>
                    <div class="text-muted" style="font-size:.78rem;">of {{ $summary['totalIssues'] }} total</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3 col-xl">
            <div class="card-opaque h-100">
                <div class="card-body py-3">
                    <div class="text-muted mb-1" style="font-size:.72rem;text-transform:uppercase;letter-spacing:.06em;">Closed Issues</div>
                    <div style="font-size:1.9rem;font-weight:700;color:#27ae60;">{{ $summary['closedIssues'] }}</div>
                    <div class="text-muted" style="font-size:.78rem;">{{ $summary['monthIssues'] }} raised this month</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3 col-xl">
            <div class="card-opaque h-100">
                <div class="card-body py-3">
                    <div class="text-muted mb-1" style="font-size:.72rem;text-transform:uppercase;letter-spacing:.06em;">Store Requests</div>
                    <div style="font-size:1.9rem;font-weight:700;color:#e67e22;">{{ $summary['pendingStore'] }}</div>
                    <div class="text-muted" style="font-size:.78rem;">pending approval</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3 col-xl">
            <div class="card-opaque h-100">
                <div class="card-body py-3">
                    <div class="text-muted mb-1" style="font-size:.72rem;text-transform:uppercase;letter-spacing:.06em;">Production Logs</div>
                    <div style="font-size:1.9rem;font-weight:700;color:#3498db;">{{ $summary['prodLogs'] }}</div>
                    <div class="text-muted" style="font-size:.78rem;">all time submissions</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3 col-xl">
            <div class="card-opaque h-100">
                <div class="card-body py-3">
                    <div class="text-muted mb-1" style="font-size:.72rem;text-transform:uppercase;letter-spacing:.06em;">Active Staff</div>
                    <div style="font-size:1.9rem;font-weight:700;color:#9b59b6;">{{ $summary['activeStaff'] }}</div>
                    <div class="text-muted" style="font-size:.78rem;">registered employees</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Issues trend + Top equipment ──────────────────────────── --}}
    <div class="row g-3 mb-4">
        <div class="col-12 col-lg-7">
            <div class="card-opaque h-100">
                <div class="card-header" style="background:#272727;">
                    <h5 class="card-title mb-0">Issues Trend — Last 6 Months</h5>
                </div>
                <div class="card-body">
                    <div style="height:220px;"><canvas id="chart-trend"></canvas></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-5">
            <div class="card-opaque h-100">
                <div class="card-header" style="background:#272727;">
                    <h5 class="card-title mb-0">Most Reported Equipment</h5>
                </div>
                <div class="card-body">
                    <div style="height:220px;"><canvas id="chart-equipment"></canvas></div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Engineers ──────────────────────────────────────────────── --}}
    <div class="header mt-3"><h1 class="header-title">Engineering</h1></div>
    <div class="row g-3 mb-4">
        <div class="col-12 col-lg-6">
            <div class="card-opaque">
                <div class="card-header" style="background:#272727;">
                    <h5 class="card-title mb-0">Most Active Engineers</h5>
                    <small class="text-muted">By number of issues resolved</small>
                </div>
                <div class="card-body">
                    <div style="height:200px;"><canvas id="chart-eng-top"></canvas></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card-opaque">
                <div class="card-header" style="background:#272727;">
                    <h5 class="card-title mb-0">Least Active Engineers</h5>
                    <small class="text-muted">By number of issues resolved</small>
                </div>
                <div class="card-body">
                    <div style="height:200px;"><canvas id="chart-eng-bottom"></canvas></div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Production & Editing ───────────────────────────────────── --}}
    <div class="header mt-3"><h1 class="header-title">Production &amp; Editing</h1></div>
    <div class="row g-3 mb-4">
        <div class="col-12 col-lg-6">
            <div class="card-opaque">
                <div class="card-header" style="background:#272727;">
                    <h5 class="card-title mb-0">Most Active Producers</h5>
                    <small class="text-muted">By submitted production logs</small>
                </div>
                <div class="card-body">
                    <div style="height:200px;"><canvas id="chart-prod-top"></canvas></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card-opaque">
                <div class="card-header" style="background:#272727;">
                    <h5 class="card-title mb-0">Least Active Producers</h5>
                    <small class="text-muted">By submitted production logs</small>
                </div>
                <div class="card-body">
                    <div style="height:200px;"><canvas id="chart-prod-bottom"></canvas></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card-opaque">
                <div class="card-header" style="background:#272727;">
                    <h5 class="card-title mb-0">Most Active Video Editors</h5>
                    <small class="text-muted">By submitted editor logs</small>
                </div>
                <div class="card-body">
                    <div style="height:200px;"><canvas id="chart-edit-top"></canvas></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card-opaque">
                <div class="card-header" style="background:#272727;">
                    <h5 class="card-title mb-0">Least Active Video Editors</h5>
                    <small class="text-muted">By submitted editor logs</small>
                </div>
                <div class="card-body">
                    <div style="height:200px;"><canvas id="chart-edit-bottom"></canvas></div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── OB Logs & Graphics ─────────────────────────────────────── --}}
    <div class="header mt-3"><h1 class="header-title">OB Logs &amp; Graphics</h1></div>
    <div class="row g-3 mb-4">
        <div class="col-12 col-lg-4">
            <div class="card-opaque">
                <div class="card-header" style="background:#272727;">
                    <h5 class="card-title mb-0">Top OB Log Users</h5>
                </div>
                <div class="card-body">
                    <div style="height:200px;"><canvas id="chart-ob-top"></canvas></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card-opaque">
                <div class="card-header" style="background:#272727;">
                    <h5 class="card-title mb-0">Top Graphics Log Users</h5>
                </div>
                <div class="card-body">
                    <div style="height:200px;"><canvas id="chart-gfx-top"></canvas></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card-opaque">
                <div class="card-header" style="background:#272727;">
                    <h5 class="card-title mb-0">Top Graphics Show Users</h5>
                </div>
                <div class="card-body">
                    <div style="height:200px;"><canvas id="chart-gfx-shows"></canvas></div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Store & Staff ──────────────────────────────────────────── --}}
    <div class="header mt-3"><h1 class="header-title">Store &amp; Staff</h1></div>
    <div class="row g-3 mb-4">
        <div class="col-12 col-lg-6">
            <div class="card-opaque">
                <div class="card-header" style="background:#272727;">
                    <h5 class="card-title mb-0">Top Store Borrowers</h5>
                    <small class="text-muted">Most store requests raised</small>
                </div>
                <div class="card-body">
                    <div style="height:200px;"><canvas id="chart-borrowers"></canvas></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card-opaque">
                <div class="card-header" style="background:#272727;">
                    <h5 class="card-title mb-0">Staff by Department</h5>
                    <small class="text-muted">Active employee distribution</small>
                </div>
                <div class="card-body">
                    <div style="height:200px;"><canvas id="chart-departments"></canvas></div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('javascript')
@include('dashboard.analytics.chart-scripts')
@endsection
