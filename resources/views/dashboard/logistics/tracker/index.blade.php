@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card table-card">
                <div class="card-header" style="margin-bottom: 1.0rem;">
                    <span>Mileage Tracker </span>
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
                <div class=" row justify-content-around">
                    <div class="mb-3 col-md-4">
                        <label for="number_plate">Number plate </label>
                        <select class="form-control select2" name="number_plate" id="number_plate">
                            <option value="">Search </option>
                            @foreach ($mileage_trackers as $tracker)
                                <option value="{{ $tracker->number_plate }}">{{ $tracker->number_plate }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @if (count($mileage_trackers) > 0)

                <div class="table-responsive" style="padding: 1.2rem; ">
                    <table class="table datatable dtr-inline" width="100%">
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
                            @foreach ($mileage_trackers as $mileage)
                            <tr>
                                <td><a href="{{route('triplogger.edit', $log->id)}}"><i class="far fa-edit"></i></a></td>
                                <td>{{ $mileage->number_plate }}</td>
                                    <td>{{ $mileage->production_name }}</td>
                                    <td>{{ $mileage->trip_date }}</td>
                                    <td>{{ $mileage->assigned_driver }}</td>
                                    <td>{{ $mileage->odometer_start }}</td>
                                    <td>{{ $mileage->odometer_stop }}</td>
                                    <td>{{ $mileage->trip_information }}</td>
                                    <td>{{ $mileage->trip_distance }}</td>
                                    <td>{{ $mileage->fuel_station }}</td>


                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                @else
                <div class="card">
                    <div class="card-body card-black">
                      <p>No Mileage Trackers Have Been Added yet, Click  <a href="{{ route('tracker.create') }}" data-toggle="tooltip" title="" data-original-title="Add Tracker">Here</a> to add a Mileage Tracker<p>
                    <p><a class="btn btn-primary" href="{{ route('tracker.create') }}">Add Mileage Tracker</a>
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
        // Select2
        $(".select2").each(function() {
                $(this)
                    .wrap("<div class=\"position-relative\"></div>")
                    .select2({
                        placeholder: "Select value",
                        dropdownParent: $(this).parent()
                    });
            })
            // Datetimepicker
            $('#datetimepicker-minimum').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });
            $('#datetimepicker-minimum2').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });
            $('#datetimepicker-view-mode').datetimepicker({
                viewMode: 'years'
            });
            $('#datetimepicker-time').datetimepicker({
                format: 'LT'
            });
            $('#datetimepicker-date').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });
    });
</script>

@endsection
