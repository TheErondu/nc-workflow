{{-- id,route,value,name --}}
@can('request-store-items')
    <form action="{{ route('store.requests.batch.repeat', $batch_store_request->id) }}" id="batch-repeat-form" method="POST">
        @method('PUT')
        @csrf
        <input type="hidden" value="{{ $batch_store_request->batch_id }}" name="batch_id" hidden readonly>
    </form>
@endcan
{{-- //////\\\\\\ --}}
@can('supervisor')
    <form action="{{ route('store.requests.batch.approve') }}" id="batch-approve-form" method="POST">
        @method('PUT')
        @csrf
        <input type="hidden" value="{{ $batch_store_request->batch_id }}" name="batch_id" hidden readonly>
    </form>
@endcan
{{-- //////\\\\\\ --}}
@can('store-admin')
    <form action="{{ route('store.requests.batch.check') }}" class="batch-check-form" method="POST">
        @method('PUT')
        @csrf
        <input type="hidden" value="{{ $batch_store_request->batch_id }}" name="batch_id" hidden readonly>
    </form>
@endcan
{{-- //////\\\\\\ --}}
@can('store-request-approval')
    <form action="{{ route('store.requests.batch.release') }}" id="batch-release-form" method="POST">
        @method('PUT')
        @csrf
        <input type="hidden" value="{{ $batch_store_request->batch_id }}" name="batch_id" hidden readonly>
    </form>
@endcan
{{-- //////\\\\\\ --}}
<form action="{{ route('store.requests.batch.return') }}" id="batch-return-form" method="POST">
    @method('PUT')
    @csrf
    <input type="hidden" value="{{ $batch_store_request->batch_id }}" name="batch_id" hidden readonly>
</form>

<form action="{{ route('gatepass.batch.print', $batch_store_request->id) }}" id="batch-gatepass-form" method="POST">
    @csrf
</form>
{{-- //////\\\\\\ --}}
@can('supervisor')
    <form action="{{ route('store.requests.batch.extend', $batch_store_request->id) }}" id="batch-extend-form"
        method="POST">
        @method('PUT')
        <input hidden type="text" name="action" value="approve">
        @csrf
    </form>
@endcan
{{-- //////\\\\\\ --}}
@can('store-admin')
    <form action="{{ route('store.requests.batch.extend', $batch_store_request->id) }}" id="batch-extend-form"
        method="POST">
        @method('PUT')
        <input hidden type="text" name="action" value="check">
        @csrf
    </form>
@endcan
{{-- //////\\\\\\ --}}
@can('store-request-approval')
    <form action="{{ route('store.requests.batch.extend', $batch_store_request->id) }}" id="batch-extend-form"
        method="POST">
        @method('PUT')
        <input hidden type="text" name="action" value="release">
        @csrf
    </form>
@endcan
