@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class=" row justify-content-around">
            <div class="col-12">
                <div class="card-opaque" style="margin-bottom: 1.0rem;">
                    <div class=" row justify-content-around">
                        <div class="mb-3 col-md-4">
                            <label for="vehicle_id">Showing Records for :</label>
                            <select class="form-control select2" name="vehicle_id" id="vehicle_id"
                                data-placeholder=" {{ $vehicle->number_plate }}" onchange="document.location.href=this.value">
                                <option value="" selected>select</option>
                                @foreach ($vehicles as $vehicle)
                                <option value="{{ route('tracker.track',$vehicle->id ) }}">{{ $vehicle->number_plate }}</option>
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-around" style="margin: 0.0rem;">
                        <div class="col-12 col-lg-6">
                            <div class="card-chart flex-fill w-100">
                                <div class="card-header">
                                    <h5>Mileage Chart(Km/Litre)</h5>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <canvas id="chartjs-line"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="card-chart flex-fill w-100">
                                <div class="card-header">
                                    <h5>Cost Chart (Cost/Km)</h5>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <canvas id="chartjs-line2"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card table-card">
                        <div class="card-header" style="margin-bottom: 1.0rem;">
                            <span>Mileage Tracker</span> &nbsp;
                            <a class="btn btn-primary" href="{{ route('tracker.create') }}">Calculate Mileage</a>
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

                        @if (count($mileage_trackers) > 0)

                            <div class="table-responsive">
                                <table class="table table-bordered display nowrap" width="100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th style="white-space:nowrap;">Odometer reading</th>
                                            <th style="white-space:nowrap;">Fuel Added</th>
                                            <th style="white-space:nowrap;">fuel Cost</th>
                                            <th style="white-space:nowrap;">Refuel date</th>
                                            <th style="white-space:nowrap;">Kilometres</th>
                                            <th style="white-space:nowrap;">Cost Per Litre</th>
                                            <th style="white-space:nowrap;">Mileage</th>
                                            <th style="white-space:nowrap;">Cost Per Km</th>
                                            <th style="white-space:nowrap;">Number Plate</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mileage_trackers as $tracker)
                                            <tr>
                                                <td><a href="{{ route('tracker.edit', $tracker->id) }}">
                                                        <i class="far fa-edit"></i></a></td>
                                                <td>{{ $tracker->odometer_reading }}</td>
                                                <td>{{ $tracker->fuel_added }}</td>
                                                <td>{{ round($tracker->fuel_cost,2) }}</td>
                                                <td>{{ $tracker->refuel_date }}</td>

                                                <td>{{ round($tracker->kilometres,2)}}</td>
                                                <td>{{ round($tracker->cost_per_litre,2)}}</td>
                                                <td>{{ round($tracker->mileage, 2)}}</td>
                                                <td>{{ round($tracker->cost_per_km,2)}}</td>
                                                <td>{{ $tracker->vehicle->number_plate }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="card">
                                <div class="card-body card-black">
                                    <p>No Mileage Trackers Have Been Added yet, Click <a
                                            href="{{ route('tracker.create') }}" data-toggle="tooltip" title=""
                                            data-original-title="Add Tracker">Here</a> to add a
                                        Mileage Tracker
                                    <p>
                                    <p><a class="btn btn-primary" href="{{ route('tracker.create') }}">Add Mileage
                                            Tracker</a>
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
                    "bDestroy": true,
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

                // Line chart 1
                new Chart(document.getElementById("chartjs-line"), {
                    type: "line",
                    data: {
                        labels: {!! $dates !!},
                        datasets: [{
                            label: "Mileage (miles)",
                            fill: true,
                            backgroundColor: "transparent",
                            borderColor: window.theme.primary,
                            data: {!! $mileage !!}
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        legend: {
                            display: true
                        },
                        tooltips: {
                            intersect: true
                        },
                        hover: {
                            intersect: true
                        },
                        plugins: {
                            filler: {
                                propagate: false
                            }
                        },
                        scales: {
                            xAxes: [{
                                reverse: true,
                                gridLines: {
                                    color: "rgba(0,0,0,0.05)"
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                    stepSize: 0.1,
                                    callback: function(value, index, values) {
                                    return value +' miles' ;
                                    }
                                },
                                display: true,
                                borderDash: [5, 5],
                                gridLines: {
                                    color: "rgba(0,0,0,0)",
                                    fontColor: "#fff"
                                }
                            }]
                        }
                    }
                });
                // Line chart 2
                new Chart(document.getElementById("chartjs-line2"), {
                    type: "line",
                    data: {
                        labels: {!! $dates !!},
                        datasets: [{
                            label: "Cost per km (₦)",
                            fill: true,
                            backgroundColor: "transparent",
                            borderColor: window.theme.primary,
                            data: {!! $cost_per_km !!}
                        }, {
                            label: "Cost per Litre (₦)",
                            fill: true,
                            backgroundColor: "transparent",
                            borderColor: window.theme.tertiary,
                            borderDash: [4, 4],
                            data: {!! $cost_per_litre !!}
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        legend: {
                            display: true
                        },
                        tooltips: {
                            intersect: false
                        },
                        hover: {
                            intersect: true
                        },
                        plugins: {
                            filler: {
                                propagate: false
                            }
                        },
                        scales: {
                            xAxes: [{
                                reverse: true,
                                gridLines: {
                                    color: "rgba(0,0,0,0.05)"
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                    stepSize: 500,
                                    callback: function(value, index, values) {
                                    return '₦' + value;
                                    }
                                },
                                display: true,
                                borderDash: [5, 5],
                                gridLines: {
                                    color: "rgba(0,0,0,0)",
                                    fontColor: "#fff"
                                }
                            }]
                        }
                    }
                });
            });
        </script>

    @endsection
