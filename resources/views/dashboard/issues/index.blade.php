@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card table-card">
                    <div class="card-header" style="margin-bottom: 1.0rem;">
                        <span>Issues</span>
                        <a href="{{ route('issues.create') }}" style="background-color: rgb(0, 0, 0) !important;"
                            class="btn btn-primary create-button">Report Tech Problem <i class="fas fa-plus"></i></a>
                    </div>
                    <div class="row">
                        @if (Session::has('message'))
                            <div class="container">
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <div class="alert-icon"><i class="far fa-fw fa-bell"></i></div>
                                    <div class="alert-message"><strong>{{ session('message') }}</strong></div>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="container">
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    @foreach ($errors->all() as $error)
                                        <div class="alert-icon"><i class="far fa-fw fa-bell"></i></div>
                                        <div class="alert-message"><strong>{{ $error }}</strong></div>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    @if (count($issues) > 0)
                        <div class="card-body" style="padding: 0.75rem 1.25rem;">
                            <div class="row align-items-end mb-2">
                                <div class="col-6 col-md-3 col-lg-2">
                                    <label for="statusFilter" style="font-size: 0.85rem; margin-bottom: 0.25rem;">Status</label>
                                    <select id="statusFilter" class="form-control form-control-sm" style="background-color: #2c2c2c; color: #fff; border-color: #555;">
                                        <option value="">All</option>
                                        <option value="OPEN">Open</option>
                                        <option value="CLOSED">Closed</option>
                                    </select>
                                </div>
                                @can('fix-issues')
                                <div class="col-6 col-md-3 col-lg-2">
                                    <button type="button" id="bulkCloseBtn" class="btn btn-sm btn-danger w-100" disabled>
                                        Close Selected (<span id="selectedCount">0</span>)
                                    </button>
                                </div>
                                @endcan
                                <div class="col-12 col-md-6 col-lg-8 mt-2 mt-md-0 text-md-end">
                                    <span class="badge" style="background-color: #c0392b; font-size: 0.8rem;">Open: {{ $issues->where('status', 'OPEN')->count() }}</span>
                                    <span class="badge" style="background-color: #27ae60; font-size: 0.8rem;">Closed: {{ $issues->where('status', 'CLOSED')->count() }}</span>
                                    <span class="badge" style="background-color: #555; font-size: 0.8rem;">Total: {{ $issues->count() }}</span>
                                </div>
                            </div>
                        </div>

                        <form id="bulkCloseForm" method="POST" action="{{ route('issues.bulk-close') }}">
                            @csrf
                            <div class="table-responsive">
                                <table id="datatables-buttons" class="table table-bordered datatable" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            @can('fix-issues')
                                            <th class="dt-no-sort dt-checkbox-col"><input type="checkbox" id="selectAll"></th>
                                            @endcan
                                            <th></th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Date</th>
                                            <th>Location</th>
                                            <th>Raised By</th>
                                            <th>Department</th>
                                            <th>Status</th>
                                            <th>Fixed by</th>
                                            <th>Action Taken</th>
                                            <th>Cause</th>
                                            <th>Engineer Comment</th>
                                            <th>Resolved</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($issues as $issue)
                                            <tr>
                                                @can('fix-issues')
                                                <td class="dt-checkbox-col">
                                                    @if($issue->status !== 'CLOSED')
                                                        <input type="checkbox" class="issue-checkbox" name="issue_ids[]" value="{{ $issue->id }}">
                                                    @endif
                                                </td>
                                                @endcan
                                                <td class="text-center">
                                                    <a href="{{ route('issues.edit', $issue->id) }}" title="Edit issue"><i class="far fa-edit"></i></a>
                                                </td>
                                                <td>{{ $issue->item_name }}</td>
                                                <td class="dt-desc-col">{{ $issue->description }}</td>
                                                <td class="text-nowrap">{{ $issue->date }}</td>
                                                <td>{{ $issue->location }}</td>
                                                <td>{{ $issue->raised_by }}</td>
                                                <td>{{ $issue->department }}</td>
                                                <td class="text-center">
                                                    @if($issue->status === 'OPEN')
                                                        <span class="badge" style="background-color: #c0392b;">OPEN</span>
                                                    @elseif($issue->status === 'CLOSED')
                                                        <span class="badge" style="background-color: #27ae60;">CLOSED</span>
                                                    @else
                                                        <span class="badge" style="background-color: #555;">{{ $issue->status }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $issue->fixed_by }}</td>
                                                <td class="dt-desc-col">{{ $issue->action_taken }}</td>
                                                <td class="dt-desc-col">{{ $issue->cause_of_breakdown }}</td>
                                                <td class="dt-desc-col">{{ $issue->engineers_comment }}</td>
                                                <td class="text-nowrap">{{ $issue->resolved_date }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    @else
                        <div class="card">
                            <div class="card-body card-black">
                                <p>You have not raised any issues yet. Click
                                    <a href="{{ route('issues.create') }}">here</a> to raise an issue.
                                </p>
                                <p><a class="btn btn-primary" href="{{ route('issues.create') }}">Report Tech Problem</a></p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        #datatables-buttons td,
        #datatables-buttons th {
            vertical-align: middle;
            font-size: 0.85rem;
            padding: 0.5rem 0.65rem;
        }
        .dt-checkbox-col {
            width: 30px;
            text-align: center !important;
        }
        .dt-desc-col {
            max-width: 180px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        #datatables-buttons_wrapper .dt-buttons {
            margin-bottom: 0;
        }
        #datatables-buttons_wrapper .dt-buttons .btn {
            background-color: #2c2c2c;
            border-color: #555;
            color: #fff;
            font-size: 0.8rem;
            padding: 0.25rem 0.6rem;
        }
        #datatables-buttons_wrapper .dt-buttons .btn:hover {
            background-color: #444;
        }
        #datatables-buttons_wrapper .dataTables_filter input {
            background-color: #2c2c2c;
            border-color: #555;
            color: #fff;
            border-radius: 0.25rem;
        }
        #datatables-buttons_wrapper .dataTables_length select {
            background-color: #2c2c2c;
            border-color: #555;
            color: #fff;
        }
        .table-responsive {
            border-radius: 0 0 0.7rem 0.7rem;
        }
        @media (max-width: 767.98px) {
            .dt-desc-col {
                max-width: 120px;
            }
        }
    </style>
