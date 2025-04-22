<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Beat Purchase Receipt</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            padding: 40px 0;
        }
        .email-wrapper {
            background: #ffffff;
            max-width: 620px;
            margin: auto;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            height: 40px;
        }
        .header {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        .content {
            font-size: 16px;
            color: #333;
            line-height: 1.6;
        }
        .btn {
            display: inline-block;
            padding: 12px 25px;
            background-color: #cf173c;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            margin: 20px 0;
        }
        .footer {
            font-size: 13px;
            text-align: center;
            color: #888;
            margin-top: 40px;
        }
    </style>
</head>
<body>
<div class="email-wrapper">
    <div class="logo">
        <h4>MeekizMusic</h4>
    </div>

    <div class="header">
        <h2>🎧 Your Beat is Ready!</h2>
    </div>

    <div class="content">
        <p>Hi {{ $user->name }},</p>

        <p>Thank you for your purchase! Your recent beat purchase was successful and the transaction has been recorded.</p>

        <p>To view your purchase details and download the full beat (MP3):</p>

        <ol>
            <li>Login to your dashboard</li>
            <li>Click on the <strong>Purchases</strong> tab</li>
            <li>Select your recent transaction</li>
            <li>Click <strong>Download</strong> to get your files</li>
        </ol>

        <a class="btn" href="{{ route('login') }}">Login to Dashboard</a>

        <p>If you need help or experience any issues, just reply to this email. We're here to help you rock your next track. 🎶</p>

        <p>— The {{ config('app.name') }} Team</p>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.<br>
        Never share your download link with anyone else.
    </div>
</div>
</body>
</html>
