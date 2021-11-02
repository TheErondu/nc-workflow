@extends('dashboard.reports.cots.app')
@section('content')
    <div class="container mt-5 print">
        <img src="{{ asset('img/logo.png') }}" style="
        padding-left: 100px;
        padding-top: 70px;">
        <h2 class="mb-4" style="text-align: center;">Certificate of Broadcast</h2>
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
        <br>

        <table class="table table-bordered yajra-datatable" style="width: 1000px;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Duration</th>
                    <th>File name</th>
                    <th>Remarks</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tbody>
        </table>

    </div>
    <div class="d-flex justify-content-end" style="float: right;padding-right: 180px; padding-top: 50px;">
        <input type="button" value="Print Report" onclick="window.print();return false;" />
    </div>
    <br>
    <div class="print">
        <div class="d-flex justify-content-start" style="float: left;padding-left: 290px;">
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



        <div class="d-flex print justify-content-end" style="float: right;padding-right: 180px; padding-top: 50px;">
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
        </footer>
        <p style="padding-top: 80px;text-align: center;">&nbsp;</p>
    </section>
@endsection
@section('javascript')
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
@endsection
