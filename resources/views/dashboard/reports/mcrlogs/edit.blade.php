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
                        <form method="POST" enctype="multipart/form-data" action="{{ route('mcr.update',$mcr_logs->id) }}">
                            @csrf
                            @method('PUT')

                            <div class=" row justify-content-between">
                                <div class="mb-3 col-md-6">
                                    <label for="bulletin">STO </label>
                                    <select class="form-control select2" name="sto" id="sto" data-placeholder=" select STO">
                                        <option value="" selected>select</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->name }}" @if($mcr_logs->sto === $user->name) selected='selected' @endif>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="row justify-content-around">
                                <div class="mb-3 col-md-4">
                                    <label for="timing">timings</label>
                                    <input name="timing" type="text" class="form-control" id="timing"
                                    value="{{ $mcr_logs->timing }}"
                                      required placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="programmes">Programmes</label>
                                    <input name="programmes" type="text" class="form-control" id="programmes"
                                        value="{{ $mcr_logs->programmes }}" required placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="traffic">Traffic</label>
                                    <input name="traffic" type="text" class="form-control" id="traffic"
                                        value="{{ $mcr_logs->traffic }}" required placeholder="">
                                </div>
                            </div>

                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-4">
                                    <label for="squeezbacks">Squeeze Backs</label>
                                    <input name="squeezbacks" type="text" class="form-control" id="squeezbacks"
                                        value="{{ $mcr_logs->squeezbacks }}" required placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="tc">TC</label>
                                    <input name="tc" type="text" class="form-control" id="tc"
                                        value="{{ $mcr_logs->tc }}" required placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="handed_over_to">STO </label>
                                    <select class="form-control select2" name="handed_over_to" id="handed_over_to" data-placeholder=" select Hand over">
                                        <option value="" selected>select</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->name }}"@if($user->name === $mcr_logs->handed_over_to) selected="selected" @endif>{{ $user->name }}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row justify-content-between">
                                <div class="mb-3 col-12">
                                    <label for="remarks">Remarks</label>
                                    <textarea name="remarks" type="text" class="form-control"
                                        id="remarks" required
                                        placeholder="">{{ $mcr_logs->remarks }}</textarea>
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
