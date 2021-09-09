@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-opaque">
                    <div class="card-header" style="background-color: #272727;">
                        <h5 class="card-title" style="color: white;">Add OB Logs</h5>

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
                        <form method="POST" enctype="multipart/form-data" action="{{ route('oblogs.update',$oblogs->id) }}">
                           @method('PUT')
                            @csrf

                            <div class=" row justify-content-between">
                                <div class="mb-3 col-md-12">
                                    <label for="event_name">Event Name </label>
                                    <input name="event_name" type="text" class="form-control" id="event_name"
                                        value="{{ $oblogs->event_name }}" required placeholder="">
                                </div>

                            </div>
                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Event date</label>
                                    <div class="input-group date" id="datetimepicker-minimum" data-target-input="nearest">
                                        <input name="event_date" type="text" class="form-control datetimepicker-input" value="{{ $oblogs->event_date }}" data-target="#datetimepicker-minimum" />
                                        <div class="input-group-text" data-target="#datetimepicker-minimum" data-toggle="datetimepicker"><i
                                                class="fa fa-calendar"></i></div>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="location">Location</label>
                                    <input name="location" type="text" class="form-control" id="location"
                                        value="{{ $oblogs->location }}" required placeholder="">
                                </div>
                            </div>

                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-6">
                                    <label for="producer">Producer  </label>
                                    <select class="form-control select2" name="producer" id="producer" data-placeholder=" select Producer">
                                        <option value="" selected>select</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->name }}" @if($oblogs->producer === $user->name) selected='selected' @endif>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="director">Director </label>
                                    <select class="form-control select2" name="director" id="director" data-placeholder=" select Director">
                                        <option value="" selected>select</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->name }}" @if($oblogs->director === $user->name) selected='selected' @endif>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-6">
                                    <label for="vision_mixer">Vision Mixer  </label>
                                    <select class="form-control select2" name="vision_mixer" id="vision_mixer" data-placeholder=" select Vision Mixer">
                                        <option value="" selected>select</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->name }}" @if($oblogs->vision_mixer === $user->name) selected='selected' @endif>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="sound">Sound  </label>
                                    <select class="form-control select2" name="sound" id="sound" data-placeholder=" select Sound ">
                                        <option value="" selected>select</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->name }}" @if($oblogs->sound === $user->name) selected='selected' @endif>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-6">
                                    <label for="engineer">Engineer  </label>
                                    <select class="form-control select2" name="engineer" id="engineer" data-placeholder=" select Engineer">
                                        <option value="" selected>select</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->name }}" @if($oblogs->engineer === $user->name) selected='selected' @endif>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="dop">Director of photography </label>
                                    <select class="form-control select2" name="dop" id="dop" data-placeholder=" select Director of photography">
                                        <option value="" selected>select</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->name }}" @if($oblogs->dop === $user->name) selected='selected' @endif>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-6">
                                    <label for="reporter">Reporter  </label>
                                    <select class="form-control select2" name="reporter" id="reporter" data-placeholder=" select Reporter">
                                        <option value="" selected>select</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->name }}" @if($oblogs->reporter === $user->name) selected='selected' @endif>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="digital">Digital</label>
                                    <select class="form-control select2" name="digital" id="digital" data-placeholder=" select Digital">
                                        <option value="" selected>select</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->name }}" @if($oblogs->digital === $user->name) selected='selected' @endif>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class=" row justify-content-between">
                                <div class="mb-3 col-md-6">
                                    <label for="transmission_time">Transmission Time </label>
                                    <input name="transmission_time" type="text" class="form-control" id="transmission_time"
                                        value="{{ $oblogs->transmission_time }}" required placeholder="">
                                </div>

                            </div>
                            <div class="row justify-content-between">
                                <div class="mb-3 col-12">
                                    <label for="comment">Comment</label>
                                    <textarea name="comment" type="text" class="form-control"
                                        id="comment" required
                                        placeholder="">{{ $oblogs->comment}}</textarea>
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
                                    <div class="mb-3 col-md-6">
                                        <button form="delete-form" style="background-color: red !important;" type="submit"
                                        class="btn btn-primary">Delete</button>
                                    </div>
                                    <div class="mb-3 col-md-1">
                                        <button style="background-color: rgb(37, 38, 38) !important;" type="submit"
                                            class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                        </form>
                        <form action="{{ route('oblogs.destroy', $oblogs->id) }}" id="delete-form" method="POST">
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
