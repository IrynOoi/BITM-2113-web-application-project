<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; margin: 0; padding: 20px; }
        .container { max-width: 480px; margin: 0 auto; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
        .header { background: #c0392b; padding: 30px; text-align: center; }
        .header img { width: 70px; height: 70px; border-radius: 50%; object-fit: cover; border: 3px solid #fff; }
        .header h1 { color: #fff; margin: 12px 0 0; font-size: 1.3rem; }
        .body { padding: 30px; text-align: center; }
        .body p { color: #555; font-size: 0.95rem; line-height: 1.6; }
        .otp-box { background: #fdf6f0; border: 2px dashed #c0392b; border-radius: 12px; padding: 20px; margin: 24px 0; }
        .otp-code { font-size: 2.5rem; font-weight: 800; color: #c0392b; letter-spacing: 10px; }
        .expire { color: #999; font-size: 0.8rem; margin-top: 8px; }
        .footer { background: #f9f9f9; padding: 16px; text-align: center; color: #aaa; font-size: 0.78rem; border-top: 1px solid #eee; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Restoran SUP TULANG ZZ</h1>
        </div>
        <div class="body">
            <p>You requested a password reset. Use the OTP below to proceed:</p>
            <div class="otp-box">
                <div class="otp-code">{{ $otp }}</div>
                <div class="expire">Valid for 10 minutes</div>
            </div>
            <p>If you did not request this, please ignore this email. Your password will remain unchanged.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Restoran SUP TULANG ZZ. All rights reserved.
        </div>
    </div>
</body>
</html>
