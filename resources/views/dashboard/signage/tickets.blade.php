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
        <h1 class="table-title">Open Tickets</h1>
        <table style="" class="table table-bordered table-dark">
            <thead style="background-color: #d71f27;">
                <tr>
                    <th style="width: 20%">Equipment</th>
                    <th style="width: 20%">Equipment</th>
                    <th style="width: 30%">Date</th>
                    <th style="width: 30%">Fault Description</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tickets as $ticket)
                    <tr class="marquee">
                        <td>{{ $ticket->item_name }}</td>
                        <td>{{ $ticket->location }}</td>
                        <td>{{ $ticket->date }}</td>
                        <td>{{ $ticket->description }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">There are No tickets at this time..</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    {{-- <script>
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
    </script> --}}
    @include('dashboard.signage.main', ['next' => 'today', 'delay'=> 10000])
</body>

</html>
