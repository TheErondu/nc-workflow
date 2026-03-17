@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card table-card">
                    <div class="card-header" style="margin-bottom: 1.0rem;">
                        <span>Branches / Locations</span> &nbsp; &nbsp;
                        <a href="{{ route('locations.create') }}" style="background-color: rgb(0, 0, 0) !important;"
                            type="button" class="btn btn-primary">Add New &nbsp;<i class="fas fa-plus"></i></a>
                    </div>
                    <div class="row">
                        @if (Session::has('message'))
                            <div class="container">
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <div class="alert-icon">
                                        <i class="far fa-fw fa-bell"></i>
                                    </div>
                                    <div class="alert-message">
                                        <strong>{{ session('message') }}</strong>
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
                                            <strong>{{ $error }}</strong>
                                        </div>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                    @if (count($locations) > 0)
                        <table class="table table-bordered datatable dtr-inline" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($locations as $location)
                                    <tr>
                                        <td>
                                            <a href="{{ route('locations.edit', $location->id) }}">
                                                <i class="far fa-edit"></i>
                                            </a>
                                        </td>
                                        <td>{{ $location->name }}</td>
                                        <td>{{ $location->address ?? '—' }}</td>
                                        <td>{{ $location->created_at }}</td>
                                        <td>{{ $location->updated_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="card">
                            <div class="card-body card-black">
                                <p>No locations have been added yet.</p>
                                <p><a class="btn btn-primary" href="{{ route('locations.create') }}">Add Location</a></p>
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
        document.addEventListener("DOMContentLoaded", function() {
            $('.table').DataTable({
                responsive: false,
                "sAutoWidth": true,
                "bDestroy": true,
                "sPaginationType": "bootstrap",
                "iDisplayLength": 10,
                "bPaginate": false,
                "bFilter": true,
                "bInfo": false,
            });
        });
    </script>
@endsection
