@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
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
                        <form method="POST" enctype="multipart/form-data" action="{{ route('schedule.store') }}">
                            @csrf
                            <div class="row justify-content-between">
                                <div class="mb-3  col-md-4">
                                    <label for="title">Name</label>
                                    <input name="title" type="text" class="form-control" id="title"
                                        placeholder="Name">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label>Status</label>
                                    <select class="form-control select2" name="status" id="status"
                                        data-placeholder=" select Status">
                                        <option value="" selected>select</option>
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status }}">{{ $status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Start date</label>
                                    <div class="input-group date" id="datetimepicker-minimum" data-target-input="nearest">
                                        <input name="start" type="text" class="form-control datetimepicker-input"
                                            data-target="#datetimepicker-minimum" />
                                        <div class="input-group-text" data-target="#datetimepicker-minimum"
                                            data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">End Date</label>
                                    <div class="input-group date" id="datetimepicker-minimum2" data-target-input="nearest">
                                        <input name="end" type="text" class="form-control datetimepicker-input"
                                            data-target="#datetimepicker-minimum2" />
                                        <div class="input-group-text" data-target="#datetimepicker-minimum2"
                                            data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label>Driver</label>
                                    <select class="form-control select2" name="driver" id="driver"
                                        data-placeholder=" select Driver">
                                        <option value="" selected>select</option>
                                        @foreach ($users as $user)
                                            @if ($user->department_id === 21)
                                                <option value="{{ $user->name }}">{{ $user->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @if (request()->query('type') === 'preproduction')
                                <input value="preproduction" name="type" type="text" class="form-control"
                                    id="type" hidden readonly>
                                <div class="row justify-content-around">
                                    <div class="mb-3 col-md-4">
                                        <label for="producer1">Producer 1 </label>
                                        <input name="producer1" type="text" class="form-control" id="producer1"
                                            value="{{ old('producer1') }}" placeholder="" />
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="producer2">Producer 2 </label>
                                        <input name="producer2" type="text" class="form-control" id="producer2"
                                            value="{{ old('producer2') }}" placeholder="" />
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="dop1">Director of Photography 1</label>
                                        <input name="dop1" type="text" class="form-control" id="dop1"
                                            value="{{ old('dop1') }}" placeholder="" />
                                    </div>
                                </div>
                                <div class="row justify-content-around">
                                    <div class="mb-3 col-md-4">
                                        <label for="dop2">Director of Photography 2</label>
                                        <input name="dop2" type="text" class="form-control" id="dop2"
                                            value="{{ old('dop2') }}" placeholder="" />
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="dop3">Director of Photography 3</label>
                                        <input name="dop3" type="text" class="form-control" id="dop3"
                                            value="{{ old('dop3') }}" placeholder="" />
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="dop4">Director of Photography 4</label>
                                        <input name="dop4" type="text" class="form-control" id="dop4"
                                            value="{{ old('dop4') }}" placeholder="" />
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="mb-3 col-md-12">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control" rows="2"
                                            placeholder="Enter short description of shoot ...."></textarea>
                                    </div>
                                </div>
                            @elseif (request()->query('type') === 'editors')
                                <input value="editors" name="type" type="text" class="form-control"
                                    id="type" hidden readonly>
                                <div class="row justify-content-center">
                                    <div class="mb-3 col-md-5">
                                        <label>Video Editor</label>
                                        <select class="form-control select2" name="video_editor" id="video_editor"
                                            data-placeholder=" select Video Editor">
                                            <option value="" selected>select</option>
                                            @foreach ($users as $user)
                                                @if ($user->department_id === 3)
                                                    <option value="{{ $user->name }}">{{ $user->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label>others</label>
                                        <textarea name="others" class="form-control" rows="2" placeholder="Enter other details  ...."></textarea>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control" rows="2"
                                            placeholder="Enter short description of shoot ...."></textarea>
                                    </div>
                                </div>
                            @elseif (request()->query('type') === 'graphics')
                                <input value="graphics" name="type" type="text" class="form-control"
                                    id="type" hidden readonly>
                                <div class="row justify-content-between">
                                    <div class="mb-3 col-md-5">
                                        <label>Graphic Editor</label>
                                        <select class="form-control select2" name="graphic_editor" id="graphic_editor"
                                            data-placeholder=" Graphic Editor">
                                            <option value="" selected>select</option>
                                            @foreach ($users as $user)
                                                @if ($user->department_id === 4 or $user->department_id === 19)
                                                    <option value="{{ $user->name }}">{{ $user->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label>others</label>
                                        <textarea name="others" class="form-control" rows="2" placeholder="Enter other details  ...."></textarea>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control" rows="2"
                                            placeholder="Enter short description of shoot ...."></textarea>
                                    </div>
                                </div>
                            @elseif (request()->query('type') === 'digital')
                                <input value="digital" name="type" type="text" class="form-control"
                                    id="type" hidden readonly>
                                <div class="row justify-content-between">
                                    <div class="mb-3 col-md-5">
                                        <label>Digital Editor</label>
                                        <select class="form-control select2" name="digital_editor" id="digital_editor"
                                            data-placeholder=" Digital Editor">
                                            <option value="" selected>select</option>
                                            @foreach ($users as $user)
                                                @if ($user->department_id === 6)
                                                    <option value="{{ $user->name }}">{{ $user->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label>others</label>
                                        <textarea name="others" class="form-control" rows="2" placeholder="Enter other details  ...."></textarea>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control" rows="2"
                                            placeholder="Enter short description of shoot ...."></textarea>
                                    </div>
                                </div>
                            @endif

                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-6">
                                    <a href="{{ route('schedule.index') }}"
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
            });

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
                format: 'LT'
            });
        });
    </script>
@endsection
