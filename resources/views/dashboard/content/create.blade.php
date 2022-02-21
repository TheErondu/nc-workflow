@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-opaque">
                    <div class="card-header" style="background-color: #272727;">
                        <h5 class="card-title" style="color: white;">FILL IN REQUIRED FIELDS.</h5>

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
                        <form method="POST" enctype="multipart/form-data" action="{{ route('content.store') }}">
                            @csrf
                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-4">
                                    <label for="title">Project Name</label>
                                    <input name="title" type="text" class="form-control" id="title" placeholder="Project Name">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="team_lead">Team Lead</label>
                                    <input name="team_lead" type="text" class="form-control" id="team_lead" placeholder="Team Lead">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="genre">Genre</label>
                                    <input name="genre" type="text" class="form-control" id="genre" placeholder="Genre ">
                                </div>
                            </div>
                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Start date</label>
                                    <div class="input-group date" id="datetimepicker-minimum" data-target-input="nearest">
                                        <input name="start" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker-minimum" />
                                        <div class="input-group-text" data-target="#datetimepicker-minimum" data-toggle="datetimepicker"><i
                                                class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">End Date</label>
                                    <div class="input-group date" id="datetimepicker-minimum2" data-target-input="nearest">
                                        <input name="end" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker-minimum2" />
                                        <div class="input-group-text" data-target="#datetimepicker-minimum2" data-toggle="datetimepicker"><i
                                                class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Delivery date</label>
                                    <div class="input-group date" id="datetimepicker-minimum3" data-target-input="nearest">
                                        <input name="delivery_date" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker-minimum3" />
                                        <div class="input-group-text" data-target="#datetimepicker-minimum3" data-toggle="datetimepicker"><i
                                                class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-6">
                                    <label for="country">Country</label>
                                    <select class="form-control select2" name="country" id="country" data-placeholder=" select Country">
                                        <option value="" selected>select</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->iso }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="location">Location/Venue</label>
                                    <input name="location" type="text" class="form-control" id="location" placeholder="Location ">
                                </div>
                            </div>
                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-6">
                                    <label for="status">Status</label>
                                    <input name="status" type="text" class="form-control" id="status" placeholder="Status ">

                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="distribution_platform">Distribution Platform</label>
                                    <input name="distribution_platform" type="text" class="form-control" id="distribution_platform" placeholder="Genre ">
                                </div>
                        </div>
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label>Project Brief</label>
                                    <textarea name="project_brief" class="form-control" rows="2"
                                        placeholder="Enter short briefing of  the Project Details ...."></textarea>
                                </div>
                            </div>

                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-6">
                                    <a href="{{ route('schedule.index') }}" style="background-color: rgb(53, 54, 55) !important;"
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
            //Select2

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
            $('#datetimepicker-minimum3').datetimepicker({
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
