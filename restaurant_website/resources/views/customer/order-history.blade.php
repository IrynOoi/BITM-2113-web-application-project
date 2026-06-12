@extends('layouts.frontend')

@section('title', 'Order History - Restoran SUP TULANG ZZ')

@section('styles')
    @include('customer.partials.account-styles')
@endsection

@section('content')
<main class="dashboard-page">
    <div class="container">
        <div class="dashboard-layout">
            @include('customer.partials.account-sidebar')
            <div class="dashboard-main">
                <div class="dashboard-header">
                    <h1>Order History</h1>
                    <p>All your past orders in one place</p>
                </div>

                <form class="history-filters" method="GET" action="{{ route('customer.order-history') }}">
                    <div class="filter-group">
                        <label>Status</label>
                        <select name="status">
                            <option value="">All Status</option>
                            <option value="completed" @selected(request('status') === 'completed')>Completed</option>
                            <option value="cancelled" @selected(request('status') === 'cancelled')>Cancelled</option>
                            <option value="pending" @selected(request('status') === 'pending')>Pending</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>From</label>
                        <input type="date" name="from" value="{{ request('from') }}">
                    </div>
                    <div class="filter-group">
                        <label>To</label>
                        <input type="date" name="to" value="{{ request('to') }}">
                    </div>
                    <button class="btn-filter" type="submit"><i class="fas fa-filter"></i> Filter</button>
                </form>

                <div class="orders-table-wrapper">
                    <table class="orders-table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Date &amp; Time</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                                    <td>{{ $order->items_count }}</td>
                                    <td>RM {{ number_format($order->total, 2) }}</td>
                                    <td>{{ ucfirst($order->order_type) }}</td>
                                    <td><span class="status-badge status-{{ $order->status }}">{{ ucfirst($order->status) }}</span></td>
                                    <td><a href="{{ route('customer.order-status', ['order_id' => $order->id]) }}" style="color:#c0392b;font-weight:600;">Track</a></td>
                                </tr>
                            @empty
                                <tr class="table-placeholder">
                                    <td colspan="7">
                                        <i class="fas fa-history"></i>
                                        <p>No order history yet. <a href="{{ route('menu') }}" style="color:#c0392b;font-weight:600;">Place your first order!</a></p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
