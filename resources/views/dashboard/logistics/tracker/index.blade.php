@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class=" row justify-content-around">
            <div class="col-12">
                <div class="card-opaque" style="margin-bottom: 1.0rem;">
                    <div class=" row justify-content-around">
                        <div class="mb-3 col-md-4" id="vehicle_id">
                            <label for="vehicle_id">Number plate </label>
                            <select class="form-control select2" name="vehicle_id"
                                data-placeholder=" select Entry" onchange="location = this.value;">
                                <option value="" selected>select</option>
                                @foreach ($vehicles as $vehicle)
                                    <option value="{{ route('tracker.track',$vehicle->id ) }}">
                                        {{ $vehicle->number_plate }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card table-card">
                        <div class="card-header" style="margin-bottom: 1.0rem;">
                            <span>Mileage Tracker</span>
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

                            <div class="card">
                                <div class="card-body card-black">
                                    <p>No data to display! </p>
                                    <br>
                                    <p>Select an entry </a> or  Click  &nbsp; <a class="btn btn-primary" href="{{ route('tracker.create') }}">Calculate Mileage</a>&nbsp; to Create a new Entry</p>

                                </div>
                            </div>
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

            });
        </script>


    @endsection
