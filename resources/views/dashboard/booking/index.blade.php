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
                    @if (request()->query("type") === 'boardroom' )


                    <div class="card-body">
                        <div id="fullcalendar"></div>
                        <a href="{{route('booking.create', ['type'=>'boardroom']) }}" class="btn btn-primary">Book Boardroom <i
                                class="fa fa-plus"></i></a>


                    </div>

                    @elseif (request()->query("type") === 'studio' )


                    <div class="card-body">
                        <div id="fullcalendar1"></div>
                        <a href="{{route('booking.create', ['type'=>'studio']) }}" class="btn btn-primary">Book Studio <i
                                class="fa fa-plus"></i></a>


                    </div>
                    @else
                    <div class="card-body">
                        <div id="fullcalendar2"></div>
                        <a href="{{route('booking.create', ['type'=>'studio']) }}" class="btn btn-primary">Book Studio <i
                                class="fa fa-plus"></i></a>


                    </div>
                    @endif
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
         @if (request()->query("type") === 'boardroom' )
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var ProdCal = document.getElementById('fullcalendar');

                var calendar = new FullCalendar.Calendar(ProdCal, {
                    themeSystem: 'bootstrap',
                    aspectRatio: 2.2,
                    initialView: 'timeGridWeek',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                    },
                    eventSources: [

                        // your event source
                        {
                            url: '/api/booking?filter[type]=boardroom',
                            method: 'GET',
                            id: 'id',
                            title: 'title',
                            start: 'start',
                            end: 'end',
                            backgroundColor: 'green'
                        }

                        // any other sources...

                    ],
                    eventClick: function(info) {
                        window.location = "/booking/" + info.event.id + "/edit";

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

         @elseif (request()->query("type") === 'studio' )

        <script>
            document.addEventListener("DOMContentLoaded", function() {

                var VideoCal = document.getElementById('fullcalendar1');

                var calendar = new FullCalendar.Calendar(VideoCal, {
                    themeSystem: 'bootstrap',
                    aspectRatio: 2.2,
                    initialView: 'timeGridWeek',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                    },
                    eventSources: [

                        // your event source
                        {
                            url: '/api/booking?filter[type]=studio',
                            method: 'GET',
                            id: 'id',
                            title: 'title',
                            start: 'start',
                            end: 'end',
                            backgroundColor: 'blue'
                        }

                        // any other sources...

                    ],
                    eventClick: function(info) {
                        window.location = "/booking/" + info.event.id + "/edit";

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
        @else
        <script>
            document.addEventListener("DOMContentLoaded", function() {

                var VideoCal = document.getElementById('fullcalendar2');

                var calendar = new FullCalendar.Calendar(VideoCal, {
                    themeSystem: 'bootstrap',
                    aspectRatio: 2.2,
                    initialView: 'timeGridWeek',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                    },
                    eventSources: [

                        // your event source
                        {
                            url: '/api/booking?filter[type]=studio',
                            method: 'GET',
                            id: 'id',
                            title: 'title',
                            start: 'start',
                            end: 'end',
                            backgroundColor: 'blue'
                        }

                        // any other sources...

                    ],
                    eventClick: function(info) {
                        window.location = "/booking/" + info.event.id + "/edit";

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
        @endif

    @endsection
