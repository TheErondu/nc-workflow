@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-opaque">
                    <div class="card-header" style="background-color: #272727;">
                        <h5 class="card-title" style="color: white;">Add log</h5>

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
                        <form method="POST" enctype="multipart/form-data" action="{{ route('prompter.store') }}">
                            @csrf

                            <div class=" row justify-content-center">
                                <div class="mb-3 col-md-4">
                                    <label for="segment">Segment</label>
                                    <input name="segment" type="text" class="form-control" id="segment"
                                    value="{{ old('segment') }}"  placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="rundown_in">Run Down In</label>
                                    <input name="rundown_in" type="text" class="form-control" id="rundown_in"
                                    value="{{ old('rundown_in') }}"  placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="script_in">Script In</label>
                                    <input name="script_in" type="text" class="form-control" id="script_in"
                                    value="{{ old('script_in') }}"  placeholder="">
                                </div>
                            </div>
                            <div class="row justify-content-around">
                                <div class="mb-3 col-md-4">
                                    <label for="host">Host </label>
                                    <input name="host" type="text" class="form-control" id="host"
                                    value="{{ old('host') }}"  placeholder="">
                                </div>
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
                                    <label for="anchor">Anchor </label>
                                    <select class="form-control select2" name="anchor" id="anchor" data-placeholder=" select anchor">
                                        <option value="" selected>select</option>
                                        @foreach($users as $user)
                                            @if ($user->department_id === 15)
                                            <option value="{{ $user->name }}">{{ $user->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row justify-content-around">

                                <div class="mb-3 col-md-4">
                                    <label for="graphics">Graphics</label>
                                    <input name="graphics" type="text" class="form-control" id="graphics"
                                    value="{{ old('graphics') }}"  placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="producer">Producer</label>
                                    <input name="producer" type="text" class="form-control" id="producer"
                                    value="{{ old('producer') }}"  placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="pa">PA </label>
                                    <input name="pa" type="text" class="form-control" id="pa"
                                    value="{{ old('pa') }}"  placeholder="">
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="mb-3 col-md-4">
                                    <label for="engineer">Engineer </label>
                                    <select class="form-control select2" name="engineer" id="engineer" data-placeholder=" select engineer ">
                                        <option value="" selected>select</option>
                                        @foreach($users as $user)
                                            @if ($user->department_id === 11)
                                            <option value="{{ $user->name }}">{{ $user->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-8">
                                    <label for="challenges">Challenges</label>
                                    <textarea name="challenges" type="text" class="form-control" id="challenges"
                                    value=""  placeholder="">{{ old('challenges') }}</textarea>
                                </div>
                            </div>
                            <div class=" row justify-content-center">
                                <div class="mb-3 col-md-4">
                                    <label for="segment2">Segment</label>
                                    <input name="segment2" type="text" class="form-control" id="segment2"
                                    value="{{ old('segment') }}"  placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="rundown_in2">Run Down In</label>
                                    <input name="rundown_in2" type="text" class="form-control" id="rundown_in2"
                                    value="{{ old('rundown_in2') }}"  placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="script_in2">Script In</label>
                                    <input name="script_in2" type="text" class="form-control" id="script_in2"
                                    value="{{ old('script_in2') }}"  placeholder="">
                                </div>
                            </div>
                            <div class="row justify-content-around">
                                <div class="mb-3 col-md-4">
                                    <label for="host2">Host </label>
                                    <input name="host2" type="text" class="form-control" id="host2"
                                    value="{{ old('host2') }}"  placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="director2">Director </label>
                                    <select class="form-control select2" name="director2" id="director2" data-placeholder=" select director">
                                        <option value="" selected>select</option>
                                        @foreach($users as $user)
                                            @if ($user->department_id === 13)
                                            <option value="{{ $user->name }}">{{ $user->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="anchor2">Anchor </label>
                                    <select class="form-control select2" name="anchor2" id="anchor2" data-placeholder=" select anchor2">
                                        <option value="" selected>select</option>
                                        @foreach($users as $user)
                                            @if ($user->department_id === 15)
                                            <option value="{{ $user->name }}">{{ $user->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row justify-content-around">

                                <div class="mb-3 col-md-4">
                                    <label for="graphics2">Graphics</label>
                                    <input name="graphics2" type="text" class="form-control" id="graphics2"
                                    value="{{ old('graphics2') }}"  placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="producer2">Producer</label>
                                    <input name="producer2" type="text" class="form-control" id="producer2"
                                    value="{{ old('producer2') }}"  placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="pa2">PA </label>
                                    <input name="pa2" type="text" class="form-control" id="pa2"
                                    value="{{ old('pa2') }}"  placeholder="">
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="mb-3 col-md-4">
                                    <label for="engineer2">Engineer </label>
                                    <select class="form-control select2" name="engineer2" id="engineer2" data-placeholder=" select engineer ">
                                        <option value="" selected>select</option>
                                        @foreach($users as $user)
                                            @if ($user->department_id === 11)
                                            <option value="{{ $user->name }}">{{ $user->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-8">
                                    <label for="challenges2">Challenges</label>
                                    <textarea name="challenges2" type="text" class="form-control" id="challenges2"
                                    value=""  placeholder="">{{ old('challenges2') }}</textarea>
                                </div>
                            </div>
                                                        <div class=" row justify-content-center">
                                <div class="mb-3 col-md-4">
                                    <label for="segment3">Segment</label>
                                    <input name="segment3" type="text" class="form-control" id="segment3"
                                    value="{{ old('segment') }}"  placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="rundown_in3">Run Down In</label>
                                    <input name="rundown_in3" type="text" class="form-control" id="rundown_in3"
                                    value="{{ old('rundown_in3') }}"  placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="script_in3">Script In</label>
                                    <input name="script_in3" type="text" class="form-control" id="script_in3"
                                    value="{{ old('script_in3') }}"  placeholder="">
                                </div>
                            </div>
                            <div class="row justify-content-around">
                                <div class="mb-3 col-md-4">
                                    <label for="host3">Host </label>
                                    <input name="host3" type="text" class="form-control" id="host3"
                                    value="{{ old('host2') }}"  placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="director3">Director </label>
                                    <select class="form-control select2" name="director3" id="director3" data-placeholder=" select director">
                                        <option value="" selected>select</option>
                                        @foreach($users as $user)
                                            @if ($user->department_id === 13)
                                            <option value="{{ $user->name }}">{{ $user->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="anchor3">Anchor </label>
                                    <select class="form-control select2" name="anchor3" id="anchor3" data-placeholder=" select anchor3">
                                        <option value="" selected>select</option>
                                        @foreach($users as $user)
                                            @if ($user->department_id === 15)
                                            <option value="{{ $user->name }}">{{ $user->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row justify-content-around">

                                <div class="mb-3 col-md-4">
                                    <label for="graphics3">Graphics</label>
                                    <input name="graphics3" type="text" class="form-control" id="graphics3"
                                    value="{{ old('graphics3') }}"  placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="producer3">Producer</label>
                                    <input name="producer3" type="text" class="form-control" id="producer3"
                                    value="{{ old('producer3') }}"  placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="pa3">PA </label>
                                    <input name="pa3" type="text" class="form-control" id="pa3"
                                    value="{{ old('pa2') }}"  placeholder="">
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="mb-3 col-md-4">
                                    <label for="engineer3">Engineer </label>
                                    <select class="form-control select2" name="engineer3" id="engineer3" data-placeholder=" select engineer ">
                                        <option value="" selected>select</option>
                                        @foreach($users as $user)
                                            @if ($user->department_id === 11)
                                            <option value="{{ $user->name }}">{{ $user->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-8">
                                    <label for="challenges3">Challenges</label>
                                    <textarea name="challenges3" type="text" class="form-control" id="challenges3"
                                    value=""  placeholder="">{{ old('challenges3') }}</textarea>
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
