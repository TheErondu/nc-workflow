@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-opaque">
                    <div class="card-header" style="background-color: #272727;">
                        <h5 class="card-title" style="color: white;">Calculate Mileage</h5>

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
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data"
                            action="{{ route('tracker.update', $tracker->id) }}">
                            @method('PUT')
                            @csrf

                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-4" id="vehicle_id">
                                    <label for="vehicle_id">Number plate </label>
                                    <select class="form-control select2" name="vehicle_id"
                                        data-placeholder=" select Vehicle" >
                                        <option value="" selected>select</option>
                                        @foreach ($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id  }}" @if($tracker->vehicle_id === $vehicle->id) selected='selected' @endif>{{ $vehicle->number_plate }}

                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class=" row justify-content-between">
                                    <div class="mb-3 col-md-6">
                                        <label for="odometer_reading">Odometer Reading </label>
                                        <input name="odometer_reading" type="text" class="form-control"
                                            id="odometer_reading" value="{{ $tracker->odometer_reading }}" required
                                            placeholder="">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Refuel Date</label>
                                        <div class="input-group date" id="datetimepicker-minimum"
                                            data-target-input="nearest">
                                            <input name="refuel_date" value="{{ $tracker->refuel_date }}" type="text"
                                                class="form-control datetimepicker-input"
                                                data-target="#datetimepicker-minimum" />
                                            <div class="input-group-text" data-target="#datetimepicker-minimum"
                                                data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
                                        </div>

                                    </div>
                                    <div class="row justify-content-between">
                                        <div class="mb-3 col-md-6">
                                            <label for="fuel_added">Fuel Added (In Litres)</label>
                                            <input name="fuel_added" type="text" class="form-control" id="fuel_added"
                                                value="{{ $tracker->fuel_added }}" required placeholder="">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="fuel_cost">Fuel Cost </label>
                                            <input name="fuel_cost" type="text" class="form-control" id="fuel_cost"
                                                value="{{ $tracker->fuel_cost }}" required placeholder="">
                                        </div>
                                    </div>

                                    <div class="row justify-content-between">
                                        <div class="mb-3 col-md-6">
                                            <button form="delete-form" style="background-color: red !important;"
                                                type="submit" class="btn btn-primary">Delete</button>
                                        </div>
                                        <div class="mb-3 col-md-1">
                                            <button style="background-color: rgb(37, 38, 38) !important;" type="submit"
                                                class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                        </form>
                        <form action="{{ route('tracker.destroy', $tracker->id) }}" id="delete-form" method="POST">
                            @method('DELETE')
                            @csrf

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('javascript')

    <script>
        document.addEventListener("DOMContentLoaded", function() {

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
