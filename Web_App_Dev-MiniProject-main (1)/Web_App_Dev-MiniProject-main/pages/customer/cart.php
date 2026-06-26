<!-- cart.php -->
<?php if (session_status() === PHP_SESSION_NONE)
    session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Restoran SUP TULANG ZZ</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/cart.css">
</head>

<body>

    <!-- ========== TOP HEADER ========== -->
    <header class="header">
        <div class="header-container">
            <a href="../../index.php" class="logo">
                <img src="../../assets/images/Logo.jpeg" alt="Restoran SUP TULANG ZZ Logo" class="logo-img">
                <h1>Restoran SUP TULANG ZZ</h1>
            </a>

            <div class="header-icons">
                <a href="cart.php" class="icon-link">
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
                <li><a href="../../index.php">Home</a></li>
                <li><a href="../menu.php">Menu</a></li>
                <li><a href="../news-events.php">News & Events</a></li>
                <li><a href="../about.php">About</a></li>
                <li><a href="../contact.php">Contact</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="dashboard.php" class="btn-login">
                            <i class="fas fa-user"></i> <?= htmlspecialchars($_SESSION['user_name']) ?>
                        </a></li>
                    <li><a href="../../api/auth.php?action=logout" class="btn-register">Logout</a></li>
                <?php else: ?>
                    <li><a href="../login.php" class="btn-login">Login</a></li>
                    <li><a href="../register.php" class="btn-register">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <!-- ========== CART PAGE CONTENT ========== -->
    <main class="cart-page">
        <div class="container">
            <!-- Page Title -->
            <div class="cart-page-header">
                <h1><i class="fas fa-shopping-cart"></i> Your Cart</h1>
                <a href="../menu.php" class="back-to-menu">
                    <i class="fas fa-arrow-left"></i> Continue Shopping
                </a>
            </div>

            <!-- Empty Cart State -->
            <div class="cart-empty" id="cartEmpty">
                <i class="fas fa-shopping-basket"></i>
                <h2>Your cart is empty</h2>
                <p>Looks like you haven't added anything yet. Let's find something delicious!</p>
                <a href="../menu.php" class="btn-primary">
                    <i class="fas fa-utensils"></i> Browse Menu
                </a>
            </div>

            <!-- Cart Content -->
            <div class="cart-content" id="cartContent" style="display: none;">
                <div class="cart-layout">
                    <!-- Cart Items -->
                    <div class="cart-items-section">
                        <div class="cart-items-header">
                            <h2>Cart Items (<span id="cartItemCount">0</span>)</h2>
                            <button class="btn-clear-cart" id="btnClearCart">
                                <i class="fas fa-trash-alt"></i> Clear All
                            </button>
                        </div>

                        <div class="cart-items-list" id="cartItemsList">
                            <!-- Cart items loaded dynamically -->
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="cart-summary-section">
                        <div class="cart-summary-card">
                            <h2>Order Summary</h2>

                            <div class="summary-row">
                                <span>Subtotal</span>
                                <span id="summarySubtotal">RM 0.00</span>
                            </div>

                            <div class="summary-row">
                                <span>Tax (6%)</span>
                                <span id="summaryTax">RM 0.00</span>
                            </div>

                            <div class="summary-row summary-total">
                                <span>Total</span>
                                <span id="summaryTotal">RM 0.00</span>
                            </div>

                            <button class="btn-checkout" id="btnCheckout">
                                <i class="fas fa-lock"></i> Proceed to Checkout
                            </button>

                            <a href="../menu.php" class="continue-shopping-link">
                                <i class="fas fa-plus-circle"></i> Add More Items
                            </a>
                        </div>

                        <!-- Order Type Selection -->
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

    <!-- ========== CONFIRM CLEAR MODAL ========== -->
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

    <!-- ========== FOOTER ========== -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-section">
                    <h3><img src="../../assets/images/Footer-logo.jpeg" alt="Logo" style="height: 50px; width: auto;">
                        Restoran SUP TULANG ZZ</h3>
                    <p>Delicious food, excellent service, memorable experience.</p>
                </div>
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="../../index.php"><i class="fas fa-chevron-right"></i> Home</a></li>
                        <li><a href="../menu.php"><i class="fas fa-chevron-right"></i> Menu</a></li>
                        <li><a href="../news-events.php"><i class="fas fa-chevron-right"></i> News & Events</a></li>
                        <li><a href="../about.php"><i class="fas fa-chevron-right"></i> About</a></li>
                        <li><a href="../contact.php"><i class="fas fa-chevron-right"></i> Contact</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Contact Us</h3>
                    <p><i class="fas fa-map-marker-alt"></i> Jalan Example, Melaka</p>
                    <p><i class="fas fa-phone"></i> 012-3456789</p>
                    <p><i class="fas fa-envelope"></i> info@restaurant.com</p>
                </div>
                <div class="footer-section">
                    <h3>Follow Us</h3>
                    <div class="social-links">
                        <a href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a>
                        <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.tiktok.com/en/"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 Restaurant SUP TULANG ZZ. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- ========== BOTTOM MOBILE NAVIGATION ========== -->
    <nav class="mobile-nav">
        <a href="../../index.php"><i class="fas fa-home"></i><span>Home</span></a>
        <a href="../menu.php"><i class="fas fa-utensils"></i><span>Menu</span></a>
        <a href="cart.php" class="active"><i class="fas fa-shopping-cart"></i><span>Cart</span></a>
        <a href="order-status.php"><i class="fas fa-receipt"></i><span>Orders</span></a>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="dashboard.php"><i
                    class="fas fa-user"></i><span><?= htmlspecialchars($_SESSION['user_name']) ?></span></a>
        <?php else: ?>
            <a href="../login.php"><i class="fas fa-user"></i><span>Login</span></a>
        <?php endif; ?>
    </nav>

    <!-- JavaScript -->
    <script src="../../assets/js/cart.js"></script>
</body>

</html>