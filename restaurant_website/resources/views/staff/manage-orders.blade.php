@extends('layouts.staff')

@section('title', 'Manage Orders - Restoran SUP TULANG ZZ')

@section('content')
<div class="staff-header">
    <h1>Manage Orders</h1>
</div>

<form method="GET" action="{{ route('staff.orders') }}" class="filter-bar" id="filterForm">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search orders..." class="filter-input" id="orderSearch">
    <select name="type" class="filter-select" id="typeFilter" onchange="document.getElementById('filterForm').submit()">
        <option value="">All Types</option>
        <option value="dine-in" {{ request('type') == 'dine-in' ? 'selected' : '' }}>Dine-In</option>
        <option value="takeaway" {{ request('type') == 'takeaway' ? 'selected' : '' }}>Takeaway</option>
        <option value="delivery" {{ request('type') == 'delivery' ? 'selected' : '' }}>Delivery</option>
    </select>
    <select name="status" class="filter-select" id="statusFilter" onchange="document.getElementById('filterForm').submit()">
        <option value="">All Statuses</option>
        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="preparing" {{ request('status') == 'preparing' ? 'selected' : '' }}>Preparing</option>
        <option value="ready" {{ request('status') == 'ready' ? 'selected' : '' }}>Ready</option>
        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
    </select>
    <button type="submit" class="btn-view" style="margin-left:10px;">Search</button>
</form>

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
                    <td>
                        {{ $order->table_number ? 'Table '.$order->table_number : '-' }}
                        @if($order->pax)
                            <br><small style="color: #666;">({{ $order->pax }} pax)</small>
                        @endif
                    </td>
                    <td>{{ $order->items_count }} item(s)</td>
                    <td>RM {{ number_format($order->total, 2) }}</td>
                    <td>{{ optional($order->created_at)->format('h:i A') ?? '-' }}</td>
                    <td>
                        <form method="POST" action="{{ route('staff.orders.status', $order->id) }}" style="display:inline-block;">
                            @csrf
                            @method('PATCH')
                            <select name="status" onchange="this.form.submit()" class="status-badge {{ $order->status }}" style="border:none; cursor:pointer;">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="preparing" {{ $order->status == 'preparing' ? 'selected' : '' }}>Preparing</option>
                                <option value="ready" {{ $order->status == 'ready' ? 'selected' : '' }}>Ready</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center py-4">No orders found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

