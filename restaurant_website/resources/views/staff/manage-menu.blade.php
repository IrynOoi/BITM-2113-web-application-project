@extends('layouts.staff')

@section('title', 'Manage Menu - Restoran SUP TULANG ZZ')

@section('content')
<div class="staff-header">
    <h1>Manage Menu</h1>
</div>

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
        <tbody id="menuTableBody"></tbody>
    </table>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/js/menu.js') }}"></script>
<script>
    const tbody = document.getElementById('menuTableBody');
    tbody.innerHTML = menuData.map((item) => {
        const image = `${window.restaurantAssetBase}/images/menu-image/item${item.id}.png`;
        return `
            <tr>
                <td><img src="${image}" class="menu-thumb" alt="${item.name}" onerror="this.style.display='none'"></td>
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

    function toggleStatus(id) {
        const badge = document.getElementById('status-' + id);
        const btn = document.getElementById('btn-' + id);
        const isAvailable = badge.classList.contains('available');
        badge.classList.toggle('available', !isAvailable);
        badge.classList.toggle('unavailable', isAvailable);
        badge.textContent = isAvailable ? 'Out of Stock' : 'Available';
        btn.classList.toggle('available', !isAvailable);
        btn.classList.toggle('unavailable', isAvailable);
        btn.innerHTML = isAvailable ? '<i class="fas fa-toggle-off"></i>' : '<i class="fas fa-toggle-on"></i>';
    }

    const searchInput = document.getElementById('menuSearch');
    const searchClear = document.getElementById('searchClear');
    searchInput.addEventListener('input', function() {
        const query = this.value.trim().toLowerCase();
        searchClear.style.display = query ? 'block' : 'none';
        tbody.querySelectorAll('tr').forEach(row => {
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
@endsection
