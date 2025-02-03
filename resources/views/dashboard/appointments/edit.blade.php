@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-opaque">

                    <div class="card-header" style="background-color: #272727;">
                        <h5 class="card-title" style="color: white;">Edit Appointment | Booked by {{ Auth::user()->name }}
                        </h5>
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
                        <form method="POST" enctype="multipart/form-data"
                            action="{{ route('appointments.update', $appointment->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Visitor's name</label>
                                    <input name="title" class="form-control" placeholder="Appointment Title" required
                                        type="text" value="{{ $appointment->title }}">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Email</label>
                                    <input name="email" class="form-control" placeholder="Email Address" required
                                        type="email" value="{{ $appointment->email }}">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Phone</label>
                                    <input name="phone" class="form-control" placeholder="Phone Number" type="text"
                                        value="{{ $appointment->phone }}">
                                </div>
                            </div>
                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Start Time</label>
                                    <div class="input-group date" id="datetimepicker-start" data-target-input="nearest">
                                        <input name="start" type="text" class="form-control datetimepicker-input"
                                            data-target="#datetimepicker-start" value="{{ $appointment->start }}" />
                                        <div class="input-group-text" data-target="#datetimepicker-start"
                                            data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">End Time</label>
                                    <div class="input-group date" id="datetimepicker-end" data-target-input="nearest">
                                        <input name="end" type="text" class="form-control datetimepicker-input"
                                            data-target="#datetimepicker-end" value="{{ $appointment->end }}" />
                                        <div class="input-group-text" data-target="#datetimepicker-end"
                                            data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="confirmed"
                                            {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="cancelled"
                                            {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control" rows="3" placeholder="Enter additional details...">{{ $appointment->description }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Photo</label>
                                    <input type="file" id="photoInput" name="photo" class="form-control"
                                        accept="image/*">
                                    <button type="button" class="btn btn-secondary mt-2" id="takePhoto">Take
                                        Photo</button>
                                    <br>
                                    @if ($appointment->photo)
                                        <a href="{{ asset('storage/' . $appointment->photo) }}"
                                            data-lightbox="imagePreview">
                                            <img id="photoPreview" src="{{ asset('storage/' . $appointment->photo) }}"
                                                class="img-fluid mt-2" style="max-height: 300px; cursor: pointer;">
                                        </a>
                                    @else
                                        <img id="photoPreview" src="" class="img-fluid mt-2"
                                            style="display: none; max-height: 300px;">
                                    @endif
                                </div>
                            </div>
                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-6">
                                    <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                                @can('update-appointment')
                                    <div class="mb-3 col-md-1">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                @endcan

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
            $(".select2").select2({
                placeholder: "Select value",
                dropdownParent: $(this).parent()
            });

            $('#datetimepicker-start').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });
            $('#datetimepicker-end').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const photoInput = document.getElementById("photoInput");
            const takePhotoBtn = document.getElementById("takePhoto");
            const photoPreview = document.getElementById("photoPreview");

            // Function to compress and show preview of the image
            function compressAndShowPreview(file) {
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = new Image();
                        img.onload = function() {
                            // Create canvas to compress the image
                            const canvas = document.createElement("canvas");
                            const ctx = canvas.getContext("2d");

                            // Set canvas dimensions to the scaled-down image
                            const maxWidth = 500; // Maximum width for the image
                            const maxHeight = 500; // Maximum height for the image
                            let width = img.width;
                            let height = img.height;

                            // Scale the image if it exceeds max dimensions
                            if (width > maxWidth || height > maxHeight) {
                                const aspectRatio = width / height;
                                if (width > height) {
                                    width = maxWidth;
                                    height = maxWidth / aspectRatio;
                                } else {
                                    height = maxHeight;
                                    width = maxHeight * aspectRatio;
                                }
                            }

                            canvas.width = width;
                            canvas.height = height;
                            ctx.drawImage(img, 0, 0, width, height);

                            // Convert the canvas to a compressed image (JPEG with quality 0.7)
                            canvas.toBlob(function(blob) {
                                const compressedFile = new File([blob], "compressed_photo.jpg", {
                                    type: "image/jpeg",
                                    lastModified: Date.now()
                                });

                                // Create a DataTransfer object and set the file to it
                                let dataTransfer = new DataTransfer();
                                dataTransfer.items.add(compressedFile);
                                photoInput.files = dataTransfer.files;

                                // Show the compressed image in the preview
                                const previewUrl = URL.createObjectURL(compressedFile);
                                photoPreview.src = previewUrl;
                                photoPreview.style.display = "block";
                            }, "image/jpeg", 0.7); // 0.7 is the quality (scale from 0 to 1)
                        };
                        img.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            }

            // Listen for file selection
            photoInput.addEventListener("change", function() {
                if (photoInput.files.length > 0) {
                    compressAndShowPreview(photoInput.files[0]);
                }
            });

            // Take Photo using Camera
            takePhotoBtn.addEventListener("click", function() {
                if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                    alert("Your device does not support camera access.");
                    return;
                }

                navigator.mediaDevices.getUserMedia({
                        video: {
                            facingMode: "environment"
                        }
                    })
                    .then((stream) => {
                        let video = document.createElement("video");
                        video.srcObject = stream;
                        video.play();

                        let canvas = document.createElement("canvas");
                        let context = canvas.getContext("2d");

                        setTimeout(() => {
                            canvas.width = video.videoWidth;
                            canvas.height = video.videoHeight;
                            context.drawImage(video, 0, 0, canvas.width, canvas.height);
                            stream.getTracks().forEach(track => track.stop());

                            // Convert canvas image to Blob
                            canvas.toBlob(blob => {
                                let file = new File([blob], "captured_photo.jpg", {
                                    type: "image/jpeg"
                                });

                                // Compress and show the photo preview
                                compressAndShowPreview(file);
                            }, "image/jpeg");
                        }, 500);
                    })
                    .catch((error) => {
                        console.error("Camera access error:", error);
                        alert("Could not access the camera.");
                    });
            });
        });
    </script>
@endsection
