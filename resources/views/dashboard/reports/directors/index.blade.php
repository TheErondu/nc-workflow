@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card table-card">
                <div class="card-header" style="margin-bottom: 1.0rem;">
                    <span>Director's Report Detail </span>
                </div>
                <div class="row">
                    @if (Session::has('message'))
                        <div class="container">
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <div class="alert-icon">
                                    <i class="far fa-fw fa-bell"></i>
                                </div>
                                <div class="alert-message">
                                    <strong> {{ session('message') }}</strong>
                                </div>

                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="container">
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                @foreach ($errors->all() as $error)
                                    <div class="alert-icon">
                                        <i class="far fa-fw fa-bell"></i>
                                    </div>
                                    <div class="alert-message">
                                        <strong> {{ $error }}</strong>
                                    </div>

                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                @if (count($directors_report) > 0)

                <div class="table-responsive" style="padding: 1.2rem; ">
                    <table <table class="table table-bordered datatable dtr-inline" width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th style="white-space:nowrap;">Bulletin 1</th>
                                <th style="white-space:nowrap;">DTS In</th>
                                <th style="white-space:nowrap;">Actual In</th>
                                <th style="white-space:nowrap;">Variance</th>
                                <th style="white-space:nowrap;">DTS Out</th>
                                <th style="white-space:nowrap;">Actual Out</th>
                                <th style="white-space:nowrap;">Variance</th>
                                <th style="white-space:nowrap;">Comment</th>
                                <th style="white-space:nowrap;">Bulletin 2</th>
                                <th style="white-space:nowrap;">DTS In</th>
                                <th style="white-space:nowrap;">Actual In</th>
                                <th style="white-space:nowrap;">Variance</th>
                                <th style="white-space:nowrap;">DTS Out</th>
                                <th style="white-space:nowrap;">Actual Out</th>
                                <th style="white-space:nowrap;">Variance</th>
                                <th style="white-space:nowrap;">Comment</th>
                                <th style="white-space:nowrap;">Uploaded By</th>
                                <th style="white-space:nowrap;">Time of Upload</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($directors_report as $report)
                            <tr>
                                    <td><a href="{{route('reports.edit',
                                           $report->id)}}"><i class="far fa-edit"></i></a>
                                    </td>
                                    <td>{{ $report->bulletin }}</td>
                                    <td>{{ $report->dts_in }}</td>
                                    <td>{{ $report->actual_in }}</td>
                                    <td>{{ $report->variance1 }}</td>
                                    <td>{{ $report->dts_out }}</td>
                                    <td>{{ $report->actual_out }}</td>
                                    <td>{{ $report->variance2 }}</td>
                                    <td>{{ $report->comment }}</td>
                                    <td>{{ $report->b2bulletin }}</td>
                                    <td>{{ $report->b2dts_in }}</td>
                                    <td>{{ $report->b2actual_in }}</td>
                                    <td>{{ $report->b2variance1 }}</td>
                                    <td>{{ $report->b2dts_out }}</td>
                                    <td>{{ $report->b2actual_out }}</td>
                                    <td>{{ $report->b2variance2 }}</td>
                                    <td>{{ $report->b2comment }}</td>
                                    <td>{{ $report->user->name }}</td>
                                    <td>{{ $report->created_at }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                @else
                <div class="card">
                    <div class="card-body card-black">
                      <p>No Reports Have Been Added yet, Click  <a href="{{ route('reports.create') }}" data-toggle="tooltip" title="" data-original-title="Add Report">Here</a> to add Reports<p>
                    <p><a class="btn btn-primary" href="{{ route('reports.create') }}">Add a Report</a>
                    </p>
                </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>
@endsection
@section('javascript')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        /* = NOTE : don't add "id" in <table> if not necessary, is added than replace each "id" here = */
        $('.table').DataTable({
            responsive: false,
            "sAutoWidth": true,
    "iDisplayStart ": 10,
    "iDisplayLength": 10,
    "bPaginate": false, //hide pagination
    "bFilter": true, //hide Search bar
    "bInfo": false,
        });
        /* =========================================================================================== */
        /* ============================ BOOTSTRAP 3/4 EVENT ========================================== */
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust().responsive.recalc();
        });
        /* =========================================================================================== */
    });
</script>

@endsection
