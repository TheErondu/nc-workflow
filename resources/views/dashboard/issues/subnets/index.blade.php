@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card table-card">
                    <div class="card-header" style="margin-bottom: 1.0rem;">
                        <span>IP Addresses </span>
                        <a href="{{ route('ipaddresses.generate') }}" style="background-color: rgb(0, 0, 0) !important;"
                            type="submit" class="btn btn-primary create-button">Generate New Ip Address <i
                                class="fas fa-plus"></i></a>
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
                    @if (count($ipAddresses) > 0)
                        <div style="overflow-y: auto; height:400px; ">
                            <table id="datatables-buttons" class="table table-bordered datatable dtr-inline" cellspacing="0"
                                width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>IP</th>
                                        <th>In Use</th>
                                        <th>Created At</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ipAddresses as $ipAddress)
                                        <tr>
                                            <td><a href="{{ route('ipaddresses.edit', $ipAddress->id) }}"><i
                                                        class="far fa-edit"></i></a></td>

                                            <td>{{ $ipAddress->device_name }}</td>
                                            <td>{{ $ipAddress->address }}</td>
                                            <td style="color: {{ $ipAddress->in_use == 1 ? 'red' : 'green' }}">
                                                {{ $ipAddress->in_use == 1 ? 'assigned' : 'unassigned' }}
                                            </td>
                                            <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ipAddress->created_at)->format('d-M-Y') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="modal fade" id="smallModal" role="dialog" aria-labelledby="smallModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" id="smallBody">
                                        <div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card">
                            <div class="card-body card-black">
                                <p>No IP Addresses Have Been Added yet, Click <a href="{{ route('ipAddresses.create') }}"
                                        data-toggle="tooltip" title="" data-original-title="Add Vehicles">Here</a> to
                                    add
                                    IP Address
                                <p>
                                <p><a class="btn btn-primary" href="{{ route('employees.create') }}">Add Address</a>
                                </p>
                            </div>
                        </div>
                    @endif
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
