@extends('dashboard.reports.cots.app')
@section('content')
<div class="">
    <img src="{{ asset('img/logo.png') }}" style="
        padding-left: 100px;
        padding-top: 2px;">
</div>
    <div class="container mt-5">
        <div class="">
            <h2 class="mb-4" style="text-align: center;">News Central Television</h2>
            <p class="mb-4" style="text-align: center;">25, Adeola Odeku, Victoria Island,Lagos State.</p>
            <p class="mb-4" style="text-align: center;">Email:</p>

            <div class="details" style="font-weight: 750;">
                <form>
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">TO:</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="to" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">IN RESPECT OF:</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="in_respect_of" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">DATE:</label>
                        <div class="col-sm-10">
                            <input class="form-control" style="width: 50%;" type="text" value="{{ date('d/m/Y') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">PRODUCT:</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="product" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">ORDER NO:</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" style="width: 50%;" id="order_no" placeholder="">
                        </div>
                    </div>
                </form>

            </div>
        </div>
        @if (null !== request()->query('name'))
        <strong> Showing search results for {{ request()->query('name') }}  from :
            {{ request()->query('start_date') }}, to
            {{ request()->query('end_date') }}</strong><br>&nbsp;&nbsp;<a href="{{route('reports')}}"><span class="btn btn-primary"><h5>Go Back</h5></span></a>
        @else
        <div class="row justify-content-between">
            <div class="col-8 card">
                <div class="card-header">
                    @if (null !== request()->query('name'))
                    <strong> Showing search results for {{ request()->query('name') }}, from :
                        {{ request()->query('start_date') }}, to
                        {{ request()->query('end_date') }} .</strong>
                    @else
                    @endif
                    <h5>Select by Date</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('reports') }}">
                        <div class="row justify-content-center">
                            <div class="mb-3 col-md-4 date">
                                <label for="date">AD Name</label>
                                <input name="name" type="text" class="form-control" required
                                    placeholder="Enter the Ad video name ">
                            </div>
                            <div class="mb-3 col-md-4 date">
                                <label for="date">Start Date</label>
                                <input name="start_date" type="text" class="form-control datepicker" id="datepicker"
                                    placeholder="">
                            </div>
                            <div class="mb-3 col-md-4 date">
                                <label for="date">End Date</label>
                                <input name="end_date" type="text" class="form-control datepicker" id="datepicker"
                                    placeholder="">
                            </div>
                        </div>




                        <div class="row justify-content-between">
                            <div class="mb-3 col-md-6">
                                <a href="{{ route('reports') }}" style="background-color: rgb(53, 54, 55) !important;"
                                    class="btn btn-primary">Cancel</a>
                            </div>
                            <div class="mb-3 col-md-2">
                                <button style="background-color: rgb(37, 38, 38) !important;" type="submit"
                                    class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif

        <br>
        <div class="">

            @if (null !== request()->query('name'))
                <table class="table table-bordered search-results" style="width: 1000px;">
                    <thead>
                        <tr>
                            <th>Playout ID</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Duration</th>
                            <th width=35%>File name</th>
                            <th>Remarks</th>
                            <th width=28%>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $name = request()->query('name');
                            $stump = ' 00:00:00';
                            $start = request()->query('start_date') . $stump;
                            $end = request()->query('end_date') . $stump;

                            $results = DB::select(DB::raw("SELECT * FROM `reports` WHERE file_name LIKE '%$name%' AND remarks NOT LIKE '%Skipped%' AND created_at >= '$start' AND created_at <= '$end';"));
                        @endphp
                        @foreach ($results as $result)
                            <tr>

                                <td>{{ $result->id }} </td>
                                <td>{{ $result->start_time }}</td>
                                <td>{{ $result->end_time }}</td>
                                <td>{{ $result->duration }}</td>
                                <td>{{ $result->file_name }}</td>
                                @if (strpos($result->remarks, 'Paused') !== false)
                                <td>Fully Played</td>
                                @else
                                <td>{{ $result->remarks }}</td>
                                @endif
                                <td>{{ $result->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <table class="table table-bordered yajra-datatable" style="width: 1000px;">
                    <thead>
                        <tr>
                            <th>Playout ID</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Duration</th>
                            <th>File name</th>
                            <th>Remarks</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            @endif

        </div>
    </div>
    {{-- <div class="d-flex justify-content-end" style="float: right;padding-right: 180px; padding-top: 50px;">
        <input type="button" value="Print Report" onclick="window.print();return false;" />
    </div> --}}
    <a class="btn btn-primary" href="{{ URL::to('/report/pdf') }}">Export to PDF</a>
    <br>

    <div class="">
        <div class="d-flex justify-content-between" style="float: left;padding-left: 290px;">
            <div>
                <p>Debit Note No:_________________</p>
                <br>
                <p style="width: 40%;">This is to certify that the above matter/advertisement was Broadcast
                    over the transmitter of News Central TV on the date shown in accordance
                    with the terms of your contract except as noted </p>
            </div>
        </div>



        <br>
        <br>

        <div class="d-flex justify-content-start" style="float: left;padding-left: 180px; padding-top: 50px;">
            <div>
                <h2>___________________</h2>
                <br>
                <p> ACCOUNTANT</p>
            </div>
        </div>



        <div class="d-flex  justify-content-end" style="float: right;padding-right: 180px; padding-top: 50px;">
            <div>
                <h2>___________________</h2>
                <br>
                <p> MARKETING MANAGER</p>
            </div>
        </div>

        <br>
    </div>
    <!-- <div class="d-flex justify-content-end mb-4">
                <a class="btn btn-primary" href="{{ URL::to('/reports/pdf') }}">Export to PDF</a>
                        </div> -->

    <section class="d-flex-row justify-content-center" style="padding-top: 100px;">
        <p style="padding-top: 80px;text-align: center;">&nbsp; FOOTER</p>
    </section>
@endsection
@section('javascript')
    @if (null !== request()->query('name'))
        <script type="text/javascript">
            $(function() {
                $('.search-results').DataTable({
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

            });
        </script>
    @else
        <script type="text/javascript">
            $(function() {

                var table = $('.yajra-datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    "paging": true,
                    "pageLength": 35,
                    info: false,

                    ajax: "{{ route('reports.list') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'start_time',
                            name: 'start_time'
                        },
                        {
                            data: 'end_time',
                            name: 'end_time'
                        },
                        {
                            data: 'duration',
                            name: 'duration'
                        },
                        {
                            data: 'file_name',
                            name: 'file_name'
                        },
                        {
                            data: 'remarks',
                            name: 'remarks'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at',
                            orderable: true,
                            searchable: true
                        },
                    ]

                });

            });
        </script>
    @endif
    <script>
        $('.datepicker').datepicker({
            format: "yyyy-mm-dd",
            // startView: "months",
            // minViewMode: "months"
        });
    </script>
@endsection
