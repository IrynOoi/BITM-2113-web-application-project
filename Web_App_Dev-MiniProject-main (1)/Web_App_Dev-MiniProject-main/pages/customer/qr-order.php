<!-- qr-order.php -->
<?php if (session_status() === PHP_SESSION_NONE)
    session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Order - Restoran SUP TULANG ZZ</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/qr-order.css">
</head>

<body>

    <!-- ========== TOP HEADER (Simplified) ========== -->
    <header class="header">
        <div class="header-container">
            <div class="logo">
                <img src="../../assets/images/Logo.jpeg" alt="Restoran SUP TULANG ZZ Logo" class="logo-img">
                <h1>Restoran SUP TULANG ZZ</h1>
            </div>
        </div>
    </header>

    <!-- ========== TABLE SELECTION SCREEN ========== -->
    <main class="qr-order-page" id="tableSelectionScreen">
        <div class="container">
            <!-- Top Image -->
            <div class="selection-image">
                <img src="../../assets/images/About 2.jpeg" alt="Welcome to Restoran SUP TULANG ZZ">
            </div>

            <!-- Welcome Text -->
            <div class="selection-welcome">
                <h1>Welcome!</h1>
                <p>Please select your table and number of guests</p>
            </div>

            <!-- Scroller Section -->
            <div class="scrollers-container">
                <!-- Table Number Scroller -->
                <div class="scroller-group">
                    <label>Table Number</label>
                    <div class="scroller-wrapper">
                        <button class="scroller-btn scroller-up" data-target="table">
                            <i class="fas fa-chevron-up"></i>
                        </button>
                        <div class="scroller-display">
                            <span class="scroller-value" id="tableValue">1</span>
                        </div>
                        <button class="scroller-btn scroller-down" data-target="table">
                            <i class="fas fa-chevron-down"></i>
                        </button>
                    </div>
                </div>
            </div>



            <!-- Dine In Button -->
            <div class="dinein-btn-container">
                <button class="btn-dine-in" id="btnDineIn">
                    <i class="fas fa-utensils"></i> Dine In
                </button>
            </div>
        </div>
    </main>

    <!-- ========== MENU ORDERING SCREEN (Hidden initially) ========== -->
    <main class="menu-order-page" id="menuOrderScreen" style="display: none;">
        <div class="container">
            <!-- Table Info Bar -->
            <div class="table-info-bar">
                <div class="table-info-left">
                    <i class="fas fa-utensils"></i>
                    <div>
                        <span class="table-label">Table</span>
                        <span class="table-number" id="displayTableNumber">1</span>
                    </div>
                </div>
                <div class="table-info-center">
                    <i class="fas fa-users"></i>
                    <span id="displayPax">1 pax</span>
                </div>
                <div class="table-info-right">
                    <button class="btn-change-table" id="btnChangeTable">
                        <i class="fas fa-exchange-alt"></i> Change
                    </button>
                </div>
            </div>

            <!-- Search Bar -->
            <div class="menu-search">
                <i class="fas fa-search"></i>
                <input type="text" id="menuSearch" placeholder="Search menu...">
                <button id="searchClear" style="display: none;">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Category Filter - Strictly followed based on the Menu given in .pdf-->
            <div class="category-filter" id="categoryFilter">
                <button class="filter-btn active" data-category="all"><i class="fas fa-th-large"></i> All</button>
                <button class="filter-btn" data-category="signature-sup"><i class="fas fa-crown"></i> Sup ZZ</button>
                <button class="filter-btn" data-category="signature-mee"><i class="fas fa-crown"></i> Mee Rebus
                    ZZ</button>
                <button class="filter-btn" data-category="sarapan-panas"><i class="fas fa-coffee"></i> Sarapan
                    Panas</button>
                <button class="filter-btn filter-more" id="btnMore">
                    <i class="fas fa-chevron-down"></i> More
                </button>
                <!-- Hidden categories -->
                <span class="more-categories" id="moreCategories" style="display: none;">
                    <button class="filter-btn" data-category="sarapan-roti"><i class="fas fa-bread-slice"></i> Roti
                        Bakar</button>
                    <button class="filter-btn" data-category="roti-canai"><i class="fas fa-bread-slice"></i> Roti
                        Canai</button>
                    <button class="filter-btn" data-category="set-nasi"><i class="fas fa-utensils"></i> Set
                        Nasi</button>
                    <button class="filter-btn" data-category="ikan"><i class="fas fa-fish"></i> Menu Ikan</button>
                    <button class="filter-btn" data-category="alacarte-sayur"><i class="fas fa-leaf"></i> Sayur</button>
                    <button class="filter-btn" data-category="alacarte-lauk"><i class="fas fa-book-open"></i> Lauk
                        Thai</button>
                    <button class="filter-btn" data-category="alacarte-tepung"><i class="fas fa-book-open"></i> Goreng
                        Tepung</button>
                    <button class="filter-btn" data-category="alacarte-sup"><i class="fas fa-mug-hot"></i> Sup Ala
                        Thai</button>
                    <button class="filter-btn" data-category="alacarte-tomyam"><i class="fas fa-pepper-hot"></i>
                        Tomyam</button>
                    <button class="filter-btn" data-category="alacarte-meekuah"><i class="fas fa-book-open"></i> Mee
                        Kuah</button>
                    <button class="filter-btn" data-category="western"><i class="fas fa-hamburger"></i> Western</button>
                    <button class="filter-btn" data-category="goreng-nasi"><i class="fas fa-hotdog"></i> Nasi
                        Goreng</button>
                    <button class="filter-btn" data-category="goreng-mee"><i class="fas fa-hotdog"></i> Mee
                        Goreng</button>
                    <button class="filter-btn" data-category="drinks-noncoffee"><i class="fas fa-mug-hot"></i>
                        Drinks</button>
                    <button class="filter-btn" data-category="drinks-coffee"><i class="fas fa-mug-hot"></i>
                        Coffee</button>
                    <button class="filter-btn" data-category="drinks-jus"><i class="fas fa-glass-water"></i>
                        Jus</button>
                    <button class="filter-btn" data-category="drinks-dessert"><i class="fas fa-ice-cream"></i>
                        Dessert</button>
                </span>
            </div>

            <!-- Menu Grid -->
            <div class="menu-grid" id="menuGrid"></div>
            <div class="no-results" id="noResults" style="display: none;">
                <i class="fas fa-utensils"></i>
                <p>No items found</p>
            </div>
        </div>
    </main>

    <!-- ========== ORDER SUMMARY BAR ========== -->
    <div class="order-summary-bar" id="orderSummaryBar" style="display: none;">
        <div class="order-summary-content">
            <div class="order-summary-left" id="btnToggleOrder">
                <div class="order-icon">
                    <i class="fas fa-receipt"></i>
                    <span class="order-count-badge" id="orderCountBadge">0</span>
                </div>
                <div class="order-info">
                    <span class="order-label">Your Order</span>
                    <span class="order-total" id="orderTotal">RM 0.00</span>
                </div>
                <i class="fas fa-chevron-up order-toggle-icon" id="orderToggleIcon"></i>
            </div>
            <button class="btn-place-order" id="btnPlaceOrder" disabled>
                <i class="fas fa-paper-plane"></i> Place Order
            </button>
        </div>

        <div class="order-items-panel" id="orderItemsPanel" style="display: none;">
            <div class="order-items-header">
                <h3>Order Details</h3>
                <button class="btn-clear-order" id="btnClearOrder">
                    <i class="fas fa-trash-alt"></i> Clear All
                </button>
            </div>
            <div class="order-items-list" id="orderItemsList"></div>
            <div class="order-empty" id="orderEmpty">
                <i class="fas fa-clipboard-list"></i>
                <p>No items added yet. Tap + to add items!</p>
            </div>
        </div>
    </div>

    <!-- ========== PLACE ORDER MODAL ========== -->
    <div class="modal-overlay" id="placeOrderModal" style="display: none;">
        <div class="modal-card confirm-order-modal">
            <div class="modal-icon-wrapper">
                <i class="fas fa-clipboard-check"></i>
            </div>
            <h2>Confirm Your Order</h2>
            <div class="confirm-order-details">
                <div class="confirm-row"><span>Table</span><strong id="confirmTable">1</strong></div>
                <div class="confirm-row"><span>Guests</span><strong id="confirmPax">1</strong></div>
                <div class="confirm-row"><span>Items</span><strong id="confirmItems">0</strong></div>
                <div class="confirm-row confirm-total"><span>Total</span><strong id="confirmTotal">RM 0.00</strong>
                </div>
            </div>
            <div class="confirm-special-instructions">
                <label for="specialInstructions">Special Instructions (optional)</label>
                <textarea id="specialInstructions" rows="3" placeholder="e.g. Less spicy, no onions..."></textarea>
            </div>
            <div class="modal-actions">
                <button class="btn-cancel" id="btnCancelOrder">Cancel</button>
                <button class="btn-confirm" id="btnConfirmOrder">
                    <i class="fas fa-check-circle"></i> Confirm Order
                </button>
            </div>
        </div>
    </div>

    <!-- ========== SUCCESS MODAL ========== -->
    <div class="modal-overlay" id="successModal" style="display: none;">
        <div class="modal-card success-modal-card">
            <div class="success-icon-wrapper">
                <i class="fas fa-check-circle"></i>
            </div>
            <h2>Order Placed Successfully!</h2>
            <p>Your order has been sent to the kitchen.</p>
            <div class="order-tracking-info">
                <div class="tracking-step active">
                    <i class="fas fa-check"></i>
                    <span>Received</span>
                </div>
                <div class="tracking-line"></div>
                <div class="tracking-step">
                    <i class="fas fa-fire"></i>
                    <span>Preparing</span>
                </div>
                <div class="tracking-line"></div>
                <div class="tracking-step">
                    <i class="fas fa-bell"></i>
                    <span>Ready</span>
                </div>
            </div>
            <div class="order-id-display">
                <span>Order ID: <strong id="successOrderId">#001</strong></span>
            </div>
            <div class="modal-actions">
                <a href="order-status.php" class="btn-primary">
                    <i class="fas fa-eye"></i> Track Order
                </a>
                <button class="btn-secondary-modal" id="btnCloseSuccess">Close</button>
            </div>
        </div>
    </div>

    <!-- ========== TOAST ========== -->
    <div class="toast-container" id="toastContainer"></div>

    <!-- ========== BOTTOM MOBILE NAVIGATION (QR Order Internal) ========== -->
    <nav class="mobile-nav" id="qrMobileNav">
        <a href="#" id="navHome" class="active">
            <i class="fas fa-home"></i>
            <span>Home</span>
        </a>
        <a href="#" id="navMenu">
            <i class="fas fa-utensils"></i>
            <span>Menu</span>
        </a>
        <a href="#" id="navCart">
            <i class="fas fa-shopping-cart"></i>
            <span>Cart</span>
        </a>
        <a href="#" id="navOrders">
            <i class="fas fa-receipt"></i>
            <span>Orders</span>
        </a>
    </nav>

    <script src="../../assets/js/qr-order.js?v=2"></script>
</body>

</html>