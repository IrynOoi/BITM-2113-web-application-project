@extends('layouts.staff')

@section('title', 'Sales Reports - Restoran SUP TULANG ZZ')

@section('content')
<div class="staff-header">
    <h1>Sales Reports</h1>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon pending"><i class="fas fa-shopping-cart"></i></div>
        <div class="stat-info">
            <span class="stat-value">{{ $dailyOrders }}</span>
            <span class="stat-label">Daily Orders</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon orders"><i class="fas fa-money-bill-wave"></i></div>
        <div class="stat-info">
            <span class="stat-value">RM {{ number_format($dailyRevenue, 2) }}</span>
            <span class="stat-label">Daily Revenue</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon completed"><i class="fas fa-shopping-bag"></i></div>
        <div class="stat-info">
            <span class="stat-value">{{ $weeklyOrders }}</span>
            <span class="stat-label">Weekly Orders</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon tables"><i class="fas fa-chart-line"></i></div>
        <div class="stat-info">
            <span class="stat-value">RM {{ number_format($weeklyRevenue, 2) }}</span>
            <span class="stat-label">Weekly Revenue</span>
        </div>
    </div>
</div>

<div class="staff-section" style="margin-top: 30px;">
    <div class="section-top">
        <h2>Top 5 Bestselling Menu Items</h2>
    </div>
    <div class="table-responsive">
        <table class="staff-table">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Menu Item</th>
                    <th>Total Quantity Sold</th>
                </tr>
            </thead>
            <tbody>
                @forelse($topItems as $index => $item)
                    <tr>
                        <td>#{{ $index + 1 }}</td>
                        <td>{{ $item->item_name }}</td>
                        <td>{{ $item->total_quantity }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-4">No sales data available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
