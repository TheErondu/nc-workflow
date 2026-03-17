@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-opaque">
                    <div class="card-header" style="background-color: #272727;">
                        <h5 class="card-title" style="color: white;">Edit Branch / Location</h5>
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
                    <div class="card-body">
                        <form method="POST" action="{{ route('locations.update', $location->id) }}">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input name="name" type="text" class="form-control" id="name"
                                        value="{{ old('name', $location->name) }}" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="address">Address</label>
                                    <input name="address" type="text" class="form-control" id="address"
                                        value="{{ old('address', $location->address) }}">
                                </div>
                            </div>
                            <div class="row justify-content-around mt-3">
                                <div class="mb-3 col-md-4">
                                    <a href="{{ url()->previous() }}"
                                        style="background-color: rgb(39, 41, 40) !important;"
                                        class="btn btn-primary">Back</a>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <button form="delete-form" style="background-color: red !important;" type="submit"
                                        class="btn btn-primary">Delete</button>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <button style="background-color: rgb(11, 208, 126) !important;" type="submit"
                                        class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                        <form action="{{ route('locations.destroy', $location->id) }}" id="delete-form" method="POST">
                            @method('DELETE')
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
