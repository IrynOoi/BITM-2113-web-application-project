<!-- cart.blade.php -->
@extends('layouts.frontend')

@section('title', 'Cart - Restoran SUP TULANG ZZ')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/cart.css') }}">
@endsection

@section('content')
    <main class="cart-page">
        <div class="container">
            <div class="cart-page-header">
                <h1><i class="fas fa-shopping-cart"></i> Your Cart</h1>
                <a href="{{ route('menu') }}" class="back-to-menu">
                    <i class="fas fa-arrow-left"></i> Continue Shopping
                </a>
            </div>

            <div class="cart-empty" id="cartEmpty">
                <i class="fas fa-shopping-basket"></i>
                <h2>Your cart is empty</h2>
                <p>Looks like you haven't added anything yet. Let's find something delicious!</p>
                <a href="{{ route('menu') }}" class="btn-primary">
                    <i class="fas fa-utensils"></i> Browse Menu
                </a>
            </div>

            <div class="cart-content" id="cartContent" style="display: none;">
                <div class="cart-layout">
                    <div class="cart-items-section">
                        <div class="cart-items-header">
                            <h2>Cart Items (<span id="cartItemCount">0</span>)</h2>
                            <button class="btn-clear-cart" id="btnClearCart">
                                <i class="fas fa-trash-alt"></i> Clear All
                            </button>
                        </div>
                        <div class="cart-items-list" id="cartItemsList"></div>
                    </div>

                    <div class="cart-summary-section">
                        <div class="cart-summary-card">
                            <h2>Order Summary</h2>
                            <div class="summary-row"><span>Subtotal</span><span id="summarySubtotal">RM 0.00</span></div>
                            <div class="summary-row"><span>Tax (6%)</span><span id="summaryTax">RM 0.00</span></div>
                            <div class="summary-row summary-total"><span>Total</span><span id="summaryTotal">RM 0.00</span>
                            </div>
                            <button class="btn-checkout" id="btnCheckout">
                                <i class="fas fa-lock"></i> Proceed to Checkout
                            </button>
                            <a href="{{ route('menu') }}" class="continue-shopping-link">
                                <i class="fas fa-plus-circle"></i> Add More Items
                            </a>
                        </div>

                        <div class="order-type-card">
                            <h3><i class="fas fa-concierge-bell"></i> Order Type</h3>
                            <div class="order-type-options">
                                <label class="order-type-option">
                                    <input type="radio" name="orderType" value="dine-in">
                                    <span class="option-content">
                                        <i class="fas fa-utensils"></i>
                                        <strong>Dine-In</strong>
                                        <small>Eat at restaurant</small>
                                    </span>
                                </label>
                                <label class="order-type-option">
                                    <input type="radio" name="orderType" value="online" checked>
                                    <span class="option-content">
                                        <i class="fas fa-motorcycle"></i>
                                        <strong>Takeaway / Delivery</strong>
                                        <small>Pickup or delivery</small>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="modal-overlay" id="confirmModal" style="display: none;">
        <div class="modal-card">
            <i class="fas fa-exclamation-triangle modal-icon"></i>
            <h3>Clear All Items?</h3>
            <p>This action cannot be undone. All items will be removed from your cart.</p>
            <div class="modal-actions">
                <button class="btn-cancel" id="btnCancelClear">Cancel</button>
                <button class="btn-confirm" id="btnConfirmClear">Yes, Clear All</button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        window.checkoutUrl = @json(route('customer.checkout'));
        window.qrOrderUrl = @json(route('customer.qr-order'));
    </script>
    <script src="{{ asset('assets/js/cart.js') }}"></script>
@endsection