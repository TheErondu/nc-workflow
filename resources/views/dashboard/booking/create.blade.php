@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-opaque">
                    <div class="card-header" style="background-color: #272727;">
                        <h5 class="card-title" style="color: white;">NOTIFICATIONS DETAIL PAGE</h5>

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
                        <form method="POST" enctype="multipart/form-data" action="{{ route('booking.store') }}">
                            @csrf
                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Title</label>
                                    <input id="title" name="title" class="form-control" placeholder="Short Title" required type="text">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Date</label>
                                    <div class="input-group date" id="datetimepicker-minimum" data-target-input="nearest">
                                        <input name="date" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker-minimum" />
                                        <div class="input-group-text" data-target="#datetimepicker-minimum" data-toggle="datetimepicker"><i
                                                class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                                <div class="row justify-content-between">
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">start time</label>
                                    <div class="input-group date" id="datetimepicker-minimum2" data-target-input="nearest">
                                        <input name="start_time" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker-minimum2" />
                                        <div class="input-group-text" data-target="#datetimepicker-minimum2" data-toggle="datetimepicker"><i
                                                class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                @if (request()->query("type") === 'studio' )
                                <input id="type" name="type" value="studio" class="form-control" hidden type="text">
                                @endif
                                @if (request()->query("type") === 'boardroom' )
                                <input id="type" name="type" value="boardroom" class="form-control" hidden type="text">
                                @endif
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">end time</label>
                                    <div class="input-group date" id="datetimepicker-minimum3" data-target-input="nearest">
                                        <input name="end_time" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker-minimum3" />
                                        <div class="input-group-text" data-target="#datetimepicker-minimum3" data-toggle="datetimepicker"><i
                                                class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                @if (request()->query("type") === 'studio' )
                                <div class="mb-3 col-md-4">
                                    <label for="country">Studio</label>
                                    <select class="form-control select2" name="facility" id="studio" data-placeholder=" select Studio">
                                        <option value="" selected>select</option>
                                        @foreach($studios as $studio)
                                            <option value="{{ $studio->name }}">{{ $studio->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif
                                @if (request()->query("type") === 'boardroom' )
                                <div class="mb-3 col-md-4">
                                    <label for="country">Boardroom</label>
                                    <select class="form-control select2" name="facility" id="boardroom" data-placeholder=" select Boardroom">
                                        <option value="" selected>select</option>
                                        @foreach($boardrooms as $boardroom)
                                            <option value="{{ $boardroom->name }}">{{ $boardroom->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif
                            </div>

                            <div class="row justify-content-between">


                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" rows="2"
                                        placeholder="Enter short briefing of  the Meeting Details ...."></textarea>
                                </div>
                            </div>

                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-6">
                                    <a href="{{ route('booking.index') }}" style="background-color: rgb(53, 54, 55) !important;"
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
