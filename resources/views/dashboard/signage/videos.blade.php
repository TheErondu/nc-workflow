<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poster Design</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
        }

        #poster {
            width: 70%;
            margin: 50px auto;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        #header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        #content {
            padding: 20px;
        }

        #image {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
        }

        #footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>

<div id="poster">
    <div id="header">
        <h1>Special Event</h1>
        <p>Date: January 1, 2023</p>
    </div>
    <div id="content">
        <img id="image" src="https://placekitten.com/800/300" alt="Event Image">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin auctor vel nunc id bibendum. Nullam nec arcu vel libero volutpat efficitur.</p>
        <p>Sed aliquet urna nec justo faucibus, non vestibulum odio varius. Vestibulum ac ex nec arcu lacinia tristique ut vel nunc.</p>
    </div>
    <div id="footer">
        <p>Contact: example@email.com | Phone: (123) 456-7890</p>
    </div>
</div>
@include('dashboard.signage.main',['next' => 'awards'])
</body>
</html>
