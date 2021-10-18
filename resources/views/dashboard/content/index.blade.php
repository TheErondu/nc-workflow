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
                                            role="tab">Nigeria</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab-2" data-bs-toggle="tab"
                                            role="tab">Kenya</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab-3" data-bs-toggle="tab"
                                            role="tab">South Africa</a></li>

                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-1" role="tabpanel">
                                        <div class="card-body">
                                            <div id="fullcalendar"></div>
                                            <a href="{{ route('content.create') }}" class="btn btn-primary">Add Project <i
                                                    class="fa fa-plus"></i></a>


                                        </div>

                                    </div>
                                    <div class="tab-pane" id="tab-2" role="tabpanel">

                                        <div class="card-body">
                                            <div id="fullcalendar1"></div>
                                            <a href="{{ route('content.create') }}" class="btn btn-primary">Add Project <i
                                                    class="fa fa-plus"></i></a>

                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab-3" role="tabpanel">

                                        <div class="card-body">
                                            <div id="fullcalendar2"></div>
                                            <a href="{{ route('content.create') }}" class="btn btn-primary">Add Project <i
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
                            url: '/api/content?filter[country]=NG',
                            method: 'GET',
                            id: 'id',
                            title: 'name',
                            start: 'start_time',
                            end: 'endtime',
                            backgroundColor: 'red'
                        }

                        // any other sources...

                    ],
                    eventClick: function(info) {
                        window.location = "/content/" + info.event.id + "/edit";

                        // change the border color just for fun
                        info.el.style.borderColor = 'red';
                    },
                    eventMouseEnter: function(info, element) {
                        $(element).popover({
                            title: info.event.title,
                            content: info.event.description,
                            trigger: 'hover',
                            placement: 'auto right',
                            delay: {
                                "hide": 300
                            }
                        });
                    },
                });
                calendar.render();
            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {

                var VideoCal = document.getElementById('fullcalendar1');

                var calendar = new FullCalendar.Calendar(VideoCal, {
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
                            url: '/api/content?filter[country]=KE',
                            method: 'GET',
                            id: 'id',
                            title: 'name',
                            start: 'start_time',
                            end: 'endtime',
                            backgroundColor: 'black'
                        }

                        // any other sources...

                    ],
                    eventClick: function(info) {
                        window.location = "/content/" + info.event.id + "/edit";

                        // change the border color just for fun
                        info.el.style.borderColor = 'red';
                    },
                    eventMouseEnter: function(info, element) {
                        $(element).popover({
                            title: info.event.title,
                            content: info.event.description,
                            trigger: 'hover',
                            placement: 'auto right',
                            delay: {
                                "hide": 300
                            }
                        });
                    },
                });

                $(document).on('shown.bs.tab', 'a[data-bs-toggle="tab"]', function(e) {
                    calendar.render();
                });
            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {

                var GraphiCal = document.getElementById('fullcalendar2')

                var calendar = new FullCalendar.Calendar(GraphiCal, {
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
                            url: '/api/content?filter[country]=ZA',
                            method: 'GET',
                            id: 'id',
                            title: 'name',
                            start: 'start_time',
                            end: 'endtime',
                            backgroundColor: 'green'
                        }

                        // any other sources...

                    ],
                    eventClick: function(info) {
                        window.location = "/content/" + info.event.id + "/edit";

                        // change the border color just for fun
                        info.el.style.borderColor = 'red';
                    },
                    eventMouseEnter: function(info, element) {
                        $(element).popover({
                            title: info.event.title,
                            content: info.event.description,
                            trigger: 'hover',
                            placement: 'auto right',
                            delay: {
                                "hide": 300
                            }
                        });
                    },
                });
                $(document).on('shown.bs.tab', 'a[data-bs-toggle="tab"]', function(e) {
                    calendar.render();
                });

            });
        </script>

    @endsection
