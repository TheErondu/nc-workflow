@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #272727;">
                        <h5 class="card-title" style="color: white;">
                            <i class="fa fa-birthday-cake me-2"></i>
                            Add New Birthday
                        </h5>
                    </div>
                    <div class="row">
                        @if (Session::has('message'))
                            <div class="container">
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <div class="alert-message">
                                        <strong>{{ session('message') }}</strong>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="container">
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    @foreach ($errors->all() as $error)
                                        <div class="alert-message">
                                            <strong>{{ $error }}</strong>
                                        </div>
                                    @endforeach
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('signage.birthdays.store') }}">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="celebrant_name">Celebrant Name <span class="text-danger">*</span></label>
                                    <input name="celebrant_name" type="text" class="form-control" id="celebrant_name"
                                        placeholder="Enter celebrant's name" value="{{ old('celebrant_name') }}" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="birthday_date">Birthday Date <span class="text-danger">*</span></label>
                                    <input name="birthday_date" type="date" class="form-control" id="birthday_date"
                                        value="{{ old('birthday_date') }}" required>
                                    <small class="text-muted">Slide will show on this date each year (month/day)</small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="image">Photo <span class="text-danger">*</span></label>
                                    <input name="image" type="file" class="form-control" id="image"
                                        accept="image/jpeg,image/png,image/gif" required>
                                    <small class="text-muted">Max size: 5MB. Allowed formats: JPG, PNG, GIF</small>
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label for="sort_order">Sort Order</label>
                                    <input name="sort_order" type="number" class="form-control" id="sort_order"
                                        placeholder="0" value="{{ old('sort_order', 0) }}" min="0">
                                </div>
                                <div class="mb-3 col-md-3">
                                    <div class="form-check mt-4">
                                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
                                            value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Active
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-6">
                                    <a href="{{ route('signage.birthdays.index') }}"
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
