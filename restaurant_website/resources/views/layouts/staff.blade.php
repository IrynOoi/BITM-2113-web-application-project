<!-- staff.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Staff Panel - Restoran SUP TULANG ZZ')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/staff.css') }}">
    @yield('styles')
</head>

<body>
    <div class="staff-layout">
        <aside class="staff-sidebar" id="staffSidebar">
            <div class="sidebar-header">
                <img src="{{ asset('assets/images/Logo.jpeg') }}" alt="Logo" class="sidebar-logo">
                <h2>Staff Panel</h2>
            </div>

            <nav class="sidebar-nav">
                <a href="{{ route('staff.dashboard') }}"
                    class="nav-item {{ request()->routeIs('staff.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-th-large"></i> Dashboard
                </a>
                <a href="{{ route('staff.orders') }}"
                    class="nav-item {{ request()->routeIs('staff.orders') ? 'active' : '' }}">
                    <i class="fas fa-clipboard-list"></i> Manage Orders
                </a>
                <a href="{{ route('staff.menu') }}"
                    class="nav-item {{ request()->routeIs('staff.menu') ? 'active' : '' }}">
                    <i class="fas fa-utensils"></i> Manage Menu
                </a>
                <a href="{{ route('staff.tables') }}"
                    class="nav-item {{ request()->routeIs('staff.tables') ? 'active' : '' }}">
                    <i class="fas fa-chair"></i> Manage Tables
                </a>
                <a href="{{ route('staff.users') }}"
                    class="nav-item {{ request()->routeIs('staff.users') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> Manage Users
                </a>
                <a href="{{ route('staff.reports') }}"
                    class="nav-item {{ request()->routeIs('staff.reports') ? 'active' : '' }}">
                    <i class="fas fa-chart-line"></i> Reports
                </a>
            </nav>

            <div class="sidebar-footer">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-item"
                        style="width:100%;border:0;background:transparent;text-align:left;cursor:pointer;">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </aside>

        <button class="sidebar-toggle" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>

        <main class="staff-main">
            @yield('content')
        </main>
    </div>

    <script>
        document.getElementById('sidebarToggle')?.addEventListener('click', function () {
            document.getElementById('staffSidebar')?.classList.toggle('open');
        });
        window.restaurantAssetBase = @json(asset('assets'));
    </script>
    @yield('scripts')
</body>

</html>