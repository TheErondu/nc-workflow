@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card-opaque">

                {{-- Header --}}
                <div class="card-header d-flex align-items-center justify-content-between" style="background-color: #272727;">
                    <div>
                        <h5 class="card-title mb-0" style="color: white;">
                            Issue #{{ $issue->id }}
                            @php
                                $statusColor = $issue->status === 'OPEN' ? '#c0392b' : ($issue->status === 'CLOSED' ? '#27ae60' : '#555');
                            @endphp
                            <span class="ms-2 badge" style="background-color:{{ $statusColor }}; font-size:.72rem; vertical-align:middle;">
                                {{ $issue->status }}
                            </span>
                        </h5>
                        <small class="text-muted">Raised by {{ $issue->raised_by }}
                            @if($issue->date) &mdash; {{ $issue->date }} @endif
                        </small>
                    </div>
                    <a href="{{ route('issues.index') }}" class="btn btn-sm btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Back
                    </a>
                </div>

                {{-- Alerts --}}
                @if (Session::has('message'))
                <div class="px-3 pt-3">
                    <div class="alert alert-success alert-dismissible mb-0" role="alert">
                        <div class="alert-message"><strong>{{ session('message') }}</strong></div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endif
                @if ($errors->any())
                <div class="px-3 pt-3">
                    <div class="alert alert-danger alert-dismissible mb-0" role="alert">
                        <div class="alert-message">
                            @foreach ($errors->all() as $error)
                                <div><strong>{{ $error }}</strong></div>
                            @endforeach
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endif

                <div class="card-body">

                    {{-- Assign Engineer (managers only) --}}
                    @can('is-manager')
                    <form action="{{ route('issues.assign', $issue->id) }}" id="assigned_engineer_form" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="row align-items-end mb-3">
                            <div class="col-md-5">
                                <label class="form-label text-muted" style="font-size:.8rem; text-transform:uppercase; letter-spacing:.05em;">Assigned Engineer</label>
                                <select class="form-control select2" name="assigned_engineer" data-placeholder="Choose Engineer...">
                                    <option value="">-- Not Assigned --</option>
                                    @foreach($engineers as $engineer)
                                        <option value="{{ $engineer->name }}" @if($issue->assigned_engineer === $engineer->name) selected @endif>
                                            {{ $engineer->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-user-check me-1"></i> Assign
                                </button>
                            </div>
                        </div>
                    </form>
                    <hr style="border-color:#3a3a3a; margin-bottom:1.5rem;">
                    @endcan

                    {{-- Main form --}}
                    <form method="POST" action="{{ route('issues.update', $issue->id) }}">
                        @csrf
                        @method('PUT')

                        @can('fix-issues')

                        {{-- Passthrough hidden fields --}}
                        <input type="hidden" name="item_name"   value="{{ $issue->item_name }}">
                        <input type="hidden" name="description" value="{{ $issue->description }}">
                        <input type="hidden" name="date"        value="{{ $issue->date }}">
                        <input type="hidden" name="location"    value="{{ $issue->location }}">
                        <input type="hidden" name="raised_by"   value="{{ $issue->raised_by }}">
                        <input type="hidden" name="department"  value="{{ $issue->department }}">

                        {{-- Ticket summary panel --}}
                        <div class="row mb-1 g-3">
                            <div class="col-md-5">
                                <div class="text-muted mb-1" style="font-size:.75rem; text-transform:uppercase; letter-spacing:.05em;">Equipment / Issue</div>
                                <div style="font-size:1.15rem; font-weight:600; color:#fff; line-height:1.3;">{{ $issue->item_name }}</div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-muted mb-1" style="font-size:.75rem; text-transform:uppercase; letter-spacing:.05em;">Location</div>
                                <div style="color:#ccc;">{{ $issue->location ?: '—' }}</div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-muted mb-1" style="font-size:.75rem; text-transform:uppercase; letter-spacing:.05em;">Department</div>
                                <div style="color:#ccc;">{{ $issue->department ?: '—' }}</div>
                            </div>
                        </div>

                        @if($issue->description)
                        <div class="mt-3 mb-1">
                            <div class="text-muted mb-1" style="font-size:.75rem; text-transform:uppercase; letter-spacing:.05em;">Fault Description</div>
                            <div style="color:#bbb; font-size:.95rem; white-space:pre-wrap;">{{ $issue->description }}</div>
                        </div>
                        @endif

                        @if($issue->fixed_by)
                        <div class="mt-2 mb-1">
                            <div class="text-muted mb-1" style="font-size:.75rem; text-transform:uppercase; letter-spacing:.05em;">Fixed By</div>
                            <div style="color:#bbb;">{{ $issue->fixed_by }}</div>
                        </div>
                        @endif

                        <hr style="border-color:#3a3a3a; margin:1.5rem 0 1.25rem;">

                        <p class="mb-3" style="font-size:.75rem; text-transform:uppercase; letter-spacing:.08em; color:#888;">Resolution Details</p>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Cause of Breakdown</label>
                                <textarea name="cause_of_breakdown" class="form-control" rows="3" placeholder="Describe the root cause...">{{ $issue->cause_of_breakdown }}</textarea>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Action Taken</label>
                                <textarea name="action_taken" class="form-control" rows="3" placeholder="Steps taken to resolve...">{{ $issue->action_taken }}</textarea>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Engineer's Comment</label>
                            <textarea name="engineers_comment" class="form-control" rows="3" placeholder="Any additional notes...">{{ $issue->engineers_comment }}</textarea>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Status</label>
                                <select class="form-control select2" name="status" id="status">
                                    @foreach($issue_status as $status)
                                        <option value="{{ $status }}" @if($status === $issue->status) selected @endif>{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        @else

                        {{-- Normal user view --}}
                        <input type="hidden" name="raised_by" value="{{ $issue->raised_by }}">
                        <input type="hidden" name="date"      value="{{ $issue->date }}">

                        <div class="row">
                            <div class="mb-3 col-md-5">
                                <label class="form-label">Equipment / Issue <span class="text-danger">*</span></label>
                                <input name="item_name" type="text" class="form-control"
                                    value="{{ old('item_name', $issue->item_name) }}" required>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Location</label>
                                <input name="location" type="text" class="form-control"
                                    value="{{ old('location', $issue->location) }}">
                            </div>
                            <div class="mb-3 col-md-3">
                                <label class="form-label">Department</label>
                                <select class="form-control select2" name="department" data-placeholder="Select Department">
                                    <option value="">-- Select --</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->name }}"
                                            @if(old('department', $issue->department) === $department->name) selected @endif>
                                            {{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Fault Description</label>
                            <textarea name="description" class="form-control" rows="4"
                                placeholder="Describe the problem in detail...">{{ old('description', $issue->description) }}</textarea>
                        </div>

                        @endcan

                        {{-- Action buttons --}}
                        <hr style="border-color:#3a3a3a; margin-top:1.5rem;">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <a href="{{ route('issues.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                            @can('delete-data')
                            <div class="col-auto">
                                <button form="delete-form" type="submit" class="btn btn-danger"
                                    onclick="return confirm('Delete this issue permanently?')">
                                    <i class="fas fa-trash me-1"></i> Delete
                                </button>
                            </div>
                            @endcan
                            <div class="col-auto ms-auto">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </div>

                    </form>

                    <form action="{{ route('issues.destroy', $issue->id) }}" id="delete-form" method="POST">
                        @method('DELETE')
                        @csrf
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        $(".select2").each(function () {
            $(this).wrap("<div class=\"position-relative\"></div>").select2({
                placeholder: "Select value",
                dropdownParent: $(this).parent()
            });
        });

        // Mark any unread notification for this issue as read on page load
        @auth
        @role('Admin')
        (function () {
            var issueId = {{ $issue->id }};
            var csrfToken = document.querySelector('meta[name="csrf-token"]')
                ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : '';
            fetch('{{ route("notifications.unread") }}', {
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': csrfToken }
            })
            .then(function (r) { return r.json(); })
            .then(function (data) {
                (data.notifications || []).forEach(function (n) {
                    if (n.issue_id && parseInt(n.issue_id) === issueId) {
                        fetch('{{ url("notifications") }}/' + n.id + '/mark-one', {
                            method: 'POST',
                            headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' }
                        });
                    }
                });
            })
            .catch(function () {});
        })();
        @endrole
        @endauth
    });
</script>
@endsection
