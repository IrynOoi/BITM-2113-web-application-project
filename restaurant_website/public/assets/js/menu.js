//menu.js
// ========================================
// MENU PAGE JAVASCRIPT — Restoran SUP TULANG ZZ
// ========================================

// menuData is now injected via the blade template (menu.blade.php)

let activeCategory = 'all';
let searchQuery = '';

function getAssetBase() {
    return (window.restaurantAssetBase || '/assets').replace(/\/$/, '');
}

function getMenuItemImage(id) {
    return `${getAssetBase()}/images/menu-image/item${id}.png`;
}

function getFallbackImage() {
    return `${getAssetBase()}/images/Logo.jpeg`;
}

// ========================================
// INITIALIZATION
// ========================================
document.addEventListener('DOMContentLoaded', function () {
    renderMenuItems(menuData);
    initCategoryFilter();
    initSearch();
    initMobileMenu();
    updateCartBadge();
    updateFloatingCart();
});

// ========================================
// RENDER MENU ITEMS
// ========================================
function renderMenuItems(items) {
    const menuGrid = document.getElementById('menuGrid');
    const resultsCount = document.getElementById('resultsCount');
    const noResults = document.getElementById('noResults');

    if (!menuGrid) return;

    let filteredItems = items;
    if (activeCategory !== 'all') {
        filteredItems = filteredItems.filter(item => item.category === activeCategory);
    }
    if (searchQuery) {
        const query = searchQuery.toLowerCase();
        filteredItems = filteredItems.filter(item =>
            item.name.toLowerCase().includes(query) ||
            item.description.toLowerCase().includes(query)
        );
    }

    if (filteredItems.length === 0) {
        resultsCount.style.display = 'none';
        noResults.style.display = 'block';
        menuGrid.innerHTML = '';
        return;
    }

    resultsCount.style.display = 'block';
    noResults.style.display = 'none';
    resultsCount.textContent = `Showing ${filteredItems.length} item(s)`;

    menuGrid.innerHTML = filteredItems.map(item => `
        <div class="menu-item-card" data-category="${item.category}">
            <div class="menu-item-image">
                <img src="${item.image || getMenuItemImage(item.id)}" onerror="this.src='${getFallbackImage()}'" alt="${item.name}" loading="lazy">
                ${item.badge ? `<span class="menu-item-badge badge-${item.badge}">${getBadgeText(item.badge)}</span>` : ''}
            </div>
            <div class="menu-item-body">
                <div class="menu-item-header">
                    <h3 class="menu-item-name">${item.name}</h3>
                    <span class="menu-item-price">RM ${item.price.toFixed(2)}</span>
                </div>
                <p class="menu-item-description">${item.description}</p>
                <div class="menu-item-meta">
                    ${item.rating > 0 ? `<span>⭐ ${item.rating}</span>` : ''}
                    ${item.spicy ? '<span>🌶️ Spicy</span>' : ''}
                </div>
                <div class="menu-item-actions">
                    <button class="btn-view-detail" data-item-id="${item.id}">
                        <i class="fas fa-info-circle"></i> Details
                    </button>
                    <button class="btn-add-cart-sm" data-item-id="${item.id}">
                        <i class="fas fa-plus"></i> Add
                    </button>
                </div>
            </div>
        </div>
    `).join('');

    menuGrid.querySelectorAll('.btn-view-detail').forEach(button => {
        button.addEventListener('click', () => viewDetail(Number(button.dataset.itemId)));
    });

    menuGrid.querySelectorAll('.btn-add-cart-sm').forEach(button => {
        button.addEventListener('click', () => {
            const item = menuData.find(menuItem => menuItem.id === Number(button.dataset.itemId));
            if (item) addToCartHandler(item, button);
        });
    });
}

function getBadgeText(badge) {
    const badges = {
        'bestseller': '🔥 Best Seller',
        'new': '✨ New',
        'spicy': '🌶️ Spicy'
    };
    return badges[badge] || badge;
}

// ========================================
// CATEGORY FILTER
// ========================================
function initCategoryFilter() {
    const filterBtns = document.querySelectorAll('.filter-btn');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            activeCategory = this.dataset.category;
            renderMenuItems(menuData);
        });
    });

    const urlParams = new URLSearchParams(window.location.search);
    const categoryParam = urlParams.get('category');
    if (categoryParam) {
        const targetBtn = document.querySelector(`[data-category="${categoryParam}"]`);
        if (targetBtn) targetBtn.click();
    }
}

