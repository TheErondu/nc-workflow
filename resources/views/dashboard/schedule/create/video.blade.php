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
                        <form method="POST" enctype="multipart/form-data" action="{{ route('awards.store') }}">
                            @csrf
                            <div class="row">
                                <div class="mb-3">
                                    <label for="title">Title of shoot</label>
                                    <input name="title" type="text" class="form-control" id="title" placeholder="title">
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
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-2">
                                    <label>Status</label>
                                    <select name="status" class="form-control mb-3" required>
                                        <option value="">Select...</option>
                                        <option value="normal">normal</option>
                                        <option value="important">important</option>
                                        <option value="critical">critical</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-5">
                                    <label>Producer 1</label>
                                    <select name="producer1" class="form-control mb-3" required>
                                        <option value="">Select...</option>
                                        <option value="important">important</option>
                                        <option value="critical">critical</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-5">
                                    <label>Producer 2</label>
                                    <select name="producer2" class="form-control mb-3" required>
                                        <option value="">Select...</option>
                                        <option value="important">important</option>
                                        <option value="critical">critical</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-5">
                                    <label>Director of Photography 1</label>
                                    <select name="dop1" class="form-control mb-3" required>
                                        <option value="">Select...</option>
                                        <option value="important">important</option>
                                        <option value="critical">critical</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-5">
                                    <label>Director of Photography 2</label>
                                    <select name="dop2" class="form-control mb-3" required>
                                        <option value="">Select...</option>
                                        <option value="important">important</option>
                                        <option value="critical">critical</option>
                                    </select>
                                </div>

                            </div>
                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-5">
                                    <label>Director of Photography 3</label>
                                    <select name="dop3" class="form-control mb-3" required>
                                        <option value="">Select...</option>
                                        <option value="important">important</option>
                                        <option value="critical">critical</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-5">
                                    <label>Director of Photography 4</label>
                                    <select name="dop4" class="form-control mb-3" required>
                                        <option value="">Select...</option>
                                        <option value="important">important</option>
                                        <option value="critical">critical</option>
                                    </select>
                                </div>

                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" rows="2"
                                        placeholder="Enter short description of shoot ...."></textarea>
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
        });
    </script>
@endsection
