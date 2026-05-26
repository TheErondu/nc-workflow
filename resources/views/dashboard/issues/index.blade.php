@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card table-card">
                    <div class="card-header" style="margin-bottom: 1.0rem;">
                        <span>Issues</span>
                        <div class="d-inline-flex gap-2">
                            <a href="{{ route('issues.create') }}" style="background-color: rgb(0,0,0) !important;"
                                class="btn btn-primary create-button">Report Tech Problem <i class="fas fa-plus"></i></a>
                            <a href="{{ route('issues.export') }}" class="btn btn-success"><i class="fas fa-file-excel"></i> Export to Excel</a>
                        </div>
                    </div>

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
                                    <div class="alert-message"><strong>{{ $error }}</strong></div>
                                @endforeach
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <div class="card-body" style="padding: 0.75rem 1.25rem;">
                        <div class="row align-items-end mb-2">
                            <div class="col-6 col-md-3 col-lg-2">
                                <label for="statusFilter" style="font-size: 0.85rem; margin-bottom: 0.25rem;">Status</label>
                                <select id="statusFilter" class="form-control form-control-sm"
                                    style="background-color: #2c2c2c; color: #fff; border-color: #555;">
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
                                <span class="badge" style="background-color: #c0392b; font-size: 0.8rem;">Open: {{ $openCount }}</span>
                                <span class="badge" style="background-color: #27ae60; font-size: 0.8rem;">Closed: {{ $closedCount }}</span>
                                <span class="badge" style="background-color: #555; font-size: 0.8rem;">Total: {{ $totalCount }}</span>
                            </div>
                        </div>
                    </div>

                    <form id="bulkCloseForm" method="POST" action="{{ route('issues.bulk-close') }}">
                        @csrf
                        <div class="table-responsive">
                            <table id="issues-table" class="table table-bordered datatable" cellspacing="0" width="100%">
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
                                        <th>Fixed By</th>
                                        <th>Action Taken</th>
                                        <th>Cause</th>
                                        <th>Engineer Comment</th>
                                        <th>Resolved</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        #issues-table td,
        #issues-table th {
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
            cursor: pointer;
        }
        .dt-desc-col.expanded {
            white-space: normal;
            max-width: none;
        }
        #issues-table_wrapper .dt-buttons { margin-bottom: 0; }
        #issues-table_wrapper .dt-buttons .btn {
            background-color: #2c2c2c; border-color: #555; color: #fff;
            font-size: 0.8rem; padding: 0.25rem 0.6rem;
        }
        #issues-table_wrapper .dt-buttons .btn:hover { background-color: #444; }
        #issues-table_wrapper .dataTables_filter input {
            background-color: #2c2c2c; border-color: #555; color: #fff; border-radius: 0.25rem;
        }
        #issues-table_wrapper .dataTables_length select {
            background-color: #2c2c2c; border-color: #555; color: #fff;
        }
        .table-responsive { border-radius: 0 0 0.7rem 0.7rem; }
        @media (max-width: 767.98px) { .dt-desc-col { max-width: 120px; } }
    </style>
