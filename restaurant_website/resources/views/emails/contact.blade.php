<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Contact Form Message</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:Arial, sans-serif; background:#f5f5f5; color:#333; }
        .wrapper { max-width:560px; margin:30px auto; background:#fff; border-radius:12px; overflow:hidden; box-shadow:0 2px 12px rgba(0,0,0,0.08); }
        .header { background:linear-gradient(135deg,#c0392b,#e74c3c); padding:28px 24px; text-align:center; color:#fff; }
        .header h1 { font-size:18px; margin-bottom:4px; }
        .header p { font-size:12px; opacity:0.85; }
        .body { padding:24px; }
        .meta-row { display:flex; padding:10px 0; border-bottom:1px dashed #eee; font-size:13px; }
        .meta-row:last-child { border-bottom:none; }
        .meta-row .label { color:#888; width:120px; flex-shrink:0; font-weight:600; }
        .meta-row .value { color:#2c3e50; font-weight:600; }
        .message-box { background:#f9f9f9; border-left:4px solid #c0392b; padding:14px 16px; border-radius:4px; margin-top:18px; font-size:13px; color:#444; line-height:1.7; }
        .footer { background:#2c3e50; padding:16px 24px; text-align:center; color:#aaa; font-size:11px; }
        .footer strong { color:#fff; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>📬 New Contact Form Message</h1>
            <p>Restoran SUP TULANG ZZ — Contact Us</p>
        </div>
        <div class="body">
            <div class="meta-row">
                <span class="label">Name</span>
                <span class="value">{{ $senderName }}</span>
            </div>
            <div class="meta-row">
                <span class="label">Email</span>
                <span class="value">{{ $senderEmail }}</span>
            </div>
            @if($senderPhone)
            <div class="meta-row">
                <span class="label">Phone</span>
                <span class="value">{{ $senderPhone }}</span>
            </div>
            @endif
            <div class="meta-row">
                <span class="label">Subject</span>
                <span class="value">{{ ucfirst($topic) }}</span>
            </div>
            <div class="meta-row">
                <span class="label">Received</span>
                <span class="value">{{ now()->format('d M Y, h:i A') }}</span>
            </div>
            <div class="message-box">
                {{ $messageBody }}
            </div>
        </div>
        <div class="footer">
            <strong>Restoran SUP TULANG ZZ</strong> &nbsp;·&nbsp; This message was sent via the contact form.
        </div>
    </div>
</body>
</html>
