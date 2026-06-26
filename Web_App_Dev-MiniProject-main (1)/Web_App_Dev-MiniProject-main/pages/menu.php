<!-- menu.php -->
<?php if (session_status() === PHP_SESSION_NONE)
    session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Restoran SUP TULANG ZZ</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/menu.css">
</head>

<body>

    <!-- ========== TOP HEADER with Glass Effect ========== -->
    <header class="header">
        <div class="header-container">
            <!-- Logo + Restaurant Name (Click to Home) -->
            <a href="../index.php" class="logo">
                <img src="../assets/images/Logo.jpeg" alt="Restoran SUP TULANG ZZ Logo" class="logo-img">
                <h1>Restoran SUP TULANG ZZ</h1>
            </a>

            <!-- Cart Icon Only -->
            <div class="header-icons">
                <a href="customer/cart.php" class="icon-link">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-badge" id="cartBadge">0</span>
                </a>
                <button class="menu-toggle" id="menuToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>

        <!-- Desktop Navigation -->
        <nav class="desktop-nav" id="desktopNav">
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="menu.php" class="active">Menu</a></li>
                <li><a href="news-events.php">News & Events</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="customer/dashboard.php" class="btn-login">
                            <i class="fas fa-user"></i> <?= htmlspecialchars($_SESSION['user_name']) ?>
                        </a></li>
                    <li><a href="../backend/api/auth.php?action=logout" class="btn-register">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php" class="btn-login">Login</a></li>
                    <li><a href="register.php" class="btn-register">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

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
    <a href="customer/cart.php" class="floating-cart" id="floatingCart">
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
                <a href="../assets/pdf/Menu.pdf" target="_blank" class="btn-see-more">
                    <i class="fas fa-file-pdf"></i> See More
                </a>
            </div>
        </div>
    </section>

    <!-- ========== FOOTER ========== -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-section">
                    <h3><img src="../assets/images/Footer-logo.jpeg" alt="Restoran SUP TULANG ZZ"
                            style="height: 50px; width: auto;"> Restoran SUP TULANG ZZ</h3>
                    <p>Delicious food, excellent service, memorable experience.</p>
                </div>

                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="../index.php"><i class="fas fa-chevron-right"></i> Home</a></li>
                        <li><a href="menu.php"><i class="fas fa-chevron-right"></i> Menu</a></li>
                        <li><a href="news-events.php"><i class="fas fa-chevron-right"></i> News & Events</a></li>
                        <li><a href="about.php"><i class="fas fa-chevron-right"></i> About</a></li>
                        <li><a href="contact.php"><i class="fas fa-chevron-right"></i> Contact</a></li>
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
                        <a href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a>
                        <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.tiktok.com/en/"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2026 Restaurant SUP TULANG ZZ Order Management System. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- ========== BOTTOM MOBILE NAVIGATION ========== -->
    <nav class="mobile-nav">
        <a href="../index.php">
            <i class="fas fa-home"></i>
            <span>Home</span>
        </a>
        <a href="menu.php" class="active">
            <i class="fas fa-utensils"></i>
            <span>Menu</span>
        </a>
        <a href="customer/cart.php">
            <i class="fas fa-shopping-cart"></i>
            <span>Cart</span>
        </a>
        <a href="customer/order-status.php">
            <i class="fas fa-receipt"></i>
            <span>Orders</span>
        </a>
        <a href="profile.php">
            <i class="fas fa-user"></i>
            <span>Profile</span>
        </a>
    </nav>

    <!-- JavaScript -->
    <script src="../assets/js/api.js"></script>
    <!-- Auto cache busting for development - remove in production -->
    <<script src="../assets/js/menu.js?v=2">
        </script>
</body>

</html>