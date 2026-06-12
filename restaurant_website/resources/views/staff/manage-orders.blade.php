@extends('layouts.staff')

@section('title', 'Manage Orders - Restoran SUP TULANG ZZ')

@section('content')
<div class="staff-header">
    <h1>Manage Orders</h1>
</div>

<div class="filter-bar">
    <input type="text" placeholder="Search orders..." class="filter-input" id="orderSearch">
    <select class="filter-select" id="typeFilter">
        <option value="">All Types</option>
        <option value="dine-in">Dine-In</option>
        <option value="takeaway">Takeaway</option>
        <option value="delivery">Delivery</option>
    </select>
</div>

<div class="table-responsive">
    <table class="staff-table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Type</th>
                <th>Table</th>
                <th>Items</th>
                <th>Total</th>
                <th>Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="ordersBody">
            @forelse($orders as $order)
                <tr data-type="{{ $order->order_type }}">
                    <td>#{{ $order->id }}</td>
                    <td>{{ ucfirst($order->order_type) }}</td>
                    <td>{{ $order->table_number ? 'Table '.$order->table_number : '-' }}</td>
                    <td>{{ $order->items_count }} item(s)</td>
                    <td>RM {{ number_format($order->total, 2) }}</td>
                    <td>{{ optional($order->created_at)->format('h:i A') ?? '-' }}</td>
                    <td><button class="btn-complete" onclick="completeOrder(this)"><i class="fas fa-check"></i> Complete</button></td>
                </tr>
            @empty
                <tr data-type="dine-in"><td>#1023</td><td>Dine-In</td><td>Table 5</td><td>Nasi Lemak x2, Iced Tea x1</td><td>RM 35.00</td><td>10:30 AM</td><td><button class="btn-complete" onclick="completeOrder(this)"><i class="fas fa-check"></i> Complete</button></td></tr>
                <tr data-type="dine-in"><td>#1024</td><td>Dine-In</td><td>Table 12</td><td>Chicken Chop x1, Tom Yum x1</td><td>RM 62.50</td><td>10:35 AM</td><td><button class="btn-complete" onclick="completeOrder(this)"><i class="fas fa-check"></i> Complete</button></td></tr>
                <tr data-type="delivery"><td>#1026</td><td>Delivery</td><td>-</td><td>Nasi Goreng x2, Mango Smoothie x2</td><td>RM 45.00</td><td>10:15 AM</td><td><button class="btn-complete" onclick="completeOrder(this)"><i class="fas fa-check"></i> Complete</button></td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script>
    function completeOrder(btn) {
        const row = btn.closest('tr');
        row.style.transition = 'opacity 0.3s ease';
        row.style.opacity = '0';
        setTimeout(() => row.remove(), 300);
    }

    document.getElementById('orderSearch').addEventListener('input', filterOrders);
    document.getElementById('typeFilter').addEventListener('change', filterOrders);

    function filterOrders() {
        const query = document.getElementById('orderSearch').value.toLowerCase();
        const type = document.getElementById('typeFilter').value;
        document.querySelectorAll('#ordersBody tr').forEach(row => {
            const matchesQuery = row.textContent.toLowerCase().includes(query);
            const matchesType = !type || row.dataset.type === type;
            row.style.display = matchesQuery && matchesType ? '' : 'none';
        });
    }
</script>
@endsection
