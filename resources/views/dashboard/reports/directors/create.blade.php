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
                        <form method="POST" enctype="multipart/form-data" action="{{ route('reports.store') }}">
                            @csrf
                            <div class="row justify-content-around">
                                <div class="mb-3 col-md-4">
                                    <label for="producer">Producer </label>
                                    <input name="producer" type="text" class="form-control" id="producer"
                                    value="{{ old('producer') }}" required placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="anchor">Anchor</label>
                                    <input name="anchor" type="text" class="form-control" id="anchor"
                                    value="{{ old('anchor') }}" required placeholder="">
                                </div>
                            </div>

                            <div class="row justify-content-around">
                                <div class="mb-3 col-md-4">
                                    <label for="director">Director </label>
                                    <select class="form-control select2" name="director" id="director" data-placeholder=" select director">
                                        <option value="" selected>select</option>
                                        @foreach($users as $user)
                                            @if ($user->department_id === 13)
                                            <option value="{{ $user->name }}">{{ $user->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="vision_mixer">Vision Mixer</label>
                                    <select class="form-control select2" name="vision_mixer" id="vision_mixer" data-placeholder=" select vision mixer">
                                        <option value="" selected>select</option>
                                        @foreach($users as $user)
                                            @if ($user->department_id === 10)
                                            <option value="{{ $user->name }}">{{ $user->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="engineer">Engineer</label>
                                    <select class="form-control select2" name="engineer" id="engineer" data-placeholder=" select engineer">
                                        <option value="" selected>select</option>
                                        @foreach($users as $user)
                                            @if ($user->department_id === 11)
                                            <option value="{{ $user->name }}">{{ $user->name }}</option>
                                            @endif
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
                                            @if ($user->department_id === 10)
                                            <option value="{{ $user->name }}">{{ $user->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="camera_operator1">Camera Operator</label>
                                    <select class="form-control select2" name="camera_operator" id="camera_operator" data-placeholder=" select Camera Operator">
                                        <option value="" selected>select</option>
                                        @foreach($users as $user)
                                            @if ($user->department_id === 9 or $user->department_id === 10)
                                            <option value="{{ $user->name }}">{{ $user->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class=" row justify-content-between">
                                <div class="mb-3 col-md-4">
                                    <label for="autocue"> AutoCUE</label>
                                    <input name="autocue" type="text" class="form-control" id="autocue"
                                    value="{{ old('autocue') }}" required placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="graphics">Graphics</label>
                                    <label for="graphics">Anchor</label>
                                    <input name="graphics" type="text" class="form-control" id="graphics"
                                    value="{{ old('graphics') }}" required placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="tx">TX </label>
                                    <select class="form-control select2" name="tx" id="tx" data-placeholder=" select TX">
                                        <option value="" selected>select</option>
                                        @foreach($users as $user)
                                            @if ($user->department_id === 10)
                                            <option value="{{ $user->name }}">{{ $user->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            <div class=" row justify-content-between">
                                <div class="mb-3 col-md-6">
                                    <label for="bulletin">Bulletin </label>
                                    <input name="bulletin" type="text" class="form-control" id="bulletin"
                                        value="{{ old('bulletin') }}" required placeholder="">
                                </div>

                            </div>
                            <div class="row justify-content-around">
                                <div class="mb-3 col-md-4">
                                    <label for="dts_in">DTS In time </label>
                                    <input name="dts_in" type="text" class="form-control" id="dts_in"
                                        value="{{ old('dts_in') }}" required placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="actual_in">Actual In Time</label>
                                    <input name="actual_in" type="text" class="form-control" id="actual_in"
                                        value="{{ old('actual_in') }}" required placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="variance1">Variance</label>
                                    <input name="variance1" type="text" class="form-control" id="variance1"
                                        value="{{ old('variance1') }}" required placeholder="">
                                </div>
                            </div>

                            <div class="row justify-content-around">
                                <div class="mb-3 col-md-4">
                                    <label for="dts_out">DTS Out time </label>
                                    <input name="dts_out" type="text" class="form-control" id="dts_out"
                                        value="{{ old('dts_out') }}" required placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="actual_out">Actual Out Time</label>
                                    <input name="actual_out" type="text" class="form-control" id="actual_out"
                                        value="{{ old('actual_out') }}" required placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="variance2">Variance</label>
                                    <input name="variance2" type="text" class="form-control" id="variance2"
                                        value="{{ old('variance2') }}" required placeholder="">
                                </div>
                            </div>
                            <div class="row justify-content-between">
                                <div class="mb-3 col-12">
                                    <label for="comment">Comment</label>
                                    <textarea name="comment" type="text" class="form-control"
                                        id="comment" required
                                        placeholder="">{{ old('comment') }}</textarea>
                                </div>
                            </div>

                            <div class=" row justify-content-between">
                                <div class="mb-3 col-md-6">
                                    <label for="b2bulletin">Bulletin </label>
                                    <input name="b2bulletin" type="text" class="form-control" id="b2bulletin"
                                        value="{{ old('b2bulletin') }}" required placeholder="">
                                </div>

                            </div>
                            <div class="row justify-content-around">
                                <div class="mb-3 col-md-4">
                                    <label for="b2dts_in">DTS In time </label>
                                    <input name="b2dts_in" type="text" class="form-control" id="b2dts_in"
                                        value="{{ old('b2dts_in') }}" required placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="b2actual_in">Actual In Time</label>
                                    <input name="b2actual_in" type="text" class="form-control" id="b2actual_in"
                                        value="{{ old('b2actual_in') }}" required placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="b2variance1">Variance</label>
                                    <input name="b2variance1" type="text" class="form-control" id="b2variance1"
                                        value="{{ old('b2variance1') }}" required placeholder="">
                                </div>
                            </div>

                            <div class="row justify-content-around">
                                <div class="mb-3 col-md-4">
                                    <label for="b2dts_out">DTS Out time </label>
                                    <input name="b2dts_out" type="text" class="form-control" id="b2dts_out"
                                        value="{{ old('b2dts_out') }}" required placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="b2actual_out">Actual Out Time</label>
                                    <input name="b2actual_out" type="text" class="form-control" id="b2actual_out"
                                        value="{{ old('b2actual_out') }}" required placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="b2variance2">Variance</label>
                                    <input name="b2variance2" type="text" class="form-control" id="b2variance2"
                                        value="{{ old('b2variance2') }}" required placeholder="">
                                </div>
                            </div>
                            <div class="row justify-content-between">
                                <div class="mb-3 col-12">
                                    <label for="b2comment">Comment</label>
                                    <textarea name="b2comment" type="text" class="form-control"
                                        id="b2comment" required
                                        placeholder="">{{ old('b2comment') }}</textarea>
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
                                        <a href="{{ route('reports.index') }}"
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
