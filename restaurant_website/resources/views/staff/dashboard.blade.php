@extends('layouts.staff')

@section('title', 'Staff Dashboard - Restoran SUP TULANG ZZ')

@section('content')
<div class="staff-header">
    <h1>Dashboard</h1>
    <div class="staff-header-right">
        <span class="staff-greeting">Welcome, {{ Auth::user()->full_name }}</span>
        <div class="staff-avatar"><i class="fas fa-user-circle"></i></div>
    </div>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon orders"><i class="fas fa-receipt"></i></div>
        <div class="stat-info">
            <span class="stat-value">{{ $allOrdersCount }}</span>
            <span class="stat-label">Total Orders</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon pending"><i class="fas fa-clock"></i></div>
        <div class="stat-info">
            <span class="stat-value">{{ $activeOrdersCount }}</span>
            <span class="stat-label">Active Orders</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon completed"><i class="fas fa-check-circle"></i></div>
        <div class="stat-info">
            <span class="stat-value">{{ $completedOrdersCount }}</span>
            <span class="stat-label">Completed Orders</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon tables"><i class="fas fa-utensils"></i></div>
        <div class="stat-info">
            <span class="stat-value">{{ $menuItemsCount }}</span>
            <span class="stat-label">Menu Items</span>
        </div>
    </div>
</div>

<div class="staff-section">
    <div class="section-top">
        <h2>Recent Orders</h2>
        <a href="{{ route('staff.orders') }}" class="btn-view-all">View All <i class="fas fa-arrow-right"></i></a>
    </div>
    <div class="table-responsive">
        <table class="staff-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Type/Table</th>
                    <th>Items</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->user ? $order->user->full_name : $order->customer_name }}</td>
                        <td>{{ $order->table_number ? 'Table '.$order->table_number : ucfirst($order->order_type) }}</td>
                        <td>{{ $order->items_count }}</td>
                        <td>RM {{ number_format($order->total, 2) }}</td>
                        <td><span class="status-badge {{ $order->status }}">{{ ucfirst($order->status) }}</span></td>
                        <td>{{ optional($order->created_at)->format('h:i A') ?? '-' }}</td>
                        <td><a href="{{ route('staff.orders') }}" class="btn-view">View</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">No recent orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
