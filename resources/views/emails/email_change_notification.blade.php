<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Change Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 100px;
            border-radius: 50%;
        }
        .content {
            font-size: 16px;
            line-height: 1.5;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2>Email Change Notification</h2>
    </div>
    <div class="content">
        <p>Hello {{ $user->name }},</p>
        <p>You have requested to change your email from <strong>{{ $user->email }}</strong> to <strong>{{ $newEmail }}</strong>.</p>
        <p>If this was not you, please contact our support team immediately. Otherwise, no further action is needed.</p>
        <p>Thank you for using our service!</p>
    </div>
    <div class="footer">
        <p>&copy; {{ date('Y') }} Your Company Name. All rights reserved.</p>
    </div>
</div>
</body>
</html>
