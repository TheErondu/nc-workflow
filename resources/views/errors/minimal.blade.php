@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 style="color: red" class="card-title mb-0">An Error ocurred -  "@yield('title')", with an Error code : @yield('code')</h5>
                </div>
                <div class="card">
                    <div class="card-body card-black">
                      <h5>Something went Wrong with that request,</h5>
                      <p> A notification has been sent to the Server Administrator and The issue will be sorted out Shortly. Click <a href="{{ url()->previous() }}" data-toggle="tooltip" title="" data-original-title="Add Vehicles">Here</a> to go back to the previous page</p>
                    <p><a class="btn btn-primary" href="{{ url()->previous() }}">Go Back</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('javascript')

@endsection
