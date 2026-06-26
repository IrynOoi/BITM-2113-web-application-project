<!-- about.php -->
<?php if (session_status() === PHP_SESSION_NONE)
    session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Restoran SUP TULANG ZZ</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
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
                <li><a href="news-events.php">News & Events</a></li>
                <li><a href="about.php" class="active">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="customer/dashboard.php" class="btn-login">
                            <i class="fas fa-user"></i> <?= htmlspecialchars($_SESSION['user_name']) ?>
                        </a></li>
                    <li><a href="../../backend/api/auth.php?action=logout" class="btn-register">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php" class="btn-login">Login</a></li>
                    <li><a href="register.php" class="btn-register">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <!-- ========== HERO SECTION ========== -->
    <section class="hero hero-about">
        <div class="hero-video">
            <img src="../assets/images/About.jpeg" alt="Restoran SUP TULANG ZZ Interior">
        </div>
        <div class="hero-overlay">
            <div class="hero-content">
                <h1>About Our Restaurant</h1>
                <p class="hero-subtitle">Discover the story behind our authentic Malaysian cuisine</p>
            </div>
        </div>
    </section>

    <!-- ========== OUR STORY SECTION ========== -->
    <section class="section about-story-section">
        <div class="container">
            <div class="section-header">
                <h2>Our Story</h2>
                <p>How it all began</p>
            </div>

            <div class="story-content">
                <p>
                    <strong>Restoran SUP TULANG ZZ</strong> was founded in 2015 with a simple mission:
                    to serve the most authentic and delicious Sup Tulang (bone marrow soup) in Melaka.
                    What started as a small family-run stall has grown into one of the most beloved
                    restaurants in the region.
                </p>
                <p>
                    Our founder, Zulkifli Zainal, learned the art of making Sup Tulang from his grandmother,
                    who passed down the secret family recipe through generations. Using only the freshest
                    ingredients and traditional cooking methods, each bowl of soup is slow-cooked for over
                    8 hours to achieve that rich, flavorful broth our customers love.
                </p>
                <p>
                    Today, we continue to uphold that tradition while expanding our menu to include
                    a variety of Malaysian favorites — from fragrant Nasi Lemak to spicy Tom Yum Soup.
                    Every dish is prepared with the same care and passion that started it all.
                </p>
            </div>
        </div>
    </section>

    <!-- ========== VIDEO + FEATURES SECTION ========== -->
    <section class="section about">
        <div class="container">
            <div class="about-grid">
                <div class="about-video">
                    <video poster="../assets/images/promo-video-poster.jpeg" controls>
                        <source src="../assets/videos/promo.mp4" type="video/mp4">
                        Your browser does not support video.
                    </video>
                </div>

                <div class="about-content">
                    <h2>Why Choose Us</h2>
                    <p class="about-story">
                        We take pride in delivering not just meals, but memorable dining experiences.
                        Every ingredient is handpicked, every recipe is perfected, and every customer
                        is treated like family.
                    </p>

                    <div class="about-features">
                        <div class="feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Fresh Ingredients Daily</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Halal Certified</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Air-Conditioned Dining</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Family-Friendly Environment</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Online Ordering Available</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Free Wi-Fi</span>
                        </div>
                    </div>

                    <div class="opening-hours">
                        <h3><i class="far fa-clock"></i> Opening Hours</h3>
                        <p>Monday - Sunday: 10:00 AM - 10:00 PM</p>
                        <p class="closed">Closed on Public Holidays</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== OUR VALUES SECTION ========== -->
    <section class="section values-section">
        <div class="container">
            <div class="section-header">
                <h2>Our Values</h2>
                <p>What drives us every day</p>
            </div>

            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3>Passion</h3>
                    <p>We pour our heart into every dish we serve, ensuring each bite is filled with love and tradition.
                    </p>
                </div>

                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3>Quality</h3>
                    <p>Only the finest ingredients make it to your plate. We never compromise on quality.</p>
                </div>

                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Community</h3>
                    <p>We believe in bringing people together through food. Our restaurant is a place for everyone.</p>
                </div>

                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h3>Tradition</h3>
                    <p>Preserving authentic Malaysian recipes passed down through generations is at our core.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== TEAM SECTION ========== -->
    <section class="section team-section">
        <div class="container">
            <div class="section-header">
                <h2>Meet Our Team</h2>
                <p>The people behind the magic</p>
            </div>

            <div class="team-grid">
                <div class="team-card">
                    <div class="team-image">
                        <img src="../assets/images/Our Team/Chef.jpeg" alt="Chef">
                    </div>
                    <h3>Chef Zulkifli</h3>
                    <span class="team-role">Founder & Head Chef</span>
                </div>

                <div class="team-card">
                    <div class="team-image">
                        <img src="../assets/images/Our Team/Chef.jpeg" alt="Sous Chef">
                    </div>
                    <h3>Chef Khairul</h3>
                    <span class="team-role">Sous Chef</span>
                </div>

                <div class="team-card">
                    <div class="team-image">
                        <img src="../assets/images/Our Team/Chef.jpeg" alt="Sous Chef">
                    </div>
                    <h3>Chef Amir</h3>
                    <span class="team-role">Sous Chef</span>
                </div>

                <div class="team-card">
                    <div class="team-image">
                        <img src="../assets/images/Our Team/Manager.jpeg" alt="Manager">
                    </div>
                    <h3>Ms. Aminah</h3>
                    <span class="team-role">Restaurant Manager</span>
                </div>
            </div>
        </div>
    </section>

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
    <script>
        // Mobile Menu
        document.addEventListener('DOMContentLoaded', function () {
            const menuToggle = document.getElementById('menuToggle');
            const desktopNav = document.getElementById('desktopNav');

            if (menuToggle && desktopNav) {
                menuToggle.addEventListener('click', function () {
                    desktopNav.classList.toggle('active');
                    const icon = menuToggle.querySelector('i');
                    icon.className = desktopNav.classList.contains('active') ? 'fas fa-times' : 'fas fa-bars';
                });
            }

            // Cart Badge
            const cart = JSON.parse(localStorage.getItem('restaurantCart') || '[]');
            const count = cart.reduce((sum, item) => sum + item.quantity, 0);
            const badge = document.getElementById('cartBadge');
            if (badge) {
                badge.textContent = count;
                badge.style.display = count > 0 ? 'flex' : 'none';
            }
        });
    </script>
</body>

</html>