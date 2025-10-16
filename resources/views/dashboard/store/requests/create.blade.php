@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-opaque">
                    <div class="card-header" style="background-color: #272727;">
                        <h5 class="card-title" style="color: white;">Store Manager</h5>

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
                        <form method="POST" enctype="multipart/form-data" action="{{ route('store-requests.store',$requested_item->id) }}">
                            @csrf
                            <div class="row justify-content-around">
                                <div class="mb-3 col-md-12">
                                    <h5 class="highlight-black" for="borrower">Borrower : {{ Auth::user()->name }}</h5>
                                </div>
                                    <div class="row justify-content-between">
                                        <div class="mb-3 col-md-6">
                                            <h5 class="highlight-black" for="borrower">Item : {{ $requested_item->item_name }}</h5>
                                        </div>
                                    </div>
                                    <div class="row justify-content-between">
                                        <div class="mb-3 col-md-4">
                                            <label for="assigned_department">Return Date</label>
                                            <div class="input-group date" id="datetimepicker-minimum"
                                                data-target-input="nearest">
                                                <input name="return_date" type="text" class="form-control datetimepicker-input"
                                                    data-target="#datetimepicker-minimum" />
                                                <div class="input-group-text" data-target="#datetimepicker-minimum"
                                                    data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                <div class="row justify-content-between">
                                    <div class="mb-3 col-md-6">
                                        <a href="{{ route('triplogger.index') }}"
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
