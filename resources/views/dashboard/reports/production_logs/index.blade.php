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
                <div class="card-opaque">
                    <div class="card-header" style="margin-bottom: 1.0rem;">
                        <span>Director's Report Detail </span>
                        <a href="{{route('production.create')}}" style="background-color: rgb(0, 0, 0) !important;" type="submit"
                        class="btn btn-primary create-button">Add New Log <i class="fas fa-plus"></i></a>&nbsp;&nbsp;<a href="{{route('production.index',['view' => 'table'])}}" style="background-color: rgb(0, 0, 0) !important;" type="submit"
                        class="btn btn-primary">Switch to Table view <i class="fas fa-cog"></i></a>
                    </div>
                    <div class="card-body">
                        <div style="overflow-y: auto; height:30rem; ">
                        <div id="fullcalendar"></div>

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
                            url: '/api/production-calendar/',
                            method: 'GET',
                            id: 'id',
                            title: 'title',
                            start: 'start',
                            end: 'end',
                            extendedProps: {
                            comment: 'comment'
                                            },
                        }

                        // any other sources...

                    ],
                    eventClick: function(info) {
                        window.location = "/logs/production/" + info.event.id + "/edit";

                    },
                    eventMouseEnter: function(info) {
                        console.log('eventMouseEnter');
            var tis=info.el;
            var tooltip = '<div class="tooltipevent" style="top:'+($(tis).offset().top-5)+'px;left:'+($(tis).offset().left+($(tis).width())/2)+'px"><div>' + info.event.title + '</div><div>' + info.event.extendedProps.comment + '</div></div>';
            var $tooltip = $(tooltip).appendTo('body');

//            If you want to move the tooltip on mouse movement then you can uncomment it
//            $(tis).mouseover(function(e) {
//                $(tis).css('z-index', 10000);
//                $tooltip.fadeIn('500');
//                $tooltip.fadeTo('10', 1.9);
//            }).mousemove(function(e) {
//                $tooltip.css('top', e.pageY + 10);
//                $tooltip.css('left', e.pageX + 20);
//            });
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
    @endsection
