@extends('layouts.app', ['activePage' => 'content', 'titlePage' => __('Dashboard')])
@section('content')
    <div class="container-fluid">
        <div class="row">
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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12">
                            <div class="tab">
                                <ul class="nav nav-tabs justify-content-between" id="myTabs" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" href="#tab-1" data-bs-toggle="tab"
                                            role="tab">Maintenance Scheduler</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-1" role="tabpanel">
                                        <div class="card-body">
                                            <div style="overflow-y: auto; height:30rem; ">
                                            <div id="fullcalendar"></div>
                                            </div>
                                            <a href="{{ route('maintenance-schedule.create') }}" class="btn btn-primary">Add  Schedule <i
                                                    class="fa fa-plus"></i></a>
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
    <script src="https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js"></script>
    <script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>


        <script>
            $(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function(e) {
                $calendar.render();
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var ProdCal = document.getElementById('fullcalendar');

                var calendar = new FullCalendar.Calendar(ProdCal, {
                    themeSystem: 'bootstrap',
                    aspectRatio: 2.2,
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                    },

                    eventSources: [

                        // your event source
                        {
                            url: '/api/maintenance-schedule/',
                            method: 'GET',
                            id: 'id',
                            title: 'title',
                            start: 'start',
                            description:'notes',
                            end: 'end',
                            backgroundColor: 'green'
                        }

                        // any other sources...

                    ],
                    eventClick: function(info) {
                        window.location = "/maintenance-schedule/" + info.event.id + "/edit";

                    },
                });
                calendar.render();
            });
        </script>
    @endsection
