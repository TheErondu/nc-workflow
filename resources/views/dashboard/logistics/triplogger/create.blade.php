@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-opaque">
                    <div class="card-header" style="background-color: #272727;">
                        <h5 class="card-title" style="color: white;">Add Trip Log</h5>

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
                        <form method="POST" enctype="multipart/form-data" action="{{ route('triplogger.store') }}">
                            @csrf

                            <div class=" row justify-content-around">
                                <div class="mb-3 col-md-4">
                                    <label for="number_plate">Number plate </label>
                                    <select class="form-control select2" name="number_plate" required id="number_plate">
                                        <option value="not Assigned">--Not Assigned--</option>
                                        @foreach ($vehicles as $vehicle)
                                            <option value="{{ $vehicle->number_plate }}">{{ $vehicle->number_plate }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="assigned_driver">User</label>
                                    <select class="form-control select2" name="assigned_driver" required id="assigned_driver">
                                        <option value="{{ Auth::user()->name }}">{{ Auth::user()->name }}</option>
                                        @foreach ($drivers as $driver)
                                            <option value="{{ $driver->name }}">{{ $driver->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <input id="type" name="type" class="form-control type" hidden value="award" required
                                type="text">
                            <div class="row justify-content-around">
                                <div class="mb-3 col-md-4">
                                    <label for="production_name">Production Name</label>
                                    <select class="form-control select2" name="production_name" required id="production_name">
                                        @foreach ($assignedProductions as $production)
                                            <option value="{{ $production->title }}">{{ $production->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label"><h3>Trip Date : {{date('Y-m-d h:i:s')}}<h3></label>
                                        <input type="" hidden readonly name="trip_date" value="{{date('Y-m-d h:i:s')}}">

                                </div>

                                <div class="row justify-content-between">
                                    <div class="mb-3 col-md-6">
                                        <label for="odometer_start">Odometer Start</label>
                                        <input name="odometer_start" type="text" class="form-control" id="odometer_start"
                                            value="{{ old('odometer_start') }}" required placeholder="">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="odometer_stop">Odometer Stop</label>
                                        <input name="odometer_stop" type="text" class="form-control" id="odometer_stop"
                                            value="{{ old('odometer_stop') }}" required placeholder="">
                                    </div>
                                </div>
                                <div class="row justify-content-between">
                                    <div class="mb-3 col-md-6">
                                        <label for="trip_distance">Trip Distance</label>
                                        <input name="trip_distance" type="text" class="form-control" id="trip_distance"
                                            value="{{ old('trip_distance') }}" required placeholder="">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="fuel_station">Fuel Station Used</label>
                                        <input name="fuel_station" type="text" class="form-control" id="fuel_station"
                                            value="{{ old('fuel_station') }}" required placeholder="">
                                    </div>
                                </div>
                                <div class="row justify-content-between">
                                    <div class="mb-3 col-12">
                                        <label for="trip_information">Trip Information</label>
                                        <textarea name="trip_information" type="text" class="form-control"
                                            id="trip_information" required
                                            placeholder="">{{ old('trip_information') }}</textarea>
                                    </div>
                                </div>


                                <div class="row justify-content-between">
                                    <div class="mb-3 col-md-6">
                                        <a href="{{ route('triplogger.index') }}"
                                            style="background-color: rgb(53, 54, 55) !important;"
                                            class="btn btn-primary">Cancel</a>
                                    </div>
                                    <div class="mb-3 col-md-1">
                                        <button style="background-color: rgb(37, 38, 38) !important;" type="submit"
                                            class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
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
