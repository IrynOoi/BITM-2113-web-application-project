<!-- news-events.php -->
<?php if (session_status() === PHP_SESSION_NONE)
    session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News & Events - Restoran SUP TULANG ZZ</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/news-events.css">
</head>

<body>

    <!-- ========== TOP HEADER with Glass Effect ========== -->
    <header class="header">
        <div class="header-container">
            <a href="../index.php" class="logo">
                <img src="../assets/images/Logo.jpeg" alt="Restoran SUP TULANG ZZ Logo" class="logo-img">
                <h1>Restoran SUP TULANG ZZ</h1>
            </a>

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

        <nav class="desktop-nav" id="desktopNav">
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="menu.php">Menu</a></li>
                <li><a href="news-events.php" class="active">News & Events</a></li>
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

    <!-- ========== NEWS & EVENTS CONTENT ========== -->
    <main class="news-page">
        <div class="container">
            <!-- Page Header -->
            <div class="news-page-header">
                <h1>News & Events</h1>
                <p>Stay updated with our latest promotions, events, and announcements</p>
            </div>

            <!-- Filter Tabs -->
            <div class="news-filter">
                <button class="news-filter-btn active" data-filter="all">All</button>
                <button class="news-filter-btn" data-filter="promotion">
                    <i class="fas fa-tag"></i> Promotions
                </button>
                <button class="news-filter-btn" data-filter="event">
                    <i class="fas fa-calendar-alt"></i> Events
                </button>
                <button class="news-filter-btn" data-filter="announcement">
                    <i class="fas fa-bullhorn"></i> Announcements
                </button>
            </div>

            <!-- Featured Banner -->
            <div class="featured-event">
                <div class="featured-event-image">
                    <img src="../assets/images/Slider/Slide1.jpeg" alt="Featured Event">
                </div>
                <div class="featured-event-content">
                    <span class="event-badge event-badge-featured">⭐ Featured</span>
                    <span class="event-category">Promotion</span>
                    <h2>🎉 Grand Opening Special - 20% OFF!</h2>
                    <p class="event-date"><i class="far fa-calendar-alt"></i> May 20 - June 30, 2026</p>
                    <p class="event-excerpt">
                        Join us in celebrating our grand opening! Enjoy 20% off on all menu items.
                        Bring your family and friends for an unforgettable dining experience.
                    </p>
                    <a href="#" class="btn-read-more">Read More <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- News Cards Grid -->
            <div class="news-grid" id="newsGrid">
                <!-- Card 1: Promotion -->
                <div class="news-card" data-category="promotion">
                    <div class="news-card-image">
                        <img src="../assets/images/Slider/Slide2.jpeg" alt="Lunch Promotion">
                        <span class="event-category">Promotion</span>
                    </div>
                    <div class="news-card-body">
                        <p class="news-card-date"><i class="far fa-clock"></i> June 1 - July 15, 2026</p>
                        <h3>🍜 Lunch Set from RM 9.90</h3>
                        <p class="news-card-text">
                            Enjoy our special lunch sets every weekday from 11AM to 2PM.
                            Choose from 5 delicious combinations!
                        </p>
                        <a href="#" class="news-card-link">View Details <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>

                <!-- Card 2: Event -->
                <div class="news-card" data-category="event">
                    <div class="news-card-image">
                        <img src="../assets/images/Slider/Slide3.jpeg" alt="Cooking Workshop">
                        <span class="event-category">Event</span>
                    </div>
                    <div class="news-card-body">
                        <p class="news-card-date"><i class="far fa-clock"></i> June 25, 2026</p>
                        <h3>👨‍🍳 Live Cooking Workshop</h3>
                        <p class="news-card-text">
                            Learn to cook our signature Sup Tulang! Limited to 20 participants.
                            Includes free lunch and recipe book.
                        </p>
                        <a href="#" class="news-card-link">Register Now <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>

                <!-- Card 3: Announcement -->
                <div class="news-card" data-category="announcement">
                    <div class="news-card-image">
                        <img src="../assets/images/Slider/Slide4.jpeg" alt="Online Ordering">
                        <span class="event-category">Announcement</span>
                    </div>
                    <div class="news-card-body">
                        <p class="news-card-date"><i class="far fa-clock"></i> June 10, 2026</p>
                        <h3>📱 Online Ordering Now Available!</h3>
                        <p class="news-card-text">
                            You can now order your favorite dishes online for pickup or delivery.
                            Scan the QR code at your table too!
                        </p>
                        <a href="menu.php" class="news-card-link">Order Now <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>

                <!-- Card 4: Promotion -->
                <div class="news-card" data-category="promotion">
                    <div class="news-card-image">
                        <img src="../assets/images/Slider/Slide5.jpeg" alt="Family Deal">
                        <span class="event-category">Promotion</span>
                    </div>
                    <div class="news-card-body">
                        <p class="news-card-date"><i class="far fa-clock"></i> Weekends Only</p>
                        <h3>👨‍👩‍👧‍👦 Family Platter - RM 49.90</h3>
                        <p class="news-card-text">
                            Perfect for 4 persons! Includes 2 main courses, 2 drinks, and 1 dessert.
                            Available every weekend.
                        </p>
                        <a href="#" class="news-card-link">View Details <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>

                <!-- Card 5: Event -->
                <div class="news-card" data-category="event">
                    <div class="news-card-image">
                        <img src="../assets/images/Slider/Slide6.jpeg" alt="Hari Raya Special">
                        <span class="event-category">Event</span>
                    </div>
                    <div class="news-card-body">
                        <p class="news-card-date"><i class="far fa-clock"></i> June 17, 2026</p>
                        <h3>🌙 Hari Raya Buffet Dinner</h3>
                        <p class="news-card-text">
                            Celebrate Hari Raya with our special buffet dinner. Over 30 dishes,
                            live music, and door gifts for early birds!
                        </p>
                        <a href="#" class="news-card-link">Book Now <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>

                <!-- Card 6: Announcement -->
                <div class="news-card" data-category="announcement">
                    <div class="news-card-image">
                        <img src="../assets/images/Slider/Slide7.jpeg" alt="New Branch">
                        <span class="event-category">Announcement</span>
                    </div>
                    <div class="news-card-body">
                        <p class="news-card-date"><i class="far fa-clock"></i> Coming Soon</p>
                        <h3>📍 New Branch Opening in Melaka Raya!</h3>
                        <p class="news-card-text">
                            We're expanding! Our new branch will open next month.
                            Stay tuned for the exact opening date and special offers.
                        </p>
                        <a href="#" class="news-card-link">Learn More <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- No Results -->
            <div class="news-no-results" id="newsNoResults" style="display: none;">
                <i class="fas fa-newspaper"></i>
                <h3>No news found</h3>
                <p>Check back soon for updates!</p>
            </div>
        </div>
    </main>

    <!-- ========== FOOTER ========== -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-section">
                    <h3><img src="../assets/images/Footer-logo.jpeg" alt="Logo" style="height: 50px; width: auto;">
                        Restoran SUP TULANG ZZ</h3>
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
                <p>&copy; 2026 Restaurant SUP TULANG ZZ. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- ========== BOTTOM MOBILE NAVIGATION ========== -->
    <nav class="mobile-nav">
        <a href="../index.php"><i class="fas fa-home"></i><span>Home</span></a>
        <a href="menu.php"><i class="fas fa-utensils"></i><span>Menu</span></a>
        <a href="customer/cart.php"><i class="fas fa-shopping-cart"></i><span>Cart</span></a>
        <a href="customer/order-status.php"><i class="fas fa-receipt"></i><span>Orders</span></a>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="customer/dashboard.php"><i
                    class="fas fa-user"></i><span><?= htmlspecialchars($_SESSION['user_name']) ?></span></a>
        <?php else: ?>
            <a href="login.php"><i class="fas fa-user"></i><span>Login</span></a>
        <?php endif; ?>
    </nav>

    <!-- JavaScript -->
    <script src="../assets/js/news-events.js"></script>
</body>

</html>