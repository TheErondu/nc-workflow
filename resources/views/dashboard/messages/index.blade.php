@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12">
                            <div class="tab">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" href="#tab-1" data-bs-toggle="tab"
                                            role="tab">MD/CEO Welcome</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab-2" data-bs-toggle="tab"
                                            role="tab">NOTIFICATIONS</a></li>

                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-1" role="tabpanel">
                                        {!! $welcome_message->message !!}
                                    </div>
                                    <div class="tab-pane" id="tab-2" role="tabpanel">

                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <div id="datatables-basic_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                                    <div class="row">
                                                        <table id="datatables-basic"
                                                            class="table table-striped dataTable dtr-inline"
                                                            style="width: 100%;" role="grid"
                                                            aria-describedby="datatables-basic_info">
                                                            <thead>
                                                                <tr role="row">
                                                                    <th class="sorting" tabindex="0"
                                                                        aria-controls="datatables-basic" rowspan="1"
                                                                        colspan="1" style="width: 283px;"
                                                                        aria-label="Name: activate to sort column ascending">
                                                                        Notification Title</th>
                                                                    <th class="sorting sorting_desc" tabindex="0"
                                                                        aria-controls="datatables-basic" rowspan="1"
                                                                        colspan="1" style="width: 441px;"
                                                                        aria-label="Position: activate to sort column ascending"
                                                                        aria-sort="descending">Notification File</th>
                                                                    <th class="sorting sorting_desc" tabindex="0"
                                                                        aria-controls="datatables-basic" rowspan="1"
                                                                        colspan="1" style="width: 441px;"
                                                                        aria-label="Position: activate to sort column ascending"
                                                                        aria-sort="descending">Filename</th>
                                                                    <th class="sorting" tabindex="0"
                                                                        aria-controls="datatables-basic" rowspan="1"
                                                                        colspan="1" style="width: 207px;"
                                                                        aria-label="Office: activate to sort column ascending">
                                                                        Updated at</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($notifications as $message)
                                                                    <tr class="odd">
                                                                        <td class="dtr-control" tabindex="0">
                                                                            {{ $message->title }}</td>
                                                                        <td><a
                                                                                href="{{ route('file.download', $message->id) }}">Click
                                                                                to download file</a></td>
                                                                        <td class="sorting_1">{{ $message->filename }}
                                                                        </td>
                                                                        <td>{{ $message->updated_at }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div>
                                                    <h5
                                                        class="card-header d-flex justify-content-between align-items-baseline flex-wrap">
                                                        <a href="{{ route('messages.create') }}"
                                                            class="btn btn-primary">Cancel <i
                                                                class="fa fa-undo-alt"></i></a>

                                                        <a href="{{ route('messages.create') }}"
                                                            class="btn btn-primary">Create <i class="fa fa-plus"></i></a>
                                                </div>
                                                </h5>
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
                    // Datatables basic
                    $('#datatables-basic').DataTable({
                        responsive: true
                    });
                    // Datatables with Buttons
                    var datatablesButtons = $('#datatables-buttons').DataTable({
                        lengthChange: !1,
                        buttons: ["copy", "print"],
                        responsive: true
                    });
                    datatablesButtons.buttons().container().appendTo("#datatables-buttons_wrapper .col-md-6:eq(0)")
                });
            </script>

        @endsection
