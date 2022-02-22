@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #272727;">
                        <h5 class="card-title" style="color: white;">Edit Schedule</h5>

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
                        <form method="POST" enctype="multipart/form-data" action="{{ route('schedule.update',$schedule->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="mb-3  col-md-8">
                                    <label for="title">Name</label>
                                    <input value="{{$schedule->title}}" name="title" type="text" class="form-control" id="title" placeholder="Name">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label>Status</label>
                                    <select class="form-control select2" name="status" id="status" data-placeholder=" select Status">
                                        <option value="" selected>select</option>
                                        @foreach($statuses as $status)
                                        <option value="{{ $status }}" @if($schedule->status === $status) selected='selected' @endif>{{ $status }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Start date</label>
                                    <div class="input-group date" id="datetimepicker-minimum" data-target-input="nearest">
                                        <input value="{{$schedule->start}}" name="start" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker-minimum" />
                                        <div class="input-group-text" data-target="#datetimepicker-minimum" data-toggle="datetimepicker"><i
                                                class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">End Date</label>
                                    <div class="input-group date" id="datetimepicker-minimum2" data-target-input="nearest">
                                        <input value="{{$schedule->end}}" name="end" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker-minimum2" />
                                        <div class="input-group-text" data-target="#datetimepicker-minimum2" data-toggle="datetimepicker"><i
                                                class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            @if($schedule->type === 'preproduction' )
                            <input value="preproduction" name="type" type="text" class="form-control" id="type" hidden readonly>
                            <div class="row justify-content-around">
                                <div class="mb-3 col-md-4">
                                    <label for="producer1">Producer 1 </label>
                                    <select class="form-control select2" name="producer1" id="producer1" data-placeholder=" select Producer">
                                        <option value="" selected>select</option>
                                        @foreach(\DB::select('SELECT name from users WHERE department_id = 13') as $user)
                                        <option value="{{ $user->name }}" @if($schedule->producer1 === $user->name) selected='selected' @endif>{{ $user->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="producer2">Producer 2 </label>
                                    <select class="form-control select2" name="producer2" id="producer2" data-placeholder=" select producer2">
                                        <option value="" selected>select</option>
                                        @foreach(\DB::select('SELECT name from users WHERE department_id = 7') as $user)
                                        <option value="{{ $user->name }}" @if($schedule->producer2 === $user->name) selected='selected' @endif>{{ $user->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="dop1">Director of Photography 1</label>
                                    <select class="form-control select2" name="dop1" id="dop1" data-placeholder=" select Director of Photography 1">
                                        <option value="" selected>select</option>
                                        @foreach(\DB::select('SELECT name from users WHERE department_id = 9') as $user)
                                        <option value="{{ $user->name }}" @if($schedule->dop1 === $user->name) selected='selected' @endif>{{ $user->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                                <div class="row justify-content-around">
                                <div class="mb-3 col-md-4">
                                    <label for="dop2">Director of Photography 2</label>
                                    <select class="form-control select2" name="dop2" id="dop2" data-placeholder=" select Director of Photography 2">
                                        <option value="" selected>select</option>
                                        @foreach(\DB::select('SELECT name from users WHERE department_id = 9') as $user)
                                        <option value="{{ $user->name }}" @if($schedule->dop2 === $user->name) selected='selected' @endif>{{ $user->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="dop3">Director of Photography 3</label>
                                    <select class="form-control select2" name="dop3" id="dop3" data-placeholder=" select Director of Photography 3">
                                        <option value="" selected>select</option>
                                        @foreach(\DB::select('SELECT name from users WHERE department_id = 9') as $user)
                                        <option value="{{ $user->name }}" @if($schedule->dop3 === $user->name) selected='selected' @endif>{{ $user->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="dop4">Director of Photography 4</label>
                                    <select class="form-control select2" name="dop4" id="dop4" data-placeholder=" select Director of Photography 4">
                                        <option value="" selected>select</option>
                                        @foreach(\DB::select('SELECT name from users WHERE department_id = 9') as $user)
                                        <option value="{{ $user->name }}" @if($schedule->dop4 === $user->name) selected='selected' @endif>{{ $user->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                </div>

                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" rows="2"
                                        placeholder="Enter short description of shoot ....">{{$schedule->description}}</textarea>
                                </div>
                            </div>
                                @elseif ($schedule->type === 'editors' )
                                <input value="editors" name="type" type="text" class="form-control" id="type" hidden readonly>
                                <div class="row justify-content-center">
                                    <div class="mb-3 col-md-5">
                                        <label>Video Editor</label>
                                        <select class="form-control select2" name="video_editor" id="video_editor" data-placeholder=" select Video Editor">
                                            <option value="" selected>select</option>
                                            @foreach(\DB::select('SELECT name from users WHERE department_id = 3') as $user)
                                                <option value="{{ $user->name }}" @if($schedule->video_editor === $user->name) selected='selected' @endif>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label>others</label>
                                        <textarea name="others" class="form-control" rows="2"
                                            placeholder="Enter other details  ....">{{$schedule->others}}</textarea>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control" rows="2"
                                            placeholder="Enter short description of shoot ....">{{$schedule->description}}</textarea>
                                    </div>
                                </div>
                             @elseif ($schedule->type === 'graphics')
                             <input value="graphics" name="type" type="text" class="form-control" id="type" hidden readonly>
                             <div class="row justify-content-center">
                                <div class="mb-3 col-md-4">
                                    <label>Graphic Editor</label>
                                    <select class="form-control select2" name="graphic_editor" id="graphic_editor" data-placeholder=" Graphic Editor">
                                        <option value="" selected>select</option>
                                        @foreach(\DB::select('SELECT name from users WHERE department_id = 4 OR department_id = 19') as $user)
                                        <option value="{{ $user->name }}" @if($schedule->graphic_editor === $user->name) selected='selected' @endif>{{ $user->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label>others</label>
                                    <textarea name="others" class="form-control" rows="2"
                                        placeholder="Enter other details  ....">{{$schedule->others}}</textarea>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" rows="2"
                                        placeholder="Enter short description of shoot ....">{{$schedule->description}}</textarea>
                                </div>
                            </div>
                            @elseif ($schedule->type === 'digital' )
                            <input value="digital" name="type" type="text" class="form-control" id="type" hidden readonly>
                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-5">
                                    <label>Digital Editor</label>
                                    <select class="form-control select2" name="digital_editor" id="digital_editor" data-placeholder=" Digital Editor">
                                        <option value="" selected>select</option>
                                        @foreach(\DB::select('SELECT * from users WHERE department_id = 6') as $user)
                                        <option value="{{ $user->name }}" @if($schedule->digital_editor === $user->name) selected='selected' @endif>{{ $user->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label>others</label>
                                    <textarea name="others" class="form-control" rows="2"
                                        placeholder="Enter other details  ....">{{$schedule->others}}</textarea>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" rows="2"
                                        placeholder="Enter short description of shoot ....">{{$schedule->description}}</textarea>
                                </div>
                            </div>
                            @endif

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
             // Select2
             $(".select2").each(function() {
                $(this)
                    .wrap("<div class=\"position-relative\"></div>")
                    .select2({
                        placeholder: "Select value",
                        dropdownParent: $(this).parent()
                    });
            })
        });
    </script>
@endsection
