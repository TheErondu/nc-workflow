@extends('layouts.app', ['activePage' => 'manual-reports', 'titlePage' => __('Edit Manual Report')])
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card-opaque">
                <div class="card-header" style="background-color: #272727;">
                    <h5 class="card-title" style="color: white;">Edit Manual Report</h5>
                </div>
                <div class="row">
                    @if (Session::has('message'))
                        <div class="container">
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <div class="alert-icon">
                                    <i class="far fa-fw fa-bell"></i>
                                </div>
                                <div class="alert-message">
                                    <strong>{{ session('message') }}</strong>
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
                                        <strong>{{ $error }}</strong>
                                    </div>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('manual-reports.update', $manualReport->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row justify-content-between">
                            <div class="mb-3 col-md-6">
                                <label for="title">Report Title <span class="text-danger">*</span></label>
                                <input name="title" type="text" class="form-control" id="title"
                                       value="{{ old('title', $manualReport->title) }}" required placeholder="Enter report title">
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="report_type">Report Type <span class="text-danger">*</span></label>
                                <select name="report_type" id="report_type" class="form-control" required>
                                    <option value="">Select Type</option>
                                    @foreach ($reportTypes as $key => $label)
                                        <option value="{{ $key }}" {{ old('report_type', $manualReport->report_type) == $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="report_date">Report Date <span class="text-danger">*</span></label>
                                <input name="report_date" type="date" class="form-control" id="report_date"
                                       value="{{ old('report_date', $manualReport->report_date->format('Y-m-d')) }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-12">
                                <label for="content">Report Content (Markdown supported) <span class="text-danger">*</span></label>
                                <textarea name="content" id="content" class="form-control" rows="15"
                                          required placeholder="Enter your report content here...">{{ old('content', $manualReport->content) }}</textarea>
                                <small class="text-muted">Supports Markdown formatting: headings (#), bold (**), italic (*), lists, blockquotes (>), etc.</small>
                            </div>
                        </div>

                        <div class="row justify-content-between">
                            <div class="mb-3 col-md-6">
                                <a href="{{ route('manual-reports.index') }}" style="background-color: rgb(53, 54, 55) !important;"
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
