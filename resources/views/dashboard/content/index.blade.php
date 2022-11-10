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
                    <div class=" row justify-content-around">
                        <div class="mb-3 col-md-4">
                            <label for="">Filter by Country:</label>
                            <input class="form-control" list="datalistOptions" id="country" placeholder="Type to search...">
                            <datalist id="datalistOptions">
                                @foreach($countries as $country)
                                <option value="{{ $country->iso }}">{{ $country->name }}</option>
                            @endforeach
                            </datalist>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="col-12">
                            <div class="tab">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-1" role="tabpanel">
                                        <div class="card-body">
                                            <div id="fullcalendar"></div>
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
            document.addEventListener("DOMContentLoaded", function() {
                var countrySelector = document.getElementById('country')
                var country = countrySelector.value??"NG";
                console.log("Default country is " +country);
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
                            url: '/api/content?filter[country]='+ country,
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
            document.addEventListener("change", function() {
                var countrySelector = document.getElementById('country')
                var country = countrySelector.value??"NG";
                console.log("Changed country to " +country);
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
                            url: '/api/content?filter[country]='+ country,
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


    @endsection
