<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | MyMoney</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #030712;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .container {
            max-width: 480px;
            margin: 40px auto;
            background: #111827;
            border-radius: 16px;
            padding: 40px 32px;
            border: 1px solid #1f2937;
        }

        .logo {
            text-align: center;
            font-size: 32px;
            font-weight: bold;
            color: #ffffff;
            margin-bottom: 24px;
        }

        h1 {
            color: #ffffff;
            font-size: 20px;
            text-align: center;
            margin-bottom: 8px;
        }

        p {
            color: #9ca3af;
            font-size: 14px;
            line-height: 1.6;
            text-align: center;
            margin-bottom: 24px;
        }

        .btn {
            display: block;
            width: fit-content;
            margin: 0 auto 24px;
            padding: 12px 32px;
            background: #059669;
            color: #ffffff;
            text-decoration: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
        }

        .btn:hover {
            background: #10b981;
        }

        .footer {
            text-align: center;
            color: #6b7280;
            font-size: 12px;
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid #1f2937;
        }

        .expiry {
            text-align: center;
            color: #6b7280;
            font-size: 12px;
            margin-top: 16px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo">MyMoney</div>
        <h1>Reset Password</h1>
        <p>Halo {{ $username }},<br>
            Kami menerima permintaan reset password untuk akun MyMoney-mu.<br>
            Klik tombol di bawah untuk membuat password baru.</p>

        <a href="{{ $url }}" class="btn">Reset Password</a>

        <p style="margin-bottom: 0;">Link ini akan kedaluwarsa dalam 60 menit.</p>
        <p style="margin-top: 8px;">Jika kamu tidak meminta reset password, abaikan email ini.</p>

        <div class="footer">
            &copy; {{ date('Y') }} MyMoney. All rights reserved.
        </div>
    </div>
</body>

</html>
