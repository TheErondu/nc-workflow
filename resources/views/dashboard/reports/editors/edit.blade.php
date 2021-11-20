@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-opaque">
                    <div class="card-header" style="background-color: #272727;">
                        <h5 class="card-title" style="color: white;">Edit Logs</h5>

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
                        <form method="POST" enctype="multipart/form-data" action="{{ route('editors.update', $editors_logs->id) }}">
                            @method('PUT')
                            @csrf
                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-3">
                                    <span>My Daily Log: <br> <strong>{{Auth::user()->name }}</strong></span>
                                </div>
                                <div class="mb-3 col-md-3">
                                    <span>Uploaded at: <br> {{ date('d-m-Y') }}</span>
                                </div>
                            </div>
                            <div class="row justify-content-around">
                                <div class="mb-3 col-md-4">
                                    <label for="first_interval">1PM Stories</label>
                                    <textarea name="first_interval" type="text" class="form-control" id="first_interval"
                                    value="" required placeholder="">{{ $editors_logs->first_interval }}</textarea>                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="second_interval">7PM Stories</label>
                                    <textarea name="second_interval" type="text" class="form-control" id="second_interval"
                                    value="" required placeholder="">{{ $editors_logs->second_interval }}</textarea>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="third_interval">9PM Stories</label>
                                    <textarea name="third_interval" type="text" class="form-control" id="third_interval"
                                    value="" required placeholder="">{{ $editors_logs->third_interval }}</textarea>
                                </div>
                            </div>

                            <div class="row justify-content-around">
                                <div class="mb-3 col-md-4">
                                    <label for="closed_at">Closed Suite At</label>
                                    <input name="closed_at" type="text" class="form-control" id="closed_at"
                                    value="{{ $editors_logs->closed_at }}" required placeholder="">
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
                    <form action="{{ route('production.destroy', $editors_logs->id) }}" id="delete-form" method="POST">
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
