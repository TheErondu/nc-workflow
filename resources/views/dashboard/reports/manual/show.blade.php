@extends('layouts.app', ['activePage' => 'manual-reports', 'titlePage' => __('View Report')])
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card-opaque">
                <div class="card-header" style="background-color: #272727;">
                    <h5 class="card-title" style="color: white;">
                        {{ $manualReport->title }}
                        <span class="badge bg-secondary ms-2">{{ $manualReport->report_type_label }}</span>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Date:</strong> {{ $manualReport->report_date->format('F j, Y') }}
                        </div>
                        <div class="col-md-6">
                            <strong>Author:</strong> {{ $manualReport->user->name ?? 'N/A' }}
                        </div>
                    </div>
                    <hr>
                    <div class="report-content markdown-body" style="background-color: #1a1a1a; padding: 20px; border-radius: 8px;">
                        {!! $manualReport->parsed_content !!}
                    </div>
                    <hr>
                    <div class="row justify-content-between mt-4">
                        <div class="col-md-6">
                            <a href="{{ route('manual-reports.index') }}" style="background-color: rgb(53, 54, 55) !important;"
                               class="btn btn-primary">Back to List</a>
                            <a href="{{ route('manual-reports.edit', $manualReport->id) }}" style="background-color: rgb(37, 38, 38) !important;"
                               class="btn btn-primary">Edit Report</a>
                        </div>
                        <div class="col-md-2 text-end">
                            <form action="{{ route('manual-reports.destroy', $manualReport->id) }}" method="POST"
                                  style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this report?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('css')
<style>
    .markdown-body {
        color: #e0e0e0;
        line-height: 1.6;
    }
    .markdown-body h1, .markdown-body h2, .markdown-body h3,
    .markdown-body h4, .markdown-body h5, .markdown-body h6 {
        color: #ffffff;
        margin-top: 1.5em;
        margin-bottom: 0.5em;
        border-bottom: 1px solid #333;
        padding-bottom: 0.3em;
    }
    .markdown-body h1 { font-size: 2em; }
    .markdown-body h2 { font-size: 1.5em; }
    .markdown-body h3 { font-size: 1.25em; }
    .markdown-body p { margin-bottom: 1em; }
    .markdown-body ul, .markdown-body ol {
        padding-left: 2em;
        margin-bottom: 1em;
    }
    .markdown-body li { margin-bottom: 0.5em; }
    .markdown-body blockquote {
        border-left: 4px solid #555;
        padding-left: 1em;
        color: #aaa;
        margin: 1em 0;
    }
    .markdown-body code {
        background-color: #333;
        padding: 0.2em 0.4em;
        border-radius: 3px;
        font-family: monospace;
    }
    .markdown-body pre {
        background-color: #2d2d2d;
        padding: 1em;
        border-radius: 5px;
        overflow-x: auto;
    }
    .markdown-body pre code {
        background-color: transparent;
        padding: 0;
    }
    .markdown-body strong { color: #fff; }
    .markdown-body a { color: #58a6ff; }
    .markdown-body hr {
        border: none;
        border-top: 1px solid #444;
        margin: 1.5em 0;
    }
    .markdown-body table {
        width: 100%;
        border-collapse: collapse;
        margin: 1em 0;
    }
    .markdown-body th, .markdown-body td {
        border: 1px solid #444;
        padding: 0.5em;
    }
    .markdown-body th {
        background-color: #333;
    }
</style>
@endsection
