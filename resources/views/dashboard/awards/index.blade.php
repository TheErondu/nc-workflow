@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="container p-5 tab">
                        <ul class="nav nav-tabs justify-content-between">
                            <li class="nav-item">
                                <a data-toggle="tab" class="nav-link active" href="#Show"><span>Show of the week</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a data-toggle="tab" class="nav-link" href="#Awardee"><span>Awardees</span></a>
                            </li>
                            <li class="nav-item">
                                <a data-toggle="tab" class="nav-link" href="#Team"><span>Team Collaboration of the
                                        Month</span></a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active py-3" id="Show" role="tabpanel">
                                <div class="card table-card">
                                    <div class="card-header" style="margin-bottom: 1.0rem;">
                                        <span>Show of the week </span>
                                    </div>
                                    @if (count($awards) > 0)


                                        <table class="table datatable dtr-inline" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Show Title</th>
                                                    <th>Showing Time</th>
                                                    <th>Image</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    @foreach ($awards as $show)

                                                        <td>{{ $show->$show_title }}</td>
                                                        <td>{{ $show->$show_title }}</td>
                                                        <td>{{ $show->$photo }}</td>
                                                    @endforeach
                                                </tr>
                                            </tbody>
                                        </table>
                                    @else
                                        <div class="card-body">
                                            <div class="col-md-6">
                                                <span>No data found</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane fade py-3" id="Awardee" role="tabpanel">
                                <div class="card table-card">
                                    <div class="card-header" style="margin-bottom: 1.0rem;">
                                        <span>Awardees</span>
                                    </div>

                                    @if (count($awards) > 0)


                                        <table class="table datatable dtr-inline" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Show Title</th>
                                                    <th>Showing Time</th>
                                                    <th>Image</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    @foreach ($awards as $show)

                                                        <td>{{ $show->$show_title }}</td>
                                                        <td>{{ $show->$show_title }}</td>
                                                        <td>{{ $show->$photo }}</td>
                                                    @endforeach
                                                </tr>
                                            </tbody>
                                        </table>
                                    @else
                                        <div class="card-body">
                                            <div class="col-md-6">
                                                <span>No data found</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane fade py-3" id="Team" role="tabpanel">
                                <div class="card table-card">
                                    <div class="card-header" style="margin-bottom: 1.0rem;">
                                        <span>Team Collaboration of the Month </span>
                                    </div>

                                    @if (count($awards) > 0)


                                        <table class="table datatable dtr-inline" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Show Title</th>
                                                    <th>Showing Time</th>
                                                    <th>Image</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    @foreach ($awards as $show)

                                                        <td>{{ $show->$show_title }}</td>
                                                        <td>{{ $show->$show_title }}</td>
                                                        <td>{{ $show->$photo }}</td>
                                                    @endforeach
                                                </tr>
                                            </tbody>
                                        </table>
                                    @else
                                        <div class="card-body">
                                            <div class="col-md-6">
                                                <span>No data found</span>
                                            </div>
                                        </div>
                                    @endif
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
                            responsive: true
                        });
                        /* =========================================================================================== */
                        /* ============================ BOOTSTRAP 3/4 EVENT ========================================== */
                        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                            $($.fn.dataTable.tables(true)).DataTable().columns.adjust().responsive.recalc();
                        });
                        /* =========================================================================================== */
                    });
                </script>

            @endsection
