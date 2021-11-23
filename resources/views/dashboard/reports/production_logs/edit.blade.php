@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-opaque">
                    <div class="card-header" style="background-color: #272727;">
                        <h5 class="card-title" style="color: white;">Add Report</h5>

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
                        <form method="POST" enctype="multipart/form-data" action="{{ route('production.store') }}">
                            @csrf

                            <div class=" row justify-content-center">
                                <div class="mb-3 col-md-6">
                                    <label for="show_name">Production Name</label>
                                    <input name="show_name" type="text" class="form-control" id="show_name"
                                    value="{{ $production_logs->show_name }}" required placeholder="">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="date">Date </label>
                                    <div class="input-group date" id="datetimepicker-minimum" data-target-input="nearest">
                                        <input name="date" value="{{ $production_logs->date }}" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker-minimum" />
                                        <div class="input-group-text" data-target="#datetimepicker-minimum" data-toggle="datetimepicker"><i
                                                class="fa fa-calendar"></i></div>
                                    </div>
                                </div>

                            </div>
                            <div class="row justify-content-around">
                                <div class="mb-3 col-md-4">
                                    <label for="location">Location</label>
                                    <input name="location" type="text" class="form-control" id="location"
                                    value="{{ $production_logs->location }}" required placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="producer1">Producer 1 </label>
                                    <select class="form-control select2" name="producer1" id="producer1" data-placeholder=" select Producer">
                                        <option value="" selected>select</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->name }}" @if($production_logs->producer2 === $user->name) selected='selected' @endif>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="producer2">Producer 2 </label>
                                    <select class="form-control select2" name="producer2" id="producer2" data-placeholder=" select Producer 2">
                                        <option value="" selected>select</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->name }}" @if($production_logs->producer2 === $user->name) selected='selected' @endif>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row justify-content-around">
                                <div class="mb-3 col-md-4">
                                    <label for="director">Director </label>
                                    <select class="form-control select2" name="director" id="director" data-placeholder=" select director">
                                        <option value="" selected>select</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->name }}" @if($production_logs->director === $user->name) selected='selected' @endif>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="vision_mixer">Vision Mixer</label>
                                    <select class="form-control select2" name="vision_mixer" id="vision_mixer" data-placeholder=" select vision mixer">
                                        <option value="" selected>select</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->name }}" @if($production_logs->vision_mixer === $user->name) selected='selected' @endif>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="engineer">Engineer</label>
                                    <select class="form-control select2" name="engineer" id="engineer" data-placeholder=" select engineer">
                                        <option value="" selected>select</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->name }}" @if($production_logs->engineer === $user->name) selected='selected' @endif>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-4">
                                    <label for="sound_technician">Sound Technician </label>
                                    <select class="form-control select2" name="sound_technician" id="sound_technician" data-placeholder=" select Sound Technician ">
                                        <option value="" selected>select</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->name }}" @if($production_logs->sound_technician === $user->name) selected='selected' @endif>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="camera_operator1">Camera Operator</label>
                                    <select class="form-control select2" name="camera_operator1" id="camera_operator1" data-placeholder=" select Camera Operator">
                                        <option value="" selected>select</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->name }}" @if($production_logs->camera_operator1 === $user->name) selected='selected' @endif>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="camera_operator2">Camera Operator</label>
                                    <select class="form-control select2" name="camera_operator2" id="camera_operator2" data-placeholder=" select Camera operator">
                                        <option value="" selected>select</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->name }}" @if($production_logs->camera_operator2 === $user->name) selected='selected' @endif>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class=" row justify-content-between">
                                <div class="mb-3 col-md-4">
                                    <label for="host"> Host</label>
                                    <input name="host" type="text" class="form-control" id="host"
                                    value="{{$production_logs->host}}" required placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="graphics">Graphics</label>
                                    <select class="form-control select2" name="graphics" id="graphics" data-placeholder=" select graphics ">
                                        <option value="" selected>select</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->name }}" @if($production_logs->graphics === $user->name) selected='selected' @endif>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="digital">Digital </label>
                                    <select class="form-control select2" name="digital" id="digital" data-placeholder=" select Digital">
                                        <option value="" selected>select</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->name }}" @if($production_logs->digital === $user->name) selected='selected' @endif>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="row justify-content-around">
                                <div class="mb-3 col-md-4">
                                    <label for="transmission"> Transmission</label>
                                    <select class="form-control select2" name="transmission" id="transmission" data-placeholder=" select transmission operator">
                                        <option value="" selected>select</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->name }}" @if($production_logs->transmission === $user->name) selected='selected' @endif>{{ $user->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="transmission_time">Transmission Time</label>
                                    <input name="transmission_time" type="text" class="form-control" id="transmission_time"
                                        value="{{ $production_logs->transmission_time }}" required placeholder="">
                                </div>

                            </div>
                            <div class="row justify-content-around">
                                <div class="mb-3 col-12">
                                    <label for="comment">Comment/Challenges</label>
                                    <textarea name="comment" type="text" class="form-control"
                                        id="comment" required
                                        placeholder="">{{$production_logs->comment}}</textarea>
                                </div>
                            </div>
                            <div class="row justify-content-around">
                                <div class="mb-3 col-md-3">
                                    <span>Uploaded by: <br> {{Auth::user()->name }}</span>
                                </div>
                                <div class="mb-3 col-md-3">
                                    <span>Uploaded at: <br> {{ date('d-m-Y') }}</span>
                                </div>
                            </div>
                            <div class="row justify-content-between">
                                @can('access-production_show_logs-readonly')

                                <div class="mb-3 col-md-4">
                                    <a href="{{ route('production.index') }}"
                                        style="background-color: rgb(53, 54, 55) !important;"
                                        class="btn btn-primary">Cancel</a>
                                </div>

                                @endcan
                                @can('delete-reports')
                                <div class="mb-3 col-md-4">

                                    <button form="delete-form" type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </div>
                                @endcan
                                @can('access-production_show_logs')
                                <div class="mb-3 col-md-4">
                                    <button style="background-color: rgb(37, 38, 38) !important;" type="submit"
                                        class="btn btn-primary">Submit</button>
                                </div>
                                @endcan

                            </div>
                        </form>
                        <form action="{{ route('production.destroy', $production_logs->id) }}" id="delete-form" method="POST">
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
