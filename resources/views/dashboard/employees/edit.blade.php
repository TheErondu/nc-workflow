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
                        <form method="POST" enctype="multipart/form-data" action="{{ route('employees.update',$employee->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-4">
                                    <label for="name">Name</label>
                                    <input name="name" type="text" class="form-control" id="name" value="{{$employee->name}}"  required placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="email">Email</label>
                                    <input name="email" type="email" class="form-control" id="email" value="{{$employee->email}}"  required placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="show_title">Department</label>
                                    <select class="form-control select2" name="department_id" id="department_id">
                                    <option value="not Assigned">Select Department </option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}" @if($department->id === $employee->department_id) selected ='selected' @endif>{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row justify-content-left">
                                <div class="mb-3 col-md-4">
                                    <label for="show_title">Status</label>
                                    <select class="form-control select2" name="status" id="status">
                                            @foreach($status as $status)
                                                <option value="{{ $status}}" @if($status === $employee->status) selected='selected' @endif>{{ $status }}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="show_title">Role</label>
                                    <select class="form-control select2" name="roles" id="roles">
                                            @foreach($roles as $role)
                                                <option value="{{ $role}}" @if($role === $employee->role) selected='selected' @endif>{{ $role }}</option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>


                            <div class="row justify-content-evenly">
                                <div class="mb-3 col-md-4">
                                    <a href="{{ route('employees.index') }}" style="background-color: rgb(53, 54, 55) !important;"
                                        class="btn btn-primary">Cancel</a>
                                </div>
                                <div style="padding-right: 40px;" class="mb-3 col-md-4">
                                    <button style="background-color: rgb(37, 38, 38) !important;" type="submit"
                                        class="btn btn-primary">Submit</button>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <button id="delete-form" style="background-color: rgb(53, 54, 55) !important;" type="submit"
                                        class="btn btn-danger">Delete</button>
                                </div>
                            </div>
                        </form>
                        <form action="{{ route('employees.reset', $employee->id) }}" id="reset_password_form" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="row justify-content-between">
                            <div class="mb-3 col-md-4">
                                <label for="reset_password">Reset password</label>
                                <input name="reset_password" type="password" class="form-control" id="reset_password"  required placeholder="">
                                <br>
                                <div class="mb-3 col-md-4">
                                    <button form="reset_password_form" style="background-color: red !important;" type="submit"
                                    class="btn btn-primary">reset</button>
                            </div>
                            </div>
                            </div>
                        </form>
                        <form action="{{ route('employees.destroy', $employee->id) }}" id="delete-form" method="POST">
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
@endsection
