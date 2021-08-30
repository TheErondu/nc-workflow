@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card table-card">
                <div class="card-header" style="margin-bottom: 1.0rem;">
                    <span>Vehicles </span>
                </div>
                <div class="row">
                    @if (Session::has('message'))
                        <div class="container">
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <div class="alert-icon">
                                    <i class="far fa-fw fa-bell"></i>
                                </div>
                                <div class="alert-message">
                                    <strong> {{ session('message') }}</strong>
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
                                        <strong> {{ $error }}</strong>
                                    </div>

                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                @if (count($vehicles) > 0)


                    <table class="table datatable dtr-inline" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Number Plate</th>
                                <th>Vehicle Make</th>
                                <th>Purpose</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Assigned Driver</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehicles as $vehicle)
                            <tr>
                                <td><a href="{{route('vehicles.edit', $vehicle->id)}}"><i class="far fa-edit"></i></a></td>
                                <td>{{ $vehicle->number_plate }}</td>
                                    <td>{{ $vehicle->vehicle_make }}</td>
                                    <td>{{ $vehicle->purpose }}</td>
                                    <td>{{ $vehicle->created_at }}</td>
                                    <td>{{ $vehicle->updated_at }}</td>
                                    <td>{{ $vehicle->assigned_driver }}</td>
                                    <td class="pl-3"> <a data-toggle="modal" id="smallButton" data-target="#smallModal" data-attr="{{ route('delete', $vehicle->id) }}" title="Delete Project">
                                        <i class="fas fa-trash text-danger  fa-lg"></i>
                                    </a></td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
<div class="modal fade" id="smallModal" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="smallBody">
                <div>
                </div>
            </div>
        </div>
    </div>
</div>

                @else
                <div class="card">
                    <div class="card-body card-black">
                      <p>No Vehicles Have Been Added yet, Click  <a href="{{ route('vehicles.create') }}" data-toggle="tooltip" title="" data-original-title="Add Vehicles">Here</a> to add vehicles and Assign them to a Driver<p>
                    <p><a class="btn btn-primary" href="{{ route('vehicles.create') }}">Add Vehicles</a>
                    </p>
                </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>
@endsection
@section('javascript')
<script>
    // display a modal (small modal)
    $(document).on('click', '#smallButton', function(event) {
        event.preventDefault();
        let href = $(this).attr('data-attr');
        $.ajax({
            url: href
            , beforeSend: function() {
                $('#loader').show();
            },
            // return the result
            success: function(result) {
                $('#smallModal').modal("show");
                $('#smallBody').html(result).show();
            }
            , complete: function() {
                $('#modal-body').trigger('click');
            }
            , error: function(jqXHR, testStatus, error) {
                console.log(error);
                alert("Page " + href + " cannot open. Error:" + error);
                $('#loader').remove();
            }
            , timeout: 8000
        })
    });

</script>

@endsection
