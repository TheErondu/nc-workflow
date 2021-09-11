@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div>
                        <div class="col-12">
                            <div class="tab">
                                <ul class="nav nav-tabs justify-content-between" id="myTabs" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" href="#tab-1" data-bs-toggle="tab"
                                            role="tab"><span>Awardees</span></a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab-2" data-bs-toggle="tab"
                                            role="tab"><span>Show of the Month  </span></a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab-3" data-bs-toggle="tab"
                                            role="tab"><span> Team Collaboration of the month</span></a></li>

                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-1" role="tabpanel">
                                        <div class="card table-card">
                                            <div class="card-header">
                                                <span>Awardees</span>
                                            </div>
                                            <div class="table-responsive">
                                                <div id="datatables-basic_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                                    <div class="row">
                                                        <table id="datatables-basic"
                                                            <table class="table table-bordered table dataTable dtr-inline"
                                                            style="width: 100%;" role="grid"
                                                            aria-describedby="datatables-basic_info">
                                                            <thead>
                                                                <tr role="row">
                                                                    <th class="" tabindex="0"
                                                                        aria-controls="datatables-basic" rowspan="1"
                                                                        colspan="1" style="width: 283px;"
                                                                        aria-label="Name: activate to sort column ascending">
                                                                        Action
                                                                    </th>
                                                                    <th class="" tabindex="0"
                                                                        aria-controls="datatables-basic" rowspan="1"
                                                                        colspan="1" style="width: 283px;"
                                                                        aria-label="Name: activate to sort column ascending">
                                                                        Item name</th>
                                                                    <th class="" tabindex="0"
                                                                        aria-controls="datatables-basic" rowspan="1"
                                                                        colspan="1" style="width: 441px;"
                                                                        aria-label="Position: activate to sort column ascending"
                                                                        aria-sort="descending">Created at</th>
                                                                    <th class="" tabindex="0"
                                                                        aria-controls="datatables-basic" rowspan="1"
                                                                        colspan="1" style="width: 441px;"
                                                                        aria-label="Position: activate to sort column ascending"
                                                                        aria-sort="descending">Updated at</th>
                                                                    <th class="" tabindex="0"
                                                                        aria-controls="datatables-basic" rowspan="1"
                                                                        colspan="1" style="width: 207px;"
                                                                        aria-label="Office: activate to sort column ascending">
                                                                        Serial no</th>
                                                                    <th class="" tabindex="0"
                                                                        aria-controls="datatables-basic" rowspan="1"
                                                                        colspan="1" style="width: 207px;"
                                                                        aria-label="Office: activate to sort column ascending">
                                                                        State</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <tr class="odd">
                                                                    <td><a href="#">Edit</a></td>
                                                                    <td class="dtr-control" tabindex="0">IDX V-MOUNT
                                                                        PLATE</td>
                                                                    <td>10-21-2019 10:06:33</td>
                                                                    <td class="sorting_1">10-21-2019 10:06:40 </td>
                                                                    <td>UR-84797</td>
                                                                    <td>New Item</td>

                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab-2" role="tabpanel">
                                        <div class="card table-card">
                                            <div class="card-header">
                                                <span>Show of the Month</span>
                                            </div>
                                            <div class="table-responsive">
                                            <div id="datatables-basic_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                                <div class="row">
                                                    <table id="datatables-basic"
                                                        <table class="table table-bordered table-striped dataTable dtr-inline"
                                                        style="width: 100%;" role="grid"
                                                        aria-describedby="datatables-basic_info">
                                                        <thead>
                                                            <tr role="row">
                                                                <th class="" tabindex="0" aria-controls="datatables-basic"
                                                                    rowspan="1" colspan="1" style="width: 283px;"
                                                                    aria-label="Name: activate to sort column ascending">
                                                                    Action
                                                                </th>
                                                                <th class="" tabindex="0" aria-controls="datatables-basic"
                                                                    rowspan="1" colspan="1" style="width: 283px;"
                                                                    aria-label="Name: activate to sort column ascending">
                                                                    Return by</th>
                                                                <th class="" tabindex="0" aria-controls="datatables-basic"
                                                                    rowspan="1" colspan="1" style="width: 441px;"
                                                                    aria-label="Position: activate to sort column ascending"
                                                                    aria-sort="descending">Borrower</th>
                                                                <th class="" tabindex="0" aria-controls="datatables-basic"
                                                                    rowspan="1" colspan="1" style="width: 441px;"
                                                                    aria-label="Position: activate to sort column ascending"
                                                                    aria-sort="descending">Requested at</th>
                                                                <th class="" tabindex="0" aria-controls="datatables-basic"
                                                                    rowspan="1" colspan="1" style="width: 207px;"
                                                                    aria-label="Office: activate to sort column ascending">
                                                                    Requested Item</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <tr class="odd">
                                                                <td><a href="#">Approve/Reject</a></td>
                                                                <td class="dtr-control" tabindex="0">25-Aug-21</td>
                                                                <td>TOLULOPE</td>
                                                                <td class="sorting_1">08-18-2021 04:59:32</td>
                                                                <td>BEHRINGER HPS3000</td>

                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab-3" role="tabpanel">

                                        <div class="card table-card">
                                            <div class="card-header">
                                                <span>Team Collaboration of the month</span>
                                            </div>
                                            <div class="table-responsive">
                                            <div id="datatables-basic_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                                <div class="row">
                                                    <table id="datatables-basic" data-stripe-classes="[]"
                                                        <table class="table table-bordered table-flushed dataTable dtr-inline"
                                                        style="width: 100%;" role="grid"
                                                        aria-describedby="datatables-basic_info">
                                                        <thead>
                                                            <tr role="row">
                                                                <th class="sorting" tabindex="0"
                                                                    aria-controls="datatables-basic" rowspan="1" colspan="1"
                                                                    style="width: 283px;"
                                                                    aria-label="Name: activate to sort column ascending">
                                                                    Action</th>

                                                                <th class="sorting sorting_desc" tabindex="0"
                                                                    aria-controls="datatables-basic" rowspan="1" colspan="1"
                                                                    style="width: 441px;"
                                                                    aria-label="Position: activate to sort column ascending"
                                                                    aria-sort="descending">Return by</th>
                                                                <th class="sorting sorting_desc" tabindex="0"
                                                                    aria-controls="datatables-basic" rowspan="1" colspan="1"
                                                                    style="width: 441px;"
                                                                    aria-label="Position: activate to sort column ascending"
                                                                    aria-sort="descending">Borrower</th>
                                                                <th class="sorting" tabindex="0"
                                                                    aria-controls="datatables-basic" rowspan="1" colspan="1"
                                                                    style="width: 207px;"
                                                                    aria-label="Office: activate to sort column ascending">
                                                                    Item</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <tr class="odd">
                                                                <td><a href="#">Returned ??</a></td>
                                                                <td class="dtr-control" tabindex="0">11-Mar-21</td>

                                                                <td class="sorting_1">ADELANDE</td>
                                                                <td>Behringer HPM100</td>
                                                            </tr>
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

    @endsection
