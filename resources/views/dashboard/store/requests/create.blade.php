@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-opaque">
                    <div class="card-header" style="background-color: #272727;">
                        <h5 class="card-title" style="color: white;">Store Manager</h5>

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
                        <form method="POST" enctype="multipart/form-data" action="{{ route('store.store') }}">
                            @csrf

                            <div class="row justify-content-around">
                                <div class="mb-3 col-md-4">
                                    <label for="item_name">Item Name</label>
                                    <input name="item_name" type="text" class="form-control" id="item_name"
                                        value="{{ old('item_name') }}" required placeholder="">
                                </div>
                            </div>
                            <input id="type" name="type" class="form-control type" hidden value="award" required
                                type="text">
                            <div class="row justify-content-around">
                                <div class="mb-3 col-md-4">
                                    <label for="serial_no">Serial No</label>
                                    <input name="serial_no" type="text" class="form-control" id="serial_no"
                                        value="{{ old('serial_no') }}" required placeholder="">
                                </div>

                                <div class="row justify-content-between">
                                    <div class="mb-3 col-md-4">
                                        <label for="assigned_department">Assigned Department</label>
                                        <select class="form-control select2" name="assigned_department" id="assigned_department">
                                            <option value="{{ Auth::user()->department }}">{{ Auth::user()->department }}</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->name }}">{{ $department->name }}</option>
                                            @endforeach
                                        </select>
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
