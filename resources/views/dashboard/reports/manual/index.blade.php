@extends('layouts.app', ['activePage' => 'manual-reports', 'titlePage' => __('Manual Reports')])
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
                            <strong>{{ session('message') }}</strong>
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
                                <strong>{{ $error }}</strong>
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
                    <span>Manual Reports</span>
                    <a href="{{ route('manual-reports.create') }}" style="background-color: rgb(0, 0, 0) !important;"
                       class="btn btn-primary create-button">Add New Report <i class="fas fa-plus"></i></a>
                </div>
                <div class="card-body">
                    <!-- Filter and Legend -->
                    <div class="row mb-3 align-items-center">
                        <div class="col-md-3">
                            <select id="reportTypeFilter" class="form-control">
                                <option value="">All Report Types</option>
                                <option value="director">Director Logs</option>
                                <option value="vision_mixer">Vision Mixer Logs</option>
                                <option value="graphics">Graphics Logs</option>
                                <option value="sto">STO Logs</option>
                                <option value="audio">Audio Logs</option>
                            </select>
                        </div>
                        <div class="col-md-9">
                            <span class="me-3"><span class="badge" style="background-color: #3788d8;">&nbsp;</span> Director</span>
                            <span class="me-3"><span class="badge" style="background-color: #28a745;">&nbsp;</span> Vision Mixer</span>
                            <span class="me-3"><span class="badge" style="background-color: #dc3545;">&nbsp;</span> Graphics</span>
                            <span class="me-3"><span class="badge" style="background-color: #ffc107;">&nbsp;</span> STO</span>
                            <span class="me-3"><span class="badge" style="background-color: #6f42c1;">&nbsp;</span> Audio</span>
                        </div>
                    </div>
                    <div style="overflow-y: auto; height: 30rem;">
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
        var filterSelect = document.getElementById('reportTypeFilter');
        var currentFilter = '';

        var calendar = new FullCalendar.Calendar(calEl, {
            themeSystem: 'bootstrap',
            aspectRatio: 2.2,
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },

            events: function(info, successCallback, failureCallback) {
                var url = '/api/manual-reports-calendar/?start=' + info.startStr + '&end=' + info.endStr;
                if (currentFilter) {
                    url += '&type=' + currentFilter;
                }
                fetch(url)
                    .then(response => response.json())
                    .then(data => successCallback(data))
                    .catch(error => failureCallback(error));
            },
            eventClick: function(info) {
                info.jsEvent.preventDefault();
                window.location.href = "{{ url('manual-reports') }}/" + info.event.id;
            },
            eventDidMount: function(info) {
                var reportType = info.event.extendedProps.report_type || '';
                $(info.el).attr('title', info.event.title + ' - ' + reportType);
                $(info.el).css('cursor', 'pointer');
            },
        });
        calendar.render();

        // Filter change handler
        filterSelect.addEventListener('change', function() {
            currentFilter = this.value;
            calendar.refetchEvents();
        });
    });
</script>
@endsection
