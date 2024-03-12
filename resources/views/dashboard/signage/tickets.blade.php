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
        <h1 style="text-align: center; color:#d71f27;font-weight: 700;">Open Tickets</h1>
        <table class="table table-dark">
            <thead style="background-color: #d71f27;">
                <tr>
                    <th>Equipment</th>
                    <th>Date</th>
                    <th>location</th>
                    <th>Fault Description</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tickets as $ticket )
                <tr>
                    <th scope="row">{{ $ticket->item_name }}</th>
                    <td>{{ $ticket->date }}</td>
                    <td>{{ $ticket->location }}</td>
                    <td>{{ $ticket->description }}</td>
                </tr>
                @empty
                <tr>
                    <th scope="row">N/A</th>
                    <th scope="row"></th>
                    <th scope="row"></th>
                    <th scope="row">There are No tickets at this time..</th>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
@include('dashboard.signage.main', ['next' => 'today', 'delay'=> 10000])

</html>
