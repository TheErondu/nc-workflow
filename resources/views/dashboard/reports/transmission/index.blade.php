@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card table-card">
                <div class="card-header" style="margin-bottom: 1.0rem;">
                    <span>Production Logs </span>
                    <a href="{{route('transmission.create')}}" style="background-color: rgb(0, 0, 0) !important;" type="submit"
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
                @if (count($tx_reports) > 0)

                <div class="table-responsive">
                    <table class="table table-bordered datatable dtr-inline" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th style="white-space:nowrap;">TC ON DUTY</th>
                                <th style="white-space:nowrap;">1PM Stories</th>
                                <th style="white-space:nowrap;">7PM Stories</th>
                                <th style="white-space:nowrap;">9PM Stories</th>
                                <th style="white-space:nowrap;">CLOSED AT</th>
                                <th style="white-space:nowrap;">Uploaded By</th>
                                <th style="white-space:nowrap;">Time of Upload</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tx_reports as $log)
                            <tr>
                                    <td><a href="{{route('editors.edit',
                                           $log->id)}}"><i class="far fa-edit"></i></a>
                                    </td>
                                    <td>{{ $log->tc_on_duty }}</td>
                                    <td>{{ $log->first_interval }}</td>
                                    <td>{{ $log->second_interval }}</td>
                                    <td>{{ $log->third_interval }}</td>
                                    <td>{{ $log->closed_at }}</td>
                                    <td>{{ $log->remarks }}</td>
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
                      <p>No Logs Have Been Added yet, Click  <a href="{{ route('transmission.create') }}" data-toggle="tooltip" title="" data-original-title="Add Report">Here</a> to add Logs<p>
                    <p><a class="btn btn-primary" href="{{ route('transmission.create') }}">Add a Log</a>
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
