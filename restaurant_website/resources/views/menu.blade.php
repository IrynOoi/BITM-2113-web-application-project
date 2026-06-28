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
                <button class="filter-btn" data-category="soup">
                    <i class="fas fa-mug-hot"></i> Soup
                </button>
                <button class="filter-btn" data-category="main">
                    <i class="fas fa-utensils"></i> Main
                </button>
                <button class="filter-btn" data-category="snacks">
                    <i class="fas fa-cookie-bite"></i> Snacks
                </button>
                <button class="filter-btn" data-category="drinks">
                    <i class="fas fa-glass-water"></i> Drinks
                </button>
                <button class="filter-btn" data-category="dessert">
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

    <!-- ========== ITEM DETAIL MODAL ========== -->
    <div id="itemModal" style="display:none; position:fixed; inset:0; z-index:9999; background:rgba(0,0,0,0.55); backdrop-filter:blur(3px); align-items:center; justify-content:center;">
        <div style="background:#fff; border-radius:20px; max-width:480px; width:90%; overflow:hidden; box-shadow:0 20px 60px rgba(0,0,0,0.25); animation:modalIn 0.25s ease;">
            <div style="position:relative;">
                <img id="modalImg" src="" alt="" style="width:100%; height:220px; object-fit:cover; display:block;">
                <button onclick="closeItemModal()" style="position:absolute; top:12px; right:12px; background:rgba(0,0,0,0.5); color:#fff; border:none; border-radius:50%; width:36px; height:36px; font-size:1rem; cursor:pointer; display:flex; align-items:center; justify-content:center;">
                    <i class="fas fa-times"></i>
                </button>
                <span id="modalBadge" style="position:absolute; top:12px; left:12px; background:#c0392b; color:#fff; padding:4px 12px; border-radius:20px; font-size:0.78rem; font-weight:700;"></span>
            </div>
            <div style="padding:22px 24px;">
                <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:8px;">
                    <h2 id="modalName" style="font-size:1.2rem; font-weight:800; color:#2c3e50; flex:1; padding-right:10px;"></h2>
                    <span id="modalPrice" style="font-size:1.3rem; font-weight:800; color:#c0392b; white-space:nowrap;"></span>
                </div>
                <p id="modalCategory" style="font-size:0.78rem; color:#aaa; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:10px;"></p>
                <p id="modalDesc" style="font-size:0.875rem; color:#666; line-height:1.6; margin-bottom:16px;"></p>
                <div id="modalRating" style="font-size:0.85rem; color:#f39c12; margin-bottom:18px;"></div>
                <div style="display:flex; align-items:center; justify-content:center; gap:14px; margin-bottom:18px;">
                    <button onclick="changeModalQty(-1)" style="width:36px; height:36px; border-radius:50%; border:2px solid #e0e0e0; background:#fff; font-size:1.1rem; cursor:pointer; font-weight:700; color:#2c3e50; display:flex; align-items:center; justify-content:center;">−</button>
                    <span id="modalQty" style="font-size:1.2rem; font-weight:800; color:#2c3e50; min-width:30px; text-align:center;">1</span>
                    <button onclick="changeModalQty(1)" style="width:36px; height:36px; border-radius:50%; border:2px solid #e0e0e0; background:#fff; font-size:1.1rem; cursor:pointer; font-weight:700; color:#2c3e50; display:flex; align-items:center; justify-content:center;">+</button>
                </div>
                <div style="display:flex; gap:10px;">
                    <button id="modalAddBtn" onclick="addToCartFromModal()" style="flex:1; padding:13px; background:linear-gradient(135deg,#c0392b,#e74c3c); color:#fff; border:none; border-radius:12px; font-size:0.95rem; font-weight:700; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:8px;">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                    <button onclick="closeItemModal()" style="padding:13px 20px; background:#f5f5f5; color:#666; border:none; border-radius:12px; font-size:0.875rem; cursor:pointer; font-weight:600;">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <style>
        @keyframes modalIn { from { transform:scale(0.92); opacity:0; } to { transform:scale(1); opacity:1; } }
    </style>

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
    @php
        $menuDataArray = $menuItems->map(function($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'category' => $item->category,
                'price' => (float)$item->price,
                'image' => $item->image_path ? Storage::url($item->image_path) : null,
                'description' => $item->description ?? '',
                'badge' => '',
                'rating' => 0,
                'spicy' => false,
            ];
        });
    @endphp
    <script>
        const menuData = @json($menuDataArray);
    </script>
    <script src="{{ asset('assets/js/api.js') }}"></script>
    <script src="{{ asset('assets/js/menu.js') }}"></script>
@endsection