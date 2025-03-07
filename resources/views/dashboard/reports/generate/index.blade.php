@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-opaque">
                    <div class="card-header" style="background-color: #272727;">
                        <h5 class="card-title" style="color: white;">Generate Report</h5>
                    </div>

                    @if (Session::has('message'))
                        <div class="container mt-3">
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <div class="alert-icon">
                                    <i class="far fa-fw fa-bell"></i>
                                </div>
                                <div class="alert-message">
                                    <strong>{{ session('message') }}</strong>
                                </div>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="container mt-3">
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                @foreach ($errors->all() as $error)
                                    <div class="alert-icon">
                                        <i class="far fa-fw fa-bell"></i>
                                    </div>
                                    <div class="alert-message">
                                        <strong>{{ $error }}</strong>
                                    </div>
                                @endforeach
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('production.store') }}">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="mb-3 col-md-4">
                                    <label for="module">Filter by Module:</label>
                                    <select class="form-control select2" name="module" id="module" onchange="redirectToRoute(this.value)">
                                        <option value="">None</option>
                                        @foreach ($module as $name => $mod)
                                            <option @if (request('module') === $name) selected="selected" @endif value="{{ $name }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="start_date">From date</label>
                                    <input class="form-control" name="start_date" value="{{ request('start_date') }}" id="start_date" type="date">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="end_date">To date</label>
                                    <input class="form-control" name="end_date" value="{{ request('end_date') }}" id="end_date" type="date">
                                </div>
                            </div>

                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-6">
                                    <a href="{{ route('reports.index') }}" class="btn btn-primary" style="background-color: rgb(53, 54, 55) !important;">Cancel</a>
                                </div>
                                <div class="mb-3 col-md-1">
                                    <button type="submit" class="btn btn-primary" style="background-color: rgb(37, 38, 38) !important;">Submit</button>
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
            $(".select2").each(function() {
                $(this).wrap("<div class=\"position-relative\"></div>").select2({
                    placeholder: "Select value",
                    dropdownParent: $(this).parent()
                });
            });
        });
    </script>

    <script>
        function redirectToRoute(model) {
            if (model) {
                let baseUrl = "{{ url('generate/reports') }}";
                window.location.href = baseUrl + "?module=" + encodeURIComponent(model);
            }
        }
    </script>
@endsection
