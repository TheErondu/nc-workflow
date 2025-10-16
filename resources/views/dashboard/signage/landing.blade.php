<!doctype html>
<html lang="en">

<head>
    <title>QSignage</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{asset('css/today-table.css')}}">

    <style>
        /* Add this CSS for centering and fitting the image to the screen */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        body {
            background-color: #000; /* Optional: Set a background color */
        }

        img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain; /* Ensures the image maintains aspect ratio */
        }
    </style>
</head>

<body>
    <img src="{{ asset('img/landing.jpg') }}" alt="Landing Image">
</body>
@include('dashboard.signage.main', ['delay'=> 5000])
</html>
