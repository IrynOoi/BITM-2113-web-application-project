<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard - Restoran SUP TULANG ZZ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/staff.css">
</head>
<body>

    <!-- ========== STAFF LAYOUT ========== -->
    <div class="staff-layout">
        
        <!-- Sidebar -->
        <aside class="staff-sidebar" id="staffSidebar">
            <div class="sidebar-header">
                <img src="../../assets/images/Logo.jpeg" alt="Logo" class="sidebar-logo">
                <h2>Staff Panel</h2>
            </div>
            
            <nav class="sidebar-nav">
                <a href="dashboard.php" class="nav-item active">
                    <i class="fas fa-th-large"></i> Dashboard
                </a>
                <a href="manage-orders.php" class="nav-item">
                    <i class="fas fa-clipboard-list"></i> Manage Orders
                </a>
                <a href="manage-menu.php" class="nav-item">
                    <i class="fas fa-utensils"></i> Manage Menu
                </a>
                <a href="manage-tables.php" class="nav-item">
                    <i class="fas fa-chair"></i> Manage Tables
                </a>
                <a href="manage-users.php" class="nav-item">
                    <i class="fas fa-users"></i> Manage Users
                </a>
            </nav>
            
            <div class="sidebar-footer">
                <a href="../../api/auth.php?action=logout" class="nav-item"> 
                    <i class="fas fa-sign-out-alt"></i> Logout <!-- For development purposes (easy to navigate to Homepage) will update to logout page-->
                </a>
            </div>
        </aside>
        
        <!-- Mobile Sidebar Toggle -->
        <button class="sidebar-toggle" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        
        <!-- Main Content -->
        <main class="staff-main">
            <div class="staff-header">
                <h1>Dashboard</h1>
                <div class="staff-header-right">
                    <span class="staff-greeting">Welcome, Admin</span>
                    <div class="staff-avatar">
                        <i class="fas fa-user-circle"></i>
                    </div>
                </div>
            </div>
            
            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon orders">
                        <i class="fas fa-receipt"></i>
                    </div>
                    <div class="stat-info">
                        <span class="stat-value">24</span>
                        <span class="stat-label">Total Orders Today</span>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon pending">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-info">
                        <span class="stat-value">5</span>
                        <span class="stat-label">Pending Orders</span>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon completed">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-info">
                        <span class="stat-value">18</span>
                        <span class="stat-label">Completed</span>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon tables">
                        <i class="fas fa-chair"></i>
                    </div>
                    <div class="stat-info">
                        <span class="stat-value">12/30</span>
                        <span class="stat-label">Tables Occupied</span>
                    </div>
                </div>
            </div>
            
            <!-- Recent Orders Table -->
            <div class="staff-section">
                <div class="section-top">
                    <h2>Recent Orders</h2>
                    <a href="manage-orders.php" class="btn-view-all">View All <i class="fas fa-arrow-right"></i></a>
                </div>
                
                <div class="table-responsive">
                    <table class="staff-table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Table</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#1023</td>
                                <td>Table 5</td>
                                <td>3</td>
                                <td>RM 35.00</td>
                                <td><span class="status-badge pending">Pending</span></td>
                                <td>10:30 AM</td>
                                <td><a href="manage-orders.php" class="btn-view">View</a></td>
                            </tr>
                            <tr>
                                <td>#1024</td>
                                <td>Table 12</td>
                                <td>5</td>
                                <td>RM 62.50</td>
                                <td><span class="status-badge preparing">Preparing</span></td>
                                <td>10:35 AM</td>
                                <td><a href="manage-orders.php" class="btn-view">View</a></td>
                            </tr>
                            <tr>
                                <td>#1025</td>
                                <td>Table 3</td>
                                <td>2</td>
                                <td>RM 18.00</td>
                                <td><span class="status-badge ready">Ready</span></td>
                                <td>10:20 AM</td>
                                <td><a href="manage-orders.php" class="btn-view">View</a></td>
                            </tr>
                            <tr>
                                <td>#1026</td>
                                <td>Online</td>
                                <td>4</td>
                                <td>RM 45.00</td>
                                <td><span class="status-badge completed">Completed</span></td>
                                <td>10:15 AM</td>
                                <td><a href="manage-orders.php" class="btn-view">View</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('staffSidebar').classList.toggle('open');
        });
    </script>
</body>
</html>