<!-- menu.blade.php -->
@extends('layouts.frontend')

@section('title', 'Menu - Restoran SUP TULANG ZZ')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/menu.css') }}">
@endsection

@section('content')
    <!-- ========== MENU PAGE CONTENT ========== -->
    <main class="menu-page">
        <div class="container">
            <!-- Page Title -->
            <div class="menu-page-header">
                <h1>Our Menu</h1>
                <p>Explore our delicious selection of authentic Malaysian cuisine</p>
            </div>

            <!-- Search Bar -->
            <div class="menu-search">
                <i class="fas fa-search"></i>
                <input type="text" id="menuSearch" placeholder="Search for dishes...">
                <button id="searchClear" style="display: none;">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Category Filter -->
            <div class="category-filter" id="categoryFilter">
                <button class="filter-btn active" data-category="all">
                    <i class="fas fa-th-large"></i> All
                </button>

                <button class="filter-btn" data-category="signature-sup">
                    <i class="fas fa-crown"></i> Sup ZZ
                </button>

                <button class="filter-btn" data-category="signature-mee">
                    <i class="fas fa-crown"></i> Mee Rebus ZZ
                </button>

                <button class="filter-btn" data-category="sarapan-panas">
                    <i class="fas fa-coffee"></i> Sarapan Panas
                </button>

                <button class="filter-btn" data-category="sarapan-roti">
                    <i class="fas fa-bread-slice"></i> Roti Bakar
                </button>

                <button class="filter-btn" data-category="roti-canai">
                    <i class="fas fa-bread-slice"></i> Roti Canai
                </button>

                <button class="filter-btn" data-category="set-nasi">
                    <i class="fas fa-utensils"></i> Set Nasi
                </button>

                <button class="filter-btn" data-category="set-panas">
                    <i class="fas fa-utensils"></i> Set Masakan
                </button>

                <button class="filter-btn" data-category="ikan-siakap">
                    <i class="fas fa-fish"></i> Ikan Siakap
                </button>

                <button class="filter-btn" data-category="ikan-bakar">
                    <i class="fas fa-fire"></i> Bakar-Bakar
                </button>

                <button class="filter-btn" data-category="alacarte-sayur">
                    <i class="fas fa-leaf"></i> Sayur
                </button>

                <button class="filter-btn" data-category="alacarte-lauk">
                    <i class="fas fa-book-open"></i> Lauk Thai
                </button>

                <button class="filter-btn" data-category="alacarte-tepung">
                    <i class="fas fa-book-open"></i> Goreng Tepung
                </button>

                <button class="filter-btn" data-category="alacarte-sup">
                    <i class="fas fa-mug-hot"></i> Sup Ala Thai
                </button>

                <button class="filter-btn" data-category="alacarte-tomyam">
                    <i class="fas fa-pepper-hot"></i> Tomyam
                </button>

                <button class="filter-btn" data-category="alacarte-meekuah">
                    <i class="fas fa-book-open"></i> Mee Kuah
                </button>

                <button class="filter-btn" data-category="western">
                    <i class="fas fa-hamburger"></i> Western
                </button>

                <button class="filter-btn" data-category="goreng-nasi">
                    <i class="fas fa-hotdog"></i> Nasi Goreng
                </button>

                <button class="filter-btn" data-category="goreng-mee">
                    <i class="fas fa-hotdog"></i> Mee Goreng
                </button>

                <button class="filter-btn" data-category="drinks-noncoffee">
                    <i class="fas fa-mug-hot"></i> Drinks
                </button>

                <button class="filter-btn" data-category="drinks-jus">
                    <i class="fas fa-glass-water"></i> Jus
                </button>

                <button class="filter-btn" data-category="drinks-dessert">
                    <i class="fas fa-ice-cream"></i> Dessert
                </button>
            </div>

            <!-- Results Count -->
            <div class="menu-results-info">
                <span id="resultsCount">Showing all items</span>
                <span id="noResults" style="display: none;">
                    <i class="fas fa-search"></i> No dishes found. Try a different search!
                </span>
            </div>

            <!-- Menu Grid -->
            <div class="menu-grid" id="menuGrid">
                <!-- Menu items loaded dynamically via JavaScript -->
            </div>
        </div>
    </main>

    <!-- ========== FLOATING CART BUTTON ========== -->
    <a href="{{ url('customer/cart') }}" class="floating-cart" id="floatingCart">
        <i class="fas fa-shopping-cart"></i>
        <span class="floating-cart-count" id="floatingCartCount">0</span>
        <span class="floating-cart-text">View Cart</span>
    </a>

    <!-- ========== ADD TO CART TOAST ========== -->
    <div class="toast-container" id="toastContainer"></div>

    <!-- ========== PDF MENU CTA SECTION ========== -->
    <section class="section pdf-menu-section">
        <div class="container">
            <div class="pdf-menu-card">
                <h3>For More Menu：</h3>
                <a href="{{ asset('assets/pdf/Menu.pdf') }}" target="_blank" class="btn-see-more">
                    <i class="fas fa-file-pdf"></i> See More
                </a>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/api.js') }}"></script>
    <script src="{{ asset('assets/js/menu.js') }}"></script>
@endsection