<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - Restoran SUP TULANG ZZ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/staff.css">
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
                <a href="manage-tables.php" class="nav-item"><i class="fas fa-chair"></i> Manage Tables</a>
                <a href="manage-users.php" class="nav-item active"><i class="fas fa-users"></i> Manage Users</a>
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
                <h1>Manage Users</h1>
                <button class="btn-add"><i class="fas fa-plus"></i> Add User</button>
            </div>
            
            <div class="table-responsive">
                <table class="staff-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>Admin</td><td>admin@suptulang.com</td><td><span class="role-badge admin">Admin</span></td><td><span class="status-badge available">Active</span></td><td><button class="btn-edit"><i class="fas fa-edit"></i></button> <button class="btn-delete"><i class="fas fa-trash"></i></button></td></tr>
                        <tr><td>Chef Zulkifli</td><td>chef@suptulang.com</td><td><span class="role-badge staff">Staff</span></td><td><span class="status-badge available">Active</span></td><td><button class="btn-edit"><i class="fas fa-edit"></i></button> <button class="btn-delete"><i class="fas fa-trash"></i></button></td></tr>
                        <tr><td>Waiter Ali</td><td>ali@suptulang.com</td><td><span class="role-badge waiter">Waiter</span></td><td><span class="status-badge available">Active</span></td><td><button class="btn-edit"><i class="fas fa-edit"></i></button> <button class="btn-delete"><i class="fas fa-trash"></i></button></td></tr>
                        <tr><td>Waiter Siti</td><td>siti@suptulang.com</td><td><span class="role-badge waiter">Waiter</span></td><td><span class="status-badge unavailable">Inactive</span></td><td><button class="btn-edit"><i class="fas fa-edit"></i></button> <button class="btn-delete"><i class="fas fa-trash"></i></button></td></tr>
                    </tbody>
                </table>
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