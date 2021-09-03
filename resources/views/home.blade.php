@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card" style="background-image: url(img/login-bg.jpg);background-size: contain;background-color: #000000c9;background-blend-mode: overlay;">
                    <div class="card-header">
                        <h5 style="color:white;" class="card-title mb-0">Brave is a production system which gives control over inventory, use of assets while
                            optimizing the whole team for maximum output.</h5>
                    </div>
                    <div class="lottie-full">
                        <lottie-player src="{{ url('/animation') }}" background="transparent" speed="0.7"
                            style="width: 100%; height: 400px;" loop autoplay></lottie-player>
                        <div class="intro-text">
                            <h5>Release 3.0</h5>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('javascript')
    <script src="{{ asset('js/lottie-player.js') }}"></script>

@endsection
