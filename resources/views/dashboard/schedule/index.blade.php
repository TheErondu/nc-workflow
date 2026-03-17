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
                            <div class="col-md-3 mb-3">
                                <label for="location_filter">Filter by Branch</label>
                                <select class="form-control select2" id="location_filter">
                                    <option value="">All Branches</option>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                                    @endforeach
                                </select>
                            </div>
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
            document.addEventListener("DOMContentLoaded", function() {

                var calendarInstances = [];
                var calendarBaseUrls = [
                    '/api/schedule/preproduction',
                    '/api/schedule/editors',
                    '/api/schedule/graphics',
                    '/api/schedule/digital'
                ];

                function makeCalendar(elId, apiUrl) {
                    var el = document.getElementById(elId);
                    var cal = new FullCalendar.Calendar(el, {
                        themeSystem: 'bootstrap',
                        aspectRatio: 2.2,
                        initialView: 'dayGridMonth',
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                        },
                        eventSources: [{ url: apiUrl, method: 'GET' }],
                        eventClick: function(info) {
                            window.location = "/schedule/" + info.event.id + "/edit";
                            info.el.style.borderColor = 'red';
                        },
                        eventMouseEnter: function(info) {
                            var tis = info.el;
                            var tooltip = '<div class="tooltipevent" style="top:' + ($(tis).offset().top - 5) + 'px;left:' + ($(tis).offset().left + ($(tis).width()) / 2) + 'px"><div>' + info.event.title + '</div><div>' + (info.event.extendedProps.description || '') + '</div></div>';
                            $(tooltip).appendTo('body');
                        },
                        eventMouseLeave: function(info) {
                            $(info.el).css('z-index', 8);
                            $('.tooltipevent').remove();
                        },
                    });
                    cal.render();
                    calendarInstances.push(cal);
                    return cal;
                }

                makeCalendar('fullcalendar',  calendarBaseUrls[0]);
                makeCalendar('fullcalendar1', calendarBaseUrls[1]);
                makeCalendar('fullcalendar2', calendarBaseUrls[2]);
                makeCalendar('fullcalendar3', calendarBaseUrls[3]);

                // Init Select2 AFTER calendars so any error doesn't block them
                $("#location_filter")
                    .wrap("<div class='position-relative'></div>")
                    .select2({
                        placeholder: "All Branches",
                        dropdownParent: $("#location_filter").parent()
                    });

                // Select2 fires change on the original <select> — use jQuery .on()
                $("#location_filter").on("change", function() {
                    var locId = $(this).val();
                    calendarInstances.forEach(function(cal, i) {
                        cal.getEventSources().forEach(function(src) { src.remove(); });
                        cal.addEventSource({
                            url: calendarBaseUrls[i],
                            method: 'GET',
                            extraParams: locId ? { location_id: locId } : {}
                        });
                    });
                });

                // Re-render on tab switch
                $(document).on('shown.bs.tab', 'a[data-bs-toggle="tab"]', function(e) {
                    calendarInstances.forEach(function(cal) { cal.render(); });
                });

            });
        </script>

    @endsection
