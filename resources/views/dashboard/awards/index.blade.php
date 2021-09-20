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

                                    @if (count($shows) > 0)


                                        <table class="table table-bordered datatable dtr-inline" cellspacing="0"
                                            width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Show Title</th>
                                                    <th>Showing Time</th>
                                                    <th>Image</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($shows as $show)
                                                    <tr>
                                                        <td>{{ $show->show_title }}</td>
                                                        <td>{{ $show->show_location }}</td>
                                                        <td><img src="uploads/{{ $show->photo }}" height="40px"
                                                                width="60px" /></td>

                                                    </tr>
                                                @endforeach
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


                                    @if (count($awards) > 0)


                                        <table class="table table-bordered datatable dtr-inline" cellspacing="0"
                                            width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Show Title</th>
                                                    <th>Showing Time</th>
                                                    <th>Image</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    @foreach ($awards as $awardee)

                                                        <td>{{ $awardee->name }}</td>
                                                        <td>{{ $awardee->description }}</td>
                                                        <td><img src="uploads/{{ $awardee->picture }}" height="40px"
                                                                width="60px" /></td>
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
                                    

                                    @if (count($teams) > 0)


                                        <table class="table table-bordered datatable dtr-inline" cellspacing="0"
                                            width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Team member 1</th>
                                                    <th>Team Member 2</th>
                                                    <th>Image1</th>
                                                    <th>Image1</th>
                                                    <th>Commendation</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    @foreach ($teams as $team)

                                                        <td>{{ $team->fullname1 }}</td>
                                                        <td>{{ $team->fullname2 }}</td>
                                                        <td><img src="uploads/{{ $team->image1 }}" height="40px"
                                                                width="60px" /></td>
                                                        <td><img src="uploads/{{ $team->image2 }}" height="40px"
                                                                width="60px" /></td>
                                                        <td>{{ $team->commendation }}</td>
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
