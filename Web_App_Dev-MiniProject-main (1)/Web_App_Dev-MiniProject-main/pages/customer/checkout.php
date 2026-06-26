<!-- checkout.php -->
<?php if (session_status() === PHP_SESSION_NONE)
    session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Restoran SUP TULANG ZZ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">

    <style>
        /* ── Checkout Page Layout ── */
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

        .checkout-page-header h1 i {
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

        /* ── Two-column layout ── */
        .checkout-layout {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 24px;
            align-items: start;
        }

        /* ── Cards ── */
        .checkout-card {
            background: #fff;
            border-radius: 16px;
            padding: 28px;
            margin-bottom: 20px;
            border: 1px solid #f0ebe4;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
        }

        .checkout-card h2 {
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

        .checkout-card h2 i {
            color: #c0392b;
        }

        /* ── Order Type Toggle ── */
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

        .order-type-btn input {
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

        .order-type-btn input:checked+span {
            border-color: #c0392b;
            background: #fdf0ef;
            color: #c0392b;
        }

        .order-type-btn span i {
            font-size: 0.95rem;
        }

        /* ── Form Fields ── */
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
        .input-wrapper textarea,
        .input-wrapper select {
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

        .error-message {
            font-size: 0.78rem;
            color: #e74c3c;
            display: none;
        }

        /* ── Payment Methods ── */
        .payment-methods {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .payment-option {
            cursor: pointer;
        }

        .payment-option input {
            display: none;
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

        .payment-option input:checked+.payment-label {
            border-color: #c0392b;
            background: #fdf0ef;
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

        /* ── Receipt Upload ── */
        .receipt-upload {
            margin-top: 16px;
        }

        .upload-area {
            border: 2px dashed #e8e0d8;
            border-radius: 12px;
            padding: 28px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            background: #fafafa;
        }

        .upload-area:hover,
        .upload-area.dragover {
            border-color: #c0392b;
            background: #fdf0ef;
        }

        .upload-area i {
            font-size: 2rem;
            color: #ccc;
            margin-bottom: 8px;
        }

        .upload-area p {
            font-size: 0.9rem;
            color: #777;
            margin-bottom: 4px;
        }

        .upload-area small {
            font-size: 0.75rem;
            color: #bbb;
        }

        .upload-area input[type="file"] {
            display: none;
        }

        .file-preview {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            background: #e8f5e9;
            border-radius: 10px;
            border: 1px solid #a5d6a7;
        }

        .file-preview i {
            color: #2e7d32;
        }

        .file-preview span {
            flex: 1;
            font-size: 0.875rem;
            color: #2e7d32;
        }

        .file-preview button {
            color: #999;
            cursor: pointer;
            border: none;
            background: none;
        }

        /* ── Summary Card (sticky) ── */
        .checkout-summary-section {
            position: sticky;
            top: 120px;
        }

        .checkout-summary-card {
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            border: 1px solid #f0ebe4;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
        }

        .checkout-summary-card h2 {
            font-size: 1.1rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 16px;
            padding-bottom: 14px;
            border-bottom: 2px solid #fdf0ef;
        }

        /* Summary items list */
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

        .summary-item:last-child {
            border-bottom: none;
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

        .summary-item-price {
            font-weight: 600;
            color: #2c3e50;
            white-space: nowrap;
        }

        .summary-divider {
            border: none;
            border-top: 2px solid #f0ebe4;
            margin: 14px 0;
        }

        /* Totals */
        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 6px 0;
            font-size: 0.875rem;
            color: #666;
        }

        .summary-total {
            font-size: 1.1rem;
            font-weight: 800;
            color: #2c3e50;
            padding-top: 12px;
            margin-top: 6px;
            border-top: 2px solid #2c3e50;
        }

        .empty-cart-msg {
            text-align: center;
            padding: 20px;
            color: #aaa;
            font-size: 0.9rem;
        }

        .empty-cart-msg a {
            color: #c0392b;
        }

        .summary-loading {
            text-align: center;
            color: #aaa;
            padding: 16px;
            font-size: 0.9rem;
        }

        /* ── Place Order Button ── */
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
            letter-spacing: 0.3px;
        }

        .btn-place-order:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(192, 57, 43, 0.45);
        }

        .btn-place-order:active {
            transform: translateY(0);
        }

        .btn-place-order:disabled {
            background: #ddd;
            color: #aaa;
            box-shadow: none;
            cursor: not-allowed;
        }

        /* ── Secure badge under button ── */
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

        /* ── Responsive ── */
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
</head>

<body>

    <!-- ========== HEADER ========== -->
    <?php include '../../includes/header.php'; ?>

    <!-- ========== CHECKOUT PAGE ========== -->
    <main class="checkout-page">
        <div class="container">
            <div class="checkout-page-header">
                <h1><i class="fas fa-credit-card"></i> Checkout</h1>
                <a href="cart.php" class="back-link">
                    <i class="fas fa-arrow-left"></i> Back to Cart
                </a>
            </div>

            <div class="checkout-layout">
                <!-- Left: Customer Details Form -->
                <div class="checkout-form-section">
                    <!-- Delivery Details -->
                    <div class="checkout-card">
                        <h2><i class="fas fa-truck"></i> Delivery / Pickup Details</h2>

                        <form class="checkout-form" id="checkoutForm" method="POST"
                            action="../../backend/api/orders.php">
                            <input type="hidden" name="action" value="place_order">

                            <!-- Order Type -->
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

                            <!-- Customer Info -->
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="custName">Full Name <span class="required">*</span></label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-user"></i>
                                        <input type="text" id="custName" name="custName" placeholder="Your full name"
                                            required>
                                    </div>
                                    <span class="error-message" id="custNameError"></span>
                                </div>
                                <div class="form-group">
                                    <label for="custPhone">Phone Number <span class="required">*</span></label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-phone"></i>
                                        <input type="tel" id="custPhone" name="custPhone" placeholder="01X-XXXXXXX"
                                            required>
                                    </div>
                                    <span class="error-message" id="custPhoneError"></span>
                                </div>
                            </div>

                            <!-- Delivery Address (shown for delivery) -->
                            <div class="form-group" id="addressSection">
                                <label for="address">Delivery Address <span class="required">*</span></label>
                                <div class="input-wrapper">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <textarea id="address" name="address" rows="3"
                                        placeholder="Enter your full delivery address"></textarea>
                                </div>
                                <span class="error-message" id="addressError"></span>
                            </div>

                            <!-- Table Number (shown for dine-in) -->
                            <div class="form-group" id="tableSection" style="display:none;">
                                <label for="tableNumber">Table Number <span class="required">*</span></label>
                                <div class="input-wrapper">
                                    <i class="fas fa-chair"></i>
                                    <input type="number" id="tableNumber" name="tableNumber"
                                        placeholder="Enter table number" min="1">
                                </div>
                                <span class="error-message" id="tableError"></span>
                            </div>

                            <!-- Special Notes -->
                            <div class="form-group">
                                <label for="notes">Special Requests / Allergies</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-comment"></i>
                                    <textarea id="notes" name="notes" rows="2"
                                        placeholder="Any special requests or dietary requirements?"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Payment Section -->
                    <div class="checkout-card">
                        <h2><i class="fas fa-wallet"></i> Payment</h2>

                        <div class="payment-methods">
                            <label class="payment-option">
                                <input type="radio" name="paymentMethod" value="cash" id="paymentCash" checked>
                                <span class="payment-label">
                                    <i class="fas fa-money-bill-wave"></i>
                                    <div>
                                        <strong>Cash on Delivery / At Counter</strong>
                                        <small>Pay when you receive your order</small>
                                    </div>
                                </span>
                            </label>
                            <label class="payment-option">
                                <input type="radio" name="paymentMethod" value="online_transfer" id="paymentTransfer">
                                <span class="payment-label">
                                    <i class="fas fa-mobile-alt"></i>
                                    <div>
                                        <strong>Online Transfer / DuitNow</strong>
                                        <small>Upload payment receipt below</small>
                                    </div>
                                </span>
                            </label>
                        </div>

                        <!-- Receipt Upload (shown for online transfer) -->
                        <div class="receipt-upload" id="receiptSection" style="display:none;">
                            <div class="form-group">
                                <label for="receipt">Payment Receipt <span class="required">*</span></label>
                                <div class="upload-area" id="uploadArea">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p>Click or drag to upload receipt</p>
                                    <small>Accepted: JPG, PNG, PDF (Max 5MB)</small>
                                    <input type="file" id="receipt" name="receipt" accept=".jpg,.jpeg,.png,.pdf">
                                </div>
                                <div class="file-preview" id="filePreview" style="display:none;">
                                    <i class="fas fa-file-check"></i>
                                    <span id="fileName"></span>
                                    <button type="button" id="removeFile"><i class="fas fa-times"></i></button>
                                </div>
                                <span class="error-message" id="receiptError"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Order Summary -->
                <div class="checkout-summary-section">
                    <div class="checkout-summary-card">
                        <h2>Order Summary</h2>
                        <div class="summary-items" id="summaryItems">
                            <!-- Items loaded from localStorage via JS -->
                            <p class="summary-loading"><i class="fas fa-spinner fa-spin"></i> Loading cart...</p>
                        </div>

                        <div class="summary-divider"></div>

                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span id="checkoutSubtotal">RM 0.00</span>
                        </div>
                        <div class="summary-row" id="deliveryFeeRow">
                            <span>Delivery Fee</span>
                            <span id="deliveryFee">RM 3.00</span>
                        </div>
                        <div class="summary-row">
                            <span>Tax (6% SST)</span>
                            <span id="checkoutTax">RM 0.00</span>
                        </div>
                        <div class="summary-row summary-total">
                            <span>Total</span>
                            <span id="checkoutTotal">RM 0.00</span>
                        </div>

                        <button type="submit" form="checkoutForm" class="btn-place-order" id="btnPlaceOrder">
                            <i class="fas fa-check-circle"></i> Place Order
                        </button>
                        <div class="secure-badge"><i class="fas fa-lock"></i> Secured & encrypted</div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- ========== FOOTER ========== -->
    <?php include '../../includes/footer.php'; ?>

    <script src="../../assets/js/cart.js"></script>
    <script src="../../assets/js/validation.js"></script>
    <script>
        // Load cart summary and handle order type toggle
        document.addEventListener('DOMContentLoaded', function () {
            loadCheckoutSummary();
            setupOrderTypeToggle();
            setupPaymentToggle();
            setupFileUpload();
        });

        function loadCheckoutSummary() {
            const cart = JSON.parse(localStorage.getItem('restaurantCart') || '[]');
            const container = document.getElementById('summaryItems');
            if (cart.length === 0) {
                container.innerHTML = '<p class="empty-cart-msg"><i class="fas fa-shopping-basket"></i> Your cart is empty. <a href="../menu.php">Browse menu</a></p>';
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
            document.querySelectorAll('input[name="paymentMethod"]').forEach(radio => {
                radio.addEventListener('change', function () {
                    document.getElementById('receiptSection').style.display = this.value === 'online_transfer' ? 'block' : 'none';
                });
            });
        }

        function setupFileUpload() {
            const fileInput = document.getElementById('receipt');
            const uploadArea = document.getElementById('uploadArea');
            const preview = document.getElementById('filePreview');
            const fileName = document.getElementById('fileName');
            const removeBtn = document.getElementById('removeFile');

            uploadArea.addEventListener('click', () => fileInput.click());
            uploadArea.addEventListener('dragover', e => { e.preventDefault(); uploadArea.classList.add('dragover'); });
            uploadArea.addEventListener('dragleave', () => uploadArea.classList.remove('dragover'));
            uploadArea.addEventListener('drop', e => {
                e.preventDefault();
                uploadArea.classList.remove('dragover');
                if (e.dataTransfer.files.length) {
                    fileInput.files = e.dataTransfer.files;
                    showFilePreview(e.dataTransfer.files[0]);
                }
            });
            fileInput.addEventListener('change', () => {
                if (fileInput.files.length) showFilePreview(fileInput.files[0]);
            });
            removeBtn.addEventListener('click', () => {
                fileInput.value = '';
                uploadArea.style.display = 'block';
                preview.style.display = 'none';
            });

            function showFilePreview(file) {
                fileName.textContent = file.name;
                uploadArea.style.display = 'none';
                preview.style.display = 'flex';
            }
        }
    </script>
</body>

</html>