@extends('layouts.app', ['activePage' => 'schedule', 'titlePage' => __('Dashboard')])
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
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="row">
                        <div class="card-body">
                            <div class="col-12">
                                <div class="tab">
                                    <ul class="nav nav-tabs justify-content-around" id="myTabs" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" href="#tab-1"
                                                data-bs-toggle="tab" role="tab">Pre-Production Scheduler</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#tab-2"
                                                data-bs-toggle="tab" role="tab">Video Editors Features scheduler</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#tab-3"
                                                data-bs-toggle="tab" role="tab">Graphics Editors scheduler</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#tab-4"
                                                data-bs-toggle="tab" role="tab">Digial Editors scheduler</a></li>

                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab-1" role="tabpanel">
                                            <div class="card-body">
                                                <div id="fullcalendar"></div>
                                                <a href="{{ route('schedule.create',['type' => 'preproduction']) }}" class="btn btn-primary">Create <i
                                                        class="fa fa-plus"></i></a>


                                            </div>

                                        </div>
                                        <div class="tab-pane" id="tab-2" role="tabpanel">

                                            <div class="card-body">
                                                <div id="fullcalendar1"></div>
                                                <a href="{{ route('schedule.create',['type' => 'editors']) }}" class="btn btn-primary">Create <i
                                                        class="fa fa-plus"></i></a>

                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab-3" role="tabpanel">

                                            <div class="card-body">
                                                <div id="fullcalendar2"></div>
                                                <a href="{{ route('schedule.create',['type' => 'graphics']) }}" class="btn btn-primary">Create <i
                                                        class="fa fa-plus"></i></a>

                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab-4" role="tabpanel">

                                            <div class="card-body">
                                                <div id="fullcalendar3"></div>
                                                <a href="{{ route('schedule.create',['type' => 'digital']) }}" class="btn btn-primary">Create <i
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
                            url: '/api/schedule/preproduction',
                            method: 'GET',
                            id: 'id',
                            title: 'name',
                            start: 'start_time',
                            end: 'endtime',
                            extendedProps: {
                            description: 'description'
                                            },
                            backgroundColor: 'color'
                        }

                        // any other sources...

                    ],
                    eventClick: function(info) {
                        window.location = "/schedule/" + info.event.id + "/edit";

                        // change the border color just for fun
                        info.el.style.borderColor = 'red';
                    },
                    eventMouseEnter: function(info) {
                        console.log('eventMouseEnter');
            var tis=info.el;
            var tooltip = '<div class="tooltipevent" style="top:'+($(tis).offset().top-5)+'px;left:'+($(tis).offset().left+($(tis).width())/2)+'px"><div>' + info.event.title + '</div><div>' + info.event.extendedProps.description + '</div></div>';
            var $tooltip = $(tooltip).appendTo('body');
        },
        eventMouseLeave: function(info) {
            console.log('eventMouseLeave');
            $(info.el).css('z-index', 8);
            $('.tooltipevent').remove();
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
                            url: '/api/schedule/editors',
                            method: 'GET',
                            id: 'id',
                            title: 'name',
                            start: 'start_time',
                            end: 'endtime',
                            backgroundColor: 'color'
                        }

                        // any other sources...

                    ],
                    eventClick: function(info) {
                        window.location = "/schedule/" + info.event.id + "/edit";

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
                            url: '/api/schedule/graphics',
                            method: 'GET',
                            id: 'id',
                            title: 'name',
                            start: 'start_time',
                            end: 'endtime',
                            backgroundColor: 'color'
                        }

                        // any other sources...

                    ],
                    eventClick: function(info) {
                        window.location = "/schedule/" + info.event.id + "/edit";

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

                var DigitalCal = document.getElementById('fullcalendar3')
                var calendar = new FullCalendar.Calendar(DigitalCal, {
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
                            url: '/api/schedule/digital',
                            method: 'GET',
                            id: 'id',
                            title: 'name',
                            start: 'start_time',
                            end: 'endtime',
                            backgroundColor: 'color'
                        }

                        // any other sources...

                    ],
                    eventClick: function(info) {
                        window.location = "/schedule/" + info.event.id + "/edit";

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
