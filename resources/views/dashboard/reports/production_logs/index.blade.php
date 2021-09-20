@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card table-card">
                <div class="card-header" style="margin-bottom: 1.0rem;">
                    <span>Production Logs </span>
                    <a href="{{route('production.create')}}" style="background-color: rgb(0, 0, 0) !important;" type="submit"
                    class="btn btn-primary create-button">Add New Log <i class="fas fa-plus"></i></a>
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
                @if (count($production_logs) > 0)

                <div class="table-responsive" style="padding: 1.2rem; ">
                    <table class="table table-bordered datatable dtr-inline" width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th style="white-space:nowrap;">Date</th>
                                <th style="white-space:nowrap;">Location</th>
                                <th style="white-space:nowrap;">Producer 1</th>
                                <th style="white-space:nowrap;">Producer 2</th>
                                <th style="white-space:nowrap;">Director </th>
                                <th style="white-space:nowrap;">Vision mixer</th>
                                <th style="white-space:nowrap;">Engineeer</th>
                                <th style="white-space:nowrap;">Sound Technician</th>
                                <th style="white-space:nowrap;">Camera Operator 1</th>
                                <th style="white-space:nowrap;">Camera Operator 2</th>
                                <th style="white-space:nowrap;">Host </th>
                                <th style="white-space:nowrap;">Graphics</th>
                                <th style="white-space:nowrap;">Digital</th>
                                <th style="white-space:nowrap;">Transmission</th>
                                <th style="white-space:nowrap;">Transmission Time</th>
                                <th style="white-space:nowrap;">Uploaded By</th>
                                <th style="white-space:nowrap;">Time of Upload</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($production_logs as $log)
                            <tr>
                                    <td><a href="{{route('production.edit',
                                           $log->id)}}"><i class="far fa-edit"></i></a>
                                    </td>
                                    <td>{{ $log->date }}</td>
                                    <td>{{ $log->location }}</td>
                                    <td>{{ $log->producer1 }}</td>
                                    <td>{{ $log->producer2 }}</td>
                                    <td>{{ $log->director }}</td>
                                    <td>{{ $log->vision_mixer }}</td>
                                    <td>{{ $log->engineer }}</td>
                                    <td>{{ $log->sound_technician }}</td>
                                    <td>{{ $log->camera_operator1 }}</td>
                                    <td>{{ $log->camera_operator2 }}</td>
                                    <td>{{ $log->host }}</td>
                                    <td>{{ $log->graphics }}</td>
                                    <td>{{ $log->digital }}</td>
                                    <td>{{ $log->transmission }}</td>
                                    <td>{{ $log->transmission_time }}</td>
                                    <td>{{ $log->user->name }}</td>
                                    <td>{{ $log->created_at }}</td>


                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                @else
                <div class="card">
                    <div class="card-body card-black">
                      <p>No Logs Have Been Added yet, Click  <a href="{{ route('production.create') }}" data-toggle="tooltip" title="" data-original-title="Add Report">Here</a> to add Logs<p>
                    <p><a class="btn btn-primary" href="{{ route('production.create') }}">Add a Log</a>
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
