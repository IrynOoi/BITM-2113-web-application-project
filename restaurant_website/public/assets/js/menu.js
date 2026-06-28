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
                    <button class="btn-add-cart-sm" data-item-id="${item.id}" style="width:100%;">
                        <i class="fas fa-plus"></i> Add to Cart
                    </button>
                </div>
            </div>
        </div>
    `).join('');

    menuGrid.querySelectorAll('.btn-add-cart-sm').forEach(button => {
        button.addEventListener('click', () => {
            const item = menuData.find(menuItem => menuItem.id === Number(button.dataset.itemId));
            if (item) openQtySelector(item, button);
        });
    });
}

// ========================================
// QUANTITY SELECTOR POPUP
// ========================================
let _qtyPopupItem = null;
let _qtyPopupBtn  = null;

function openQtySelector(item, triggerBtn) {
    _qtyPopupItem = item;
    _qtyPopupBtn  = triggerBtn;

    let popup = document.getElementById('qtySelectorPopup');
    if (!popup) {
        popup = document.createElement('div');
        popup.id = 'qtySelectorPopup';
        popup.style.cssText = 'position:fixed;inset:0;z-index:9998;display:flex;align-items:center;justify-content:center;background:rgba(0,0,0,0.45);backdrop-filter:blur(2px);';
        popup.innerHTML = `
            <div style="background:#fff;border-radius:18px;padding:28px 24px;width:300px;text-align:center;box-shadow:0 16px 48px rgba(0,0,0,0.2);">
                <p id="qtyItemName" style="font-size:1rem;font-weight:800;color:#2c3e50;margin-bottom:4px;"></p>
                <p id="qtyItemPrice" style="font-size:0.9rem;color:#c0392b;font-weight:700;margin-bottom:20px;"></p>
                <div style="display:flex;align-items:center;justify-content:center;gap:20px;margin-bottom:22px;">
                    <button onclick="changeQty(-1)" style="width:40px;height:40px;border-radius:50%;border:2px solid #e0e0e0;background:#fff;font-size:1.3rem;cursor:pointer;font-weight:700;color:#2c3e50;">−</button>
                    <span id="qtyValue" style="font-size:1.5rem;font-weight:800;color:#2c3e50;min-width:36px;">1</span>
                    <button onclick="changeQty(1)" style="width:40px;height:40px;border-radius:50%;border:2px solid #e0e0e0;background:#fff;font-size:1.3rem;cursor:pointer;font-weight:700;color:#2c3e50;">+</button>
                </div>
                <div style="display:flex;gap:10px;">
                    <button onclick="confirmQtyAdd()" style="flex:1;padding:12px;background:linear-gradient(135deg,#c0392b,#e74c3c);color:#fff;border:none;border-radius:12px;font-size:0.95rem;font-weight:700;cursor:pointer;">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                    <button onclick="closeQtySelector()" style="padding:12px 16px;background:#f5f5f5;color:#666;border:none;border-radius:12px;font-size:0.875rem;cursor:pointer;font-weight:600;">Cancel</button>
                </div>
            </div>`;
        popup.addEventListener('click', e => { if (e.target === popup) closeQtySelector(); });
        document.body.appendChild(popup);
    }

    document.getElementById('qtyItemName').textContent = item.name;
    document.getElementById('qtyItemPrice').textContent = 'RM ' + item.price.toFixed(2);
    document.getElementById('qtyValue').textContent = '1';
    popup.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function changeQty(delta) {
    const el = document.getElementById('qtyValue');
    el.textContent = Math.max(1, parseInt(el.textContent) + delta);
}

function confirmQtyAdd() {
    if (!_qtyPopupItem) return;
    const qty = parseInt(document.getElementById('qtyValue').textContent) || 1;
    for (let i = 0; i < qty; i++) addToCartHandler(_qtyPopupItem, _qtyPopupBtn);
    closeQtySelector();
}

function closeQtySelector() {
    const popup = document.getElementById('qtySelectorPopup');
    if (popup) popup.style.display = 'none';
    document.body.style.overflow = '';
    _qtyPopupItem = null;
    _qtyPopupBtn  = null;
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

let _modalItem = null;

function viewDetail(id) {
    const item = menuData.find(i => i.id === id);
    if (!item) return;
    _modalItem = item;

    const modal = document.getElementById('itemModal');
    document.getElementById('modalName').textContent = item.name;
    document.getElementById('modalPrice').textContent = 'RM ' + item.price.toFixed(2);
    document.getElementById('modalCategory').textContent = item.category || '';
    document.getElementById('modalDesc').textContent = item.description || 'No description available.';

    // Rating stars
    const ratingEl = document.getElementById('modalRating');
    if (item.rating > 0) {
        const stars = '★'.repeat(Math.round(item.rating)) + '☆'.repeat(5 - Math.round(item.rating));
        ratingEl.textContent = stars + '  ' + item.rating + ' / 5';
    } else {
        ratingEl.textContent = '';
    }

    // Badge
    const badgeEl = document.getElementById('modalBadge');
    if (item.badge) {
        badgeEl.textContent = item.badge === 'bestseller' ? '🔥 Best Seller' : item.badge === 'new' ? '✨ New' : item.badge === 'spicy' ? '🌶️ Spicy' : item.badge;
        badgeEl.style.display = 'inline-block';
    } else {
        badgeEl.style.display = 'none';
    }

    // Image
    const img = document.getElementById('modalImg');
    img.src = getMenuItemImage(item.id);
    img.onerror = () => { img.src = getFallbackImage(); };

    // Availability
    const addBtn = document.getElementById('modalAddBtn');
    if (item.is_available === false || item.is_available === 0) {
        addBtn.disabled = true;
        addBtn.style.opacity = '0.5';
        addBtn.innerHTML = '<i class="fas fa-ban"></i> Unavailable';
    } else {
        addBtn.disabled = false;
        addBtn.style.opacity = '1';
        addBtn.innerHTML = '<i class="fas fa-shopping-cart"></i> Add to Cart';
    }

    // Reset quantity
    document.getElementById('modalQty').textContent = '1';

    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function changeModalQty(delta) {
    const qtyEl = document.getElementById('modalQty');
    const current = parseInt(qtyEl.textContent);
    const next = Math.max(1, current + delta);
    qtyEl.textContent = next;
}

function closeItemModal() {
    document.getElementById('itemModal').style.display = 'none';
    document.body.style.overflow = '';
    _modalItem = null;
}

function addToCartFromModal() {
    if (!_modalItem) return;
    const qty = parseInt(document.getElementById('modalQty').textContent) || 1;
    const btn = document.getElementById('modalAddBtn');
    for (let i = 0; i < qty; i++) addToCartHandler(_modalItem, btn);
    setTimeout(closeItemModal, 600);
}

// Close modal on backdrop click
document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('itemModal').addEventListener('click', function(e) {
        if (e.target === this) closeItemModal();
    });
});

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
