@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-opaque">
                    <div class="card-header" style="background-color: #272727;">
                        <h5 class="card-title" style="color: white;">Add  Vehicle</h5>

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
                        <form method="POST" enctype="multipart/form-data" action="{{ route('vehicles.store') }}">
                            @csrf

                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label for="show_title">Assigned Driver </label>
                                    <select class="form-control select2" name="assigned_driver" id="assigned_driver">
                                    <option value="not Assigned">--Not Assigned--</option>
                                        @foreach($drivers as $driver)
                                            <option value="{{ $driver->name }}">{{ $driver->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <input id="type" name="type" class="form-control type" hidden value="award" required  type="text">
                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-4">
                                    <label for="number_plate">Number Plate</label>
                                    <input name="number_plate" type="text" class="form-control" id="number_plate" value="{{old ('number_plate') }}"  required placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="vehicle_make">Vehicle Make</label>
                                    <input name="vehicle_make" type="text" class="form-control" id="vehicle_make" value="{{old ('vehicle_make') }}" required placeholder="">
                                </div>
                            </div>
                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-4">
                                    <label for="purpose">Purpose</label>
                                    <input name="purpose" type="text" class="form-control" id="purpose" value="{{old ('purpose') }}" required placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="vehicle_colour">Vehicle Color</label>
                                    <input name="vehicle_colour" type="text" class="form-control" id="vehicle_colour" value="{{old ('vehicle_colour') }}" required placeholder="">
                                </div>
                            </div>


                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-6">
                                    <a href="{{ route('awards.index') }}" style="background-color: rgb(53, 54, 55) !important;"
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
                format:'YYYY-MM-DD HH:mm:ss'
            });
            $('#datetimepicker-minimum2').datetimepicker({
                format:'YYYY-MM-DD HH:mm:ss'
            });
            $('#datetimepicker-view-mode').datetimepicker({
                viewMode: 'years'
            });
            $('#datetimepicker-time').datetimepicker({
                format: 'LT'
            });
            $('#datetimepicker-date').datetimepicker({
                format: 'LT'
            });
        });
    </script>
@endsection
