@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-opaque">
                    <div class="card-header" style="background-color: #272727;">
                        <h5 class="card-title" style="color: white;">Sales Production Scheduler</h5>

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
                        <form method="POST" enctype="multipart/form-data" action="{{ route('sales-production.update',$sales_schedule->id ) }}">
                            @csrf
                            @method('PUT')
                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-4">
                                    <label for="client_type">Client Type</label>
                                    <select class="form-control select2" name="client_type" id="client_type" data-placeholder="Select Client Type">
                                        <option value="" selected>Select Client Type</option>
                                        @foreach($client_types as $type)
                                            <option value="{{ $type}}" @if($type === $sales_schedule->client_type) selected='selected' @endif>{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="client_name">Client Name</label>
                                    <input value="{{$sales_schedule->title}}" name="client_name" type="text" class="form-control" id="client_name" placeholder="Client Name">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="sales_exec_ext">Sales Exec Ext.</label>
                                    <input value="{{$sales_schedule->sales_exec_ext}}" name="sales_exec_ext" type="text" class="form-control" id="sales_exec_ext" placeholder="Sales Exec. Ext.">
                                </div>
                            </div>
                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-4">
                                    <label for="client_cell">Client Cell</label>
                                    <input value="{{$sales_schedule->client_cell}}" name="client_cell" type="text" class="form-control" id="client_cell" placeholder="Client Cell.">
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Start Date</label>
                                    <div class="input-group date" id="datetimepicker-minimum2" data-target-input="nearest">
                                        <input value="{{$sales_schedule->start}}" name="start" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker-minimum2" />
                                        <div class="input-group-text" data-target="#datetimepicker-minimum2" data-toggle="datetimepicker"><i
                                                class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="brief_in_time">Brief-In Time</label>
                                    <input value="{{$sales_schedule->brief_in_time}}" name="brief_in_time" type="text" class="form-control" id="brief_in_time" placeholder="Brief In Time ">
                                </div>

                            </div>

                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Completion Deadline</label>
                                    <div class="input-group date" id="datetimepicker-minimum3" data-target-input="nearest">
                                        <input value="{{$sales_schedule->end}}" name="end" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker-minimum3" />
                                        <div class="input-group-text" data-target="#datetimepicker-minimum3" data-toggle="datetimepicker"><i
                                                class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                 <div class="mb-3 col-md-4">
                                    <label for="sales_exec_name">Sales Exec Name</label>
                                    <input  value="{{$sales_schedule->sales_exec_name}}" name="sales_exec_name" type="text" class="form-control" id="sales_exec_name" placeholder="Sales Exec Name ">
                                 </div>
                                 <div class="mb-3 col-md-4">
                                    <label for="type_of_production">Type of Production </label>
                                    <select class="form-control select2" name="type_of_production" id="type_of_production" data-placeholder="Production Type">
                                        <option value="" selected>Select Client Type</option>
                                        @foreach($production_type as $type)
                                            <option value="{{ $type}}" @if($type === $sales_schedule->type_of_production) selected='selected' @endif>{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label>Production Requirement</label>
                                    <textarea name="production_requirements" class="form-control" rows="2"
                                        placeholder="Enter Production Requirements Details ....">{{$sales_schedule->production_requirements}}</textarea>
                                </div>
                            </div>
                            <div class="row justify-content-between">
                            <div class="mb-3 col-md-4">
                                <label for="production_period"> Production Period</label>
                                <input name="production_period"  value="{{$sales_schedule->production_period}}" type="text" class="form-control" id="production_period" placeholder="production_period ">
                            </div>
                        @can('is-manager')
                            <div class="mb-3 col-md-4">
                                <label for="status">Status</label>
                                <select class="form-control select2" name="status" id="status" data-placeholder="Select Status">
                                    <option value="" selected>Approve or Reject</option>
                                    @foreach($schedule_status as $type)
                                        <option value="{{ $type}}" @if($type === $sales_schedule->status) selected='selected' @endif>{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endcan
                            <div class="mb-3 col-md-4">
                                <label for="product">Product</label>
                                <input name="product" value="{{$sales_schedule->product}}" type="text" class="form-control" id="product" placeholder="product ">
                            </div>
                            </div>
                            @can('is-manager')
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label>Approval Comments</label>
                                    <textarea name="approval_comments" class="form-control" rows="2"
                                        placeholder="Enter Approval Comments Details ....">{{$sales_schedule->approval_comments}}</textarea>
                                </div>
                            </div>
                            @endcan
                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-6">
                                    <a href="{{ route('schedule.index') }}" style="background-color: rgb(53, 54, 55) !important;"
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
@section('javascript')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            //Select2

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
                format:'YYYY-MM-DD'
            });
            $('#datetimepicker-minimum3').datetimepicker({
                format:'YYYY-MM-DD'
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
