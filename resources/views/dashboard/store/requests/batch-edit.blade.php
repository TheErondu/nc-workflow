@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-opaque">
                    <div class="card-header" style="background-color: #272727;">
                        <h5 class="card-title" style="color: white;">Store Manager</h5>

                    </div>
                    <div class="row">

                    </div>
                    <div class="card-body">
                        <div>
                            @csrf
                            <div class="row justify-content-around">
                                <div class="col-12">
                                    <div class="table-card">
                                        <div class="card-header">
                                            <h5 class="card-title">{{ $batch_store_request->user->name }}s'Batch Request
                                                with Batch No:{{ $batch_store_request->batch_id }} and Return
                                                Date:{{ \Carbon\Carbon::parse($batch_store_request->return_date)->format('d-M-Y') }}
                                            </h5>
                                        </div>
                                        @include('dashboard.store.requests.request-rejection-modal', [
                                            'store_request' => $batch_store_request,
                                        ])
                                        {{-- Batch Forms --}}
                                        @include('dashboard.store.requests.batch-forms', [
                                            'batch_store_request' => $batch_store_request,
                                        ])
                                        <table id="tableId" class="table table-sm table-bordered no-wrap">
                                            <input type="hidden" value="{{ $batch_store_request->batch_id }}"
                                                name="batch_id" hidden readonly>
                                            <thead>
                                                <tr>
                                                    <th style="width:50%">Item name</th>
                                                    <th>inventory No</th>
                                                    <th style="width:20%">Assigned Dept.</th>
                                                    <th style="width:10%">Status</th>

                                                </tr>
                                            </thead>

                                            <tbody>
                                                @forelse ($items as $key => $item)
                                                    <tr>

                                                        <td>{{ $item->item_name }}</td>
                                                        <td>{{ $item->serial_no }}</td>
                                                        <td>{{ $item->assigned_department }}</td>
                                                        <td>{{ $batch_store_request->status }}</td>

                                                    </tr>
                                                @empty
                                                    <div style="padding: 1rem" class="justify-content-center">
                                                        <h3 style="color: rgb(217, 172, 11)">All items in
                                                            this batch request are currently in
                                                            use.
                                                        </h3>
                                                    </div>
                                                @endforelse
                                                @can('supervisor')
                                                    @if ($batch_store_request->date_extension_status == 1)
                                                        <div class="justify-content-center">
                                                            <h3 style="color: rgb(89, 187, 240)">
                                                                {{ $batch_store_request->user->name }} wants to
                                                                extend the return date to
                                                                {{ \Carbon\Carbon::parse($batch_store_request->extended_date)->format('d-M-Y') }}.
                                                                <br>
                                                                Extension
                                                                Reason:{{ $batch_store_request->date_extension_reason }}
                                                                <br>
