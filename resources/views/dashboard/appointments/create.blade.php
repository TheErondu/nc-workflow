@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-opaque">

                    <div class="card-header" style="background-color: #272727;">
                        <h5 class="card-title" style="color: white;">Create Appointment</h5>
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
                        <form method="POST" enctype="multipart/form-data" action="{{ route('appointments.store') }}">
                            @csrf
                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Visitor's name</label>
                                    <input name="title" class="form-control" placeholder="Appointment Title" required
                                        type="text">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Email</label>
                                    <input name="email" class="form-control" placeholder="Email Address" required
                                        type="email">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Phone</label>
                                    <input name="phone" class="form-control" placeholder="Phone Number" type="text">
                                </div>
                            </div>
                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Start Time</label>
                                    <div class="input-group date" id="datetimepicker-start" data-target-input="nearest">
                                        <input name="start" type="text" class="form-control datetimepicker-input"
                                            data-target="#datetimepicker-start" />
                                        <div class="input-group-text" data-target="#datetimepicker-start"
                                            data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">End Time</label>
                                    <div class="input-group date" id="datetimepicker-end" data-target-input="nearest">
                                        <input name="end" type="text" class="form-control datetimepicker-input"
                                            data-target="#datetimepicker-end" />
                                        <div class="input-group-text" data-target="#datetimepicker-end"
                                            data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="pending" selected>Pending</option>
                                        <option value="confirmed">Confirmed</option>
                                        <option value="cancelled">Cancelled</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control" rows="3" placeholder="Enter additional details..."></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Visitor's Photo (for security confirmation)</label>
                                    <input type="file" id="photoInput" name="photo" class="form-control" accept="image/*">
                                    <button type="button" class="btn btn-secondary mt-2" id="takePhoto">Take Photo</button>
                                    <img id="photoPreview" src="" class="img-fluid mt-2" style="display: none; max-height: 200px;">
                                </div>
                            </div>
                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-6">
                                    <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                                <div class="mb-3 col-md-1">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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

    // Function to show preview
    function showPreview(file) {
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                photoPreview.src = e.target.result;
                photoPreview.style.display = "block";
            };
            reader.readAsDataURL(file);
        }
    }

    // Function to compress image
    function compressImage(file, callback) {
        const img = new Image();
        const reader = new FileReader();

        reader.onload = function(e) {
            img.onload = function() {
                // Create a canvas to resize the image
                const canvas = document.createElement("canvas");
                const ctx = canvas.getContext("2d");

                // Set the canvas dimensions to the image dimensions (scaled down)
                const maxWidth = 500;  // Set your preferred width
                const maxHeight = 500; // Set your preferred height
                let width = img.width;
                let height = img.height;

                // Calculate the new dimensions while preserving aspect ratio
                if (width > height) {
                    if (width > maxWidth) {
                        height *= maxWidth / width;
                        width = maxWidth;
                    }
                } else {
                    if (height > maxHeight) {
                        width *= maxHeight / height;
                        height = maxHeight;
                    }
                }

                canvas.width = width;
                canvas.height = height;

                // Draw the image onto the canvas
                ctx.drawImage(img, 0, 0, width, height);

                // Compress the image by reducing the quality
                canvas.toBlob(function(blob) {
                    const compressedFile = new File([blob], file.name, {
                        type: "image/jpeg",
                        lastModified: Date.now()
                    });
                    callback(compressedFile);
                }, "image/jpeg", 0.7);  // 0.7 is the quality (0 to 1)
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }

    // Listen for file selection
    photoInput.addEventListener("change", function() {
        if (photoInput.files.length > 0) {
            const file = photoInput.files[0];

            // Compress the image before showing the preview
            compressImage(file, function(compressedFile) {
                showPreview(compressedFile);

                // Append the compressed image to the form
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(compressedFile);
                photoInput.files = dataTransfer.files;
            });
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

                        // Compress the image before showing the preview
                        compressImage(file, function(compressedFile) {
                            // Create a DataTransfer object and add the compressed file to it
                            let dataTransfer = new DataTransfer();
                            dataTransfer.items.add(compressedFile);
                            photoInput.files = dataTransfer.files;

                            // Show preview
                            showPreview(compressedFile);
                        });
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
