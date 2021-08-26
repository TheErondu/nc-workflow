@extends('layouts.app', ['activePage' => 'schedule', 'titlePage' => __('Dashboard')])
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12">
                            <div class="tab">
                                <ul class="nav nav-tabs justify-content-between" id="myTabs" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" href="#tab-1" data-bs-toggle="tab"
                                            role="tab">Pre-Productions Scheduler</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab-2" data-bs-toggle="tab"
                                            role="tab">Video Editors scheduler</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab-3" data-bs-toggle="tab"
                                            role="tab">Graphics Editors scheduler</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab-4" data-bs-toggle="tab"
                                            role="tab">Digial Editors scheduler</a></li>

                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-1" role="tabpanel">
                                        <div class="card-body">
                                            <div id="fullcalendar"></div>
                                            <a href="{{ route('schedule.create') }}" class="btn btn-primary">Create <i
                                                    class="fa fa-plus"></i></a>


                                        </div>

                                    </div>
                                    <div class="tab-pane" id="tab-2" role="tabpanel">

                                        <div class="card-body">
                                            <div id="fullcalendar1"></div>
                                            <a href="{{ route('schedule.create') }}" class="btn btn-primary">Create <i
                                                    class="fa fa-plus"></i></a>

                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab-2" role="tabpanel">

                                        <div class="card-body">
                                            <div id="fullcalendar2"></div>
                                            <a href="{{ route('schedule.create') }}" class="btn btn-primary">Create <i
                                                    class="fa fa-plus"></i></a>

                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab-2" role="tabpanel">

                                        <div class="card-body">
                                            <div id="fullcalendar3"></div>
                                            <a href="{{ route('schedule.create') }}" class="btn btn-primary">Create <i
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
        <script scr="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var calendarEl = document.getElementById('fullcalendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    themeSystem: 'bootstrap',
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    eventSources: [

                        // your event source
                        {
                            url: '/api/calendar-event',
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
          $(element).popover({title: info.event.title, content: info.event.description, trigger: 'hover', placement: 'auto right', delay: {"hide": 300 }});
        },
                });
                    calendar.render();
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var calendarEl = document.getElementById('fullcalendar1');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    themeSystem: 'bootstrap',
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    eventSources: [

                        // your event source
                        {
                            url: '/api/calendar-event',
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
          $(element).popover({title: info.event.title, content: info.event.description, trigger: 'hover', placement: 'auto right', delay: {"hide": 300 }});
        },
                });

                    calendar.render();
            });
        </script>

    @endsection
