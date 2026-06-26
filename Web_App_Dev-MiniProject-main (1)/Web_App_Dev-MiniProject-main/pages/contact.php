<!-- contact.php -->
<?php if (session_status() === PHP_SESSION_NONE)
    session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Restoran SUP TULANG ZZ</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/contact.css">
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
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php" class="active">Contact</a></li>
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

    <!-- ========== HERO SECTION ========== -->
    <section class="hero hero-contact">
        <div class="hero-video">
            <img src="../assets/images/Contact.jpeg" alt="Contact Restoran SUP TULANG ZZ">
        </div>
        <div class="hero-overlay">
            <div class="hero-content">
                <h1>Contact Us</h1>
                <p class="hero-subtitle">We'd love to hear from you — let's connect!</p>
            </div>
        </div>
    </section>

    <!-- ========== CONTACT SECTION ========== -->
    <section class="section contact-section">
        <div class="container">
            <div class="contact-layout">
                <!-- Left: Contact Info -->
                <div class="contact-info">
                    <div class="contact-info-header">
                        <h2>Get In Touch</h2>
                        <p>
                            Have a question, feedback, or want to make a reservation?
                            Drop us a message and we'll get back to you within 24 hours.
                            We're always happy to help!
                        </p>
                    </div>

                    <div class="contact-details">
                        <div class="contact-detail-item">
                            <div class="contact-detail-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-detail-text">
                                <h4>Our Location</h4>
                                <p>Jalan Example, Taman Melaka Raya,<br>75000 Melaka, Malaysia</p>
                            </div>
                        </div>

                        <div class="contact-detail-item">
                            <div class="contact-detail-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="contact-detail-text">
                                <h4>Call Us</h4>
                                <p>012-3456789<br>06-123 4567</p>
                            </div>
                        </div>

                        <div class="contact-detail-item">
                            <div class="contact-detail-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-detail-text">
                                <h4>Email Us</h4>
                                <p>info@suptulangzz.com<br>reservations@suptulangzz.com</p>
                            </div>
                        </div>

                        <div class="contact-detail-item">
                            <div class="contact-detail-icon">
                                <i class="far fa-clock"></i>
                            </div>
                            <div class="contact-detail-text">
                                <h4>Opening Hours</h4>
                                <p>Monday - Sunday<br>10:00 AM - 10:00 PM</p>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div class="contact-social">
                        <h4>Follow Us</h4>
                        <div class="social-links">
                            <a href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a>
                            <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                            <a href="https://www.tiktok.com/en/"><i class="fab fa-tiktok"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Right: Contact Form -->
                <div class="contact-form-wrapper">
                    <div class="contact-form-card">
                        <h3>Send Us a Message</h3>
                        <p class="form-subtitle">Fill in the form below and we'll get right back to you ✨</p>

                        <form class="contact-form" id="contactForm">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="fullName">Full Name <span class="required">*</span></label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-user"></i>
                                        <input type="text" id="fullName" name="fullName" placeholder="Your full name"
                                            required>
                                    </div>
                                    <span class="error-message" id="nameError"></span>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email Address <span class="required">*</span></label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-envelope"></i>
                                        <input type="email" id="email" name="email" placeholder="your@email.com"
                                            required>
                                    </div>
                                    <span class="error-message" id="emailError"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-phone"></i>
                                    <input type="tel" id="phone" name="phone" placeholder="012-3456789">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="subject">Subject <span class="required">*</span></label>
                                <div class="input-wrapper">
                                    <i class="fas fa-tag"></i>
                                    <select id="subject" name="subject" required>
                                        <option value="">Select a topic</option>
                                        <option value="general">General Inquiry</option>
                                        <option value="reservation">Table Reservation</option>
                                        <option value="catering">Catering & Events</option>
                                        <option value="feedback">Feedback & Suggestions</option>
                                        <option value="complaint">Complaint</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <span class="error-message" id="subjectError"></span>
                            </div>

                            <div class="form-group">
                                <label for="message">Your Message <span class="required">*</span></label>
                                <div class="input-wrapper textarea-wrapper">
                                    <i class="fas fa-comment"></i>
                                    <textarea id="message" name="message" rows="5"
                                        placeholder="Tell us how we can help you..." required></textarea>
                                </div>
                                <span class="error-message" id="messageError"></span>
                            </div>

                            <button type="submit" class="btn-submit">
                                <i class="fas fa-paper-plane"></i> Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== SUCCESS MODAL ========== -->
    <div class="modal-overlay" id="successModal" style="display: none;">
        <div class="modal-card success-modal">
            <div class="success-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h2>Message Sent Successfully!</h2>
            <p>Thank you for reaching out! We've received your message and our team will get back to you within
                <strong>24 hours</strong>.</p>
            <p class="success-subtitle">In the meantime, feel free to browse our menu or check out our latest
                promotions!</p>
            <div class="modal-actions">
                <a href="menu.php" class="btn-primary">
                    <i class="fas fa-utensils"></i> Browse Menu
                </a>
                <button class="btn-secondary-modal" id="btnCloseModal">
                    <i class="fas fa-times"></i> Close
                </button>
            </div>
        </div>
    </div>

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
    <script src="../assets/js/contact.js"></script>
</body>

</html>