@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card table-card">
                    <div class="card-header" style="margin-bottom: 1.0rem;">
                        <span>OB Logs </span>
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
                    @if (count($oblogs) > 0)

                        <div class="table-responsive" style="padding: 1.2rem; ">
                            <table class="table table-bordered datatable dtr-inline" width="100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th style="white-space:nowrap;">Event NAME</th>
                                        <th style="white-space:nowrap;">EVENT DATE</th>
                                        <th style="white-space:nowrap;">LOCATION</th>
                                        <th style="white-space:nowrap;">PRODUCER</th>
                                        <th style="white-space:nowrap;">DIRECTOR</th>
                                        <th style="white-space:nowrap;">VISION MIXER</th>
                                        <th style="white-space:nowrap;">SOUND</th>
                                        <th style="white-space:nowrap;">ENGINEER</th>
                                        <th style="white-space:nowrap;">D.O.P</th>
                                        <th style="white-space:nowrap;">REPORTER</th>
                                        <th style="white-space:nowrap;">DIGITAL </th>
                                        <th style="white-space:nowrap;">TRANSMISSION TIME</th>
                                        <th style="white-space:nowrap;">COMMENT</th>
                                        <th style="white-space:nowrap;">UPLOADED BY</th>
                                        <th style="white-space:nowrap;">Time of Upload</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($oblogs as $logs)
                                        <tr>
                                            <td><a
                                                    href="{{ route('oblogs.edit', $logs->id) }}"><i
                                                        class="far fa-edit"></i></a>
                                            </td>
                                            <td>{{ $logs->event_name }}</td>
                                            <td>{{ $logs->event_date }}</td>
                                            <td>{{ $logs->location }}</td>
                                            <td>{{ $logs->producer }}</td>
                                            <td>{{ $logs->director }}</td>
                                            <td>{{ $logs->vision_mixer }}</td>
                                            <td>{{ $logs->sound }}</td>
                                            <td>{{ $logs->engineer }}</td>
                                            <td>{{ $logs->dop }}</td>
                                            <td>{{ $logs->reporter }}</td>
                                            <td>{{ $logs->digital }}</td>
                                            <td>{{ $logs->transmission_time }}</td>
                                            <td>{{ $logs->comment }}</td>
                                            <td>{{ $logs->user->name }}</td>
                                            <td>{{ $logs->created_at }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="card">
                            <div class="card-body card-black">
                                <p>No Reports Have Been Added yet, Click <a href="{{ route('oblogs.create') }}"
                                        data-toggle="tooltip" title="" data-original-title="Add Report">Here</a> to add
                                    Reports
                                <p>
                                <p><a class="btn btn-primary" href="{{ route('oblogs.create') }}">Add a Report</a>
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
