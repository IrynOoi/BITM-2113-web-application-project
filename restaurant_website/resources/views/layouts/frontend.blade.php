<!-- frontend.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Restoran SUP TULANG ZZ')</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @yield('styles')
</head>

<body>
    <!-- ========== TOP HEADER ========== -->
    <header class="header">
        <div class="header-container">
            <a href="{{ url('/') }}" class="logo">
                <img src="{{ asset('assets/images/Logo.jpeg') }}" alt="Restoran SUP TULANG ZZ Logo" class="logo-img">
                <h1>Restoran SUP TULANG ZZ</h1>
            </a>
            <div class="header-icons">
                <a href="{{ route('customer.order-status') }}" class="icon-link" title="Track Order">
                    <i class="fas fa-receipt"></i>
                </a>
                <a href="{{ route('customer.cart') }}" class="icon-link">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-badge" id="cartBadge">0</span>
                </a>
                <button class="menu-toggle" id="menuToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
        <nav class="desktop-nav" id="desktopNav">
            <ul>
                <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ url('menu') }}" class="{{ request()->is('menu') ? 'active' : '' }}">Menu</a></li>
                <li><a href="{{ url('news-events') }}" class="{{ request()->is('news-events') ? 'active' : '' }}">News
                        &amp; Events</a></li>
                <li><a href="{{ url('about') }}" class="{{ request()->is('about') ? 'active' : '' }}">About</a></li>
                <li><a href="{{ url('contact') }}" class="{{ request()->is('contact') ? 'active' : '' }}">Contact</a>
                </li>
                @auth
                    <li><a href="{{ Auth::user()->role === 'customer' ? route('customer.dashboard') : route('staff.dashboard') }}"
                            class="btn-login">
                            <i class="fas fa-user"></i> {{ Auth::user()->name ?? Auth::user()->full_name ?? 'Dashboard' }}
                        </a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" style="display:inline;" id="logoutForm">
                            @csrf
                            <a href="{{ route('logout') }}" class="btn-register"
                                onclick="event.preventDefault(); localStorage.removeItem('restaurantCart'); localStorage.removeItem('restaurantLastOrderType'); document.getElementById('logoutForm').submit();">Logout</a>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}"
                            class="btn-login {{ request()->routeIs('login') ? 'active' : '' }}">Login</a></li>
                    <li><a href="{{ route('register') }}"
                            class="btn-register {{ request()->routeIs('register') ? 'active' : '' }}">Register</a></li>
                @endauth
            </ul>
        </nav>
    </header>

    @yield('content')

    <!-- ========== FOOTER ========== -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-section">
                    <h3><img src="{{ asset('assets/images/Footer-logo.jpeg') }}" alt="Logo"
                            style="height:50px;width:auto;vertical-align:middle;"> Restoran SUP TULANG ZZ</h3>
                    <p>Delicious food, excellent service, memorable experience.</p>
                </div>
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="{{ url('/') }}"><i class="fas fa-chevron-right"></i> Home</a></li>
                        <li><a href="{{ url('menu') }}"><i class="fas fa-chevron-right"></i> Menu</a></li>
                        <li><a href="{{ url('news-events') }}"><i class="fas fa-chevron-right"></i> News &amp;
                                Events</a></li>
                        <li><a href="{{ url('about') }}"><i class="fas fa-chevron-right"></i> About</a></li>
                        <li><a href="{{ url('contact') }}"><i class="fas fa-chevron-right"></i> Contact</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Contact Us</h3>
                    <p><i class="fas fa-map-marker-alt"></i> Jalan Example, Taman Melaka Raya, 75000 Melaka</p>
                    <p><i class="fas fa-phone"></i> 012-3456789</p>
                    <p><i class="fas fa-envelope"></i> info@suptulangzz.com</p>
                </div>
                <div class="footer-section">
                    <h3>Follow Us</h3>
                    <div class="social-links">
                        <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook"></i></a>
                        <a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.tiktok.com/en/" target="_blank"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Restaurant SUP TULANG ZZ. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- ========== BOTTOM MOBILE NAVIGATION ========== -->
    <nav class="mobile-nav">
        <a href="{{ url('/') }}"><i class="fas fa-home"></i><span>Home</span></a>
        <a href="{{ url('menu') }}"><i class="fas fa-utensils"></i><span>Menu</span></a>
        <a href="{{ route('customer.cart') }}"><i class="fas fa-shopping-cart"></i><span>Cart</span></a>
        <a href="{{ route('customer.order-status') }}"><i class="fas fa-receipt"></i><span>Orders</span></a>
        @auth
            <a href="{{ Auth::user()->role === 'customer' ? route('customer.dashboard') : route('staff.dashboard') }}"><i
                    class="fas fa-user"></i><span>{{ Auth::user()->name ?? Auth::user()->full_name ?? 'Profile' }}</span></a>
        @else
            <a href="{{ route('login') }}"><i class="fas fa-user"></i><span>Login</span></a>
        @endauth
    </nav>

    <script>
        window.restaurantAssetBase = @json(asset('assets'));
        window.menuUrl = @json(route('menu'));
        document.addEventListener('DOMContentLoaded', function () {
            const menuToggle = document.getElementById('menuToggle');
            const desktopNav = document.getElementById('desktopNav');
            if (menuToggle && desktopNav) {
                menuToggle.addEventListener('click', function () {
                    desktopNav.classList.toggle('active');
                    this.querySelector('i').className =
                        desktopNav.classList.contains('active') ? 'fas fa-times' : 'fas fa-bars';
                });
                document.addEventListener('click', function (e) {
                    if (!menuToggle.contains(e.target) && !desktopNav.contains(e.target)) {
                        desktopNav.classList.remove('active');
                        menuToggle.querySelector('i').className = 'fas fa-bars';
                    }
                });
            }
            // Cart badge from localStorage
            const cart = JSON.parse(localStorage.getItem('restaurantCart') || '[]');
            const count = cart.reduce((sum, i) => sum + i.quantity, 0);
            const badge = document.getElementById('cartBadge');
            if (badge) { badge.textContent = count; badge.style.display = count > 0 ? 'flex' : 'none'; }
        });

    </script>
    @yield('scripts')
</body>

</html>