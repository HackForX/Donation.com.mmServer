<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f4f4f4;
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: #333;
        }

        .container {
            text-align: center;
            padding: 40px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }

        h1 {
            font-size: 72px;
            margin-bottom: 10px;
            color: #ff6f61;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        p {
            font-size: 16px;
            margin-bottom: 30px;
            color: #777;
        }

        .btn {
            padding: 12px 30px;
            background-color: #ff6f61;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #ff4f41;
        }

        .illustration {
            margin: 20px auto;
            max-width: 200px;
        }

        footer {
            margin-top: 30px;
            font-size: 14px;
            color: #aaa;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>404</h1>
        <h2>Oops! Page Not Found</h2>
        <p>We're sorry, but the page you were looking for doesn't exist or may have been moved.</p>
        <a href="{{ url('/') }}" class="btn">Back to Home</a>
        
        <footer>
            &copy; {{ date('Y') }} Your Application. All rights reserved.
        </footer>
    </div>
</body>
</html>
