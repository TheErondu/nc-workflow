<!doctype html>
<html lang="en">

<head>
    <title>Table 07</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{asset('css/today-table.css')}}">

</head>

<body>

    <div>
        <h1 style="text-align: center; color:#d71f27;font-weight: 700;">Today's bookings</h1>
        <table class="table table-dark">
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
                    <tr>
                        <th scope="row">{{ $schedule->producer1 }}</th>
                        <td>{{ $schedule->title }}</td>
                        <td>{{ $schedule->start }} - {{ $schedule->end }}</td>
                        <td>{{ $schedule->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
@include('dashboard.signage.main', ['next' => 'showreels', 'delay'=> 10000])

</html>
