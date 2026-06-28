<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; color: #333; }
        .wrapper { max-width: 600px; margin: 30px auto; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,0.08); }
        .header { background: linear-gradient(135deg, #c0392b, #e74c3c); padding: 32px 24px; text-align: center; color: #fff; }
        .header h1 { font-size: 22px; margin-bottom: 4px; }
        .header p { font-size: 13px; opacity: 0.9; }
        .check { width: 56px; height: 56px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 14px; font-size: 24px; }
        .body { padding: 28px 24px; }
        .greeting { font-size: 15px; margin-bottom: 20px; color: #444; }
        .order-meta { background: #f9f9f9; border-radius: 8px; padding: 16px; margin-bottom: 20px; }
        .meta-row { display: flex; justify-content: space-between; padding: 5px 0; font-size: 13px; border-bottom: 1px dashed #eee; }
        .meta-row:last-child { border-bottom: none; }
        .meta-row span:first-child { color: #888; }
        .meta-row span:last-child { font-weight: 600; color: #2c3e50; }
        .items-title { font-size: 14px; font-weight: 700; color: #2c3e50; margin-bottom: 10px; }
        .item-row { display: flex; justify-content: space-between; padding: 8px 0; font-size: 13px; border-bottom: 1px solid #f0f0f0; }
        .item-row:last-child { border-bottom: none; }
        .totals { margin-top: 12px; padding-top: 12px; border-top: 2px solid #f0f0f0; }
        .total-row { display: flex; justify-content: space-between; font-size: 13px; color: #666; padding: 3px 0; }
        .total-row.grand { font-size: 15px; font-weight: 800; color: #2c3e50; border-top: 2px solid #2c3e50; margin-top: 8px; padding-top: 8px; }
        .note { background: #fff8e1; border-left: 4px solid #f39c12; padding: 12px 16px; border-radius: 4px; font-size: 13px; color: #666; margin-top: 20px; }
        .footer { background: #2c3e50; padding: 20px 24px; text-align: center; color: #aaa; font-size: 12px; }
        .footer strong { color: #fff; }
        .status-badge { display: inline-block; background: #fff3cd; color: #856404; padding: 2px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; }
    </style>
</head>
<body>
    <div class="wrapper">

        <div class="header">
            <div class="check">&#10003;</div>
            <h1>Order Confirmed!</h1>
            <p>Thank you for ordering from Restoran SUP TULANG ZZ</p>
        </div>

        <div class="body">
            <p class="greeting">Hi <strong>{{ $order->customer_name }}</strong>,</p>
            <p style="font-size:13px; color:#666; margin-bottom:20px;">
                Your order has been received and is now being processed. Here are your order details:
            </p>

            {{-- Order Meta --}}
            <div class="order-meta">
                <div class="meta-row">
                    <span>Order ID</span>
                    <span>#{{ $order->id }}</span>
                </div>
                <div class="meta-row">
                    <span>Order Type</span>
                    <span>{{ $order->orderTypeLabel() }}</span>
                </div>
                <div class="meta-row">
                    <span>Payment</span>
                    <span>{{ $order->payment_method === 'cash' ? 'Cash' : 'Online Transfer' }}</span>
                </div>
                @if($order->delivery_address)
                <div class="meta-row">
                    <span>Delivery Address</span>
                    <span>{{ $order->delivery_address }}</span>
                </div>
                @endif
                <div class="meta-row">
                    <span>Status</span>
                    <span><span class="status-badge">&#9203; Pending</span></span>
                </div>
                <div class="meta-row">
                    <span>Estimated Time</span>
                    <span>20 &ndash; 35 minutes</span>
                </div>
            </div>

            {{-- Items --}}
            <p class="items-title">Items Ordered</p>
            @foreach($order->items as $item)
                <div class="item-row">
                    <span>{{ $item->item_name }} <span style="color:#aaa;">x{{ $item->quantity }}</span></span>
                    <span>RM {{ number_format($item->line_total, 2) }}</span>
                </div>
            @endforeach

            <div class="totals">
                <div class="total-row">
                    <span>Subtotal</span>
                    <span>RM {{ number_format($order->subtotal, 2) }}</span>
                </div>
                <div class="total-row">
                    <span>Tax (6% SST)</span>
                    <span>RM {{ number_format($order->tax, 2) }}</span>
                </div>
                @if($order->delivery_fee > 0)
                <div class="total-row">
                    <span>Delivery Fee</span>
                    <span>RM {{ number_format($order->delivery_fee, 2) }}</span>
                </div>
                @endif
                <div class="total-row grand">
                    <span>Total</span>
                    <span>RM {{ number_format($order->total, 2) }}</span>
                </div>
            </div>

            <div class="note">
                <strong>Track your order:</strong> Visit our website and go to <strong>Track Order</strong> &ndash; enter your Order ID <strong>#{{ $order->id }}</strong> to check your order status anytime.
            </div>
        </div>

        <div class="footer">
            <strong>Restoran SUP TULANG ZZ</strong><br>
            This is an automated email, please do not reply.<br>
            &copy; {{ date('Y') }} Restoran SUP TULANG ZZ. All rights reserved.
        </div>

    </div>
</body>
</html>
