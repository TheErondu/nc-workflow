@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-opaque">
                    <div class="card-header" style="background-color: #272727;">
                        <h5 class="card-title" style="color: white;">Edit Audio Log</h5>
                    </div>
                    <div class="row">
                        @if (Session::has('message'))
                            <div class="container">
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <div class="alert-icon"><i class="far fa-fw fa-bell"></i></div>
                                    <div class="alert-message"><strong>{{ session('message') }}</strong></div>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="container">
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    @foreach ($errors->all() as $error)
                                        <div class="alert-icon"><i class="far fa-fw fa-bell"></i></div>
                                        <div class="alert-message"><strong>{{ $error }}</strong></div>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('audio-logs.update', $audio_log->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row justify-content-between">
                                <x-user-select name="sto" label="STO" :users="$users" :selected="$audio_log->sto" col-class="col-md-6" placeholder="select STO" />
                                <div class="mb-3 col-md-4">
                                    <label for="log_date">Log Date</label>
                                    <input name="log_date" type="date" class="form-control" id="log_date" value="{{ $audio_log->start ? \Carbon\Carbon::parse($audio_log->start)->format('Y-m-d') : '' }}">
                                    <small class="text-muted">Date this log is for</small>
                                </div>
                            </div>
                            <div class="row justify-content-around">
                                <div class="mb-3 col-md-4">
                                    <label for="timing">Timings</label>
                                    <input name="timing" type="text" class="form-control" id="timing" value="{{ $audio_log->timing }}" required placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="programmes">Programmes</label>
                                    <input name="programmes" type="text" class="form-control" id="programmes" value="{{ $audio_log->programmes }}" required placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="traffic">Traffic</label>
                                    <input name="traffic" type="text" class="form-control" id="traffic" value="{{ $audio_log->traffic }}" required placeholder="">
                                </div>
                            </div>
                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-4">
                                    <label for="squeezbacks">Squeeze Backs</label>
                                    <input name="squeezbacks" type="text" class="form-control" id="squeezbacks" value="{{ $audio_log->squeezbacks }}" required placeholder="">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="tc">TC</label>
                                    <input name="tc" type="text" class="form-control" id="tc" value="{{ $audio_log->tc }}" required placeholder="">
                                </div>
                                <x-user-select name="handed_over_to" label="Handed Over To" :users="$users" :selected="$audio_log->handed_over_to" placeholder="select Hand over" />
                            </div>
                            <div class="row justify-content-between">
                                <div class="mb-3 col-12">
                                    <label for="remarks">Remarks</label>
                                    <textarea name="remarks" class="form-control" id="remarks" required placeholder="">{{ $audio_log->remarks }}</textarea>
                                </div>
                            </div>
                            <div class="row justify-content-around">
                                <div class="mb-3 col-md-3">
                                    <span>Uploaded by: <br> {{ $audio_log->user->name ?? 'N/A' }}</span>
                                </div>
                                <div class="mb-3 col-md-3">
                                    <span>Uploaded at: <br> {{ $audio_log->created_at }}</span>
                                </div>
                            </div>
                            <div class="row justify-content-between">
                                <div class="mb-3 col-md-4">
                                    <a href="{{ route('audio-logs.index') }}" style="background-color: rgb(53, 54, 55) !important;" class="btn btn-primary">Cancel</a>
                                </div>
                                @can('delete-reports')
                                <div class="mb-3 col-md-4">
                                    <button form="delete-form" type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </div>
                                @endcan
                                <div class="mb-3 col-md-4">
                                    <button style="background-color: rgb(37, 38, 38) !important;" type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                        <form action="{{ route('audio-logs.destroy', $audio_log->id) }}" id="delete-form" method="POST">
                            @method('DELETE')
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        $(".select2").each(function() {
            $(this).wrap("<div class=\"position-relative\"></div>").select2({
                placeholder: "Select value",
                dropdownParent: $(this).parent(),
                tags: $(this).data('tags') || false
            });
        })
    });
</script>
@endsection
