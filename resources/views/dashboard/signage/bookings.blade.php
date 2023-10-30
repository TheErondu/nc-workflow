<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    <!-- PICK ONE OF THE STYLES BELOW -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/summernote.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/nunito.css') }}" rel="stylesheet">
    <link href="{{ asset('css/Jost.css') }}" rel="stylesheet">
    <link href="{{ asset('css/Jost.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body>
    <div>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                @foreach ($schedules as $schedule)
                    <div class="carousel-item">
                        <img class="d-block w-100"
                            src="https://images.unsplash.com/photo-1432958576632-8a39f6b97dc7?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ&s=6ecedc1e639d8a4b77aa8e85f4962f03"
                            data-color="lightblue" alt="First Image">
                        <div class="carousel-caption d-md-block">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card-opaque">
                                        <div class="card-header" style="background-color: #272727;">
                                            <h5 class="card-title" style="color: white;">{{ $schedule->title }}</h5>

                                        </div>
                                        <div class="card-body">
                                            <div class="row justify-content-around">
                                                <div class="mb-3 col-md-4">
                                                    <h5 class="highlight-black" for="borrower">Producer :
                                                        {{ $schedule->producer1 }}</h5>
                                                </div>
                                                <div class="mb-3 col-md-4">
                                                    <h5 class="highlight-black" for="borrower">Item :
                                                        {{ $schedule->description }}</h5>
                                                </div>

                                                <div class="mb-3 col-md-4">
                                                    <h5 class="highlight-black" for="borrower">Return Date
                                                        :&nbsp;{{ \Carbon\Carbon::parse($schedule->start)->format('d-M-Y') }}
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <style>
        h5 {
            display: inline-block;
            padding: 10px;
            background: #B9121B;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .full-screen {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
    <script>
        var $item = $('.carousel-item');
        var $wHeight = $(window).height();
        $item.eq(0).addClass('active');
        $item.height($wHeight);
        $item.addClass('full-screen');

        $('.carousel img').each(function() {
            var $src = $(this).attr('src');
            var $color = $(this).attr('data-color');
            $(this).parent().css({
                'background-image': 'url(' + $src + ')',
                'background-color': $color
            });
            $(this).remove();
        });

        $(window).on('resize', function() {
            $wHeight = $(window).height();
            $item.height($wHeight);
        });

        $('.carousel').carousel({
            interval: 6000,
            pause: "false"
        });
    </script>
</body>

</html>
