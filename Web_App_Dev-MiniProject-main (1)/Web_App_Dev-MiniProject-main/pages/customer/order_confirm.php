<!-- order_confirm.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed - Restoran SUP TULANG ZZ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>

    <!-- ========== HEADER ========== -->
    <?php include '../../includes/header.php'; ?>

    <!-- ========== ORDER CONFIRMATION ========== -->
    <main class="confirmation-page">
        <div class="container">
            <div class="confirmation-card">
                <!-- Success Animation -->
                <div class="confirmation-icon">
                    <i class="fas fa-check-circle"></i>
                </div>

                <h1>Order Placed Successfully!</h1>
                <p class="confirmation-subtitle">Thank you for your order. We're preparing it now! 🍜</p>

                <!-- Order Details -->
                <div class="order-details-box">
                    <div class="order-detail-row">
                        <span class="detail-label"><i class="fas fa-receipt"></i> Order ID</span>
                        <span class="detail-value" id="confirmOrderId">
                            <?php echo isset($_GET['order_id']) ? '#' . htmlspecialchars($_GET['order_id']) : '#-------'; ?>
                        </span>
                    </div>
                    <div class="order-detail-row">
                        <span class="detail-label"><i class="far fa-clock"></i> Estimated Time</span>
                        <span class="detail-value">20 – 35 minutes</span>
                    </div>
                    <div class="order-detail-row">
                        <span class="detail-label"><i class="fas fa-concierge-bell"></i> Status</span>
                        <span class="detail-value status-badge status-pending">
                            <i class="fas fa-hourglass-half"></i> Pending
                        </span>
                    </div>
                </div>

                <!-- Order Summary from localStorage (cleared after displaying) -->
                <div class="confirmed-items" id="confirmedItems">
                    <!-- Populated by JS -->
                </div>

                <p class="confirmation-note">
                    <i class="fas fa-bell"></i>
                    You'll receive updates on your order status. You can track your order at any time.
                </p>

                <!-- Action Buttons -->
                <div class="confirmation-actions">
                    <a href="order-status.php" class="btn-primary">
                        <i class="fas fa-search"></i> Track My Order
                    </a>
                    <a href="../menu.php" class="btn-secondary">
                        <i class="fas fa-utensils"></i> Order More
                    </a>
                    <a href="../../index.php" class="btn-ghost">
                        <i class="fas fa-home"></i> Back to Home
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- ========== FOOTER ========== -->
    <?php include '../../includes/footer.php'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Display last order items from localStorage then clear cart
            const cart = JSON.parse(localStorage.getItem('restaurantCart') || '[]');
            const container = document.getElementById('confirmedItems');
            if (cart.length > 0) {
                let subtotal = 0;
                const rows = cart.map(item => {
                    const lineTotal = item.price * item.quantity;
                    subtotal += lineTotal;
                    return `<div class="confirmed-item-row">
                        <span>${item.name} x${item.quantity}</span>
                        <span>RM ${lineTotal.toFixed(2)}</span>
                    </div>`;
                }).join('');
                const tax = subtotal * 0.06;
                const total = subtotal + tax;
                container.innerHTML = `
                    <div class="confirmed-items-list">
                        ${rows}
                        <div class="confirmed-total-row">
                            <span><strong>Total (incl. 6% tax)</strong></span>
                            <span><strong>RM ${total.toFixed(2)}</strong></span>
                        </div>
                    </div>`;
                // Clear cart after confirming
                localStorage.removeItem('restaurantCart');
                // Update cart badges to 0
                document.querySelectorAll('.cart-badge, #cartBadge, #floatingCartCount').forEach(el => {
                    el.textContent = '0';
                    el.style.display = 'none';
                });
            }
        });
    </script>
</body>

</html>