<!doctype html>
<html lang="en">

<head>
    <title>Today's Bookings</title>
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

        .booking-count {
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

        .booking-card {
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

        .booking-card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
            transform: scale(1.01);
        }

        .booking-icon {
            width: 60px;
            height: 60px;
            background: #d71f27;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .booking-icon svg {
            width: 30px;
            height: 30px;
            fill: #fff;
        }

        .booking-info {
            flex: 1;
            min-width: 0;
        }

        .booking-title {
            color: #1a1a1a;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.4rem;
        }

        .booking-description {
            color: #333;
            font-size: 1.4rem;
            line-height: 1.4;
            margin-bottom: 0.4rem;
        }

        .booking-producer {
            color: #666;
            font-size: 1.2rem;
        }

        .booking-producer span {
            color: #d71f27;
            font-weight: 600;
        }

        .booking-meta {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 0.6rem;
            flex-shrink: 0;
        }

        .booking-time {
            background: #d71f27;
            color: #fff;
            padding: 0.6rem 1.4rem;
            border-radius: 20px;
            font-size: 1.3rem;
            font-weight: 600;
            white-space: nowrap;
        }

        .no-bookings {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: #888;
        }

        .no-bookings svg {
            width: 120px;
            height: 120px;
            fill: #ccc;
            margin-bottom: 2rem;
        }

        .no-bookings p {
            font-size: 2.5rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="header-icon">
                <svg viewBox="0 0 24 24"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM9 10H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm-8 4H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2z"/></svg>
            </div>
            <h1 class="header-title">Today's Bookings</h1>
            <div class="booking-count">{{ count($schedules) }} {{ Str::plural('Booking', count($schedules)) }}</div>
        </div>

        <div class="marquee-container">
            @if(count($schedules) > 0)
                <div class="marquee-content" id="marquee">
                    @foreach ($schedules as $schedule)
                        <div class="booking-card">
                            <div class="booking-icon">
                                <svg viewBox="0 0 24 24"><path d="M18 4l2 4h-3l-2-4h-2l2 4h-3l-2-4H8l2 4H7L5 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V4h-4z"/></svg>
                            </div>
                            <div class="booking-info">
                                <div class="booking-title">{{ $schedule->title }}</div>
                                @if($schedule->description)
                                    <div class="booking-description">{{ $schedule->description }}</div>
                                @endif
                                <div class="booking-producer">Producer: <span>{{ $schedule->producer1 ?? 'TBA' }}</span></div>
                            </div>
                            <div class="booking-meta">
                                <span class="booking-time">{{ \Carbon\Carbon::parse($schedule->start)->format('h:i A') }} - {{ \Carbon\Carbon::parse($schedule->end)->format('h:i A') }}</span>
                            </div>
                        </div>
                    @endforeach

                    {{-- Duplicate for seamless loop (only when scrolling is needed) --}}
                    @if(count($schedules) > 3)
                        @foreach ($schedules as $schedule)
                            <div class="booking-card">
                                <div class="booking-icon">
                                    <svg viewBox="0 0 24 24"><path d="M18 4l2 4h-3l-2-4h-2l2 4h-3l-2-4H8l2 4H7L5 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V4h-4z"/></svg>
                                </div>
                                <div class="booking-info">
                                    <div class="booking-title">{{ $schedule->title }}</div>
                                    @if($schedule->description)
                                        <div class="booking-description">{{ $schedule->description }}</div>
                                    @endif
                                    <div class="booking-producer">Producer: <span>{{ $schedule->producer1 ?? 'TBA' }}</span></div>
                                </div>
                                <div class="booking-meta">
                                    <span class="booking-time">{{ \Carbon\Carbon::parse($schedule->start)->format('h:i A') }} - {{ \Carbon\Carbon::parse($schedule->end)->format('h:i A') }}</span>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            @else
                <div class="no-bookings">
                    <svg viewBox="0 0 24 24"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM9 10H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2z"/></svg>
                    <p>No bookings scheduled for today</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const marquee = document.getElementById('marquee');
            const bookingCount = {{ count($schedules) }};

            if (marquee && bookingCount > 0) {
                // Calculate scroll duration based on number of bookings
                const baseDuration = 5; // seconds per booking
                const duration = Math.max(15, bookingCount * baseDuration);
                marquee.style.setProperty('--scroll-duration', duration + 's');

                // If only a few bookings, stop animation
                if (bookingCount <= 3) {
                    marquee.style.animation = 'none';
                }
            }
        });
    </script>

    @include('dashboard.signage.main', ['delay' => $screen->view_duration ?? 60000])
</body>

</html>
