@extends('layouts.app')
@section('content')
    <style>
        .card-box {
            position: relative;
            color: #fff;
            padding: 20px 10px 40px;
            margin: 20px 0px;
        }

        .card-box:hover {
            text-decoration: none;
            color: #f1f1f1;
        }

        .card-box:hover .icon i {
            font-size: 100px;
            transition: 1s;
            -webkit-transition: 1s;
        }

        .card-box .inner {
            padding: 5px 10px 0 10px;
        }

        .card-box h3 {
            font-size: 27px;
            font-weight: bold;
            margin: 0 0 8px 0;
            white-space: nowrap;
            padding: 0;
            text-align: left;
        }

        .card-box p {
            font-size: 15px;
        }

        .card-box .icon {
            position: absolute;
            top: auto;
            bottom: 5px;
            right: 5px;
            z-index: 0;
            font-size: 72px;
            color: rgba(0, 0, 0, 0.15);
        }

        .card-box .card-box-footer {
            position: absolute;
            left: 0px;
            bottom: 0px;
            text-align: center;
            padding: 3px 0;
            color: rgba(255, 255, 255, 0.8);
            background: rgba(0, 0, 0, 0.1);
            width: 100%;
            text-decoration: none;
        }

        .card-box:hover .card-box-footer {
            background: rgba(0, 0, 0, 0.3);
        }

        .bg-blue {
            background-color: #00c0ef !important;
        }

        .bg-green {
            background-color: #00a65a !important;
        }

        .bg-orange {
            background-color: #f39c12 !important;
        }

        .bg-red {
            background-color: #d9534f !important;
        }

        .screens-table {
            background-color: #1a1a1a;
        }

        .screens-table tbody tr {
            background-color: #1a1a1a;
            color: #fff;
            border-bottom: 1px solid #444;
        }

        .screens-table thead {
            background-color: #000;
            color: #fff;
        }

        .screens-table thead th {
            border-bottom: 2px solid #444;
        }

        .screens-table tbody tr a:not(.btn) {
            color: #fff;
        }

        .screens-table .badge.bg-secondary {
            background-color: #444 !important;
        }
    </style>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="container">
        @if (Session::has('message'))
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <div class="alert-message">
                            <strong>{{ session('message') }}</strong>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card-box bg-blue">
                    <div class="inner">
                        <h3>{{ count($screens ?? 0) }}</h3>
                        <p>Screens</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-desktop" aria-hidden="true"></i>
                    </div>
                    <a href="{{ route('signage.admin.screens.create') }}" class="card-box-footer">
                        Add New Screen <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="card-box bg-green">
                    <div class="inner">
                        <h3>Slides</h3>
                        <p>Manage Content</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-image" aria-hidden="true"></i>
                    </div>
                    <a href="{{ route('signage.slides.index') }}" class="card-box-footer">
                        Manage Slides <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #272727;">
                        <h5 class="card-title mb-0" style="color: white;">All Screens</h5>
                    </div>
                    <div class="card-body">
                        @if ($screens->isEmpty())
                            <p class="text-muted">No screens have been created yet.</p>
                        @else
                            <div class="table-responsive">
                                <table class="table screens-table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Views</th>
                                            <th>Slide Duration</th>
                                            <th>View Duration</th>
                                            <th>Created</th>
                                            <th style="width: 200px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($screens as $screen)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('signage.show', $screen->name) }}" target="_blank">
                                                        {{ $screen->name }}
                                                    </a>
                                                </td>
                                                <td>
                                                    @if (is_array($screen->views))
                                                        @foreach ($screen->views as $view)
                                                            <span class="badge bg-secondary">{{ $view }}</span>
                                                        @endforeach
                                                    @else
                                                        {{ $screen->views }}
                                                    @endif
                                                </td>
                                                <td>{{ ($screen->slide_duration ?? 7000) / 1000 }}s</td>
                                                <td>{{ ($screen->view_duration ?? 60000) / 1000 }}s</td>
                                                <td>{{ $screen->created_at->format('Y-m-d') }}</td>
                                                <td>
                                                    <a href="{{ route('signage.show', $screen->name) }}" target="_blank"
                                                        class="btn btn-sm btn-outline-success" title="Preview">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a style="padding: 10px" class="text-white" href="{{ route('signage.admin.screens.edit', $screen) }}"
                                                        class="btn btn-sm btn-outline-primary" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('signage.admin.screens.destroy', $screen) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Are you sure you want to delete this screen?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center">
                                {{ $screens->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
