<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <style>html, body { background-color: #000; }</style>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{env('APP_NAME')}}</title>

    <style>
        body {
            opacity: 0;
        }
    </style>
     <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicon/apple-icon-57x57.png') }}">
     <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicon/apple-icon-60x60.png') }}">
     <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicon/apple-icon-72x72.png') }}">
     <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/apple-icon-76x76.png') }}">
     <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicon/apple-icon-114x114.png') }}">
     <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicon/apple-icon-120x120.png') }}">
     <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicon/apple-icon-144x144.png') }}">
     <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicon/apple-icon-152x152.png') }}">
     <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-icon-180x180.png') }}">
     <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('favicon/android-icon-192x192.png') }}">
     <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
     <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon/favicon-96x96.png') }}">
     <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
     <meta name="msapplication-TileColor" content="#ffffff">
     <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
     <meta name="theme-color" content="#ffffff">
    <script src="js/settings.js"></script>
</head>

<body class="theme-blue">
    <div class="splash active">
        <div class="splash-icon"></div>
    </div>

    <main class="main h-100 w-100">
        <div class="container h-100 w100" style="background: url(/img/login-bg.png);
        background-size: cover;">
            <div class="row h-100 w-100">
                <div class="col-8 col-lg-6 mx-auto d-table h-100 w-100">
                    <div class="d-table-cell align-middle">
                        <div class="row" style="float: right;">
                        <div class="card" style="background-color: #0c0c0cd6;">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    <div class="text-center">
                                        <img src="/img/nc-logo.jpg" alt="News Central"
                                            class="img-fluid rounded-circle" width="80" height="80" />
                                    </div>
                                    <h5 class="text-center mb-4" style="color:#fff;">{{ __('Reset Password') }}</h5>

                                    <form method="POST" action="{{ route('password.update') }}">
                                        @csrf

                                        <input type="hidden" name="token" value="{{ $token }}">

                                        <div class="mb-3">
                                            <label>{{ __('E-Mail Address') }}</label>
                                            <input
                                                class="form-control form-control-lg @error('email') is-invalid @enderror"
                                                type="email" name="email" value="{{ $email ?? old('email') }}" placeholder="Enter your email" required autofocus />
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label>{{ __('New Password') }}</label>
                                            <input
                                                class="form-control form-control-lg @error('password') is-invalid @enderror"
                                                type="password" name="password" placeholder="Enter new password" required autocomplete="new-password" />
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label>{{ __('Confirm New Password') }}</label>
                                            <input
                                                class="form-control form-control-lg"
                                                type="password" name="password_confirmation" placeholder="Confirm new password" required autocomplete="new-password" />
                                        </div>

                                        <div class="text-center mt-3">
                                            <button type="submit" class="btn btn-lg btn-primary">{{ __('Reset Password') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="js/main.js"></script>
</body>

</html>
