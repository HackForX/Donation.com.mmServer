<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $data['title'] }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #ff6f61;
            font-size: 24px;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            color: #555;
            margin-bottom: 20px;
        }

        a.button {
            display: inline-block;
            background-color: #ff6f61;
            color: #fff;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 6px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 14px;
            margin-bottom: 20px;
        }

        a.button:hover {
            background-color: #ff4f41;
        }

        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #aaa;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h1>{{ $data['title'] }}</h1>
        <p>{{ $data['body'] }}</p>
        <a href="{{ $data['url'] }}" class="button">Reset Password</a>
        <p>Thank you!</p>

        <div class="footer">
            &copy; {{ date('Y') }} Donation.com.mm. All rights reserved.
        </div>
    </div>
</body>
</html>
