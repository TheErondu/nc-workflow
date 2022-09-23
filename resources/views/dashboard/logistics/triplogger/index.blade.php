@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card table-card">
                <div class="card-header" style="margin-bottom: 1.0rem;">
                    <span>Trip Logger </span>
                    <a href="{{route('triplogger.create')}}" style="background-color: rgb(0, 0, 0) !important;" type="submit"
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
                @if (count($triploggers) > 0)

                <div class="table-responsive">
                    <table class="table table-bordered datatable dtr-inline" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th style="white-space:nowrap;">Number Plate</th>
                                <th style="white-space:nowrap;">Production Make</th>
                                <th style="white-space:nowrap;">Trip date</th>
                                <th style="white-space:nowrap;">Designated Driver</th>
                                <th style="white-space:nowrap;">Odometer start</th>
                                <th style="white-space:nowrap;">Odometer Stop</th>
                                <th style="white-space:nowrap;">Trip Information</th>
                                <th style="white-space:nowrap;">Trip Distance</th>
                                <th style="white-space:nowrap;">Fuel Station</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($triploggers as $log)
                            <tr>
                                <td><a href="{{route('triplogger.edit', $log->id)}}"><i class="far fa-edit"></i></a></td>
                                <td>{{ $log->number_plate }}</td>
                                    <td>{{ $log->production_name }}</td>
                                    <td>{{ $log->trip_date }}</td>
                                    <td>{{ $log->assigned_driver }}</td>
                                    <td>{{ $log->odometer_start }}</td>
                                    <td>{{ $log->odometer_stop }}</td>
                                    <td>{{ $log->trip_information }}</td>
                                    <td>{{ $log->trip_distance }}</td>
                                    <td>{{ $log->fuel_station }}</td>


                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                @else
                <div class="card">
                    <div class="card-body card-black">
                      <p>No Vehicles Have Been Added yet, Click  <a href="{{ route('triplogger.create') }}" data-toggle="tooltip" title="" data-original-title="Add Vehicles">Here</a> to add Logs<p>
                    <p><a class="btn btn-primary" href="{{ route('triplogger.create') }}">Add Trip Log</a>
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
    "bDestroy":true,
    "sPaginationType": "bootstrap", // full_numbers
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
