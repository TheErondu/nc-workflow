@extends('layouts.app', ['activePage' => 'audio-logs', 'titlePage' => __('Audio Logs')])
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
                        <span>Audio Logs</span>
                        <a href="{{ route('audio-logs.create') }}" style="background-color: rgb(0, 0, 0) !important;"
                            class="btn btn-primary create-button">Add New Log <i class="fas fa-plus"></i></a>
                    </div>
                    <div class="card-body">
                        <div style="overflow-y: auto; height:30rem;">
                            <div id="fullcalendar"></div>
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
        var calEl = document.getElementById('fullcalendar');
        var calendar = new FullCalendar.Calendar(calEl, {
            themeSystem: 'bootstrap',
            aspectRatio: 2.2,
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            eventSources: [{
                url: '/api/audiologs-calendar/',
                method: 'GET',
            }],
            eventClick: function(info) {
                info.jsEvent.preventDefault();
                window.location.href = "{{ url('logs/audio') }}/" + info.event.id + "/edit";
            },
            eventDidMount: function(info) {
                var remarks = info.event.extendedProps.remarks || '';
                $(info.el).attr('title', info.event.title + ' - ' + remarks);
                $(info.el).css('cursor', 'pointer');
            },
        });
        calendar.render();
    });
</script>
@endsection
