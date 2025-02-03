<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Schedule Posted</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        .header {
            background-color: #272727;
            padding: 20px;
            color: white;
            text-align: center;
        }
        .content {
            margin-top: 20px;
        }
        .intro {
            background-color: #f4f4f4;
            padding: 10px;
            margin-bottom: 20px;
            font-size: 16px;
            border-left: 5px solid #4CAF50;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }
        .col-6 {
            width: 48%;
            margin-right: 2%;
        }
        .col-12 {
            width: 100%;
        }
        .label {
            font-weight: bold;
        }
        .value {
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Schedule Posted</h2>
        </div>

        <div class="content">
            <!-- Introductory Message -->
            <div class="intro">
                <p><strong>{{ $schedule->user->name }}</strong> has posted a new schedule for you to review.</p>
            </div>

            <!-- Schedule Details -->
            <div class="row">
                <div class="col-6">
                    <span class="label">Name:</span>
                    <span class="value">{{ $schedule->title }}</span>
                </div>
                <div class="col-6">
                    <span class="label">Status:</span>
                    <span class="value">{{ $schedule->status }}</span>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <span class="label">Start Date:</span>
                    <span class="value">{{ $schedule->start }}</span>
                </div>
                <div class="col-6">
                    <span class="label">End Date:</span>
                    <span class="value">{{ $schedule->end }}</span>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <span class="label">Driver:</span>
                    <span class="value">{{ $schedule->driver }}</span>
                </div>
            </div>

            @if($schedule->type === 'preproduction')
                <div class="row">
                    <div class="col-6">
                        <span class="label">Producer 1:</span>
                        <span class="value">{{ $schedule->producer1 }}</span>
                    </div>
                    <div class="col-6">
                        <span class="label">Producer 2:</span>
                        <span class="value">{{ $schedule->producer2 }}</span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <span class="label">Director of Photography 1:</span>
                        <span class="value">{{ $schedule->dop1 }}</span>
                    </div>
                    <div class="col-6">
                        <span class="label">Director of Photography 2:</span>
                        <span class="value">{{ $schedule->dop2 }}</span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <span class="label">Director of Photography 3:</span>
                        <span class="value">{{ $schedule->dop3 }}</span>
                    </div>
                    <div class="col-6">
                        <span class="label">Director of Photography 4:</span>
                        <span class="value">{{ $schedule->dop4 }}</span>
                    </div>
                </div>
            @elseif($schedule->type === 'editors')
                <div class="row">
                    <div class="col-6">
                        <span class="label">Video Editor:</span>
                        <span class="value">{{ $schedule->video_editor }}</span>
                    </div>
                </div>
            @elseif($schedule->type === 'graphics')
                <div class="row">
                    <div class="col-6">
                        <span class="label">Graphic Editor:</span>
                        <span class="value">{{ $schedule->graphic_editor }}</span>
                    </div>
                </div>
            @elseif($schedule->type === 'digital')
                <div class="row">
                    <div class="col-6">
                        <span class="label">Digital Editor:</span>
                        <span class="value">{{ $schedule->digital_editor }}</span>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <span class="label">Description:</span>
                    <p class="value">{{ $schedule->description }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <span class="label">Others:</span>
                    <p class="value">{{ $schedule->others }}</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
