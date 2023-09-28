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
        <div class="carousel">
            <ul class="slides">
                <input type="radio" name="radio-buttons" id="img-1" checked />
                <li class="slide-container">
                    <div class="slide-image">
                        <img
                            src="https://placehold.co/1920x1080">
                    </div>
                </li>
                <input type="radio" name="radio-buttons" id="img-2" />
                <li class="slide-container">
                    <div class="slide-image">
                        <img
                            src="https://placehold.co/1920x1080">
                    </div>
                </li>
                <input type="radio" name="radio-buttons" id="img-3" />
                <li class="slide-container">
                    <div class="slide-image">
                        <img src="https://placehold.co/1920x1080">
                    </div>
                </li>
            </ul>
            <div class="overlay-table">
                <!-- Your table content goes here -->
                <table>
                    <tr>
                        <th>Show title</th>
                        <th>Start time</th>
                        <th>End time</th>
                    </tr>
                    @foreach ($bookings as $booking )
                    <tr>
                        <td>{{$booking->title}}&nbsp; </td>
                        <td>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$booking->start)}}&nbsp; </td>
                        <td>{{$booking->end}}&nbsp; </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <style>
        .carousel {
            position: relative;
            overflow: hidden;
        }

        ul.slides {
            display: block;
            position: relative;
            height: 100vh;
            width: 100vw;
            margin: 0;
            padding: 0;
            overflow: hidden;
            list-style: none;
        }

        .slides * {
            user-select: none;
            -ms-user-select: none;
            -moz-user-select: none;
            -khtml-user-select: none;
            -webkit-user-select: none;
            -webkit-touch-callout: none;
        }

        ul.slides input {
            display: none;
        }

        .slide-container {
            display: block;
        }

        .slide-image {
            display: block;
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            opacity: 0;
            transition: all 3s ease-in-out;
        }

        .slide-image img {
            width: 100%;
            min-width: 100%;
            height: 100%;
        }

        .carousel-dots {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 20px;
            z-index: 999;
            text-align: center;
        }

        .carousel-dots .carousel-dot {
            display: inline-block;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #fff;
            opacity: 0.5;
            margin: 10px;
        }

        input:checked+.slide-container .slide-image {
            opacity: 1;
            transform: scale(1);
            transition: opacity 1s ease-in-out;
        }

        input#img-1:checked~.carousel-dots label#img-dot-1,
        input#img-2:checked~.carousel-dots label#img-dot-2,
        input#img-3:checked~.carousel-dots label#img-dot-3 {
            opacity: 1;
        }

        .overlay-table {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Adjust the background color and opacity as needed */
            display: flex;
            justify-content: center;
            align-items: start;
            z-index: 1000;
            pointer-events: none;
        }

        .overlay-table table {
            color: #fff;
            font-size: 24px;
        }
    </style>
    <script>
        // Auto-slide functionality
        let currentSlide = 1;

        function autoSlide() {
            const slides = document.querySelectorAll('.slide-container');
            const radios = document.querySelectorAll('input[name="radio-buttons"]');

            radios[currentSlide - 1].checked = true;

            currentSlide++;

            if (currentSlide > slides.length) {
                currentSlide = 1;
            }

            setTimeout(autoSlide, 5000); // Adjust the duration (in milliseconds) between slides
        }

        autoSlide();
    </script>
</body>

</html>
