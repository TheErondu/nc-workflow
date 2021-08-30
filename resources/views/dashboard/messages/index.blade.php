@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12">
                            <div class="tab">
                                <ul class="nav nav-tabs justify-content-around" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" href="#tab-1" data-bs-toggle="tab"
                                            role="tab">Welcome to Brave</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab-2" data-bs-toggle="tab"
                                            role="tab">Notifications</a></li>

                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-1" role="tabpanel">
                                        {!! $welcome_message->message !!}
                                    </div>
                                    <div class="tab-pane" id="tab-2" role="tabpanel">

                                        <div class="card-body table-card">
                                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group mr-2" role="group" aria-label="First group">
                                                    <button type="button" class="btn btn-secondary"><a
                                                            href="{{ route('messages.create') }}">Add a
                                                            Message</a></button>
                                                </div>

                                            </div>
                                            <div class="table-responsive">
                                                <div id="datatables-basic_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                                    <div class="row">
                                                        <table id="datatables-basic"
                                                            class="table table-flushed dataTable dtr-inline"
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
                                                                            <a
                                                                                href="{{ route('messages.edit', $message->id) }}">
                                                                                {{ $message->title }}</a>
                                                                        </td>
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
