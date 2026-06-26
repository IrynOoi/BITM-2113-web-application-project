<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Tables - Restoran SUP TULANG ZZ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/staff.css?v=2">
</head>
<body>

    <div class="staff-layout">
        <aside class="staff-sidebar" id="staffSidebar">
            <div class="sidebar-header">
                <img src="../../assets/images/Logo.jpeg" alt="Logo" class="sidebar-logo">
                <h2>Staff Panel</h2>
            </div>
            <nav class="sidebar-nav">
                <a href="dashboard.php" class="nav-item"><i class="fas fa-th-large"></i> Dashboard</a>
                <a href="manage-orders.php" class="nav-item"><i class="fas fa-clipboard-list"></i> Manage Orders</a>
                <a href="manage-menu.php" class="nav-item"><i class="fas fa-utensils"></i> Manage Menu</a>
                <a href="manage-tables.php" class="nav-item active"><i class="fas fa-chair"></i> Manage Tables</a>
                <a href="manage-users.php" class="nav-item"><i class="fas fa-users"></i> Manage Users</a>
            </nav>
            <div class="sidebar-footer">
                <a href="../../api/auth.php?action=logout" class="nav-item"> 
                    <i class="fas fa-sign-out-alt"></i> Logout <!-- For development purposes (easy to navigate to Homepage) will update to logout page-->
                </a>
            </div>
        </aside>
        
        <button class="sidebar-toggle" id="sidebarToggle"><i class="fas fa-bars"></i></button>
        
        <main class="staff-main">
            <div class="staff-header">
                <h1>Manage Tables</h1>
                <button class="btn-add"><i class="fas fa-plus"></i> Add Table</button>
            </div>
            
            <!-- Table Grid -->
            <div class="tables-grid">
                <?php for ($i = 1; $i <= 30; $i++): ?> 
                <div class="table-card <?php echo $i <= 8 ? 'occupied' : 'available'; ?>">
                    <div class="table-qr">
                        <img src="../../assets/images/Table-QRs/qr<?php echo $i; ?>.jpeg" alt="QR Code" onerror="this.style.display='none'">
                    </div>
                    <span class="table-num">Table <?php echo $i; ?></span>
                    <span class="table-status"><?php echo $i <= 8 ? 'Occupied' : 'Available'; ?></span>
                    <?php if ($i <= 8): ?>
                    <small>3 pax • RM 45.00</small>
                    <?php endif; ?>
                    <button class="btn-table-action" onclick="viewTable(<?php echo $i; ?>)">View</button>
                </div>
                <?php endfor; ?>
            </div>
        </main>
    </div>

    <!-- Table Detail Modal -->
    <div class="modal-overlay" id="tableModal" style="display: none;">
        <div class="modal-card table-detail-modal">
            <div class="modal-header">
                <h2 id="modalTableTitle">Table 1</h2>
                <button class="modal-close" onclick="closeModal()"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="table-detail-qr">
                    <img id="modalQrImage" src="" alt="QR Code" style="display:none;">
                    <p class="qr-label">Table QR Code</p>
                </div>
                <div class="table-detail-info">
                    <div class="detail-row">
                        <span class="detail-label">Status</span>
                        <span class="detail-value" id="modalStatus">Available</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Current Order</span>
                        <span class="detail-value" id="modalOrder">-</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Pax</span>
                        <span class="detail-value" id="modalPax">-</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Total</span>
                        <span class="detail-value" id="modalTotal">-</span>
                    </div>
                </div>
            </div>
            <div class="modal-actions">
                <button class="btn-cancel" onclick="closeModal()">Close</button>
            </div>
        </div>
    </div>

    <!-- Add Table Modal -->
    <div class="modal-overlay" id="addTableModal" style="display: none;">
        <div class="modal-card add-table-modal">
            <div class="modal-header">
                <h2>Add New Table</h2>
                <button class="modal-close" onclick="closeAddModal()"><i class="fas fa-times"></i></button>
            </div>
            <form class="add-table-form" id="addTableForm">
                <div class="form-group">
                    <label for="tableNumber">Table Number <span class="required">*</span></label>
                    <input type="number" id="tableNumber" min="1" placeholder="e.g. 31" required>
                    <span class="error-message" id="tableNumberError"></span>
                </div>
                <p class="form-hint">
                    <i class="fas fa-info-circle"></i> 
                    QR code will be generated automatically after table is added.
                </p>
                <div class="modal-actions">
                    <button type="submit" class="btn-confirm">
                        <i class="fas fa-plus"></i> Add Table</button>
                    <button type="button" class="btn-cancel" onclick="closeAddModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Sidebar toggle
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('staffSidebar').classList.toggle('open');
        });

        // View table detail
        function viewTable(tableNum) {
            const modal = document.getElementById('tableModal');
            document.getElementById('modalTableTitle').textContent = 'Table ' + tableNum;
            
            // Update QR image dynamically
            const qrImg = document.getElementById('modalQrImage');
            qrImg.src = '../../assets/images/Table-QRs/qr' + tableNum + '.jpeg';
            qrImg.style.display = 'block';
            
            // Demo data - replace with real data later
            if (tableNum <= 8) {
                document.getElementById('modalStatus').innerHTML = '<span class="status-badge preparing">Occupied</span>';
                document.getElementById('modalOrder').textContent = '#102' + tableNum;
                document.getElementById('modalPax').textContent = '3 pax';
                document.getElementById('modalTotal').textContent = 'RM 45.00';
            } else {
                document.getElementById('modalStatus').innerHTML = '<span class="status-badge available">Available</span>';
                document.getElementById('modalOrder').textContent = '-';
                document.getElementById('modalPax').textContent = '-';
                document.getElementById('modalTotal').textContent = '-';
            }
            
            modal.style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('tableModal').style.display = 'none';
        }

        // Close on overlay click
        document.getElementById('tableModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });

        // Add Table Modal
        document.querySelector('.btn-add').addEventListener('click', function() {
            document.getElementById('addTableModal').style.display = 'flex';
        });

        function closeAddModal() {
            document.getElementById('addTableModal').style.display = 'none';
        }

        document.getElementById('addTableModal').addEventListener('click', function(e) {
            if (e.target === this) closeAddModal();
        });

        // Add Table Form Submit
        document.getElementById('addTableForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const tableNum = document.getElementById('tableNumber').value;
            if (!tableNum || tableNum < 1) {
                document.getElementById('tableNumberError').textContent = 'Please enter a valid table number';
                return;
            }
            // TODO: Backend - save to database
            alert('✅ Table ' + tableNum + ' added! QR code will be generated.');
            closeAddModal();
            document.getElementById('tableNumber').value = '';
        });
    </script>
</body>
</html>