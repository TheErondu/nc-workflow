@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
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
                    <div>
                        <div class="row">
                            <div class="col-12 col-xl-6">
                                <div class="table-card">
                                    <div class="card-header">
                                        <h5 class="card-title">Available Items</h5>
                                    </div>
                                    <table class="table table-sm table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th style="width:30%">Action</th>

                                                <th style="width:50%">Item name</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($available_items as $item)
                                            <tr>
                                                <td>
                                                    <a href="{{route('store-requests.create', ['id' =>$item->id ] )}}"><i class=" fas fa-plus">&nbsp;Make Request</i></a>
                                                </td>
                                                <td>{{$item->item_name}}</td>

                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-12 col-xl-6">
                                <div class="table-card">
                                    <div class="card-header">
                                        <h5 class="card-title">Items you requested</h5>
                                        </div>
                                    <table class="table table-sm table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th style="width:15%;">Status</th>
                                                <th style="width:25%">Due date</th>
                                                <th style="width:30%">Date of request</th>
                                                <th style="width:30%">Item</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($requested_items as $item )
                                            <tr>
                                                <td>{{$item->status}}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->return_date)->format('d-M-Y') }}</td>
                                                <td class="d-none d-md-table-cell">{{ \Carbon\Carbon::parse($item->created_at)->format('d-M-Y') }}</td>
                                                <td class="table-action">{{$item->item}}</td>
                                            </tr>
                                           @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-card">
                                    <div class="card-header">
                                        <h5 class="card-title">Closed item Requests</h5>
                                       </div>
                                    <table class="table table-sm table-bordered ">
                                        <thead>
                                            <tr>
                                                <th>Status</th>
                                                <th class="text-end">Due date</th>
                                                <th class="text-end">Requested Date</th>
                                                <th class="text-end">Requested Item</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($all_requested as $request )
                                             <tr>
                                                <td>{{$request->status}}</td>
                                                <td class="text-end">{{ \Carbon\Carbon::parse($request->return_date)->format('d-M-Y') }}</td>
                                                <td class="text-end">{{ \Carbon\Carbon::parse($request->created_at)->format('d-M-Y') }}</td>
                                                <td class="text-end">{{$request->item}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    @endsection
    @section('javascript')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                /* = NOTE : don't add "id" in <table> if not necessary, is added than replace each "id" here = */
                $('.table').DataTable({
                    responsive: false,
                    "sAutoWidth": true,
                    "bDestroy": true,
                    "sPaginationType": "bootstrap", // full_numbers
                    "iDisplayStart ": 10,
                    "iDisplayLength": 10,
                    "bPaginate": false, //hide pagination
                    "bFilter": true, //hide Search bar
                    "bInfo": false,
                });
                /* =========================================================================================== */
                /* ============================ BOOTSTRAP 3/4 EVENT ========================================== */
                $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                    $($.fn.dataTable.tables(true)).DataTable().columns.adjust().responsive.recalc();
                });
            });
        </script>
    @endsection
