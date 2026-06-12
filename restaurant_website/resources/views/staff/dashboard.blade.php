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
            <span class="stat-value">{{ \App\Models\Order::whereDate('created_at', today())->count() }}</span>
            <span class="stat-label">Total Orders Today</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon pending"><i class="fas fa-clock"></i></div>
        <div class="stat-info">
            <span class="stat-value">{{ \App\Models\Order::whereIn('status', ['pending', 'confirmed', 'preparing'])->count() }}</span>
            <span class="stat-label">Pending Orders</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon completed"><i class="fas fa-check-circle"></i></div>
        <div class="stat-info">
            <span class="stat-value">{{ \App\Models\Order::where('status', 'completed')->count() }}</span>
            <span class="stat-label">Completed</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon tables"><i class="fas fa-chair"></i></div>
        <div class="stat-info">
            <span class="stat-value">12/30</span>
            <span class="stat-label">Tables Occupied</span>
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
                    <th>Table</th>
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
                        <td>{{ $order->table_number ? 'Table '.$order->table_number : ucfirst($order->order_type) }}</td>
                        <td>{{ $order->items_count }}</td>
                        <td>RM {{ number_format($order->total, 2) }}</td>
                        <td><span class="status-badge {{ $order->status }}">{{ ucfirst($order->status) }}</span></td>
                        <td>{{ optional($order->created_at)->format('h:i A') ?? '-' }}</td>
                        <td><a href="{{ route('staff.orders') }}" class="btn-view">View</a></td>
                    </tr>
                @empty
                    <tr>
                        <td>#1023</td>
                        <td>Table 5</td>
                        <td>3</td>
                        <td>RM 35.00</td>
                        <td><span class="status-badge pending">Pending</span></td>
                        <td>10:30 AM</td>
                        <td><a href="{{ route('staff.orders') }}" class="btn-view">View</a></td>
                    </tr>
                    <tr>
                        <td>#1024</td>
                        <td>Table 12</td>
                        <td>5</td>
                        <td>RM 62.50</td>
                        <td><span class="status-badge preparing">Preparing</span></td>
                        <td>10:35 AM</td>
                        <td><a href="{{ route('staff.orders') }}" class="btn-view">View</a></td>
                    </tr>
                    <tr>
                        <td>#1025</td>
                        <td>Table 3</td>
                        <td>2</td>
                        <td>RM 18.00</td>
                        <td><span class="status-badge ready">Ready</span></td>
                        <td>10:20 AM</td>
                        <td><a href="{{ route('staff.orders') }}" class="btn-view">View</a></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
