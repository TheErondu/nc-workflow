@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        {{-- Header Section --}}
        <div class="row mb-3">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="text-white">
                        <i class="fa fa-birthday-cake me-2"></i>
                        Birthday Calendar
                    </h4>
                    <div>
                        <a href="{{ route('signage.admin') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> Back to Signage
                        </a>
                        <a href="{{ route('signage.birthdays.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Add Birthday
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Session Messages --}}
        @if (Session::has('message'))
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <div class="alert-message">
                            <strong>{{ session('message') }}</strong>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif

        {{-- Birthday Calendar --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #272727;">
                        <h5 class="card-title mb-0" style="color: white;">
                            {{ $birthdays->count() }} {{ Str::plural('Birthday', $birthdays->count()) }} Registered
                        </h5>
                        <a href="{{ route('signage.birthdays.create') }}" class="btn btn-sm btn-success">
                            <i class="fa fa-plus"></i> Add Birthday
                        </a>
                    </div>
                    <div class="card-body">
                        <div id="birthdayCalendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Birthday Preview Modal --}}
    <div class="modal fade" id="birthdayPreviewModal" tabindex="-1" aria-labelledby="birthdayPreviewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #272727;">
                    <h5 class="modal-title text-white" id="birthdayPreviewModalLabel">
                        <i class="fa fa-birthday-cake me-2"></i>
                        <span id="modalCelebrantName"></span>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalBirthdayImage" src="" alt="Birthday Image" class="img-fluid mb-3" style="max-height: 300px; border-radius: 8px;">
                    <p class="mb-2">
                        <strong>Birthday:</strong> <span id="modalBirthdayDate"></span>
                    </p>
                    <p class="mb-0">
                        <strong>Status:</strong> <span id="modalStatus"></span>
                    </p>
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this birthday?');">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="#" id="modalEditLink" class="btn btn-primary">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <style>
        .fc-event {
            cursor: pointer;
        }
        .fc-daygrid-event {
            white-space: normal;
            padding: 2px 4px;
        }
        .birthday-event-content {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .birthday-event-content img {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            object-fit: cover;
        }
        .tooltipevent {
            position: absolute;
            z-index: 10001;
            padding: 10px;
            background: #272727;
            color: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            max-width: 250px;
            text-align: center;
        }
        .tooltipevent img {
            max-width: 100%;
            max-height: 150px;
            border-radius: 4px;
            margin-bottom: 8px;
        }
        .fc .fc-toolbar-title {
            color: white;
        }
        .fc .fc-col-header-cell-cushion {
            color: white;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var calendarEl = document.getElementById('birthdayCalendar');
            if (!calendarEl) return;

            var modal = new bootstrap.Modal(document.getElementById('birthdayPreviewModal'));

            var calendar = new FullCalendar.Calendar(calendarEl, {
                themeSystem: 'bootstrap',
                initialView: 'dayGridMonth',
                height: 'auto',
                aspectRatio: 2,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,listMonth'
                },
                eventSources: [{
                    url: '{{ route("signage.birthdays.calendar") }}',
                    method: 'GET'
                }],
                eventClick: function(info) {
                    var props = info.event.extendedProps;

                    document.getElementById('modalCelebrantName').textContent = props.celebrant_name;
                    document.getElementById('modalBirthdayImage').src = props.image_url;
                    document.getElementById('modalBirthdayDate').textContent = props.original_date;

                    var statusBadge = props.is_active
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-secondary">Inactive</span>';
                    document.getElementById('modalStatus').innerHTML = statusBadge;

                    document.getElementById('modalEditLink').href = '/signage/admin/birthdays/' + props.slide_id + '/edit';
                    document.getElementById('deleteForm').action = '/signage/admin/birthdays/' + props.slide_id;

                    modal.show();
                },
                eventMouseEnter: function(info) {
                    var props = info.event.extendedProps;
                    var el = info.el;
                    var rect = el.getBoundingClientRect();

                    var tooltip = document.createElement('div');
                    tooltip.className = 'tooltipevent';
                    tooltip.innerHTML = '<img src="' + props.image_url + '" alt="' + props.celebrant_name + '">' +
                        '<div><strong>' + props.celebrant_name + '</strong></div>' +
                        '<div>' + props.original_date + '</div>';

                    tooltip.style.top = (rect.top + window.scrollY - 10) + 'px';
                    tooltip.style.left = (rect.left + window.scrollX + rect.width / 2) + 'px';
                    tooltip.style.transform = 'translate(-50%, -100%)';

                    document.body.appendChild(tooltip);
                },
                eventMouseLeave: function(info) {
                    document.querySelectorAll('.tooltipevent').forEach(function(el) {
                        el.remove();
                    });
                },
                eventContent: function(arg) {
                    var props = arg.event.extendedProps;
                    var container = document.createElement('div');
                    container.className = 'birthday-event-content';

                    var img = document.createElement('img');
                    img.src = props.image_url;
                    img.alt = props.celebrant_name;

                    var text = document.createElement('span');
                    text.textContent = arg.event.title;

                    container.appendChild(img);
                    container.appendChild(text);

                    return { domNodes: [container] };
                }
            });

            calendar.render();
        });
    </script>
@endsection
