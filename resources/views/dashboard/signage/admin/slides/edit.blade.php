@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #272727;">
                        <h5 class="card-title" style="color: white;">
                            <i class="fa fa-images me-2"></i>
                            Edit Slide
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
                        <form method="POST" enctype="multipart/form-data" action="{{ route('signage.slides.update', $slide) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label for="view_type">View Type <span class="text-danger">*</span></label>
                                    <select class="form-control" name="view_type" id="view_type" required>
                                        <option value="">Select View Type</option>
                                        <option value="showreels" {{ old('view_type', $slide->view_type) == 'showreels' ? 'selected' : '' }}>Showreels</option>
                                        <option value="general" {{ old('view_type', $slide->view_type) == 'general' ? 'selected' : '' }}>General</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="title">Title (optional)</label>
                                    <input name="title" type="text" class="form-control" id="title"
                                        placeholder="Slide title" value="{{ old('title', $slide->title) }}">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="sort_order">Sort Order</label>
                                    <input name="sort_order" type="number" class="form-control" id="sort_order"
                                        placeholder="0" value="{{ old('sort_order', $slide->sort_order) }}" min="0">
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="active_from">Active From</label>
                                    <input name="active_from" type="date" class="form-control" id="active_from"
                                        value="{{ old('active_from', $slide->active_from ? $slide->active_from->format('Y-m-d') : '') }}">
                                    <small class="text-muted">Leave empty for always active</small>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="active_until">Active Until</label>
                                    <input name="active_until" type="date" class="form-control" id="active_until"
                                        value="{{ old('active_until', $slide->active_until ? $slide->active_until->format('Y-m-d') : '') }}">
                                    <small class="text-muted">Leave empty for no end date</small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label class="d-block">Slide Type <span class="text-danger">*</span></label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="slide_type" id="slide_type_image"
                                            value="image" {{ old('slide_type', $slide->slide_type ?? 'image') === 'image' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="slide_type_image">Image</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="slide_type" id="slide_type_video"
                                            value="video" {{ old('slide_type', $slide->slide_type ?? 'image') === 'video' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="slide_type_video">Video</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="image-section">
                                <div class="mb-3 col-md-3">
                                    <label>Current Image</label>
                                    <div>
                                        @if($slide->image_path)
                                            <img src="{{ $slide->image_url }}" alt="{{ $slide->title }}"
                                                style="max-width: 200px; max-height: 120px; object-fit: cover; border-radius: 4px;">
                                        @else
                                            <span class="text-muted">No image</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3 col-md-5">
                                    <label for="image">Replace Image</label>
                                    <input name="image" type="file" class="form-control" id="image"
                                        accept="image/jpeg,image/png,image/gif">
                                    <small class="text-muted">Leave empty to keep current image. Max 5MB.</small>
                                </div>
                            </div>

                            <div class="row" id="video-section">
                                @if($slide->video_path)
                                    <div class="mb-3 col-md-4">
                                        <label>Current Video</label>
                                        <div>
                                            <video src="{{ $slide->video_url }}" controls
                                                style="max-width: 100%; max-height: 150px; border-radius: 4px;"></video>
                                        </div>
                                    </div>
                                @endif
                                <div class="mb-3 col-md-5">
                                    <label for="video">{{ $slide->video_path ? 'Replace Video' : 'Upload Video' }}</label>
                                    <input name="video" type="file" class="form-control" id="video"
                                        accept="video/mp4,video/webm,video/ogg">
                                    <small class="text-muted">Leave empty to keep current video. Max 100MB.</small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <div class="form-check mt-4">
                                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
                                            value="1" {{ old('is_active', $slide->is_active) ? 'checked' : '' }}>
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
    (function () {
        var imageSection = document.getElementById('image-section');
        var videoSection = document.getElementById('video-section');
        var radios = document.querySelectorAll('input[name="slide_type"]');

        function toggleSections() {
            var selected = document.querySelector('input[name="slide_type"]:checked');
            var isVideo = selected && selected.value === 'video';
            imageSection.style.display = isVideo ? 'none' : '';
            videoSection.style.display = isVideo ? '' : 'none';
        }

        radios.forEach(function (r) { r.addEventListener('change', toggleSections); });
        toggleSections();
    })();
</script>
@endsection
