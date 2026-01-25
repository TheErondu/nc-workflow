@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #272727;">
                        <h5 class="card-title" style="color: white;">
                            <i class="fa fa-images me-2"></i>
                            Add New Slide
                        </h5>
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
                        <form method="POST" enctype="multipart/form-data" action="{{ route('signage.slides.store') }}">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label for="view_type">View Type <span class="text-danger">*</span></label>
                                    <select class="form-control" name="view_type" id="view_type" required>
                                        <option value="">Select View Type</option>
                                        <option value="showreels" {{ old('view_type') == 'showreels' ? 'selected' : '' }}>Showreels</option>
                                        <option value="general" {{ old('view_type') == 'general' ? 'selected' : '' }}>General</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="title">Title (optional)</label>
                                    <input name="title" type="text" class="form-control" id="title"
                                        placeholder="Slide title" value="{{ old('title') }}">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="sort_order">Sort Order</label>
                                    <input name="sort_order" type="number" class="form-control" id="sort_order"
                                        placeholder="0" value="{{ old('sort_order', 0) }}" min="0">
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="active_from">Active From</label>
                                    <input name="active_from" type="date" class="form-control" id="active_from"
                                        value="{{ old('active_from') }}">
                                    <small class="text-muted">Leave empty for always active</small>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="active_until">Active Until</label>
                                    <input name="active_until" type="date" class="form-control" id="active_until"
                                        value="{{ old('active_until') }}">
                                    <small class="text-muted">Leave empty for no end date</small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="image">Image <span class="text-danger">*</span></label>
                                    <input name="image" type="file" class="form-control" id="image"
                                        accept="image/jpeg,image/png,image/gif" required>
                                    <small class="text-muted">Max size: 5MB. Allowed formats: JPG, PNG, GIF</small>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <div class="form-check mt-4">
                                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
                                            value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Active
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-6">
                                    <a href="{{ route('signage.slides.index') }}"
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
