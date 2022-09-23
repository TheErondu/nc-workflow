@extends('layouts.app')
@section('content')
<div class="container-fluid">

    <div class="header">
        <h1 class="header-title">
          Ticket Analytics
        </h1>
    </div>
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Most Active Engineer</h5>
                    <h6 class="card-subtitle text-muted">Top Three Engineers who have the highest number of resolved issues</h6>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="chartjs-bar0"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Least Active Engineer</h5>
                    <h6 class="card-subtitle text-muted">Least Three Engineers who have the Lowest number of resolved issues</h6>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="chartjs-bar1"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Most Active Borrower</h5>
                    <h6 class="card-subtitle text-muted">A bar chart provides a way of showing data values represented as vertical bars.</h6>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="chartjs-bar2"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>
   <div class="header">
        <h1 class="header-title">
          Producers & Directors Statistics
        </h1>
    </div>
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Most Active Producers</h5>
                    <h6 class="card-subtitle text-muted">Top Three Producers who have the highest number of Submitted Logs. </h6>
                </div>
                <div class="chart">
                    <canvas id="chartjs-bar3"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">least Active Producer</h5>
                    <h6 class="card-subtitle text-muted">Least Three Producers who have the Lowest number of Submitted Logs. </h6>
                </div>
                <div class="chart">
                    <canvas id="chartjs-bar4"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Most Active Editor</h5>
                    <h6 class="card-subtitle text-muted">Top Three Video Editors who have the highest number of Submitted Logs. </h6>
                </div>
                <div class="chart">
                    <canvas id="chartjs-bar5"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Least Active Editor</h5>
                    <h6 class="card-subtitle text-muted">Least Three Video Editors who have the lowest number of Submitted Logs. </h6>
                </div>
                <div class="chart">
                    <canvas id="chartjs-bar6"></canvas>
                </div>
            </div>
        </div>
        <div class="header">
            <h1 class="header-title">
            OB logs Statistics
            </h1>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Most Active Users</h5>
                        <h6 class="card-subtitle text-muted">Top Three Users who have the highest number of Submitted Logs. </h6>
                    </div>
                    <div class="chart">
                        <canvas id="chartjs-bar7"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">least Active Users</h5>
                        <h6 class="card-subtitle text-muted">Least Three Users who have the Lowest number of Submitted Logs. </h6>
                    </div>
                    <div class="chart">
                        <canvas id="chartjs-bar8"></canvas>
                    </div>
                </div>
            </div>
            <div class="header">
                <h1 class="header-title">
                Graphics logs Statistics
                </h1>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Most Active Users</h5>
                            <h6 class="card-subtitle text-muted">Top Three Users who have the highest number of Submitted Logs. </h6>
                        </div>
                        <div class="chart">
                            <canvas id="chartjs-bar9"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">least Active Users</h5>
                            <h6 class="card-subtitle text-muted">Least Three Users who have the Lowest number of Submitted Logs. </h6>
                        </div>
                        <div class="chart">
                            <canvas id="chartjs-bar10"></canvas>
                        </div>
                    </div>
                </div>
        {{--  <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Bar Chart</h5>
                    <h6 class="card-subtitle text-muted">A bar chart provides a way of showing data values represented as vertical bars.</h6>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="chartjs-bar4"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Bar Chart</h5>
                    <h6 class="card-subtitle text-muted">A bar chart provides a way of showing data values represented as vertical bars.</h6>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="chartjs-bar5"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Bar Chart</h5>
                    <h6 class="card-subtitle text-muted">A bar chart provides a way of showing data values represented as vertical bars.</h6>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="chartjs-bar6"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="header">
        <h1 class="header-title">
          Equipment Utilization
        </h1>
    </div>
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Bar Chart</h5>
                    <h6 class="card-subtitle text-muted">A bar chart provides a way of showing data values represented as vertical bars.</h6>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="chartjs-bar7"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Bar Chart</h5>
                    <h6 class="card-subtitle text-muted">A bar chart provides a way of showing data values represented as vertical bars.</h6>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="chartjs-bar8"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div> --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Users by Department</h5>
                    <h6 class="card-subtitle text-muted">Shows the staff size by Departments</h6>
                </div>
                <div class="card-body">
                    <div class="chart chart-xs">
                        <canvas id="chartjs-pie"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
@include('dashboard.analytics.chart-scripts')
@endsection
