@extends('layouts.frontend')

@section('title', 'Table Order - Restoran SUP TULANG ZZ')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/qr-order.css') }}">
@endsection

@section('content')
<main class="qr-order-page" id="tableSelectionScreen">
    <div class="container">
        <div class="selection-image">
            <img src="{{ asset('assets/images/About 2.jpeg') }}" alt="Welcome to Restoran SUP TULANG ZZ">
        </div>
        <div class="selection-welcome">
            <h1>Welcome!</h1>
            <p>Please select your table and number of guests</p>
        </div>
        <div class="scrollers-container">
            <div class="scroller-group">
                <label>Table Number</label>
                <div class="scroller-wrapper">
                    <button class="scroller-btn scroller-up" data-target="table"><i class="fas fa-chevron-up"></i></button>
                    <div class="scroller-display"><span class="scroller-value" id="tableValue">1</span></div>
                    <button class="scroller-btn scroller-down" data-target="table"><i class="fas fa-chevron-down"></i></button>
                </div>
            </div>
        </div>
        <div class="dinein-btn-container">
            <button class="btn-dine-in" id="btnDineIn"><i class="fas fa-utensils"></i> Dine In</button>
        </div>
    </div>
</main>

<main class="menu-order-page" id="menuOrderScreen" style="display: none;">
    <div class="container">
        <div class="table-info-bar">
            <div class="table-info-left">
                <i class="fas fa-utensils"></i>
                <div><span class="table-label">Table</span><span class="table-number" id="displayTableNumber">1</span></div>
            </div>
            <div class="table-info-center"><i class="fas fa-users"></i><span id="displayPax">1 pax</span></div>
            <div class="table-info-right"><button class="btn-change-table" id="btnChangeTable"><i class="fas fa-exchange-alt"></i> Change</button></div>
        </div>

        <div class="menu-search">
            <i class="fas fa-search"></i>
            <input type="text" id="menuSearch" placeholder="Search menu...">
            <button id="searchClear" style="display: none;"><i class="fas fa-times"></i></button>
        </div>

        <div class="category-filter" id="categoryFilter">
            <button class="filter-btn active" data-category="all"><i class="fas fa-th-large"></i> All</button>
            <button class="filter-btn" data-category="signature-sup"><i class="fas fa-crown"></i> Sup ZZ</button>
            <button class="filter-btn" data-category="signature-mee"><i class="fas fa-crown"></i> Mee Rebus ZZ</button>
            <button class="filter-btn" data-category="sarapan-panas"><i class="fas fa-coffee"></i> Sarapan Panas</button>
            <button class="filter-btn filter-more" id="btnMore"><i class="fas fa-chevron-down"></i> More</button>
            <span class="more-categories" id="moreCategories" style="display: none;">
                <button class="filter-btn" data-category="sarapan-roti"><i class="fas fa-bread-slice"></i> Roti Bakar</button>
                <button class="filter-btn" data-category="roti-canai"><i class="fas fa-bread-slice"></i> Roti Canai</button>
                <button class="filter-btn" data-category="set-nasi"><i class="fas fa-utensils"></i> Set Nasi</button>
                <button class="filter-btn" data-category="ikan-siakap"><i class="fas fa-fish"></i> Ikan Siakap</button>
                <button class="filter-btn" data-category="ikan-bakar"><i class="fas fa-fire"></i> Bakar-Bakar</button>
                <button class="filter-btn" data-category="western"><i class="fas fa-hamburger"></i> Western</button>
                <button class="filter-btn" data-category="goreng-nasi"><i class="fas fa-hotdog"></i> Nasi Goreng</button>
                <button class="filter-btn" data-category="goreng-mee"><i class="fas fa-hotdog"></i> Mee Goreng</button>
                <button class="filter-btn" data-category="drinks-noncoffee"><i class="fas fa-mug-hot"></i> Drinks</button>
                <button class="filter-btn" data-category="drinks-jus"><i class="fas fa-glass-water"></i> Jus</button>
                <button class="filter-btn" data-category="drinks-dessert"><i class="fas fa-ice-cream"></i> Dessert</button>
            </span>
        </div>

        <div class="menu-grid" id="menuGrid"></div>
        <div class="no-results" id="noResults" style="display: none;"><i class="fas fa-utensils"></i><p>No items found</p></div>
    </div>
</main>

<div class="order-summary-bar" id="orderSummaryBar" style="display: none;">
    <div class="order-summary-content">
        <div class="order-summary-left" id="btnToggleOrder">
            <div class="order-icon"><i class="fas fa-receipt"></i><span class="order-count-badge" id="orderCountBadge">0</span></div>
            <div class="order-info"><span class="order-label">Your Order</span><span class="order-total" id="orderTotal">RM 0.00</span></div>
            <i class="fas fa-chevron-up order-toggle-icon" id="orderToggleIcon"></i>
        </div>
        <button class="btn-place-order" id="btnPlaceOrder" disabled><i class="fas fa-paper-plane"></i> Place Order</button>
    </div>
    <div class="order-items-panel" id="orderItemsPanel" style="display: none;">
        <div class="order-items-header"><h3>Order Details</h3><button class="btn-clear-order" id="btnClearOrder"><i class="fas fa-trash-alt"></i> Clear All</button></div>
        <div class="order-items-list" id="orderItemsList"></div>
        <div class="order-empty" id="orderEmpty"><i class="fas fa-clipboard-list"></i><p>No items added yet. Tap + to add items!</p></div>
    </div>
</div>

<div class="modal-overlay" id="placeOrderModal" style="display: none;">
    <div class="modal-card confirm-order-modal">
        <div class="modal-icon-wrapper"><i class="fas fa-clipboard-check"></i></div>
        <h2>Confirm Your Order</h2>
        <div class="confirm-order-details">
            <div class="confirm-row"><span>Table</span><strong id="confirmTable">1</strong></div>
            <div class="confirm-row"><span>Guests</span><strong id="confirmPax">1</strong></div>
            <div class="confirm-row"><span>Items</span><strong id="confirmItems">0</strong></div>
            <div class="confirm-row confirm-total"><span>Total</span><strong id="confirmTotal">RM 0.00</strong></div>
        </div>
        <div class="confirm-special-instructions">
            <label for="specialInstructions">Special Instructions (optional)</label>
            <textarea id="specialInstructions" rows="3" placeholder="e.g. Less spicy, no onions..."></textarea>
        </div>
        <div class="modal-actions">
            <button class="btn-cancel" id="btnCancelOrder">Cancel</button>
            <button class="btn-confirm" id="btnConfirmOrder"><i class="fas fa-check-circle"></i> Confirm Order</button>
        </div>
    </div>
</div>

<div class="modal-overlay" id="successModal" style="display: none;">
    <div class="modal-card success-modal-card">
        <div class="success-icon-wrapper"><i class="fas fa-check-circle"></i></div>
        <h2>Order Placed Successfully!</h2>
        <p>Your order has been sent to the kitchen.</p>
        <div class="order-id-display"><span>Order ID: <strong id="successOrderId">#001</strong></span></div>
        <div class="modal-actions">
            <a href="{{ route('customer.order-status') }}" class="btn-primary"><i class="fas fa-eye"></i> Track Order</a>
            <button class="btn-secondary-modal" id="btnCloseSuccess">Close</button>
        </div>
    </div>
</div>

<div class="toast-container" id="toastContainer"></div>
@endsection

@section('scripts')
    <script>
        window.orderStatusUrl = @json(route('customer.order-status'));
    </script>
    <script src="{{ asset('assets/js/qr-order.js') }}"></script>
@endsection