@endsection
@section('javascript')
<script>
document.addEventListener("DOMContentLoaded", function () {

    var hasCheckbox = {{ auth()->user()->can('fix-issues') ? 'true' : 'false' }};
    var colOffset   = hasCheckbox ? 1 : 0;

    // Build columns array dynamically
    var columns = [];
    if (hasCheckbox) {
        columns.push({ data: 'checkbox', orderable: false, searchable: false, className: 'dt-checkbox-col text-center' });
    }
    columns.push(
        { data: 'edit_link',            orderable: false, searchable: false, className: 'text-center' },
        { data: 'item_name',            title: 'Name' },
        { data: 'description',          title: 'Description',       className: 'dt-desc-col' },
        { data: 'date',                 title: 'Date',               className: 'text-nowrap' },
        { data: 'location',             title: 'Location' },
        { data: 'raised_by',            title: 'Raised By' },
        { data: 'department',           title: 'Department' },
        { data: 'status',               title: 'Status',             className: 'text-center' },
        { data: 'fixed_by',             title: 'Fixed By' },
        { data: 'action_taken',         title: 'Action Taken',       className: 'dt-desc-col' },
        { data: 'cause_of_breakdown',   title: 'Cause',              className: 'dt-desc-col' },
        { data: 'engineers_comment',    title: 'Engineer Comment',   className: 'dt-desc-col' },
        { data: 'resolved_date',        title: 'Resolved',           className: 'text-nowrap' }
    );

    var statusColIndex = 8 + colOffset;

    var columnDefs = [
        { responsivePriority: 1, orderable: false, targets: [0 + colOffset] },                       // edit
        { responsivePriority: 1, targets: [2 + colOffset, statusColIndex] },                          // name, status
        { responsivePriority: 2, targets: [4 + colOffset, 6 + colOffset, 7 + colOffset] },            // date, raised_by, dept
        { responsivePriority: 3, targets: [3 + colOffset, 5 + colOffset] },                           // desc, location
        { responsivePriority: 4, targets: [9 + colOffset, 13 + colOffset] },                          // fixed_by, resolved
        { responsivePriority: 5, targets: [10 + colOffset, 11 + colOffset, 12 + colOffset] },         // action, cause, comment
    ];
    if (hasCheckbox) {
        columnDefs.push({ responsivePriority: 1, orderable: false, targets: 0 });
    }

    var table = $('#issues-table').DataTable({
        processing:  true,
        serverSide:  true,
        stateSave:   true,
        responsive:  true,
        fixedHeader: true,
        pageLength:  25,
        lengthMenu:  [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
        order:       [[4 + colOffset, 'desc']],   // date descending
        ajax: {
            url: '{{ route("issues.datatables") }}',
            data: function (d) {
                d.status_filter = $('#statusFilter').val();
            }
        },
        columns: columns,
        columnDefs: columnDefs,
        dom: '<"row align-items-center"<"col-sm-6 col-md-4"l><"col-sm-6 col-md-4"B><"col-md-4"f>>rtip',
        buttons: [
            { extend: 'copy',  text: 'Copy',  exportOptions: { columns: ':not(.dt-checkbox-col)' } },
            { extend: 'csv',   text: 'CSV',   exportOptions: { columns: ':not(.dt-checkbox-col)' } },
            { extend: 'print', text: 'Print', exportOptions: { columns: ':not(.dt-checkbox-col)' } },
        ],
        language: {
            search: '',
            searchPlaceholder: 'Search issues…',
            lengthMenu: 'Show _MENU_',
            info: 'Showing _START_ to _END_ of _TOTAL_ issues',
            infoEmpty: 'No issues found',
            infoFiltered: '(filtered from _MAX_ total)',
            paginate: { previous: '&laquo;', next: '&raquo;' },
            processing: '<i class="fas fa-spinner fa-spin"></i> Loading…'
        },
        // Restore status dropdown to match saved state
        stateLoadParams: function (settings, data) {
            if (data.statusFilter !== undefined) {
                $('#statusFilter').val(data.statusFilter);
            }
        },
        stateSaveParams: function (settings, data) {
            data.statusFilter = $('#statusFilter').val();
        }
    });

    // Status filter — reload table with new filter value
    $('#statusFilter').on('change', function () {
        table.ajax.reload();
    });

    // ── Multiselect across pages ───────────────────────────────────────────
    // Track selected IDs in a Set so they survive page navigation
    var selectedIds = new Set();

    // Re-apply checkboxes after each draw
    table.on('draw.dt', function () {
        table.rows({ page: 'current' }).nodes().each(function (row) {
            var cb = $(row).find('.issue-checkbox');
            if (cb.length) {
                cb.prop('checked', selectedIds.has(parseInt(cb.data('id'))));
            }
        });
        syncSelectAll();
        updateBulkBtn();
    });

    // Individual checkbox
    $(document).on('change', '.issue-checkbox', function () {
        var id = parseInt($(this).data('id'));
        if (this.checked) { selectedIds.add(id); } else { selectedIds.delete(id); }
        syncSelectAll();
        updateBulkBtn();
    });

    // Select-all (current page only)
    $('#selectAll').on('change', function () {
        var check = this.checked;
        table.rows({ page: 'current' }).nodes().each(function (row) {
            var cb = $(row).find('.issue-checkbox');
            if (!cb.length) return;
            var id = parseInt(cb.data('id'));
            cb.prop('checked', check);
            if (check) { selectedIds.add(id); } else { selectedIds.delete(id); }
        });
        updateBulkBtn();
    });

    function syncSelectAll() {
        var all = $('.issue-checkbox');
        if (!all.length) { $('#selectAll').prop({ checked: false, indeterminate: false }); return; }
        var checkedCount = all.toArray().filter(function (cb) { return selectedIds.has(parseInt($(cb).data('id'))); }).length;
        $('#selectAll').prop('checked',       checkedCount === all.length);
        $('#selectAll').prop('indeterminate', checkedCount > 0 && checkedCount < all.length);
    }

    function updateBulkBtn() {
        $('#selectedCount').text(selectedIds.size);
        $('#bulkCloseBtn').prop('disabled', selectedIds.size === 0);
    }

    // Populate hidden inputs from Set before submit
    $('#bulkCloseBtn').on('click', function () {
        if (selectedIds.size === 0) return;
        if (!confirm('Close ' + selectedIds.size + ' issue(s)?')) return;
        $('#bulkCloseForm').find('input[name="issue_ids[]"]').remove();
        selectedIds.forEach(function (id) {
            $('<input>').attr({ type: 'hidden', name: 'issue_ids[]', value: id }).appendTo('#bulkCloseForm');
        });
        $('#bulkCloseForm')[0].submit();
    });

    // Expand/collapse description cells on click
    $(document).on('click', '.dt-desc-col', function () {
        $(this).toggleClass('expanded');
    });
});
</script>
@endsection
