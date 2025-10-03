<!doctype html>
<html lang="en">

<head>
    <title>Table 07</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{asset('css/today-table.css')}}">

</head>

<body style="margin: 0rem 2rem">

    <div>
        <h1 class="table-title">Today's bookings</h1>
        <table style="" class="table table-dark">
            <thead style="background-color: #d71f27;">
                <tr>
                    <th>Producer</th>
                    <th>Title</th>
                    <th>Duration</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($schedules as $schedule)
                    <tr class="marquee">
                        <td>{{ $schedule->producer1 }}</td>
                        <td>{{ $schedule->title }}</td>
                        <td style="width:22%">{{ \Carbon\Carbon::parse($schedule->start )->format('h:i a')}} - {{ \Carbon\Carbon::parse($schedule->end )->format('h:i a')}}</td>
                        <td>{{ $schedule->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <script>
            // Function to check if the number of rows exceeds the threshold and add animation accordingly
            function addMarqueeAnimation() {
                const rows = document.querySelectorAll('.marquee');
                console.log(rows.length);
                if (rows.length > 3) {
                    rows.forEach(row => {
                        row.classList.add('marquee-animation');
                    });
                }
            }

            // Call addMarqueeAnimation on window load
            window.onload = addMarqueeAnimation;
        </script>
    </div>
</body>
@include('dashboard.signage.main')

</html>