@endsection
@section('javascript')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var hasCheckbox = {{ auth()->user()->can('fix-issues') ? 'true' : 'false' }};
            var colOffset = hasCheckbox ? 1 : 0;
            var statusColIndex = 8 + colOffset;

            // Column visibility priorities for responsive collapsing
            var columnDefs = [
                // Never collapse: checkbox, edit, name, status
                { responsivePriority: 1, targets: [0 + colOffset, 2 + colOffset, 8 + colOffset] },
                // High priority: date, raised by, department
                { responsivePriority: 2, targets: [4 + colOffset, 6 + colOffset, 7 + colOffset] },
                // Medium: description, location
                { responsivePriority: 3, targets: [3 + colOffset, 5 + colOffset] },
                // Low: fixed by, resolved date
                { responsivePriority: 4, targets: [9 + colOffset, 13 + colOffset] },
                // Collapse first: action taken, cause, engineer comment
                { responsivePriority: 5, targets: [10 + colOffset, 11 + colOffset, 12 + colOffset] },
                // Edit column: not sortable
                { orderable: false, targets: [0 + colOffset] }
            ];

            if (hasCheckbox) {
                columnDefs.push({ orderable: false, targets: 0, responsivePriority: 1 });
            }

            var datatablesButtons = $("#datatables-buttons").DataTable({
                responsive: true,
                fixedHeader: true,
                pageLength: 25,
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                order: [[ (hasCheckbox ? 1 : 0), "desc" ]],
                dom: '<"row align-items-center"<"col-sm-6 col-md-4"l><"col-sm-6 col-md-4"B><"col-md-4"f>>rtip',
                buttons: [
                    {
                        extend: 'copy',
                        exportOptions: { columns: ':not(.dt-checkbox-col)' }
                    },
                    {
                        extend: 'csv',
                        exportOptions: { columns: ':not(.dt-checkbox-col)' }
                    },
                    {
                        extend: 'print',
                        exportOptions: { columns: ':not(.dt-checkbox-col)' }
                    }
                ],
                columnDefs: columnDefs,
                language: {
                    search: "",
                    searchPlaceholder: "Search issues...",
                    lengthMenu: "Show _MENU_",
                    info: "Showing _START_ to _END_ of _TOTAL_ issues",
                    infoEmpty: "No issues found",
                    infoFiltered: "(filtered from _MAX_ total)",
                    paginate: {
                        previous: "&laquo;",
                        next: "&raquo;"
                    }
                }
            });

            // Status filter
            $('#statusFilter').on('change', function() {
                var val = $(this).val();
                datatablesButtons.column(statusColIndex).search(val ? '^' + val + '$' : '', true, false).draw();
            });

            // Select all - only affects visible filtered rows
            $('#selectAll').on('change', function() {
                var checked = this.checked;
                var rows = datatablesButtons.rows({ search: 'applied' }).nodes();
                $(rows).find('.issue-checkbox').prop('checked', checked);
                updateSelectedCount();
            });

            // Individual checkbox
            $(document).on('change', '.issue-checkbox', function() {
                if (!this.checked) {
                    $('#selectAll').prop('checked', false);
                }
                updateSelectedCount();
            });

            function updateSelectedCount() {
                var count = $('.issue-checkbox:checked').length;
                $('#selectedCount').text(count);
                $('#bulkCloseBtn').prop('disabled', count === 0);
            }

            // Bulk close
            $('#bulkCloseBtn').on('click', function() {
                var count = $('.issue-checkbox:checked').length;
                if (count === 0) return;
                if (confirm('Are you sure you want to close ' + count + ' issue(s)?')) {
                    $('#bulkCloseForm').submit();
                }
            });

            // Expand description on click
            $(document).on('click', '.dt-desc-col', function() {
                $(this).toggleClass('text-wrap');
                if ($(this).hasClass('text-wrap')) {
                    $(this).css({'white-space': 'normal', 'max-width': 'none'});
                } else {
                    $(this).css({'white-space': 'nowrap', 'max-width': '180px'});
                }
            });

            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust().responsive.recalc();
            });
        });
    </script>
@endsection