b 
                                                                <button form="batch-extend-form" style="margin: 1rem"
                                                                    class=" btn-primary" type="submit"
                                                                    style="background-color: green !important;" name="button">
                                                                    Approve</button>
                                                    @endif
                                                @endcan
                                                @can('store-admin')
                                                    @if ($batch_store_request->date_extension_status == 2)
                                                        <div class="justify-content-center">
                                                            <h3 style="color: rgb(89, 187, 240)">
                                                                {{ $batch_store_request->user->name }}
                                                                wants to
                                                                extend the return date to
                                                                {{ \Carbon\Carbon::parse($batch_store_request->extended_date)->format('d-M-Y') }}.
                                                                <br>
                                                                Extension
                                                                Reason:{{ $batch_store_request->date_extension_reason }}
                                                                <br>

                                                                <button form="batch-extend-form" style="margin: 1rem"
                                                                    class=" btn-primary" type="submit"
                                                                    style="background-color: green !important;" name="button">
                                                                    Approve</button>
                                                    @endif
                                                @endcan
                                                @can('role-create')
                                                    @if ($batch_store_request->date_extension_status == 3)
                                                        <div class="justify-content-center">
                                                            <h3 style="color: rgb(89, 187, 240)">
                                                                {{ $batch_store_request->user->name }} wants to
                                                                extend the return date to
                                                                {{ \Carbon\Carbon::parse($batch_store_request->extended_date)->format('d-M-Y') }}.
                                                                <br>
                                                                Extension
                                                                Reason:{{ $batch_store_request->date_extension_reason }}
                                                                <br>

                                                                <button form="batch-extend-form" style="margin: 1rem"
                                                                    class=" btn-primary" type="submit"
                                                                    style="background-color: green !important;" name="button">
                                                                    Approve</button>
                                                    @endif
                                                    </h3>
                                        </div>
                                    @endcan
                                    </tbody>

                                    </table>

                                    {{-- Batch action Buttons --}}
                                    @can('request-store-items')
                                        @if ($items->count() > 0 && $batch_store_request->user_id == Auth()->user()->id)
                                            <button form="batch-repeat-form" style="margin: 1rem" class=" btn-primary"
                                                type="submit" style="background-color: orange !important;"
                                                name="button">Repeat Request</button>
                                        @endif
                                        @if ($batch_store_request->status == 'released' && $batch_store_request->user_id == Auth()->user()->id)
                                            <button form="batch-extend-form" style="margin: 1rem" class=" btn-primary"
                                                type="submit" style="background-color: orange !important;"
                                                name="button">Extend Date</button>
                                        @endif
                                    @endcan
                                    @if ($batch_store_request->status == 'pending')
                                        <button id="approve-btn" form="batch-approve-form" class=" btn-primary"
                                            type="submit" style="margin: 1rem; background-color: green !important;"
                                            name="button">Mark
                                            Batch request as approved</button>
                                    @endif
                                    {{-- @canany(['gatepass', 'store-admin']) --}}
                                    {{-- @if ($batch_store_request->status == 'approved')
                                                <button id="check-btn" form="batch-check-form" class=" btn-primary"
                                                    type="submit" style="margin: 1rem; background-color: green !important;"
                                                    name="button">Mark
                                                    Batch request as checked</button>
                                            @endif --}}

                                    @if ($batch_store_request->status == 'approved')
                                        <button id="return-btn" form="batch-return-form" style="margin: 1rem"
                                            class=" btn-primary" type="submit" style="background-color: green !important;"
                                            name="button">Mark
                                            Batch request as returned</button>

                                        <label>Make printed Gatepass Available For Security
                                            <input form="batch-gatepass-form" type="checkbox" name="for_security"
                                                value="1">
                                        </label>

                                        <button id="gatepass-btn" form="batch-gatepass-form" style="margin: 1rem"
                                            class=" btn-primary" type="submit" style="background-color: green !important;"
                                            name="button"><i class="fa fa-print"></i>&nbsp; Print Gatepass
                                        </button>
                                    @endif
                                    {{-- @endcanany --}}
                                    @canany(['role-create', 'supervisor'])
                                        @if ($batch_store_request->status != 'returned')
                                            <button class="btn-primary" href="#" data-bs-toggle="modal"
                                                data-bs-target="#requestRejectionCenteredModalPrimary"
                                                style="background-color: red !important;"><strong>Reject</strong></button>
                                        @endif
                                    @endcanany
                                    <button class="btn-primary" onclick="location.href='{{ url()->previous() }}';"
                                        style="background-color: red !important;"><strong>Go Back</strong></button>

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
            /* = NOTE : don't add "id" in <table> if not necessary, is added than replace each "id" here = */
            $('.table').DataTable({
                "pageLength": 5,
                "pagingType": "numbers"
            });
            /* =========================================================================================== */
            /* ============================ BOOTSTRAP 3/4 EVENT ========================================== */
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust().responsive.recalc();
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // Select2
            $(".select2").each(function() {
                $(this)
                    .wrap("<div class=\"position-relative\"></div>")
                    .select2({
                        placeholder: "Select value",
                        dropdownParent: $(this).parent()
                    });
            })
            // Datetimepicker
            $('#datetimepicker-minimum').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });
            $('#datetimepicker-minimum2').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });
            $('#datetimepicker-view-mode').datetimepicker({
                viewMode: 'years'
            });
            $('#datetimepicker-time').datetimepicker({
                format: 'LT'
            });
            $('#datetimepicker-date').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });
        });
    </script>

    <script>
        $('#all').on('click', function() {
            $(':checkbox').prop("checked", $(this).is(':checked'));
        });
    </script>

    <script>
        $('#repeat-btn').on('click', function() {
            $('.batch-repeat-form').submit();
        });

        $('#approve-btn').on('click', function() {
            $('.batch-approve-form').submit();
        });

        $('#check-btn').on('click', function() {
            $('.batch-check-form').submit();
        });

        $('#release-btn').on('click', function() {
            $('.batch-release-form').submit();
        });

        $('#return-btn').on('click', function() {
            $('.batch-return-form').submit();
        });

        $('#gatepass-btn').on('click', function() {
            $('.batch-gatepass-form').submit();
        });

        $('#repeat-btn').on('click', function() {
            $('.batch-repeat-form').submit();
        });

        $('#extend-btn').on('click', function() {
            $('.batch-extend-form').submit();
        });
    </script>
@endsection
