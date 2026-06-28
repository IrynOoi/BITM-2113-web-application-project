<!-- order-confirm.blade.php -->
@extends(request()->has('qr') ? 'layouts.qr' : 'layouts.frontend')

@section('title', 'Order Confirmed - Restoran SUP TULANG ZZ')

@section('styles')
<style>
    .confirm-page {
        min-height: 80vh;
        padding: 40px 0 60px;
        background: #fdf8f6;
    }

    .confirm-wrapper {
        max-width: 640px;
        margin: 0 auto;
        padding: 0 16px;
    }

    /* Success banner */
    .confirm-banner {
        background: linear-gradient(135deg, #27ae60, #2ecc71);
        border-radius: 20px;
        padding: 32px 24px;
        text-align: center;
        color: #fff;
        margin-bottom: 20px;
        box-shadow: 0 8px 24px rgba(39,174,96,0.25);
    }

    .confirm-banner .check-icon {
        width: 64px;
        height: 64px;
        background: rgba(255,255,255,0.25);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
        font-size: 1.8rem;
    }

    .confirm-banner h1 {
        font-size: 1.5rem;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .confirm-banner p {
        font-size: 0.9rem;
        opacity: 0.9;
    }

    /* Order meta card */
    .confirm-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #f0ebe4;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        margin-bottom: 16px;
        overflow: hidden;
    }

    .confirm-card-header {
        padding: 14px 20px;
        background: #fdf8f7;
        border-bottom: 1px solid #f0ebe4;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .confirm-card-header h3 {
        font-size: 0.9rem;
        font-weight: 700;
        color: #2c3e50;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .confirm-card-header h3 i {
        color: #c0392b;
    }

    .confirm-card-body {
        padding: 16px 20px;
    }

    .meta-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }

    .meta-item label {
        font-size: 0.75rem;
        color: #aaa;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: block;
        margin-bottom: 3px;
    }

    .meta-item span {
        font-size: 0.9rem;
        font-weight: 700;
        color: #2c3e50;
    }

    .badge-pending {
        background: #fff3cd;
        color: #856404;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    /* Items list */
    .item-row {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        padding: 8px 0;
        font-size: 0.875rem;
        border-bottom: 1px dashed #f0ebe4;
        color: #444;
    }

    .item-row:last-child { border-bottom: none; }

    .item-row .item-name { flex: 1; padding-right: 10px; }

    .item-row .item-qty {
        font-size: 0.75rem;
        color: #aaa;
        background: #f0ebe4;
        padding: 1px 7px;
        border-radius: 10px;
        margin-left: 6px;
    }

    .totals-section {
        margin-top: 12px;
        padding-top: 12px;
        border-top: 2px solid #f0ebe4;
    }

    .total-row {
        display: flex;
        justify-content: space-between;
        font-size: 0.85rem;
        color: #666;
        padding: 4px 0;
    }

    .total-row.grand {
        font-size: 1rem;
        font-weight: 800;
        color: #2c3e50;
        border-top: 2px solid #2c3e50;
        margin-top: 8px;
        padding-top: 10px;
    }

    /* Note */
    .confirm-note {
        text-align: center;
        font-size: 0.82rem;
        color: #aaa;
        padding: 10px 0 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    /* Actions */
    .confirm-actions {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 20px;
    }

    .btn-track {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 14px;
        background: linear-gradient(135deg, #c0392b, #e74c3c);
        color: #fff;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.95rem;
        text-decoration: none;
        box-shadow: 0 4px 14px rgba(192,57,43,0.3);
        transition: transform 0.2s;
    }

    .btn-track:hover { transform: translateY(-2px); color: #fff; }

    .btn-more {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 13px;
        background: #fff;
        color: #c0392b;
        border: 2px solid #c0392b;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.95rem;
        text-decoration: none;
        transition: background 0.2s;
    }

    .btn-more:hover { background: #fdf0ef; color: #c0392b; }

    .btn-home {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px;
        background: transparent;
        color: #aaa;
        border-radius: 12px;
        font-size: 0.875rem;
        text-decoration: none;
        transition: color 0.2s;
    }

    .btn-home:hover { color: #2c3e50; }
</style>
@endsection

@section('content')
<main class="confirm-page">
    <div class="confirm-wrapper">

        {{-- Success Banner --}}
        <div class="confirm-banner">
            <div class="check-icon"><i class="fas fa-check"></i></div>
            <h1>Order Placed!</h1>
            <p>Thank you! We are preparing your order now.</p>
        </div>

        {{-- Order Meta --}}
        <div class="confirm-card">
            <div class="confirm-card-header">
                <h3><i class="fas fa-receipt"></i> Order Details</h3>
                @if($order)
                    <span style="font-size:0.85rem; color:#c0392b; font-weight:700;">#{{ $order->id }}</span>
                @endif
            </div>
            <div class="confirm-card-body">
                @if($order)
                <div class="meta-grid">
                    <div class="meta-item">
                        <label>Customer</label>
                        <span>{{ $order->customer_name }}</span>
                    </div>
                    <div class="meta-item">
                        <label>Order Type</label>
                        <span>{{ $order->orderTypeLabel() }}</span>
                    </div>
                    @if($order->table_number)
                    <div class="meta-item">
                        <label>Table</label>
                        <span>Table {{ $order->table_number }} @if($order->pax)({{ $order->pax }} pax)@endif</span>
                    </div>
                    @endif
                    <div class="meta-item">
                        <label>Status</label>
                        <span class="badge-pending"><i class="fas fa-hourglass-half"></i> Pending</span>
                    </div>
                    <div class="meta-item">
                        <label>Est. Time</label>
                        <span>20 â€“ 35 mins</span>
                    </div>
                    <div class="meta-item">
                        <label>Payment</label>
                        <span>{{ $order->payment_method === 'cash' ? 'Cash' : 'Online Transfer' }}</span>
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- Items --}}
        @if($order && $order->items->count())
        <div class="confirm-card">
            <div class="confirm-card-header">
                <h3><i class="fas fa-utensils"></i> Items Ordered</h3>
                <span style="font-size:0.8rem; color:#aaa;">{{ $order->items->count() }} item(s)</span>
            </div>
            <div class="confirm-card-body">
                @foreach($order->items as $item)
                    <div class="item-row">
                        <span class="item-name">
                            {{ $item->item_name }}
                            <span class="item-qty">x{{ $item->quantity }}</span>
                        </span>
                        <span>RM {{ number_format($item->line_total, 2) }}</span>
                    </div>
                @endforeach

                <div class="totals-section">
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
            </div>
        </div>
        @endif

        <p class="confirm-note">
            <i class="fas fa-bell"></i> Save your Order ID <strong style="color:#2c3e50;">#{{ $orderId }}</strong> to track your order later.
        </p>

        {{-- Actions --}}
        <div class="confirm-actions">
            @php
                $statusParams = ['order_id' => $orderId];
                if (request()->has('qr')) {
                    $statusParams['qr'] = 1;
                    if (request('table')) $statusParams['table'] = request('table');
                    if (request('pax'))   $statusParams['pax']   = request('pax');
                }
            @endphp
            <a href="{{ route('customer.order-status', $statusParams) }}" class="btn-track">
                <i class="fas fa-search"></i> Track My Order
            </a>

            @if(request()->has('qr'))
                @php
                    $qrBase  = url('/customer/qr-order');
                    $qrQuery = http_build_query(array_filter(['table' => request('table'), 'pax' => request('pax')]));
                @endphp
                <a href="{{ $qrBase . ($qrQuery ? '?' . $qrQuery : '') }}" class="btn-more">
                    <i class="fas fa-plus"></i> Order More
                </a>
            @else
                <a href="{{ route('menu') }}" class="btn-more">
                    <i class="fas fa-plus"></i> Order More
                </a>
                <a href="{{ route('home') }}" class="btn-home">
                    <i class="fas fa-home"></i> Back to Home
                </a>
            @endif
        </div>

    </div>
</main>
@endsection

@section('scripts')
<script>
    localStorage.removeItem('restaurantCart');
    localStorage.removeItem('restaurantLastOrderType');
    document.querySelectorAll('.cart-badge, #cartBadge, #floatingCartCount').forEach(el => {
        el.textContent = '0';
        el.style.display = 'none';
    });
</script>
@endsection

