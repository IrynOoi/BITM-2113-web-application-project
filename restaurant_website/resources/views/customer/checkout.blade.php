<!-- checkout.blade.php -->
@extends('layouts.frontend')

@section('title', 'Checkout - Restoran SUP TULANG ZZ')

@section('styles')
    <style>
        .checkout-page {
            padding: 32px 0 60px;
        }

        .checkout-page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .checkout-page-header h1 {
            font-size: 1.8rem;
            font-weight: 800;
            color: #2c3e50;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .checkout-page-header h1 i,
        .checkout-card h2 i {
            color: #c0392b;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #c0392b;
            font-weight: 500;
            font-size: 0.9rem;
            text-decoration: none;
            transition: gap 0.2s;
        }

        .back-link:hover {
            gap: 10px;
        }

        .checkout-layout {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 24px;
            align-items: start;
        }

        .checkout-card,
        .checkout-summary-card {
            background: #fff;
            border-radius: 16px;
            padding: 28px;
            border: 1px solid #f0ebe4;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
        }

        .checkout-card {
            margin-bottom: 20px;
        }

        .checkout-card h2,
        .checkout-summary-card h2 {
            font-size: 1.1rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
            padding-bottom: 14px;
            border-bottom: 2px solid #fdf0ef;
        }

        .checkout-form {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-group label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #2c3e50;
        }

        .required {
            color: #c0392b;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper>i:first-child {
            position: absolute;
            left: 14px;
            color: #aaa;
            font-size: 0.875rem;
            pointer-events: none;
        }

        .input-wrapper input,
        .input-wrapper textarea {
            width: 100%;
            padding: 11px 14px 11px 40px;
            border: 2px solid #e8e0d8;
            border-radius: 10px;
            font-size: 0.9rem;
            font-family: inherit;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            background: #fff;
            color: #2c3e50;
        }

        .input-wrapper textarea {
            resize: vertical;
            padding-top: 10px;
        }

        .input-wrapper input:focus,
        .input-wrapper textarea:focus {
            border-color: #c0392b;
            box-shadow: 0 0 0 3px rgba(192, 57, 43, 0.08);
        }

        .order-type-toggle {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .order-type-btn {
            flex: 1;
            cursor: pointer;
            min-width: 100px;
        }

        .order-type-btn input,
        .payment-option input {
            display: none;
        }

        .order-type-btn span {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 11px 14px;
            border: 2px solid #e8e0d8;
            border-radius: 10px;
            font-size: 0.875rem;
            font-weight: 600;
            color: #555;
            background: #fafafa;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .order-type-btn input:checked+span,
        .payment-option input:checked+.payment-label {
            border-color: #c0392b;
            background: #fdf0ef;
            color: #c0392b;
        }

        .payment-methods {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .payment-option {
            cursor: pointer;
        }

        .payment-label {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 16px 18px;
            border: 2px solid #e8e0d8;
            border-radius: 12px;
            transition: all 0.2s;
            background: #fafafa;
        }

        .payment-label>i {
            font-size: 1.4rem;
            color: #c0392b;
            width: 28px;
            text-align: center;
        }

        .payment-label strong {
            display: block;
            font-size: 0.9rem;
            color: #2c3e50;
        }

        .payment-label small {
            font-size: 0.78rem;
            color: #999;
        }

        .checkout-summary-section {
            position: sticky;
            top: 120px;
        }

        .summary-items {
            margin-bottom: 16px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            padding: 7px 0;
            font-size: 0.875rem;
            border-bottom: 1px solid #f8f4f0;
        }

        .summary-item-name {
            color: #444;
            flex: 1;
            padding-right: 10px;
        }

        .qty-badge {
            font-size: 0.75rem;
            color: #999;
            background: #f0ebe4;
            padding: 1px 6px;
            border-radius: 10px;
            margin-left: 4px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 6px 0;
            font-size: 0.875rem;
            color: #666;
        }

        .summary-divider {
            border: 0;
            border-top: 2px solid #f0ebe4;
            margin: 14px 0;
        }

        .summary-total {
            font-size: 1.1rem;
            font-weight: 800;
            color: #2c3e50;
            padding-top: 12px;
            margin-top: 6px;
            border-top: 2px solid #2c3e50;
        }

        .empty-cart-msg,
        .summary-loading {
            text-align: center;
            color: #aaa;
            padding: 16px;
            font-size: 0.9rem;
        }

        .empty-cart-msg a {
            color: #c0392b;
        }

        .btn-place-order {
            width: 100%;
            margin-top: 20px;
            padding: 15px;
            background: linear-gradient(135deg, #c0392b, #e74c3c);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s;
            box-shadow: 0 4px 14px rgba(192, 57, 43, 0.35);
        }

        .btn-place-order:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(192, 57, 43, 0.45);
        }

        .btn-place-order:disabled {
            background: #ddd;
            color: #aaa;
            box-shadow: none;
            cursor: not-allowed;
        }

        .secure-badge {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: 10px;
            font-size: 0.75rem;
            color: #aaa;
        }

        .secure-badge i {
            color: #27ae60;
        }

        @media (max-width: 900px) {
            .checkout-layout {
                grid-template-columns: 1fr;
            }

            .checkout-summary-section {
                position: static;
            }
        }

        @media (max-width: 540px) {
            .form-row {
                grid-template-columns: 1fr;
            }

            .order-type-toggle {
                flex-direction: column;
            }

            .checkout-card {
                padding: 20px;
            }
        }
    </style>
@endsection

@section('content')
    <main class="checkout-page">
        <div class="container">
            <div class="checkout-page-header">
                <h1><i class="fas fa-credit-card"></i> Checkout</h1>
                <a href="{{ route('customer.cart') }}" class="back-link"><i class="fas fa-arrow-left"></i> Back to Cart</a>
            </div>

            <form class="checkout-layout" id="checkoutForm" method="POST" action="{{ route('customer.orders.store') }}">
                @csrf
                <input type="hidden" name="cartData" id="cartData">
                <input type="hidden" name="paymentMethod" id="paymentMethodHidden" value="cash">

                <div class="checkout-form-section">
                    <div class="checkout-card">
                        <h2><i class="fas fa-truck"></i> Delivery / Pickup Details</h2>
                        <div class="checkout-form">
                            <div class="form-group">
                                <label>Order Type <span class="required">*</span></label>
                                <div class="order-type-toggle">
                                    <label class="order-type-btn">
                                        <input type="radio" name="orderType" value="takeaway" id="typeTakeaway">
                                        <span><i class="fas fa-shopping-bag"></i> Takeaway</span>
                                    </label>
                                    <label class="order-type-btn">
                                        <input type="radio" name="orderType" value="delivery" id="typeDelivery" checked>
                                        <span><i class="fas fa-motorcycle"></i> Delivery</span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="custName">Full Name <span class="required">*</span></label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-user"></i>
                                        <input type="text" id="custName" name="custName"
                                            value="{{ old('custName', Auth::user()->full_name) }}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="custPhone">Phone Number <span class="required">*</span></label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-phone"></i>
                                        <input type="tel" id="custPhone" name="custPhone"
                                            value="{{ old('custPhone', Auth::user()->phone) }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" id="addressSection">
                                <label for="address">Delivery Address <span class="required">*</span></label>
                                <div class="input-wrapper">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <textarea id="address" name="address" rows="3"
                                        placeholder="Enter your full delivery address">{{ old('address', Auth::user()->address) }}</textarea>
                                </div>
                            </div>

                            <div class="form-group" id="tableSection" style="display:none;">
                                <label for="tableNumber">Table Number <span class="required">*</span></label>
                                <div class="input-wrapper">
                                    <i class="fas fa-chair"></i>
                                    <input type="number" id="tableNumber" name="tableNumber"
                                        placeholder="Enter table number" min="1">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="notes">Special Requests / Allergies</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-comment"></i>
                                    <textarea id="notes" name="notes" rows="2"
                                        placeholder="Any special requests or dietary requirements?"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="checkout-card">
                        <h2><i class="fas fa-wallet"></i> Payment</h2>
                        <div class="payment-methods">
                            <label class="payment-option">
                                <input type="radio" name="paymentMethodUi" value="cash" checked>
                                <span class="payment-label">
                                    <i class="fas fa-money-bill-wave"></i>
                                    <div><strong>Cash on Delivery / At Counter</strong><small>Pay when you receive your
                                            order</small></div>
                                </span>
                            </label>
                            <label class="payment-option">
                                <input type="radio" name="paymentMethodUi" value="online_transfer">
                                <span class="payment-label">
                                    <i class="fas fa-mobile-alt"></i>
                                    <div><strong>Online Transfer / DuitNow</strong><small>Upload receipt to staff if
                                            requested</small></div>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="checkout-summary-section">
                    <div class="checkout-summary-card">
                        <h2>Order Summary</h2>
                        <div class="summary-items" id="summaryItems">
                            <p class="summary-loading"><i class="fas fa-spinner fa-spin"></i> Loading cart...</p>
                        </div>
                        <div class="summary-divider"></div>
                        <div class="summary-row"><span>Subtotal</span><span id="checkoutSubtotal">RM 0.00</span></div>
                        <div class="summary-row" id="deliveryFeeRow"><span>Delivery Fee</span><span id="deliveryFee">RM
                                3.00</span></div>
                        <div class="summary-row"><span>Tax (6% SST)</span><span id="checkoutTax">RM 0.00</span></div>
                        <div class="summary-row summary-total"><span>Total</span><span id="checkoutTotal">RM 0.00</span>
                        </div>
                        <button type="submit" class="btn-place-order" id="btnPlaceOrder">
                            <i class="fas fa-check-circle"></i> Place Order
                        </button>
                        <div class="secure-badge"><i class="fas fa-lock"></i> Secured order submission</div>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            loadCheckoutSummary();
            setupOrderTypeToggle();
            setupPaymentToggle();

            document.getElementById('checkoutForm').addEventListener('submit', function (event) {
                const cart = JSON.parse(localStorage.getItem('restaurantCart') || '[]');
                if (cart.length === 0) {
                    event.preventDefault();
                    window.location.href = @json(route('customer.cart'));
                    return;
                }
                document.getElementById('cartData').value = JSON.stringify(cart);
            });
        });

        function loadCheckoutSummary() {
            const cart = JSON.parse(localStorage.getItem('restaurantCart') || '[]');
            const container = document.getElementById('summaryItems');
            if (cart.length === 0) {
                container.innerHTML = '<p class="empty-cart-msg"><i class="fas fa-shopping-basket"></i> Your cart is empty. <a href="{{ route('menu') }}">Browse menu</a></p>';
                document.getElementById('btnPlaceOrder').disabled = true;
                return;
            }
            let subtotal = 0;
            container.innerHTML = cart.map(item => {
                const lineTotal = item.price * item.quantity;
                subtotal += lineTotal;
                return `<div class="summary-item">
                    <span class="summary-item-name">${item.name} <span class="qty-badge">x${item.quantity}</span></span>
                    <span class="summary-item-price">RM ${lineTotal.toFixed(2)}</span>
                </div>`;
            }).join('');
            const deliveryType = document.querySelector('input[name="orderType"]:checked')?.value;
            const deliveryFee = deliveryType === 'delivery' ? 3.00 : 0.00;
            const tax = subtotal * 0.06;
            const total = subtotal + tax + deliveryFee;
            document.getElementById('checkoutSubtotal').textContent = 'RM ' + subtotal.toFixed(2);
            document.getElementById('checkoutTax').textContent = 'RM ' + tax.toFixed(2);
            document.getElementById('checkoutTotal').textContent = 'RM ' + total.toFixed(2);
            document.getElementById('deliveryFee').textContent = 'RM ' + deliveryFee.toFixed(2);
        }

        function setupOrderTypeToggle() {
            document.querySelectorAll('input[name="orderType"]').forEach(radio => {
                radio.addEventListener('change', function () {
                    document.getElementById('addressSection').style.display = this.value === 'delivery' ? 'block' : 'none';
                    document.getElementById('tableSection').style.display = this.value === 'dine-in' ? 'block' : 'none';
                    document.getElementById('deliveryFeeRow').style.display = this.value === 'delivery' ? 'flex' : 'none';
                    loadCheckoutSummary();
                });
            });
        }

        function setupPaymentToggle() {
            document.querySelectorAll('input[name="paymentMethodUi"]').forEach(radio => {
                radio.addEventListener('change', function () {
                    document.getElementById('paymentMethodHidden').value = this.value;
                });
            });
        }
    </script>
@endsection