// ========================================
// SEARCH FUNCTIONALITY
// ========================================
function initSearch() {
    const searchInput = document.getElementById('menuSearch');
    const searchClear = document.getElementById('searchClear');

    if (!searchInput) return;

    searchInput.addEventListener('input', function () {
        searchQuery = this.value.trim();
        if (searchClear) searchClear.style.display = searchQuery ? 'block' : 'none';
        renderMenuItems(menuData);
    });

    if (searchClear) {
        searchClear.addEventListener('click', function () {
            searchInput.value = '';
            searchQuery = '';
            this.style.display = 'none';
            renderMenuItems(menuData);
            searchInput.focus();
        });
    }

    const urlParams = new URLSearchParams(window.location.search);
    const searchParam = urlParams.get('search');
    if (searchParam) {
        searchInput.value = searchParam;
        searchQuery = searchParam;
        if (searchClear) searchClear.style.display = 'block';
        renderMenuItems(menuData);
    }
}

// ========================================
// ADD TO CART
// ========================================
function addToCartHandler(item, button) {
    const cart = JSON.parse(localStorage.getItem('restaurantCart') || '[]');
    const image = item.image || getMenuItemImage(item.id);

    const existingItem = cart.find(cartItem => cartItem.id === item.id);
    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({ id: item.id, name: item.name, price: item.price, image, quantity: 1 });
    }

    localStorage.setItem('restaurantCart', JSON.stringify(cart));
    updateCartBadge();
    updateFloatingCart();
    showToast(`${item.name} added to cart!`);

    if (button) {
        button.classList.add('added');
        button.innerHTML = '<i class="fas fa-check"></i> Added';
        setTimeout(() => {
            button.classList.remove('added');
            button.innerHTML = '<i class="fas fa-plus"></i> Add';
        }, 1500);
    }
}

function viewDetail(id) {
    const item = menuData.find(i => i.id === id);
    if (item) {
        alert(`${item.name}\n\n${item.description}\n\nPrice: RM ${item.price.toFixed(2)}\n${item.rating > 0 ? 'Rating: ⭐ ' + item.rating : ''}`);
    }
}

function updateCartBadge() {
    const cart = JSON.parse(localStorage.getItem('restaurantCart') || '[]');
    const count = cart.reduce((sum, item) => sum + item.quantity, 0);
    document.querySelectorAll('.cart-badge').forEach(badge => {
        badge.textContent = count;
        badge.style.display = count > 0 ? 'flex' : 'none';
    });
}

function updateFloatingCart() {
    const cart = JSON.parse(localStorage.getItem('restaurantCart') || '[]');
    const count = cart.reduce((sum, item) => sum + item.quantity, 0);
    const floatingCount = document.getElementById('floatingCartCount');
    const floatingCart = document.getElementById('floatingCart');
    if (floatingCount) floatingCount.textContent = count;
    if (floatingCart) floatingCart.style.display = count > 0 ? 'flex' : 'none';
}

function showToast(message) {
    const container = document.getElementById('toastContainer');
    if (!container) return;
    const toast = document.createElement('div');
    toast.className = 'toast';
    toast.innerHTML = `<i class="fas fa-check-circle"></i> ${message}`;
    container.appendChild(toast);
    setTimeout(() => { if (toast.parentNode) toast.parentNode.removeChild(toast); }, 2000);
}

function initMobileMenu() {
    const menuToggle = document.getElementById('menuToggle');
    const desktopNav = document.getElementById('desktopNav');
    if (menuToggle && desktopNav) {
        menuToggle.addEventListener('click', function () {
            desktopNav.classList.toggle('active');
            const icon = menuToggle.querySelector('i');
            icon.className = desktopNav.classList.contains('active') ? 'fas fa-times' : 'fas fa-bars';
        });
        document.addEventListener('click', function (event) {
            if (!menuToggle.contains(event.target) && !desktopNav.contains(event.target)) {
                desktopNav.classList.remove('active');
                menuToggle.querySelector('i').className = 'fas fa-bars';
            }
        });
    }
}
