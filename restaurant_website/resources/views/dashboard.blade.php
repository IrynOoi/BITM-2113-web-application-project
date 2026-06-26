<!-- dashboard.blade.php -->
@extends('layouts.frontend')

@section('title', 'My Dashboard - Restoran SUP TULANG ZZ')

@section('styles')
    <style>
        /* ── Dashboard Layout ── */
        .dashboard-page {
            padding: 40px 0 60px;
            background: #f9f9f9;
        }

        .dashboard-layout {
            display: grid;
            grid-template-columns: 260px 1fr;
            gap: 28px;
            align-items: start;
        }

        /* ── Sidebar ── */
        .dashboard-sidebar {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid #f0ebe4;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 140px;
        }

        .sidebar-profile {
            padding: 28px 20px;
            text-align: center;
            background: linear-gradient(135deg, #c0392b, #96281b);
            color: #fff;
        }

        .sidebar-profile .profile-avatar {
            font-size: 3.5rem;
            margin-bottom: 10px;
            opacity: 0.9;
        }

        .sidebar-profile h3 {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .sidebar-profile p {
            font-size: 0.8rem;
            opacity: 0.8;
            margin: 0;
        }

        .sidebar-nav {
            padding: 10px 0;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 20px;
            font-size: 0.9rem;
            font-weight: 500;
            color: #2c3e50;
            text-decoration: none;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .sidebar-nav a:hover {
            background: #fdf6f0;
            color: #c0392b;
        }

        .sidebar-nav a.active {
            background: #fdf0ef;
            color: #c0392b;
            font-weight: 700;
            border-left-color: #c0392b;
        }

        .sidebar-nav a i {
            width: 18px;
            color: #c0392b;
            font-size: 0.95rem;
        }

        .sidebar-nav form.logout-form button {
            width: 100%;
            text-align: left;
            background: none;
            border: none;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 20px;
            font-size: 0.9rem;
            font-weight: 500;
            color: #999;
            cursor: pointer;
            margin-top: 4px;
            border-top: 1px solid #f0ebe4;
            transition: all 0.2s;
        }

        .sidebar-nav form.logout-form button:hover {
            color: #c0392b;
            background: #fdf0ef;
        }

        /* ── Main Content ── */
        .dashboard-main {
            min-width: 0;
        }

        .dashboard-header {
            margin-bottom: 24px;
        }

        .dashboard-header h1 {
            font-size: 1.6rem;
            font-weight: 800;
            color: #2c3e50;
            margin-bottom: 4px;
        }

        .dashboard-header p {
            color: #777;
            font-size: 0.9rem;
        }

        /* ── Stats Grid ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 14px;
            border: 1px solid #f0ebe4;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .stat-icon-blue {
            background: #e3f2fd;
            color: #1565c0;
        }

        .stat-icon-orange {
            background: #fff3e0;
            color: #e65100;
        }

        .stat-icon-green {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .stat-icon-red {
            background: #fce4ec;
            color: #c62828;
        }

        .stat-value {
            display: block;
            font-size: 1.6rem;
            font-weight: 800;
            color: #2c3e50;
            line-height: 1;
        }

        .stat-label {
            font-size: 0.78rem;
            color: #999;
            margin-top: 4px;
            display: block;
        }

        .address-card .address-text {
            font-size: 0.9rem;
            color: #444;
            line-height: 1.6;
            background: #fdf6f0;
            padding: 14px 16px;
            border-radius: 10px;
            border-left: 3px solid #c0392b;
        }

        .address-card .address-empty {
            font-size: 0.875rem;
            color: #999;
            padding: 14px 16px;
            background: #fafafa;
            border-radius: 10px;
            border: 1px dashed #e8e0d8;
            text-align: center;
        }

        /* ── Dashboard Sections ── */
        .dashboard-section {
            background: #fff;
            border-radius: 12px;
            padding: 24px;
            border: 1px solid #f0ebe4;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            margin-bottom: 20px;
        }

        .section-title-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .section-title-row h2 {
            font-size: 1.1rem;
            font-weight: 700;
            color: #2c3e50;
            margin: 0;
        }

        .view-all-link {
            font-size: 0.85rem;
            color: #c0392b;
            font-weight: 500;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* ── Orders Table ── */
        .orders-table-wrapper {
            overflow-x: auto;
        }

        .orders-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.875rem;
        }

        .orders-table th {
            background: #fdf6f0;
            padding: 11px 14px;
            text-align: left;
            font-weight: 600;
            color: #2c3e50;
            border-bottom: 2px solid #f0ebe4;
            white-space: nowrap;
        }

        .orders-table td {
            padding: 12px 14px;
            border-bottom: 1px solid #f8f4f0;
            color: #444;
            vertical-align: middle;
        }

        .orders-table tbody tr:hover {
            background: #fdf6f0;
        }

        .table-placeholder td {
            text-align: center;
            padding: 40px;
            color: #bbb;
            font-size: 0.9rem;
        }

        .table-placeholder i {
            font-size: 2.5rem;
            display: block;
            margin-bottom: 10px;
            opacity: 0.3;
        }

        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-pending {
            background: #fff3cd;
            color: #856404;
        }

        .badge-confirmed {
            background: #cce5ff;
            color: #004085;
        }

        .badge-preparing {
            background: #d4edda;
            color: #155724;
        }

        .badge-ready {
            background: #d1ecf1;
            color: #0c5460;
        }

        .badge-completed {
            background: #d4edda;
            color: #155724;
        }

        .badge-cancelled {
            background: #f8d7da;
            color: #721c24;
        }

        /* ── Quick Actions ── */
        .quick-actions-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
        }

        .quick-action-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 20px 14px;
            background: #fdf6f0;
            border-radius: 12px;
            border: 1px solid #f0ebe4;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 600;
            color: #2c3e50;
            transition: all 0.2s;
        }

        .quick-action-card:hover {
            background: #fdf0ef;
            border-color: #c0392b;
            color: #c0392b;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(192, 57, 43, 0.15);
        }

        .quick-action-card i {
            font-size: 1.5rem;
            color: #c0392b;
        }

        /* ── Responsive ── */
        @media (max-width: 1024px) {
            .dashboard-layout {
                grid-template-columns: 1fr;
            }

            .dashboard-sidebar {
                position: static;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .quick-actions-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
@endsection

@section('content')
    <main class="dashboard-page">
        <div class="container">
            @if(Auth::user()->role === 'admin' || Auth::user()->role === 'staff')
                <div class="dashboard-layout">
                    <div class="dashboard-main" style="grid-column: 1 / -1;">
                        <div class="dashboard-header">
                            <h1>Welcome back, {{ Auth::user()->role === 'admin' ? 'Admin' : 'Staff' }}
                                {{ Auth::user()->full_name }}! 👋
                            </h1>
                            <p>This is the {{ Auth::user()->role }} dashboard. We will port the full {{ Auth::user()->role }}
                                functionality soon.</p>
                            <form method="POST" action="{{ route('logout') }}" style="margin-top: 20px;">
                                @csrf
                                <button type="submit" class="quick-action-card"
                                    style="width: auto; padding: 10px 20px; display: inline-flex; flex-direction: row; cursor: pointer;">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <div class="dashboard-layout">
                    <!-- ── Sidebar ── -->
                    <aside class="dashboard-sidebar">
                        <div class="sidebar-profile">
                            <div class="profile-avatar"><i class="fas fa-user-circle"></i></div>
                            <h3>{{ Auth::user()->full_name }}</h3>
                            <p>{{ Auth::user()->email }}</p>
                        </div>
                        <nav class="sidebar-nav">
                            <a href="{{ route('dashboard') }}" class="active">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                            <a href="{{ route('customer.order-status') }}">
                                <i class="fas fa-receipt"></i> Order Status
                            </a>
                            <a href="{{ route('customer.order-history') }}">
                                <i class="fas fa-history"></i> Order History
                            </a>
                            <a href="{{ route('customer.profile') }}">
                                <i class="fas fa-user-edit"></i> Edit Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                                @csrf
                                <button type="submit">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </nav>
                    </aside>

                    <!-- ── Main Content ── -->
                    <div class="dashboard-main">

                        <div class="dashboard-header">
                            <h1>Welcome back, {{ explode(' ', Auth::user()->full_name)[0] }}! 👋</h1>
                            <p>Here's a summary of your activity.</p>
                        </div>

                        <!-- Stats -->
                        <div class="stats-grid">
                            <div class="stat-card">
                                <div class="stat-icon stat-icon-blue">
                                    <i class="fas fa-shopping-bag"></i>
                                </div>
                                <div>
                                    <span class="stat-value"
                                        id="totalOrders">{{ App\Models\Order::where('user_id', Auth::id())->count() }}</span>
                                    <span class="stat-label">Total Orders</span>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-icon stat-icon-orange">
                                    <i class="fas fa-hourglass-half"></i>
                                </div>
                                <div>
                                    <span class="stat-value"
                                        id="pendingOrders">{{ App\Models\Order::where('user_id', Auth::id())->whereIn('status', ['pending', 'preparing', 'confirmed'])->count() }}</span>
                                    <span class="stat-label">Pending</span>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-icon stat-icon-green">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <span class="stat-value"
                                        id="completedOrders">{{ App\Models\Order::where('user_id', Auth::id())->where('status', 'completed')->count() }}</span>
                                    <span class="stat-label">Completed</span>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-icon stat-icon-red">
                                    <i class="fas fa-wallet"></i>
                                </div>
                                <div>
                                    <span class="stat-value" id="totalSpent">RM
                                        {{ number_format(App\Models\Order::where('user_id', Auth::id())->where('status', 'completed')->sum('total'), 2) }}</span>
                                    <span class="stat-label">Total Spent</span>
                                </div>
                            </div>
                        </div>

                        <!-- Delivery Address -->
                        <div class="dashboard-section address-card">
                            <div class="section-title-row">
                                <h2><i class="fas fa-map-marker-alt" style="color:#c0392b;margin-right:8px;"></i>Delivery
                                    Address</h2>
                                <a href="{{ route('customer.profile') }}" class="view-all-link">
                                    <i class="fas fa-pen"></i> Edit
                                </a>
                            </div>
                            @if(Auth::user()->address)
                                <p class="address-text">{!! nl2br(e(Auth::user()->address)) !!}</p>
                            @else
                                <p class="address-empty">
                                    No address saved yet.
                                    <a href="{{ route('customer.profile') }}" style="color:#c0392b;font-weight:600;">Add your
                                        address</a>
                                    to enable faster delivery checkout.
                                </p>
                            @endif
                        </div>

                        <!-- Recent Orders -->
                        <div class="dashboard-section">
                            <div class="section-title-row">
                                <h2><i class="fas fa-receipt" style="color:#c0392b;margin-right:8px;"></i>Recent Orders</h2>
                                <a href="{{ route('customer.order-history') }}" class="view-all-link">
                                    View All <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                            <div class="orders-table-wrapper">
                                <table class="orders-table">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Date</th>
                                            <th>Total</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse(App\Models\Order::where('user_id', Auth::id())->orderBy('created_at', 'desc')->take(5)->get() as $order)
                                            <tr>
                                                <td>#{{ $order->id }}</td>
                                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                                <td>RM {{ number_format($order->total, 2) }}</td>
                                                <td>{{ ucfirst($order->order_type) }}</td>
                                                <td><span
                                                        class="badge badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
                                                </td>
                                                <td><a href="{{ route('customer.order-status', ['order_id' => $order->id]) }}"
                                                        style="color:#c0392b;">View</a></td>
                                            </tr>
                                        @empty
                                            <tr class="table-placeholder">
                                                <td colspan="6">
                                                    <i class="fas fa-receipt"></i>
                                                    No orders yet.
                                                    <a href="{{ url('menu') }}" style="color:#c0392b;font-weight:600;">
                                                        Place your first order!
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="dashboard-section">
                            <div class="section-title-row">
                                <h2><i class="fas fa-bolt" style="color:#c0392b;margin-right:8px;"></i>Quick Actions</h2>
                            </div>
                            <div class="quick-actions-grid">
                                <a href="{{ url('menu') }}" class="quick-action-card">
                                    <i class="fas fa-utensils"></i>
                                    <span>Order Now</span>
                                </a>
                                <a href="{{ route('customer.order-status') }}" class="quick-action-card">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>Track Order</span>
                                </a>
                                <a href="{{ route('customer.profile') }}" class="quick-action-card">
                                    <i class="fas fa-user-edit"></i>
                                    <span>Edit Profile</span>
                                </a>
                                <a href="{{ url('contact') }}" class="quick-action-card">
                                    <i class="fas fa-headset"></i>
                                    <span>Support</span>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            @endif
        </div>
    </main>
@endsection