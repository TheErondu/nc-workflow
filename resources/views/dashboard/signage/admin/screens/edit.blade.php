@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #272727;">
                        <h5 class="card-title" style="color: white;">Edit Screen: {{ $screen->name }}</h5>
                    </div>
                    <div class="row">
                        @if (Session::has('message'))
                            <div class="container">
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <div class="alert-message">
                                        <strong>{{ session('message') }}</strong>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="container">
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    @foreach ($errors->all() as $error)
                                        <div class="alert-message">
                                            <strong>{{ $error }}</strong>
                                        </div>
                                    @endforeach
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('signage.admin.screens.update', $screen) }}">
                            @csrf
                            @method('PUT')
                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-4">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input name="name" type="text" class="form-control" id="name"
                                        placeholder="Screen Name" value="{{ old('name', $screen->name) }}" required>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="views">Select Views <span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="views[]" id="views" multiple required>
                                        @php
                                            $selectedViews = old('views', is_array($screen->views) ? $screen->views : explode(',', $screen->views ?? ''));
                                        @endphp
                                        @foreach ($views as $view)
                                            <option value="{{ $view }}" {{ in_array($view, $selectedViews) ? 'selected' : '' }}>
                                                {{ ucfirst($view) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-3">
                                    <label for="slide_duration">Slide Duration (seconds)</label>
                                    <input name="slide_duration" type="number" class="form-control" id="slide_duration"
                                        placeholder="7" value="{{ old('slide_duration', ($screen->slide_duration ?? 7000) / 1000) }}"
                                        min="1" max="60">
                                    <small class="text-muted">How long each slide displays (1-60 seconds)</small>
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label for="view_duration">View Duration (seconds)</label>
                                    <input name="view_duration" type="number" class="form-control" id="view_duration"
                                        placeholder="60" value="{{ old('view_duration', ($screen->view_duration ?? 60000) / 1000) }}"
                                        min="10" max="600">
                                    <small class="text-muted">How long to stay on each view before switching (10-600 seconds)</small>
                                </div>
                            </div>

                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-6">
                                    <a href="{{ route('signage.admin') }}"
                                        style="background-color: rgb(53, 54, 55) !important;"
                                        class="btn btn-primary">Cancel</a>
                                </div>
                                <div class="mb-3 col-md-1">
                                    <button style="background-color: rgb(37, 38, 38) !important;" type="submit"
                                        class="btn btn-primary">Update</button>
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
                        placeholder: "Select views",
                        dropdownParent: $(this).parent()
                    });
            });

            // Convert seconds to milliseconds before form submission
            document.querySelector('form').addEventListener('submit', function(e) {
                var slideDuration = document.getElementById('slide_duration');
                var viewDuration = document.getElementById('view_duration');

                slideDuration.value = parseInt(slideDuration.value) * 1000;
                viewDuration.value = parseInt(viewDuration.value) * 1000;
            });
        });
    </script>
@endsection
