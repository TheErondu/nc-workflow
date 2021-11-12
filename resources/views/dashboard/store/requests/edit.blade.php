@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-opaque">
                    <div class="card-header" style="background-color: #272727;">
                        <h5 class="card-title" style="color: white;">Store Manager</h5>

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
                    <div class="card-body">
                        @csrf
                        <div class="row justify-content-around">
                            @if( Request::get('returned'))
                            <div class="mb-3 col-md-4">
                                <h5 class="highlight-black" for="borrower">Borrower : {{ $store_request->user->name }}</h5>
                            </div>
                            <div class="mb-3 col-md-4">
                                    <h5 class="highlight-black" for="borrower">Item : {{ $store_request->item }}</h5>
                                </div>

                            <div class="mb-3 col-md-4">
                                <h5 class="highlight-black" for="borrower">Return Date :&nbsp;{{ \Carbon\Carbon::parse($store_request->return_date)->format('d-M-Y') }}</h5>
                            </div>
                        </div>
                        <div class="row justify-content-between">
                            <div class="mb-3 col-md-6">
                                <button form="return-form" style="background-color: green !important;" type="submit"
                                    class="btn btn-primary">Mark as Returned&nbsp;<i class="fas fa-check"></i></button>

                            </div>
                            <div class="mb-3 col-md-6">
                                <a href="{{ url()->previous() }}" style="background-color: red !important;"
                                    class="btn btn-primary">Go Back&nbsp;<i class="fas fa-back"></i></a>

                            </div>
                            <form action="{{ route('store-requests.return', $store_request->id) }}" id="return-form"
                                method="POST">
                                @method('PUT')
                                @csrf

                            </form>

                        </div>

                            @else
                            <div class="mb-3 col-md-4">
                                <h5 class="highlight-black" for="borrower">Borrower : {{ Auth::user()->name }}</h5>
                            </div>
                            <div class="mb-3 col-md-4">
                                    <h5 class="highlight-black" for="borrower">Item : {{ $store_request->item }}</h5>
                                </div>

                            <div class="mb-3 col-md-4">
                                <h5 class="highlight-black" for="borrower">Return Date :&nbsp;{{ \Carbon\Carbon::parse($store_request->return_date)->format('d-M-Y') }}</h5>
                            </div>
                        </div>
                        <div class="row justify-content-between">
                            <div class="mb-3 col-md-6">
                                <button form="approve-form" style="background-color: green !important;" type="submit"
                                    class="btn btn-primary">Approve</button>
                                <button form="reject-form" style="background-color: red !important;" type="submit"
                                    class="btn btn-primary">Reject</button>
                            </div>

                        </div>
                        <form action="{{ route('store-requests.approve', $store_request->id) }}" id="approve-form"
                            method="POST">
                            @method('PUT')
                            @csrf

                        </form>

                        <form action="{{ route('store-requests.reject', $store_request->id) }}" id="reject-form"
                            method="POST">
                            @method('PUT')
                            @csrf

                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('javascript')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // Select2
            $(".select2").each(function() {
                $(this)
                    .wrap("<div class=\"position-relative\"></div>")
                    .select2({
                        placeholder: "Select value",
                        dropdownParent: $(this).parent()
                    });
            })
            // Datetimepicker
            $('#datetimepicker-minimum').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });
            $('#datetimepicker-minimum2').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });
            $('#datetimepicker-view-mode').datetimepicker({
                viewMode: 'years'
            });
            $('#datetimepicker-time').datetimepicker({
                format: 'LT'
            });
            $('#datetimepicker-date').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });
        });
    </script>
@endsection
