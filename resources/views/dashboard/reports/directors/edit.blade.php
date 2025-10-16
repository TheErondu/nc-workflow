@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-opaque">
                    <div class="card-header" style="background-color: #272727;">
                        <h5 class="card-title" style="color: white;">Edit Report</h5>

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
                                        <script>
                                            Toastify({
                                                text: " {{ $error }}",
                                                duration: 3000,
                                                close: true,
                                                gravity: "top", // `top` or `bottom`
                                                position: "left", // `left`, `center` or `right`
                                                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                                                stopOnFocus: true, // Prevents dismissing of toast on hover
                                                onClick: function() {} // Callback after click
                                            }).showToast();
                                        </script>

                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data"
                            action="{{ route('reports.update', $reports->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="row justify-content-around">
                                <div class="mb-3 col-md-4">
                                    <label for="date">Date </label>
                                    <div class="input-group date" id="datetimepicker-minimum" data-target-input="nearest">
                                        <input name="log_date" value="{{ $reports->log_date }}" type="text"
                                            class="form-control datetimepicker-input"
                                            data-target="#datetimepicker-minimum" />
                                        <div class="input-group-text" data-target="#datetimepicker-minimum"
                                            data-toggle="datetimepicker"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="producer">Producer </label>
                                    <input name="producer" type="text" class="form-control" id="producer"
                                        value="{{ $reports->producer }}" placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="anchor">Anchor </label>
                                    <input name="anchor" type="text" class="form-control" id="anchor"
                                        value="{{ $reports->anchor }}" placeholder="">
                                </div>
                            </div>

                            <div class="row justify-content-around">
                                <div class="mb-3 col-md-4">
                                    <label for="director">Director </label>
                                    <select class="form-control select2" name="director" id="director"
                                        data-placeholder=" select director">
                                        <option value="" selected>select</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->name }}"
                                                @if ($reports->director === $user->name) selected='selected' @endif>
                                                {{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="vision_mixer">Vision Mixer</label>
                                    <select class="form-control select2" name="vision_mixer" id="vision_mixer"
                                        data-placeholder=" select vision mixer">
                                        <option value="" selected>select</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->name }}"
                                                @if ($reports->vision_mixer === $user->name) selected='selected' @endif>
                                                {{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="engineer">Engineer</label>
                                    <select class="form-control select2" name="engineer" id="engineer"
                                        data-placeholder=" select engineer">
                                        <option value="" selected>select</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->name }}"
                                                @if ($reports->engineer === $user->name) selected='selected' @endif>
                                                {{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-4">
                                    <label for="sound_technician">Sound Technician </label>
                                    <select class="form-control select2" name="sound_technician" id="sound_technician"
                                        data-placeholder=" select Sound Technician ">
                                        <option value="" selected>select</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->name }}"
                                                @if ($reports->sound_technician === $user->name) selected='selected' @endif>
                                                {{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="camera_operator1">Camera Operator 2</label>
                                    <select class="form-control select2" name="camera_operator" id="camera_operator"
                                        data-placeholder=" select Camera Operator">
                                        <option value="" selected>select</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->name }}"
                                                @if ($reports->camera_operator === $user->name) selected='selected' @endif>
                                                {{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="camera_operator2">Camera Operator</label>
                                    <select class="form-control select2" name="camera_operator2" id="camera_operator2"
                                        data-placeholder=" select Camera Operator">
                                        <option value="" selected>select</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->name }}"
                                                @if ($reports->camera_operator2 === $user->name) selected='selected' @endif>
                                                {{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class=" row justify-content-between">
                                <div class="mb-3 col-md-4">
                                    <label for="autocue"> AutoCUE</label>
                                    <input name="autocue" type="text" class="form-control" id="autocue"
                                        value="{{ $reports->autocue }}" placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="graphics">Graphics</label>
                                    <input name="graphics" type="text" class="form-control" id="graphics"
                                        value="{{ $reports->graphics }}" placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="tx"> TX</label>
                                    <select class="form-control select2" name="tx" id="tx"
                                        data-placeholder=" select TX operator">
                                        <option value="" selected>select</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->name }}"
                                                @if ($reports->tx === $user->name) selected='selected' @endif>
                                                {{ $user->name }}</option>
                                        @endforeach

                                    </select>
                                </div>


                            </div>

                            <section id="dynamic bulletin">
                                @foreach(json_decode($reports->bulletins, true) as $index => $bulletin)
                                    <div class="dynamic-section">
                                        <div class="row justify-content-between">
                                            <div class="mb-3 col-md-4">
                                                <label for="bulletin">Bulletin </label>
                                                <input name="bulletin[]"
                                                    id="bulletin{{ $index }}" type="text" class="form-control"
                                                    value="{{ $bulletin['bulletin']}}"
                                                    placeholder="">
                                            </div>
                                        </div>
                                        <div class="row justify-content-around">
                                            <div class="mb-3 col-md-4">
                                                <label for="dts_in">DTS In time </label>
                                                <input name="dts_in[]" type="text" class="form-control"
                                                    id="dts_in"  value="{{ $bulletin['dts_in']}}" placeholder="">
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label for="actual_in">Actual In Time</label>
                                                <input name="actual_in[]" type="text" class="form-control"
                                                    id="actual_in" value="{{ $bulletin['actual_in']}}"
                                                    placeholder="">
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label for="variance1">Variance</label>
                                                <input name="variance1[]" type="text" class="form-control"
                                                    id="variance1" value="{{ $bulletin['variance1']}}"
                                                    placeholder="">
                                            </div>
                                        </div>
                                        <div class="row justify-content-around">
                                            <div class="mb-3 col-md-4">
                                                <label for="dts_out">DTS Out time </label>
                                                <input name="dts_out[]" type="text" class="form-control"
                                                    id="dts_out" value="{{ $bulletin['dts_out']}}" placeholder="">
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label for="actual_out">Actual Out Time</label>
                                                <input name="actual_out[]" type="text" class="form-control"
                                                    id="actual_out" value="{{ $bulletin['actual_out']}}"
                                                    placeholder="">
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label for="variance2">Variance</label>
                                                <input name="variance2[]" type="text" class="form-control"
                                                    id="variance2" value="{{ $bulletin['variance2']}}"
                                                    placeholder="">
                                            </div>
                                        </div>
                                        <div class="row justify-content-between">
                                            <div class="mb-3 col-12">
                                                <label for="comment">Comment</label>
                                                <textarea name="comment[]" type="text" class="form-control" id="comment" placeholder="">{{ $bulletin['comment']}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </section>


                            <!-- Add One More Section Button -->
                            <div class="row justify-content-between">
                                <div class="mb-3 col-sm-4">
                                    <button class="btn btn-primary" type="button" id="addSectionButton"
                                        onclick="addNewSection()">Add one
                                        more bulletin</button>
                                </div>
                            </div>

                            <div class="row justify-content-around">
                                <div class="mb-3 col-md-3">
                                    <span>Uploaded by: <br> {{ $reports->user->name }}</span>
                                </div>
                                <div class="mb-3 col-md-3">
                                    <span>Uploaded at: <br>
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $reports->created_at)->format('Y-M-d') }}</span>
                                </div>
                            </div>


                            <div class="row justify-content-between">
                                    <div class="mb-3 col-md-4">
                                        <a href="{{ route('reports.index') }}"
                                            style="background-color: rgb(53, 54, 55) !important;"
                                            class="btn btn-primary">Cancel</a>
                                    </div>
                                @can('delete-reports')
                                    <div class="mb-3 col-md-4">

                                        <button form="delete-form" type="submit" class="btn btn-xs btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </div>
                                @endcan
                                @can('access-dir_reports')
                                    <div class="mb-3 col-md-4">
                                        <button style="background-color: rgb(37, 38, 38) !important;" type="submit"
                                            class="btn btn-primary">Submit</button>
                                    </div>
                                @endcan

                            </div>
                        </form>
                        <form action="{{ route('reports.destroy', $reports->id) }}" id="delete-form" method="POST">
                            @method('DELETE')
                            @csrf

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
                        placeholder: "Select value",
                        dropdownParent: $(this).parent()
                    });
            })
            // Datetimepicker
            $('#datetimepicker-minimum').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });
            $('#datetimepicker-minimum2').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });
            $('#datetimepicker-view-mode').datetimepicker({
                viewMode: 'years'
            });
            $('#datetimepicker-time').datetimepicker({
                format: 'LT'
            });
            $('#datetimepicker-date').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });
        });
    </script>
    <script>
        // JavaScript function to add a new section
        function addNewSection() {
            // Clone the entire dynamic-section
            var existingSection = document.querySelector('.dynamic-section');
            var newSection = existingSection.cloneNode(true);

            // Clear values in the cloned section
            var inputFields = newSection.querySelectorAll('input, textarea');
            inputFields.forEach(function(field) {
                field.value = '';
            });

            // Append the new section just after the last section
            existingSection.parentNode.appendChild(newSection);
        }
    </script>
@endsection
