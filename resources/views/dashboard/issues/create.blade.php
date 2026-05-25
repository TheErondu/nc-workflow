@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-opaque">
                    <div class="card-header" style="background-color: #272727;">
                        <h5 class="card-title" style="color: white;">Report Tech Problem</h5>
                    </div>

                    @if (Session::has('message'))
                        <div class="container mt-3">
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <div class="alert-icon"><i class="far fa-fw fa-bell"></i></div>
                                <div class="alert-message"><strong>{{ session('message') }}</strong></div>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="container mt-3">
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                @foreach ($errors->all() as $error)
                                    <div class="alert-message"><strong>{{ $error }}</strong></div>
                                @endforeach
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('issues.store') }}">
                            @csrf

                            {{-- Admin: submit on behalf of another user --}}
                            @role('Admin')
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="on_behalf_of_user_id">Raise on behalf of <span class="text-muted">(optional)</span></label>
                                    <select class="form-control select2" name="on_behalf_of_user_id" id="on_behalf_of_user_id" data-placeholder="— Myself —">
                                        <option value="">— Myself —</option>
                                        @foreach($users as $u)
                                            <option value="{{ $u->id }}" {{ old('on_behalf_of_user_id') == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr>
                            @endrole

                            {{-- Equipment + Location + Department --}}
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    <label for="item_name">Equipment / Item <span class="text-danger">*</span></label>
                                    <input name="item_name" type="text" class="form-control" id="item_name"
                                        value="{{ old('item_name') }}" required placeholder="e.g. Camera 3, Graphics PC">
                                </div>
                                <div class="col-md-4">
                                    <label for="location">Location <span class="text-danger">*</span></label>
                                    <input name="location" type="text" class="form-control" id="location"
                                        value="{{ old('location') }}" required placeholder="e.g. Studio A, Control Room">
                                </div>
                                <div class="col-md-3">
                                    <label for="department">Department</label>
                                    <select class="form-control select2" name="department" id="department" data-placeholder="Select Department">
                                        <option value="">Select</option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->name }}" {{ old('department') == $department->name ? 'selected' : '' }}>
                                                {{ $department->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Fault description --}}
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label for="description">Fault Description <span class="text-danger">*</span></label>
                                    <textarea name="description" class="form-control" id="description"
                                        rows="5" required placeholder="Describe the problem, any error messages, and when it started…">{{ old('description') }}</textarea>
                                </div>
                            </div>

                            {{-- Actions --}}
                            <div class="row">
                                <div class="col-auto">
                                    <a href="{{ route('issues.index') }}" style="background-color: rgb(53,54,55) !important;" class="btn btn-primary">
                                        Cancel
                                    </a>
                                </div>
                                <div class="col-auto ms-auto">
                                    <button style="background-color: rgb(37,38,38) !important;" type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        $(".select2").each(function () {
            $(this).wrap("<div class=\"position-relative\"></div>").select2({
                placeholder: "Select value",
                dropdownParent: $(this).parent()
            });
        });
    });
</script>
@endsection
