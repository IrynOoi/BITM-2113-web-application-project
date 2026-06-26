<?php
// Start session only if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ── Dynamic base path ──────────────────────────────────────
// Calculates how many levels deep the current file is from htdocs/
// So $base always resolves back to WebMiniProject/ root
$scriptPath   = str_replace('\\', '/', $_SERVER['SCRIPT_FILENAME']);
$htdocsPos    = strpos($scriptPath, 'htdocs/');
$relativePath = $htdocsPos !== false ? substr($scriptPath, $htdocsPos + 7) : '';
$depth        = substr_count($relativePath, '/') - 1;
$base         = str_repeat('../', $depth);
// $base examples:
//   index.php                  (depth 1) → ../            = WebMiniProject/
//   pages/menu.php             (depth 2) → ../../         = WebMiniProject/
//   pages/customer/cart.php    (depth 3) → ../../../      = WebMiniProject/

// Active page detection
$currentPage = basename($_SERVER['PHP_SELF']);
function isActivePage($page) {
    global $currentPage;
    return $currentPage === $page ? 'active' : '';
}
?>
<!-- ========== TOP HEADER ========== -->
<header class="header">
    <div class="header-container">
        <a href="<?= $base ?>index.php" class="logo">
            <img src="<?= $base ?>assets/images/Logo.jpeg" alt="Restoran SUP TULANG ZZ Logo" class="logo-img">
            <h1>Restoran SUP TULANG ZZ</h1>
        </a>
        <div class="header-icons">
            <a href="<?= $base ?>pages/customer/cart.php" class="icon-link">
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
            <li><a href="<?= $base ?>index.php" class="<?= isActivePage('index.php') ?>">Home</a></li>
            <li><a href="<?= $base ?>pages/menu.php" class="<?= isActivePage('menu.php') ?>">Menu</a></li>
            <li><a href="<?= $base ?>pages/news-events.php" class="<?= isActivePage('news-events.php') ?>">News &amp; Events</a></li>
            <li><a href="<?= $base ?>pages/about.php" class="<?= isActivePage('about.php') ?>">About</a></li>
            <li><a href="<?= $base ?>pages/contact.php" class="<?= isActivePage('contact.php') ?>">Contact</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="<?= $base ?>pages/customer/dashboard.php" class="btn-login">
                    <i class="fas fa-user"></i> <?= htmlspecialchars($_SESSION['user_name']) ?>
                </a></li>
                <li><a href="<?= $base ?>api/auth.php?action=logout" class="btn-register">Logout</a></li>
            <?php else: ?>
                <li><a href="<?= $base ?>pages/login.php" class="btn-login <?= isActivePage('login.php') ?>">Login</a></li>
                <li><a href="<?= $base ?>pages/register.php" class="btn-register <?= isActivePage('register.php') ?>">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const menuToggle = document.getElementById('menuToggle');
        const desktopNav = document.getElementById('desktopNav');
        if (menuToggle && desktopNav) {
            menuToggle.addEventListener('click', function () {
                desktopNav.classList.toggle('active');
                this.querySelector('i').className =
                    desktopNav.classList.contains('active') ? 'fas fa-times' : 'fas fa-bars';
            });
            document.addEventListener('click', function (e) {
                if (!menuToggle.contains(e.target) && !desktopNav.contains(e.target)) {
                    desktopNav.classList.remove('active');
                    menuToggle.querySelector('i').className = 'fas fa-bars';
                }
            });
        }
        // Cart badge from localStorage
        const cart  = JSON.parse(localStorage.getItem('restaurantCart') || '[]');
        const count = cart.reduce((sum, i) => sum + i.quantity, 0);
        const badge = document.getElementById('cartBadge');
        if (badge) { badge.textContent = count; badge.style.display = count > 0 ? 'flex' : 'none'; }
    });
</script>
