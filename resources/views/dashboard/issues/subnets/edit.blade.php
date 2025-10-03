@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-opaque">
                    <div class="card-header" style="background-color: #272727;">
                        <h5 class="card-title" style="color: white;">Edit  User Information</h5>

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
                        <form method="POST" enctype="multipart/form-data" action="{{ route('ipaddresses.update',$ipAddress->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-4">
                                    <label for="device_name">Device name</label>
                                    <input name="device_name" type="text" class="form-control" id="name" value="{{$ipAddress->device_name}}" placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="address">IP Address</label>
                                    <input name="address" type="address" class="form-control" id="address" value="{{$ipAddress->address}}"  required placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="show_title">Status</label>
                                    <select class="form-control select2" name="in_use" id="in_use">

                                            <option value=0 @if($ipAddress->in_use == 0) selected ='selected' @endif>Unassigned</option>
                                            <option value=1 @if($ipAddress->in_use == 1) selected ='selected' @endif>Assigned</option>

                                    </select>
                                </div>
                            </div>



                            <div class="row justify-content-evenly">
                                <div class="mb-3 col-md-4">
                                    <a href="{{ route('ipaddresses.index') }}" style="background-color: rgb(53, 54, 55) !important;"
                                        class="btn btn-primary">Cancel</a>
                                </div>
                                <div style="padding-right: 40px;" class="mb-3 col-md-4">
                                    <button style="background-color: rgb(37, 38, 38) !important;" type="submit"
                                        class="btn btn-primary">Submit</button>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <a class="btn btn-danger" href="#" onclick="confirmDelete(event)">Delete</a>
                                </div>
                            </div>
                        </form>

                        <form action="{{ route('ipaddresses.destroy', $ipAddress->id) }}" id="delete-form" method="POST">
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
                format:'YYYY-MM-DD HH:mm:ss'
            });
            $('#datetimepicker-minimum2').datetimepicker({
                format:'YYYY-MM-DD HH:mm:ss'
            });
            $('#datetimepicker-view-mode').datetimepicker({
                viewMode: 'years'
            });
            $('#datetimepicker-time').datetimepicker({
                format: 'LT'
            });
            $('#datetimepicker-date').datetimepicker({
                format: 'LT'
            });
        });
    </script>
        <script>
            function confirmDelete(event) {
                event.preventDefault();
                if (confirm('Are you sure you want to delete this employee?')) {
                    document.getElementById('delete-form').submit();
                }
            }
        </script>
@endsection
