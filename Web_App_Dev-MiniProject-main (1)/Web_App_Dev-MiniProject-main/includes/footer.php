<?php
if (!isset($base)) {
    $scriptPath = str_replace('\\', '/', $_SERVER['SCRIPT_FILENAME']);
    $htdocsPos  = strpos($scriptPath, 'htdocs/');
    $relativePath = $htdocsPos !== false ? substr($scriptPath, $htdocsPos + 7) : '';
    $depth = substr_count($relativePath, '/') - 1;
    $base  = str_repeat('../', $depth);
}
?>
<!-- ========== FOOTER ========== -->
<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-section">
                <h3><img src="<?= $base ?>assets/images/Footer-logo.jpeg" alt="Logo" style="height:50px;width:auto;vertical-align:middle;"> Restoran SUP TULANG ZZ</h3>
                <p>Delicious food, excellent service, memorable experience.</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul class="footer-links">
                    <li><a href="<?= $base ?>index.php"><i class="fas fa-chevron-right"></i> Home</a></li>
                    <li><a href="<?= $base ?>pages/menu.php"><i class="fas fa-chevron-right"></i> Menu</a></li>
                    <li><a href="<?= $base ?>pages/news-events.php"><i class="fas fa-chevron-right"></i> News &amp; Events</a></li>
                    <li><a href="<?= $base ?>pages/about.php"><i class="fas fa-chevron-right"></i> About</a></li>
                    <li><a href="<?= $base ?>pages/contact.php"><i class="fas fa-chevron-right"></i> Contact</a></li>
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
                    <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook"></i></a>
                    <a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.tiktok.com/en/" target="_blank"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?= date('Y') ?> Restaurant SUP TULANG ZZ. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- ========== BOTTOM MOBILE NAVIGATION ========== -->
<nav class="mobile-nav">
    <a href="<?= $base ?>index.php"><i class="fas fa-home"></i><span>Home</span></a>
    <a href="<?= $base ?>pages/menu.php"><i class="fas fa-utensils"></i><span>Menu</span></a>
    <a href="<?= $base ?>pages/customer/cart.php"><i class="fas fa-shopping-cart"></i><span>Cart</span></a>
    <a href="<?= $base ?>pages/customer/order-status.php"><i class="fas fa-receipt"></i><span>Orders</span></a>
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="<?= $base ?>pages/customer/dashboard.php"><i class="fas fa-user"></i><span><?= htmlspecialchars($_SESSION['user_name']) ?></span></a>
    <?php else: ?>
        <a href="<?= $base ?>pages/login.php"><i class="fas fa-user"></i><span>Login</span></a>
    <?php endif; ?>
</nav>
