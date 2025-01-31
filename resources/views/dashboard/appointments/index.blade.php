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
                        <div id="fullcalendar2"></div>
                        <a href="{{ route('appointments.create') }}" class="btn btn-primary">Book
                            Appointment
                            <i class="fa fa-plus"></i></a>


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

                var VideoCal = document.getElementById('fullcalendar2');

                var calendar = new FullCalendar.Calendar(VideoCal, {
                    themeSystem: 'bootstrap',
                    aspectRatio: 2.2,
                    initialView: 'listMonth',
                    height: 'auto',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                    },
                    eventSources: [

                        // your event source
                        {
                            url: 'api/appointments',
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
                        window.location = "/appointments/" + info.event.id + "/edit";

                        // change the border color just for fun
                        info.el.style.borderColor = 'red';
                    },
                    eventMouseEnter: function(info) {

                        var tis = info.el;
                        var tooltip = '<div class="tooltipevent" style="top:' + ($(tis).offset().top - 5) +
                            'px;left:' + ($(tis).offset().left + ($(tis).width()) / 2) + 'px"><div>' + info
                            .event.title + '</div><div>' + info.event.extendedProps.description +
                            '</div></div>';
                        var $tooltip = $(tooltip).appendTo('body');
                    },
                    eventMouseLeave: function(info) {

                        $(info.el).css('z-index', 8);
                        $('.tooltipevent').remove();
                    },
                });
                calendar.render();
            });
        </script>
    @endsection
