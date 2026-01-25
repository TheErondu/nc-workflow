<!doctype html>
<html lang="en">

<head>
    <title>Open Tickets</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: #fff;
            min-height: 100vh;
            overflow: hidden;
        }

        .container {
            padding: 2rem 3rem;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
            flex-shrink: 0;
            background: #d71f27;
            margin: -2rem -3rem 2rem -3rem;
            padding: 1.5rem 3rem;
        }

        .header-icon {
            width: 70px;
            height: 70px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1.5rem;
        }

        .header-icon svg {
            width: 40px;
            height: 40px;
            fill: white;
        }

        .header-title {
            color: #fff;
            font-size: 3rem;
            font-weight: 700;
        }

        .ticket-count {
            margin-left: auto;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            padding: 0.8rem 2rem;
            border-radius: 40px;
            font-size: 1.8rem;
            font-weight: 600;
        }

        .marquee-container {
            flex: 1;
            overflow: hidden;
            position: relative;
        }

        .marquee-content {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            animation: scroll-up var(--scroll-duration, 30s) linear infinite;
        }

        .marquee-content:hover {
            animation-play-state: paused;
        }

        @keyframes scroll-up {
            0% {
                transform: translateY(0);
            }
            100% {
                transform: translateY(-50%);
            }
        }

        .ticket-card {
            background: #f8f8f8;
            border-left: 6px solid #d71f27;
            border-radius: 0 12px 12px 0;
            padding: 1.8rem 2.5rem;
            display: flex;
            align-items: center;
            gap: 2rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .ticket-card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
            transform: scale(1.01);
        }

        .ticket-icon {
            width: 60px;
            height: 60px;
            background: #d71f27;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .ticket-icon svg {
            width: 30px;
            height: 30px;
            fill: #fff;
        }

        .ticket-info {
            flex: 1;
            min-width: 0;
        }

        .ticket-equipment {
            color: #1a1a1a;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.4rem;
        }

        .ticket-description {
            color: #333;
            font-size: 1.4rem;
            line-height: 1.4;
            margin-bottom: 0.4rem;
        }

        .ticket-reporter {
            color: #666;
            font-size: 1.2rem;
        }

        .ticket-reporter span {
            color: #d71f27;
            font-weight: 600;
        }

        .ticket-meta {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 0.6rem;
            flex-shrink: 0;
        }

        .ticket-location {
            background: #d71f27;
            color: #fff;
            padding: 0.5rem 1.2rem;
            border-radius: 20px;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .ticket-date {
            color: #888;
            font-size: 1.2rem;
        }

        .no-tickets {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: #888;
        }

        .no-tickets svg {
            width: 120px;
            height: 120px;
            fill: #ccc;
            margin-bottom: 2rem;
        }

        .no-tickets p {
            font-size: 2.5rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="header-icon">
                <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
            </div>
            <h1 class="header-title">Open Tickets</h1>
            <div class="ticket-count">{{ count($tickets) }} {{ Str::plural('Issue', count($tickets)) }}</div>
        </div>

        <div class="marquee-container">
            @if(count($tickets) > 0)
                <div class="marquee-content" id="marquee">
                    @foreach ($tickets as $ticket)
                        <div class="ticket-card">
                            <div class="ticket-icon">
                                <svg viewBox="0 0 24 24"><path d="M22.7 19l-9.1-9.1c.9-2.3.4-5-1.5-6.9-2-2-5-2.4-7.4-1.3L9 6 6 9 1.6 4.7C.4 7.1.9 10.1 2.9 12.1c1.9 1.9 4.6 2.4 6.9 1.5l9.1 9.1c.4.4 1 .4 1.4 0l2.3-2.3c.5-.4.5-1.1.1-1.4z"/></svg>
                            </div>
                            <div class="ticket-info">
                                <div class="ticket-equipment">{{ $ticket->item_name }}</div>
                                <div class="ticket-description">{{ $ticket->description }}</div>
                                <div class="ticket-reporter">Reported by: <span>{{ $ticket->raised_by ?? 'Unknown' }}</span></div>
                            </div>
                            <div class="ticket-meta">
                                <span class="ticket-location">{{ $ticket->location }}</span>
                                <span class="ticket-date">{{ \Carbon\Carbon::parse($ticket->date)->format('d M Y') }}</span>
                            </div>
                        </div>
                    @endforeach

                    {{-- Duplicate for seamless loop (only when scrolling is needed) --}}
                    @if(count($tickets) > 3)
                        @foreach ($tickets as $ticket)
                            <div class="ticket-card">
                                <div class="ticket-icon">
                                    <svg viewBox="0 0 24 24"><path d="M22.7 19l-9.1-9.1c.9-2.3.4-5-1.5-6.9-2-2-5-2.4-7.4-1.3L9 6 6 9 1.6 4.7C.4 7.1.9 10.1 2.9 12.1c1.9 1.9 4.6 2.4 6.9 1.5l9.1 9.1c.4.4 1 .4 1.4 0l2.3-2.3c.5-.4.5-1.1.1-1.4z"/></svg>
                                </div>
                                <div class="ticket-info">
                                    <div class="ticket-equipment">{{ $ticket->item_name }}</div>
                                    <div class="ticket-description">{{ $ticket->description }}</div>
                                    <div class="ticket-reporter">Reported by: <span>{{ $ticket->raised_by ?? 'Unknown' }}</span></div>
                                </div>
                                <div class="ticket-meta">
                                    <span class="ticket-location">{{ $ticket->location }}</span>
                                    <span class="ticket-date">{{ \Carbon\Carbon::parse($ticket->date)->format('d M Y') }}</span>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            @else
                <div class="no-tickets">
                    <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                    <p>No open tickets at this time</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const marquee = document.getElementById('marquee');
            const ticketCount = {{ count($tickets) }};

            if (marquee && ticketCount > 0) {
                // Calculate scroll duration based on number of tickets
                // More tickets = longer duration for smooth scrolling
                const baseDuration = 5; // seconds per ticket
                const duration = Math.max(15, ticketCount * baseDuration);
                marquee.style.setProperty('--scroll-duration', duration + 's');

                // If only a few tickets, slow down or stop animation
                if (ticketCount <= 3) {
                    marquee.style.animation = 'none';
                }
            }
        });
    </script>

    @include('dashboard.signage.main', ['delay' => $screen->view_duration ?? 60000])
</body>

</html>
