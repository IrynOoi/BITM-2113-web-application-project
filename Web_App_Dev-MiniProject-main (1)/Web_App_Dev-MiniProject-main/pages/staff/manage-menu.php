<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Menu - Restoran SUP TULANG ZZ</title>
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
                <a href="manage-menu.php" class="nav-item active"><i class="fas fa-utensils"></i> Manage Menu</a>
                <a href="manage-tables.php" class="nav-item"><i class="fas fa-chair"></i> Manage Tables</a>
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
                <h1>Manage Menu</h1>
            </div>
            
            <!-- Search Menu Bar -->
            <div class="filter-bar">
                <input type="text" id="menuSearch" placeholder="Search menu..." class="filter-input" style="width: 300px;">
                <button id="searchClear" style="display: none; background: none; border: none; cursor: pointer; color: #999;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="table-responsive">
                <table class="staff-table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="menuTableBody">
                        <!-- Loaded by JS -->
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Shared Menu Data -->
    <script src="../../assets/js/menu.js?v=2"></script>
    <script>
        // Sidebar toggle
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('staffSidebar').classList.toggle('open');
        });

        // Render menu table with toggle
        const tbody = document.getElementById('menuTableBody');
        tbody.innerHTML = menuData.map((item, index) => {
            const imgNum = index + 1;
            return `
                <tr>
                    <td><img src="../../assets/images/menu-image/item${imgNum}.png" class="menu-thumb" alt="${item.name}" onerror="this.style.display='none'"></td>
                    <td>${item.name}</td>
                    <td>${item.category.replace(/-/g, ' ').replace(/\b\w/g, c => c.toUpperCase())}</td>
                    <td>RM ${item.price.toFixed(2)}</td>
                    <td><span class="status-badge available" id="status-${item.id}">Available</span></td>
                    <td>
                        <button class="btn-toggle available" id="btn-${item.id}" onclick="toggleStatus(${item.id})">
                            <i class="fas fa-toggle-on"></i>
                        </button>
                    </td>
                </tr>
            `;
        }).join('');

        // Toggle function
        function toggleStatus(id) {
            const badge = document.getElementById('status-' + id);
            const btn = document.getElementById('btn-' + id);
            const isAvailable = badge.classList.contains('available');
            
            if (isAvailable) {
                badge.classList.remove('available');
                badge.classList.add('unavailable');
                badge.textContent = 'Out of Stock';
                btn.classList.remove('available');
                btn.classList.add('unavailable');
                btn.innerHTML = '<i class="fas fa-toggle-off"></i>';
            } else {
                badge.classList.remove('unavailable');
                badge.classList.add('available');
                badge.textContent = 'Available';
                btn.classList.remove('unavailable');
                btn.classList.add('available');
                btn.innerHTML = '<i class="fas fa-toggle-on"></i>';
            }
        }

        // Search functionality
        const searchInput = document.getElementById('menuSearch');
        const searchClear = document.getElementById('searchClear');
        
        searchInput.addEventListener('input', function() {
            const query = this.value.trim().toLowerCase();
            searchClear.style.display = query ? 'block' : 'none';
            
            const rows = tbody.querySelectorAll('tr');
            rows.forEach(row => {
                const name = row.cells[1].textContent.toLowerCase();
                const category = row.cells[2].textContent.toLowerCase();
                row.style.display = (name.includes(query) || category.includes(query)) ? '' : 'none';
            });
        });
        
        searchClear.addEventListener('click', function() {
            searchInput.value = '';
            this.style.display = 'none';
            tbody.querySelectorAll('tr').forEach(row => row.style.display = '');
        });
    </script>
</body>
</html>