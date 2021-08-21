<div id="datatables-basic_wrapper" class="dataTables_wrapper dt-bootstrap4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <table class="table table-flush dataTable dtr-inline" id="datatable-basic" style="width: 100%;"
                        role="grid" aria-describedby="datatables-basic_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1" style="width: 240px;" aria-label="Position: activate to sort column ascending">{{ trans('ticketit::lang.table-id') }}</th>
                                <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1" style="width: 240px;" aria-label="Position: activate to sort column ascending">{{ trans('ticketit::lang.table-subject') }}</th>
                                <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1" style="width: 240px;" aria-label="Position: activate to sort column ascending">{{ trans('ticketit::lang.table-status') }}</th>
                                <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1" style="width: 240px;" aria-label="Position: activate to sort column ascending">{{ trans('ticketit::lang.table-last-updated') }}</th>
                                <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1" style="width: 240px;" aria-label="Position: activate to sort column ascending">{{ trans('ticketit::lang.table-agent') }}</th>
                                @if ($u->isAgent() || $u->isAdmin())
                                <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1" style="width: 240px;" aria-label="Position: activate to sort column ascending">{{ trans('ticketit::lang.table-priority') }}</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1" style="width: 240px;" aria-label="Position: activate to sort column ascending">{{ trans('ticketit::lang.table-owner') }}</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1" style="width: 240px;" aria-label="Position: activate to sort column ascending">{{ trans('ticketit::lang.table-category') }}</th>
                                @endif
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
