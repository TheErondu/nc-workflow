@extends('layouts.app')
@section('content')
    <style>
        .slides-table {
            background-color: #1a1a1a;
        }

        .slides-table tbody tr {
            background-color: #1a1a1a;
            color: #fff;
            border-bottom: 1px solid #444;
        }

        .slides-table thead {
            background-color: #000;
            color: #fff;
        }

        .slides-table thead th {
            border-bottom: 2px solid #444;
        }

        .slides-table tbody tr a:not(.btn) {
            color: #fff;
        }

        .slides-table .badge.bg-secondary {
            background-color: #444 !important;
        }
    </style>

    <div class="container-fluid">
        {{-- Header Section --}}
        <div class="row mb-3">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="text-white">
                        <i class="fa fa-images me-2"></i>
                        Signage Slides
                    </h4>
                    <div>
                        <a href="{{ route('signage.admin') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> Back to Signage
                        </a>
                        <a href="{{ route('signage.slides.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Add New Slide
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Session Messages --}}
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

        {{-- Slides Table --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #272727;">
                        <h5 class="card-title mb-0" style="color: white;">
                            All Slides ({{ $slides->total() }})
                        </h5>
                        <a href="{{ route('signage.slides.create') }}" class="btn btn-sm btn-primary">
                            <i class="fa fa-plus"></i> Add Slide
                        </a>
                    </div>
                    <div class="card-body">
                        {{-- Search and Filter --}}
                        <form method="GET" action="{{ route('signage.slides.index') }}" class="mb-4">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control"
                                            placeholder="Search by title..."
                                            value="{{ request('search') }}">
                                        <button type="submit" class="btn btn-outline-secondary">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <select name="view_type" class="form-select" onchange="this.form.submit()">
                                        <option value="">All View Types</option>
                                        @foreach ($viewTypes as $type)
                                            <option value="{{ $type }}" {{ request('view_type') == $type ? 'selected' : '' }}>
                                                {{ ucfirst($type) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    @if(request('search') || request('view_type'))
                                        <a href="{{ route('signage.slides.index') }}" class="btn btn-outline-secondary">
                                            <i class="fa fa-times"></i> Clear
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>

                        @if ($slides->isEmpty())
                            <div class="text-center py-5">
                                <i class="fa fa-images fa-4x text-muted mb-3"></i>
                                <h5>No Slides Found</h5>
                                @if(request('search') || request('view_type'))
                                    <p class="text-muted">No slides match your search criteria.</p>
                                    <a href="{{ route('signage.slides.index') }}" class="btn btn-secondary">
                                        Clear Filters
                                    </a>
                                @else
                                    <p class="text-muted">No slides have been created yet.</p>
                                    <a href="{{ route('signage.slides.create') }}" class="btn btn-primary">
                                        <i class="fa fa-plus"></i> Create Your First Slide
                                    </a>
                                @endif
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table slides-table">
                                    <thead>
                                        <tr>
                                            <th style="width: 100px;">Preview</th>
                                            <th>Title</th>
                                            <th>View Type</th>
                                            <th>Active From</th>
                                            <th>Active Until</th>
                                            <th>Order</th>
                                            <th>Status</th>
                                            <th>Created By</th>
                                            <th style="width: 150px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($slides as $slide)
                                            <tr>
                                                <td>
                                                    <img src="{{ $slide->image_url }}" alt="{{ $slide->title }}"
                                                        style="width: 80px; height: 50px; object-fit: cover; border-radius: 4px;">
                                                </td>
                                                <td>{{ $slide->title ?? '-' }}</td>
                                                <td>
                                                    <span class="badge bg-secondary">{{ ucfirst($slide->view_type) }}</span>
                                                </td>
                                                <td>{{ $slide->active_from ? $slide->active_from->format('Y-m-d') : 'Always' }}</td>
                                                <td>{{ $slide->active_until ? $slide->active_until->format('Y-m-d') : 'Always' }}</td>
                                                <td>{{ $slide->sort_order }}</td>
                                                <td>
                                                    @if ($slide->is_active)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>{{ $slide->user->name ?? 'Unknown' }}</td>
                                                <td>
                                                    <a href="{{ route('signage.slides.edit', $slide) }}"
                                                        class="btn btn-sm btn-outline-primary">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('signage.slides.destroy', $slide) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Are you sure you want to delete this slide?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- Pagination --}}
                            <div class="row justify-content-center mt-4">
                                <div class="col-6">
                                    {!! $slides->render('dashboard.roles.paginate') !!}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
