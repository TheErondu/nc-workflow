<div class="modal fade" id="requestRejectionCenteredModalPrimary" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="row justify-content-center">
                <div class="modal-body m-3">
                    @if ($store_request->batch_id == null)
                    <form id="reject-form" method="POST"
                    action=
                    "{{ route('store.requests.reject', $store_request->id) }}">
                    @else
                    <form id="reject-form" method="POST"
                        action=
                        "{{ route('store.requests.batch.reject', $store_request->id) }}">
                        <input name="batch_id" value="{{$store_request->batch_id}}" hidden readonly/>
                    @endif
                        @method('PUT')
                        @csrf

                        <div class="row justify-content-center">
                            <h4>Rejection comment: </h4>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <textarea required placeholder="Enter details" class="col-12" name="rejection_comment"type="text"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button form="reject-form" type="submit" class="btn btn-primary">Proceed</button>
                </div>
            </div>
        </div>
    </div>
</div>
