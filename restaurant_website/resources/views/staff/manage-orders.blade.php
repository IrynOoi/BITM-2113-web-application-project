@extends('layouts.staff')

@section('title', 'Manage Orders - Restoran SUP TULANG ZZ')

@section('content')
<div class="staff-header">
    <h1>Manage Orders</h1>
</div>

<form method="GET" action="{{ route('staff.orders') }}" class="filter-bar" id="filterForm">
    <input type="date" name="date" value="{{ request('date', today()->toDateString()) }}" class="filter-input" style="width:160px;" onchange="document.getElementById('filterForm').submit()">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search orders..." class="filter-input" id="orderSearch">
    <select name="type" class="filter-select" onchange="document.getElementById('filterForm').submit()">
        <option value="">All Types</option>
        <option value="dine-in"  {{ request('type') == 'dine-in'  ? 'selected' : '' }}>Dine In</option>
        <option value="takeaway" {{ request('type') == 'takeaway' ? 'selected' : '' }}>Takeaway</option>
        <option value="pickup"   {{ request('type') == 'pickup'   ? 'selected' : '' }}>Pick Up</option>
        <option value="delivery" {{ request('type') == 'delivery' ? 'selected' : '' }}>Delivery</option>
    </select>
    <select name="status" class="filter-select" onchange="document.getElementById('filterForm').submit()">
        <option value="active" {{ (!request()->has('status') || request('status') == 'active') ? 'selected' : '' }}>Active Orders</option>
        <option value="all"     {{ request('status') == 'all' ? 'selected' : '' }}>All Statuses</option>
        <option value="pending"   {{ request('status') == 'pending'   ? 'selected' : '' }}>Pending</option>
        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
        <option value="preparing" {{ request('status') == 'preparing' ? 'selected' : '' }}>Preparing</option>
        <option value="ready"     {{ request('status') == 'ready'     ? 'selected' : '' }}>Ready</option>
        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
    </select>
    <button type="submit" class="btn-view" style="margin-left:10px;">Search</button>
    <span style="margin-left:auto; font-size:0.8rem; color:#aaa;" id="autoRefreshLabel">
        <i class="fas fa-sync-alt"></i> Auto-refresh in <span id="countdown">30</span>s
    </span>
</form>

<div class="table-responsive">
    <table class="staff-table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Type</th>
                <th>Table</th>
                <th>Items</th>
                <th>Total</th>
                <th>Time</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                @php
                    $rowColor = match($order->status) {
                        'pending'   => '#fff8e1',
                        'confirmed' => '#e8f5e9',
                        'preparing' => '#fff3e0',
                        'ready'     => '#e3f2fd',
                        'completed' => '#f5f5f5',
                        'cancelled' => '#fce4ec',
                        default     => '#fff',
                    };
                    $minutesAgo = $order->created_at ? (int) $order->created_at->diffInMinutes(now()) : 0;
                @endphp
                <tr style="background:{{ $rowColor }}; cursor:pointer;" onclick="toggleItems({{ $order->id }})">
                    <td><strong>#{{ $order->id }}</strong></td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->orderTypeLabel() }}</td>
                    <td>
                        {{ $order->table_number ? 'Table '.$order->table_number : '-' }}
                        @if($order->pax)
                            <br><small style="color:#666;">({{ $order->pax }} pax)</small>
                        @endif
                    </td>
                    <td>
                        <span style="color:#c0392b; font-weight:600;">{{ $order->items_count }} item(s)</span>
                        <br><small style="color:#aaa;">click to expand</small>
                    </td>
                    <td>RM {{ number_format($order->total, 2) }}</td>
                    <td>
                        {{ optional($order->created_at)->format('h:i A') ?? '-' }}
                        @if($minutesAgo > 0)
                            <br><small style="color:{{ $minutesAgo > 20 ? '#e74c3c' : '#aaa' }};">
                                {{ $minutesAgo }}m ago
                            </small>
                        @endif
                    </td>
                    <td onclick="event.stopPropagation()">
                        <form method="POST" action="{{ route('staff.orders.status', $order->id) }}" style="display:inline-block;">
                            @csrf
                            @method('PATCH')
                            <select name="status" onchange="this.form.submit()" class="status-badge {{ $order->status }}" style="border:none; cursor:pointer;">
                                <option value="pending"   {{ $order->status == 'pending'   ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="preparing" {{ $order->status == 'preparing' ? 'selected' : '' }}>Preparing</option>
                                <option value="ready"     {{ $order->status == 'ready'     ? 'selected' : '' }}>Ready</option>
                                @if($order->order_type !== 'dine-in')
                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                @endif
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </form>
                    </td>
                </tr>
                <tr id="items-{{ $order->id }}" style="display:none; background:{{ $rowColor }};">
                    <td colspan="8" style="padding:0 20px 16px;">
                        <div style="background:#fff; border-radius:10px; padding:14px 18px; border:1px solid #e0e0e0;">
                            <strong style="font-size:0.85rem; color:#2c3e50; display:block; margin-bottom:10px;">
                                <i class="fas fa-receipt"></i> Order Items
                            </strong>
                            @foreach($order->items as $item)
                                <div style="display:flex; justify-content:space-between; padding:6px 0; border-bottom:1px dashed #f0f0f0; font-size:0.875rem;">
                                    <span>{{ $item->item_name }} <span style="color:#aaa;">x{{ $item->quantity }}</span></span>
                                    <span>RM {{ number_format($item->line_total, 2) }}</span>
                                </div>
                            @endforeach
                            @if($order->special_notes)
                                <div style="margin-top:10px; padding:8px 12px; background:#fff8e1; border-radius:8px; font-size:0.8rem; color:#666;">
                                    <i class="fas fa-comment"></i> {{ $order->special_notes }}
                                </div>
                            @endif
                            @if($order->receipt_path)
                                <div style="margin-top:10px;">
                                    <strong style="font-size:0.8rem; color:#2c3e50;"><i class="fas fa-file-invoice"></i> Payment Receipt</strong>
                                    <div style="margin-top:6px;">
                                        <a href="{{ asset($order->receipt_path) }}" target="_blank">
                                            <img src="{{ asset($order->receipt_path) }}" alt="Receipt"
                                                 style="max-width:180px; max-height:180px; border-radius:8px; border:1px solid #e0e0e0; object-fit:cover; cursor:pointer;"
                                                 title="Click to view full receipt">
                                        </a>
                                        <br>
                                        <small style="color:#aaa;">Click image to view full size</small>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" class="text-center py-4">No orders found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script>
    function toggleItems(orderId) {
        const row = document.getElementById('items-' + orderId);
        row.style.display = row.style.display === 'none' ? 'table-row' : 'none';
    }

    // Auto-refresh countdown
    let seconds = 30;
    const countdown = document.getElementById('countdown');
    setInterval(() => {
        seconds--;
        if (countdown) countdown.textContent = seconds;
        if (seconds <= 0) window.location.reload();
    }, 1000);
</script>
@endsection


