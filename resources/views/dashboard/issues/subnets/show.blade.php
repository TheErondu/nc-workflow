@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

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
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title mb-0">New IP Address Generated</h1>
                    </div>
                    <div class="card-body">
                        <h2 class="card-text">Device Name : {{ $newIPAddress->device_name }}</h2>
                        <h2 class="card-text">IP Address : {{ $newIPAddress->address }}</h2>
                        <h2 class="card-text">In Use : {{ $newIPAddress->in_use == true ?"true":"false" }}</h2>

                        <form method="POST" enctype="multipart/form-data" action="{{ route('ipaddresses.store') }}">
                            @csrf
                            @method('POST')
                            <input name="device_name" type="text" class="form-control" id="name"
                                value="{{ $newIPAddress->device_name }}" hidden required placeholder="">
                            <input name="address" type="address" class="form-control" id="address"
                                value="{{ $newIPAddress->address }}" hidden required placeholder="">
                            <input name="in_use" type="address" class="form-control" id="in_use"
                                value=1 hidden required placeholder="">

                            <button style="background-color: rgb(37, 38, 38) !important;" type="submit"
                                class="btn btn-primary">Reserve IP Address</button>

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
            // Datatables with Buttons
            var datatablesButtons = $("#datatables-buttons").DataTable({
                responsive: true,
                fixedHeader: true,
                paginate: false,
                buttons: ["copy", "print"]
            });
            datatablesButtons.buttons().container().appendTo("#datatables-buttons_wrapper .col-md-6:eq(0)");
            /* =========================================================================================== */
            /* ============================ BOOTSTRAP 3/4 EVENT ========================================== */
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust().responsive.recalc();
            });
        });
    </script>
@endsection
