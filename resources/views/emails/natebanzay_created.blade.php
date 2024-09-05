<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Natebanzay Created</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        h1 {
            font-size: 24px;
            color: #333;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #888;
        }
        .footer a {
            color: #333;
            text-decoration: none;
        }
        .details-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        .details-table th, .details-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .details-table th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>New Natebanzay Created</h1>

        <p>Hello Admin,</p>

        <p>A new Natebanzay has been created by <strong>{{ $natebanzay->user->name }}</strong>. Below are the details:</p>

        <table class="details-table">
            <tr>
                <th>Natebanzay ID</th>
                <td>{{ $natebanzay->id }}</td>
            </tr>
            <tr>
                <th>Quantity</th>
                <td>{{ $natebanzay->quantity }}</td>
            </tr>
               <tr>
                <th>Note</th>
                <td>{{ $natebanzay->note }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $natebanzay->status }}</td>
            </tr>
            <tr>
                <th>Created At</th>
                <td>{{ $natebanzay->created_at->format('Y-m-d H:i') }}</td>
            </tr>
            @if (!empty($natebanzay->photos))
                <tr>
                    <th>Photos</th>
                    <td>
                        <ul>
                            @foreach (json_decode($natebanzay->photos) as $photo)
                                <li><a href="{{ asset('storage/images/natebanzay_photos/' . $photo) }}" target="_blank">{{ $photo }}</a></li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endif
        </table>

        <p>Please review the new Natebanzay and take any necessary actions.</p>

        <p>Thank you,<br>Your Application Team</p>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Donation.com.mm. All rights reserved.</p>
            <p><a href="{{ config('app.url') }}" target="_blank">{{ config('app.name') }}</a></p>
        </div>
    </div>
</body>
</html>
