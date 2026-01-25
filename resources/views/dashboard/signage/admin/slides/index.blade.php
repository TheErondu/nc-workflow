@extends('layouts.app')
@section('content')
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

        {{-- Slides by View Type --}}
        @forelse ($slidesByViewType as $viewType => $viewSlides)
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #272727;">
                            <h5 class="card-title mb-0" style="color: white;">
                                {{ ucfirst($viewType) }} Slides ({{ $viewSlides->count() }})
                            </h5>
                            <a href="{{ route('signage.slides.create') }}" class="btn btn-sm btn-primary">
                                <i class="fa fa-plus"></i> Add Slide
                            </a>
                        </div>
                        <div class="card-body">
                            @if ($viewSlides->isEmpty())
                                <p class="text-muted">No slides for this view type.</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 100px;">Preview</th>
                                                <th>Title</th>
                                                <th>Active From</th>
                                                <th>Active Until</th>
                                                <th>Order</th>
                                                <th>Status</th>
                                                <th>Created By</th>
                                                <th style="width: 150px;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($viewSlides as $slide)
                                                <tr>
                                                    <td>
                                                        <img src="{{ $slide->image_url }}" alt="{{ $slide->title }}"
                                                            style="width: 80px; height: 50px; object-fit: cover; border-radius: 4px;">
                                                    </td>
                                                    <td>{{ $slide->title ?? '-' }}</td>
                                                    <td>{{ $slide->active_from ? $slide->active_from->format('Y-m-d') : 'Always' }}</td>
                                                    <td>{{ $slide->active_until ? $slide->active_until->format('Y-m-d') : 'Always' }}</td>
                                                    <td>{{ $slide->sort_order }}</td>
                                                    <td>
                                                        @if ($slide->is_active)
                                                            <span class="badge bg-success">Active</span>
                                                        @else
                                                            <span class="badge bg-secondary">Inactive</span>
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
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            {{-- Empty State --}}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center py-5">
                                <i class="fa fa-images fa-4x text-muted mb-3"></i>
                                <h5>No Slides Yet</h5>
                                <p class="text-muted">No slides have been created yet. Get started by creating your first slide.</p>
                                <a href="{{ route('signage.slides.create') }}" class="btn btn-primary">
                                    <i class="fa fa-plus"></i> Create Your First Slide
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
@endsection
