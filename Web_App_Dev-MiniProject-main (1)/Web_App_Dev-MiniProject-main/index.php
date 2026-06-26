<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restoran SUP TULANG ZZ - Order Online</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <!-- ========== TOP HEADER ========== -->
    <header class="header">
        <div class="header-container">
            <a href="index.php" class="logo">
                <img src="assets/images/Logo.jpeg" alt="Restoran SUP TULANG ZZ Logo" class="logo-img">
                <h1>Restoran SUP TULANG ZZ</h1>
            </a>
            <div class="header-icons">
                <a href="pages/customer/cart.php" class="icon-link">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-badge">0</span>
                </a>
                <button class="menu-toggle" id="menuToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>

        <nav class="desktop-nav" id="desktopNav">
            <ul>
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="pages/menu.php">Menu</a></li>
                <li><a href="pages/news-events.php">News &amp; Events</a></li>
                <li><a href="pages/about.php">About</a></li>
                <li><a href="pages/contact.php">Contact</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li>
                        <a href="pages/customer/dashboard.php" class="btn-login">
                            <i class="fas fa-user"></i> <?= htmlspecialchars($_SESSION['user_name']) ?>
                        </a>
                    </li>
                    <li><a href="api/auth.php?action=logout" class="btn-register">Logout</a></li>
                <?php else: ?>
                    <li><a href="pages/login.php" class="btn-login">Login</a></li>
                    <li><a href="pages/register.php" class="btn-register">Register</a></li>
                <?php endif; ?>
                <li><a href="pages/customer/qr-order.php">QR order</a></li>
            </ul>
        </nav>
    </header>

    <!-- ========== HERO SECTION ========== -->
    <section class="hero">
        <div class="hero-video">
            <img src="assets/images/Banner.jpeg" alt="Restaurant ambiance">
        </div>
        <div class="hero-overlay">
            <div class="hero-content">
                <h1>Welcome to Restoran Sup Tulang ZZ</h1>
                <p class="hero-subtitle">Delicious food delivered fresh to your table</p>
                <div class="hero-buttons">
                    <a href="pages/menu.php" class="btn-primary">
                        <i class="fas fa-utensils"></i> View Our Menu
                    </a>
                    <a href="pages/contact.php" class="btn-secondary">
                        <i class="fas fa-phone"></i> Contact
                    </a>
                </div>
                <div class="promo-banner">
                    <span class="promo-tag">🔥 Special Offer</span>
                    <p>20% OFF on your first online order! Use code: <strong>WELCOME20</strong></p>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== TODAY'S SPECIAL ========== -->
    <section class="section specials">
        <div class="container">
            <div class="section-header">
                <h2>Today's Special</h2>
                <p>Chef's recommended dishes of the day</p>
            </div>
            <div class="specials-grid">
                <div class="special-card">
                    <div class="card-image">
                        <img src="assets/images/Today special/Sup Gearbox Kambing.jpeg" alt="Sup Gearbox Kambing">
                        <span class="discount-badge">-21%</span>
                    </div>
                    <div class="card-content">
                        <h3>Sup Gearbox Kambing</h3>
                        <p class="description">Signature lamb gearbox soup served with rich traditional broth.</p>
                        <div class="price-row">
                            <span class="price">RM 15.0</span>
                            <span class="old-price">RM 19.0</span>
                        </div>
                        <button class="btn-add-cart" onclick="addToCart(1, 'Sup Gearbox Kambing', 15.00)">
                            <i class="fas fa-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>

                <div class="special-card">
                    <div class="card-image">
                        <img src="assets/images/Today special/Nasi Siakap Goreng Berlado.jpg" alt="Nasi Siakap Goreng Berlado">
                        <span class="discount-badge">-10%</span>
                    </div>
                    <div class="card-content">
                        <h3>Nasi Siakap Goreng Berlado</h3>
                        <p class="description">Fried siakap fish served with spicy berlado sauce and rice.</p>
                        <div class="price-row">
                            <span class="price">RM 13.99</span>
                            <span class="old-price">RM 15.0</span>
                        </div>
                        <button class="btn-add-cart" onclick="addToCart(2, 'Nasi Siakap Goreng Berlado', 13.99)">
                            <i class="fas fa-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>

                <div class="special-card">
                    <div class="card-image">
                        <img src="assets/images/Today special/Chicken Chop.jpeg" alt="Chicken Chop">
                        <span class="discount-badge">-10%</span>
                    </div>
                    <div class="card-content">
                        <h3>Chicken Chop</h3>
                        <p class="description">Western style chicken chop available fried or grilled.</p>
                        <div class="price-row">
                            <span class="price">RM 16.99</span>
                            <span class="old-price">RM 18.5</span>
                        </div>
                        <button class="btn-add-cart" onclick="addToCart(3, 'Chicken Chop', 16.99)">
                            <i class="fas fa-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== POPULAR MENU ========== -->
    <section class="section popular">
        <div class="container">
            <div class="section-header">
                <h2>Popular Menu</h2>
                <p>Most ordered by our customers</p>
            </div>
            
            <div class="popular-grid">
                <div class="popular-item">
                    <img src="assets/images/Popular menu/Mee Rebus Gearbox Kambing.jpeg" alt="Tom Yum Soup">
                    <h3>Mee Rebus Gearbox Kambing</h3>
                    <span class="rating">⭐ 4.8</span>
                </div>
                
                <div class="popular-item">
                    <img src="assets/images/Popular menu/Roti Sarang Burung Daging.jpeg" alt="Fried Rice">
                    <h3>Roti Sarang Burung Daging</h3>
                    <span class="rating">⭐ 4.7</span>
                </div>
                
                <div class="popular-item">
                    <img src="assets/images/Popular menu/Cendol.jpeg" alt="Iced Lemon Tea">
                    <h3>Cendol</h3>
                    <span class="rating">⭐ 4.9</span>
                </div>
                
                <div class="popular-item">
                    <img src="assets/images/Popular menu/Nasi Goreng Kampung.jpeg" alt="Satay">
                    <h3>Nasi Goreng Kampung</h3>
                    <span class="rating">⭐ 4.6</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== IMAGE SLIDER SECTION ========== -->
    <section class="section image-slider-section">
        <div class="container">
            <div class="section-header">
                <h2>Our Gallery</h2>
                <p>Experience the ambiance of Restoran SUP TULANG ZZ</p>
            </div>
            <div class="slider-container">
                <div class="slider-wrapper" id="sliderWrapper">
                    <div class="slider-slide"><img src="assets/images/Slider/Slide1.jpeg" alt="Gallery 1"></div>
                    <div class="slider-slide"><img src="assets/images/Slider/Slide2.jpeg" alt="Gallery 2"></div>
                    <div class="slider-slide"><img src="assets/images/Slider/Slide3.jpeg" alt="Gallery 3"></div>
                    <div class="slider-slide"><img src="assets/images/Slider/Slide4.jpeg" alt="Gallery 4"></div>
                    <div class="slider-slide"><img src="assets/images/Slider/Slide5.jpeg" alt="Gallery 5"></div>
                    <div class="slider-slide"><img src="assets/images/Slider/Slide6.jpeg" alt="Gallery 6"></div>
                    <div class="slider-slide"><img src="assets/images/Slider/Slide7.jpeg" alt="Gallery 7"></div>
                    <div class="slider-slide"><img src="assets/images/Slider/Slide8.jpeg" alt="Gallery 8"></div>
                    <div class="slider-slide"><img src="assets/images/Slider/Slide9.jpeg" alt="Gallery 9"></div>
                    <div class="slider-slide"><img src="assets/images/Slider/Slide10.jpeg" alt="Gallery 10"></div>
                    <div class="slider-slide"><img src="assets/images/Slider/Slide11.jpeg" alt="Gallery 11"></div>
                    <div class="slider-slide"><img src="assets/images/Slider/Slide12.jpeg" alt="Gallery 12"></div>
                </div>
                <button class="slider-arrow slider-arrow-left" id="sliderArrowLeft">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="slider-arrow slider-arrow-right" id="sliderArrowRight">
                    <i class="fas fa-chevron-right"></i>
                </button>
                <div class="slider-dots" id="sliderDots">
                    <span class="slider-dot active" data-index="0"></span>
                    <span class="slider-dot" data-index="1"></span>
                    <span class="slider-dot" data-index="2"></span>
                    <span class="slider-dot" data-index="3"></span>
                    <span class="slider-dot" data-index="4"></span>
                    <span class="slider-dot" data-index="5"></span>
                    <span class="slider-dot" data-index="6"></span>
                    <span class="slider-dot" data-index="7"></span>
                    <span class="slider-dot" data-index="8"></span>
                    <span class="slider-dot" data-index="9"></span>
                    <span class="slider-dot" data-index="10"></span>
                    <span class="slider-dot" data-index="11"></span>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== FOOTER ========== -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-section">
                    <h3><img src="assets/images/Footer-logo.jpeg" alt="Logo" style="height:50px;width:auto;vertical-align:middle;"> Restoran SUP TULANG ZZ</h3>
                    <p>Delicious food, excellent service, memorable experience.</p>
                </div>
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="index.php"><i class="fas fa-chevron-right"></i> Home</a></li>
                        <li><a href="pages/menu.php"><i class="fas fa-chevron-right"></i> Menu</a></li>
                        <li><a href="pages/news-events.php"><i class="fas fa-chevron-right"></i> News &amp; Events</a></li>
                        <li><a href="pages/about.php"><i class="fas fa-chevron-right"></i> About</a></li>
                        <li><a href="pages/contact.php"><i class="fas fa-chevron-right"></i> Contact</a></li>
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
        <a href="index.php" class="active"><i class="fas fa-home"></i><span>Home</span></a>
        <a href="pages/menu.php"><i class="fas fa-utensils"></i><span>Menu</span></a>
        <a href="pages/customer/cart.php"><i class="fas fa-shopping-cart"></i><span>Cart</span></a>
        <a href="pages/customer/order-status.php"><i class="fas fa-receipt"></i><span>Orders</span></a>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="pages/customer/dashboard.php"><i class="fas fa-user"></i><span><?= htmlspecialchars($_SESSION['user_name']) ?></span></a>
        <?php else: ?>
            <a href="pages/login.php"><i class="fas fa-user"></i><span>Login</span></a>
        <?php endif; ?>
    </nav>
    
    <!-- JavaScript -->
    <script src="assets/js/main.js"></script>
</body>
</html>
