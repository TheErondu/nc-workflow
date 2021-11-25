@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card table-card">
                <div class="card-header" style="margin-bottom: 1.0rem;">
                    <span>Graphics Logs For Shows </span>
                    <a href="{{route('graphics-shows.create')}}" style="background-color: rgb(0, 0, 0) !important;" type="submit"
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
                @if (count($graphics_log_shows) > 0)

                <div class="table-responsive">
                    <table class="table table-bordered datatable dtr-inline" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th style="white-space:nowrap;">Segment</th>
                                <th style="white-space:nowrap;">Rundown in</th>
                                <th style="white-space:nowrap;">Script in</th>
                                <th style="white-space:nowrap;">Anchor</th>
                                <th style="white-space:nowrap;">Director </th>
                                <th style="white-space:nowrap;">Host</th>
                                <th style="white-space:nowrap;">Engineeer</th>
                                <th style="white-space:nowrap;">Comment</th>
                                <th style="white-space:nowrap;">graphics</th>
                                <th style="white-space:nowrap;">Producer</th>
                                <th style="white-space:nowrap;">PA</th>
                                <th style="white-space:nowrap;">Engineer</th>
                                <th style="white-space:nowrap;">Challenges</th>
                                <th style="white-space:nowrap;">Uploaded By</th>
                                <th style="white-space:nowrap;">Time of Upload</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($graphics_log_shows as $log)
                            <tr>
                                    <td><a href="{{route('graphics-news.edit',
                                           $log->id)}}"><i class="far fa-edit"></i></a>
                                    </td>
                                    <td>{{ $log->segment }}</td>
                                    <td>{{ $log->rundown_in }}</td>
                                    <td>{{ $log->script_in }}</td>
                                    <td>{{ $log->anchor }}</td>
                                    <td>{{ $log->director }}</td>
                                    <td>{{ $log->host }}</td>
                                    <td>{{ $log->comment }}</td>
                                    <td>{{ $log->graphics }}</td>
                                    <td>{{ $log->producer }}</td>
                                    <td>{{ $log->pa }}</td>
                                    <td>{{ $log->host }}</td>
                                    <td>{{ $log->engineer }}</td>
                                    <td>{{ $log->challenges }}</td>
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
                      <p>No Logs Have Been Added yet, Click  <a href="{{ route('graphics-shows.create') }}" data-toggle="tooltip" title="" data-original-title="Add Report">Here</a> to add Logs<p>
                    <p><a class="btn btn-primary" href="{{ route('graphics-shows.create') }}">Add a Log</a>
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
