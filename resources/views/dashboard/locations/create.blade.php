@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-opaque">
                    <div class="card-header" style="background-color: #272727;">
                        <h5 class="card-title" style="color: white;">Add Branch / Location</h5>
                    </div>
                    <div class="row">
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
                        <form method="POST" action="{{ route('locations.store') }}">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input name="name" type="text" class="form-control" id="name"
                                        value="{{ old('name') }}" required placeholder="e.g. Lagos">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="address">Address</label>
                                    <input name="address" type="text" class="form-control" id="address"
                                        value="{{ old('address') }}" placeholder="e.g. 1 Broad Street, Lagos Island">
                                </div>
                            </div>
                            <div class="row justify-content-between mt-3">
                                <div class="mb-3 col-md-6">
                                    <a href="{{ route('locations.index') }}"
                                        style="background-color: rgb(53, 54, 55) !important;"
                                        class="btn btn-primary">Cancel</a>
                                </div>
                                <div class="mb-3 col-md-1">
                                    <button style="background-color: rgb(37, 38, 38) !important;" type="submit"
                                        class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
