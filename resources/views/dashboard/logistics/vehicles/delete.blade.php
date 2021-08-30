
<form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="post">
    <div class="modal-body">
        @csrf
        @method('DELETE')
        <h5 class="text-center">Are you sure you want to delete  <strong>{{ $vehicle->vehicle_make }}</strong> with plate number:<strong>{{ $vehicle->number_plate }}</strong> ? Click any where on screen to go back</h5>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Yes, Delete Vehicle</button>
    </div>
</form>
<script>
    $('#btn-secondary').trigger('click');
</script>
