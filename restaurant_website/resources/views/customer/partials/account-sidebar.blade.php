<!-- account-sidebar.blade.php -->
<aside class="dashboard-sidebar">
    <div class="sidebar-profile">
        <div class="profile-avatar"><i class="fas fa-user-circle"></i></div>
        <h3>{{ Auth::user()->full_name }}</h3>
        <p>{{ Auth::user()->email }}</p>
    </div>
    <nav class="sidebar-nav">
        <a href="{{ route('customer.dashboard') }}"
            class="{{ request()->routeIs('dashboard', 'customer.dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
        <a href="{{ route('customer.order-status') }}"
            class="{{ request()->routeIs('customer.order-status') ? 'active' : '' }}">
            <i class="fas fa-receipt"></i> Order Status
        </a>
        <a href="{{ route('customer.order-history') }}"
            class="{{ request()->routeIs('customer.order-history') ? 'active' : '' }}">
            <i class="fas fa-history"></i> Order History
        </a>
        <a href="{{ route('customer.profile') }}" class="{{ request()->routeIs('customer.profile') ? 'active' : '' }}">
            <i class="fas fa-user-edit"></i> Edit Profile
        </a>
        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
        </form>
    </nav>
</aside>