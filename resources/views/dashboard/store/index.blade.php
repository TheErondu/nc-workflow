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
                        <div class="col-12">
                            <div class="tab">
                                <ul class="nav nav-tabs justify-content-between" id="myTabs" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" href="#tab-1" data-bs-toggle="tab"
                                            role="tab"><span>Store Items</span></a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab-2" data-bs-toggle="tab"
                                            role="tab"><span>All requested Items</span></a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab-3" data-bs-toggle="tab"
                                            role="tab"><span> Approved Items</span></a></li>

                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-1" role="tabpanel">
                                        <div class="card table-card">
                                            <a href="{{route('store.create')}}" style="background-color: rgb(0, 0, 0) !important;" type="submit"
                                                    class="btn btn-primary create-button">Add Item <i class="fas fa-plus"></i></a>
                                                    <div class="table-responsive">
                                                <div id="datatables-basic_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                                    <div class="row">
                                                       <table class="table table-bordered display nowrap" width="100%">
                                                            <thead>
                                                                <tr>
                                                                    <th></th>
                                                                    <th style="white-space:nowrap;">Item name</th>
                                                                    <th style="white-space:nowrap;">Serial No</th>
                                                                    <th style="white-space:nowrap;">State</th>
                                                                    <th style="white-space:nowrap;">Created at</th>
                                                                    <th style="white-space:nowrap;">Updated at</th>
                                                                    <th style="white-space:nowrap;">Assigned Department</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($store_items as $item)
                                                                    <tr>
                                                                         <td><a
                                                                                href="{{ route('store.edit', $item->id) }}">
                                                                                <i class="far fa-edit"></i></a></td>
                                                                        <td>{{ $item->item_name }}</td>
                                                                        <td>{{ $item->serial_no }}</td>
                                                                        <td>{{ $item->state }}</td>
                                                                        <td>{{ $item->created_at }}</td>
                                                                        <td>{{ $item->updated_at }}</td>
                                                                        <td>{{ $item->assigned_department }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab-2" role="tabpanel">
                                        <div class="card table-card">
                                            <div class="table-responsive">
                                                <div id="datatables-basic_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                                    <div class="row">
                                                        <table class="table table-bordered dataTable dtr-inline"
                                                            style="width: 100%;" role="grid"
                                                            aria-describedby="datatables-basic_info">
                                                            <thead>
                                                                <tr role="row">
                                                                    <th></th>
                                                                    <th style="white-space:nowrap;">Date</th>
                                                                    <th style="white-space:nowrap;">Return By</th>
                                                                    <th style="white-space:nowrap;">Borrower</th>
                                                                    <th style="white-space:nowrap;">Item</th>
                                                                    <th style="white-space:nowrap;">Serial No</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($store_requests as $request)
                                                                    <tr class="odd">
                                                                        <td><a href="{{ route('store-requests.edit',$request->id) }}">Approve/Reject</a></td>
                                                                        <td>
                                                                            {{ \Carbon\Carbon::parse($request->created_at)->format('d-M-Y') }}</td>
                                                                        <td class="sorting_1">
                                                                            {{ \Carbon\Carbon::parse($request->return_date)->format('d-M-Y') }}</td>
                                                                        <td>{{ $request->user->name??"N?A" }}</td>

                                                                        <td class="dtr-control" tabindex="0">
                                                                            {{ $request->item }}</td>
                                                                            <td class="dtr-control" tabindex="0">
                                                                                {{ $request->store->serial_no }}</td>

                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                     {{-- Table For batch Requests --}}

                                                     <div class="row">
                                                        <div class="card table-card">
                                                        <h1> Batch Requests</h1>
                                                        </div>
                                                        <table class="table table-bordered dataTable dtr-inline"
                                                            style="width: 100%;" role="grid"
                                                            aria-describedby="datatables-basic_info">
                                                            <thead>
                                                                <tr role="row">
                                                                    <th class="___class_+?28___" tabindex="0"
                                                                        aria-controls="datatables-basic" rowspan="1"
                                                                        colspan="1" style="width: 283px;"
                                                                        aria-label="Name: activate to sort column ascending">
                                                                        Action
                                                                    </th>
                                                                    <th class="___class_+?29___" tabindex="0"
                                                                        aria-controls="datatables-basic" rowspan="1"
                                                                        colspan="1" style="width: 283px;"
                                                                        aria-label="Name: activate to sort column ascending">
                                                                        Date</th>
                                                                        <th class="___class_+?29___" tabindex="0"
                                                                        aria-controls="datatables-basic" rowspan="1"
                                                                        colspan="1" style="width: 283px;"
                                                                        aria-label="Name: activate to sort column ascending">
                                                                        Batch ID</th>
                                                                    <th class="___class_+?30___" tabindex="0"
                                                                        aria-controls="datatables-basic" rowspan="1"
                                                                        colspan="1" style="width: 441px;"
                                                                        aria-label="Position: activate to sort column ascending"
                                                                        aria-sort="descending">Items</th>
                                                                    {{-- <th class="___class_+?31___" tabindex="0"
                                                                        aria-controls="datatables-basic" rowspan="1"
                                                                        colspan="1" style="width: 441px;"
                                                                        aria-label="Position: activate to sort column ascending"
                                                                        aria-sort="descending">Requestor</th> --}}
                                                                    <th class="___class_+?32___" tabindex="0"
                                                                        aria-controls="datatables-basic" rowspan="1"
                                                                        colspan="1" style="width: 207px;"
                                                                        aria-label="Office: activate to sort column ascending">
                                                                        Return Date</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($batch_store_requests as $batchRequest)
                                                                <tr>
                                                                    <td>
                                                                        <a
                                                                            href="{{ route('store.requests.batch.edit', [$batchRequest->id]) }}"><i
                                                                                class=" fas fa-eye">&nbsp;inspect</i></a>
                                                                    </td>
                                                                    <td class="sorting_1">
                                                                        {{ \Carbon\Carbon::parse($batchRequest->created_at)->format('d-M-Y') }}</td>
                                                                    <td><strong>{{ $batchRequest->batch_id }}</td>
                                                                    <td> <strong> {{ count(json_decode($batchRequest->items)) }}
                                                                            Item(s)<strong>
                                                                    </td>
                                                                    {{-- <td> <strong>{{ $batchRequest->user->name }}</td> --}}
                                                                    <td> <strong>{{ \Carbon\Carbon::parse($batchRequest->return_date)->format('d-M-Y') }}

                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab-3" role="tabpanel">

                                        <div class="card table-card">
                                            <div class="table-responsive">
                                                <div id="datatables-basic_wrapper" class="dataTables_wrapper dt-bootstrap4">

                                                    <div class="row">
                                                        <table class="table table-bordered display nowrap" width="100%">
                                                            <thead>
                                                                <tr>
                                                                    <th></th>
                                                                    <th style="white-space:nowrap;">Date</th>
                                                                    <th style="white-space:nowrap;">Return By</th>
                                                                    <th style="white-space:nowrap;">Borrower</th>
                                                                    <th style="white-space:nowrap;">Item</th>
                                                                    <th style="white-space:nowrap;">Serial No</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($approved_items as $item)
                                                                    <tr>
                                                                        <td><a
                                                                                href="{{ route('store-requests.edit',['id'=> $item->id, 'returned' => "yes"]) }}">Returned??</a></td>
                                                                                <td class="sorting_1">
                                                                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d-M-Y') }}</td>
                                                                        <td>{{ $item->return_date }}</td>
                                                                        <td>{{ $item->user->name??"N/A" }}</td>
                                                                        <td>{{ $item->item }}</td>
                                                                        <td>{{ $item->store->serial_no }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                       {{-- Table For Approved batch Requests --}}

                                                       <div class="row">
                                                        <div class="card table-card">
                                                        <h1> Batch Requests</h1>
                                                        </div>
                                                        <table class="table table-bordered dataTable dtr-inline"
                                                            style="width: 100%;" role="grid"
                                                            aria-describedby="datatables-basic_info">
                                                            <thead>
                                                                <tr role="row">
                                                                    <th class="___class_+?28___" tabindex="0"
                                                                        aria-controls="datatables-basic" rowspan="1"
                                                                        colspan="1" style="width: 283px;"
                                                                        aria-label="Name: activate to sort column ascending">
                                                                        Action
                                                                    </th>
                                                                    <th class="___class_+?29___" tabindex="0"
                                                                        aria-controls="datatables-basic" rowspan="1"
                                                                        colspan="1" style="width: 283px;"
                                                                        aria-label="Name: activate to sort column ascending">
                                                                       Date</th>
                                                                    <th class="___class_+?29___" tabindex="0"
                                                                        aria-controls="datatables-basic" rowspan="1"
                                                                        colspan="1" style="width: 283px;"
                                                                        aria-label="Name: activate to sort column ascending">
                                                                        Batch ID</th>
                                                                    <th class="___class_+?30___" tabindex="0"
                                                                        aria-controls="datatables-basic" rowspan="1"
                                                                        colspan="1" style="width: 441px;"
                                                                        aria-label="Position: activate to sort column ascending"
                                                                        aria-sort="descending">Items</th>
                                                                    <th class="___class_+?31___" tabindex="0"
                                                                        aria-controls="datatables-basic" rowspan="1"
                                                                        colspan="1" style="width: 441px;"
                                                                        aria-label="Position: activate to sort column ascending"
                                                                        aria-sort="descending">Requestor</th>
                                                                    <th class="___class_+?32___" tabindex="0"
                                                                        aria-controls="datatables-basic" rowspan="1"
                                                                        colspan="1" style="width: 207px;"
                                                                        aria-label="Office: activate to sort column ascending">
                                                                        Return Date</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($approved_batch_store_requests as $batchRequest)
                                                                <tr>
                                                                    <td>
                                                                        <a
                                                                            href="{{ route('store.requests.batch.edit', [$batchRequest->id]) }}"><i
                                                                                class=" fas fa-eye">&nbsp;inspect</i></a>
                                                                    </td>
                                                                    <td class="sorting_1">
                                                                        {{ \Carbon\Carbon::parse($batchRequest->created_at)->format('d-M-Y') }}</td>
                                                                    <td>{{ $batchRequest->batch_id }}</td>
                                                                    <td> <strong> {{ count(json_decode($batchRequest->items)) }}
                                                                            Item(s)<strong>
                                                                    </td>
                                                                    <td>{{ $batchRequest->user->name??"N/A" }}</td>
                                                                    <td> {{ \Carbon\Carbon::parse($batchRequest->return_date)->format('d-M-Y') }}

                                                                    </td>
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
                    pageLength: 5
                });
                /* =========================================================================================== */
                /* ============================ BOOTSTRAP 3/4 EVENT ========================================== */
                $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                    $($.fn.dataTable.tables(true)).DataTable().columns.adjust().responsive.recalc();
                });
            });
        </script>
    @endsection
