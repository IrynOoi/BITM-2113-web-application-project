// qr-order.js

// ========================================
// QR ORDER PAGE JS — Restoran SUP TULANG ZZ
// ========================================

// Menu items loaded from database via /api/menu-items
let menuItems = [
];

let currentTable = 1;
let currentPax = 1;
let currentOrder = [];
let activeCategory = "all";
let searchQuery = '';
const MAX_TABLE = 30;
const MAX_PAX = 10;

function getAssetBase() {
    return (window.restaurantAssetBase || '/assets').replace(/\/$/, '');
}

function getMenuItemImage(id) {
    return `${getAssetBase()}/images/menu-image/item${id}.png`;
}

function getFallbackImage() {
    return `${getAssetBase()}/images/Logo.jpeg`;
}

document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    let autoStart = false;

    if (urlParams.has('table')) {
        let tbl = parseInt(urlParams.get('table'));
        if (tbl >= 1 && tbl <= MAX_TABLE) {
            currentTable = tbl;
            document.getElementById('tableValue').textContent = currentTable;
            // Hide table scroller — table is already known from QR
            const tableScrollerGroup = document.getElementById('tableScrollerGroup');
            if (tableScrollerGroup) tableScrollerGroup.style.display = 'none';
        }
    }

    if (urlParams.has('pax')) {
        let pax = parseInt(urlParams.get('pax'));
        if (pax >= 1 && pax <= MAX_PAX) {
            currentPax = pax;
            document.getElementById('paxValue').textContent = currentPax;
            const paxScrollerGroup = document.getElementById('paxScrollerGroup');
            if (paxScrollerGroup) paxScrollerGroup.style.display = 'none';
            // Only auto-skip to menu when pax is also known (Order More scenario)
            autoStart = true;
        }
    }

    initScrollers();
    initDineIn();
    updateCartBadge();
    initQrNav();

    // Load menu from database, then auto-start if needed
    fetch('/api/menu-items')
        .then(res => res.json())
        .then(data => {
            // Map DB categories to display categories used by filter buttons
            const categoryMap = {
                'soup': 'signature-sup',
                'main': 'sarapan-panas',
                'snacks': 'sarapan-roti',
                'drinks': 'drinks-noncoffee',
                'dessert': 'drinks-dessert',
            };
            menuItems = data.map(item => ({
                id: item.id,
                name: item.name,
                category: categoryMap[item.category] || item.category,
                price: parseFloat(item.price),
                image: item.image_path || '',
                badge: '',
            }));

            if (autoStart) {
                document.getElementById('tableSelectionScreen').style.display = 'none';
                document.getElementById('menuOrderScreen').style.display = 'block';
                document.getElementById('orderSummaryBar').style.display = 'block';
                document.getElementById('displayTableNumber').textContent = currentTable;
                document.getElementById('displayPax').textContent = currentPax + ' pax';
                document.getElementById('confirmTable').textContent = currentTable;
                document.getElementById('confirmPax').textContent = currentPax;
                initSearch();
                renderMenu(menuItems);
                initCategoryFilter();
                initOrderPanel();
                initPlaceOrder();
                initChangeTable();
                initMobileMenu();
            }
        })
        .catch(() => {
            // API failed — keep using hardcoded menuItems as fallback
            console.warn('Menu API failed, using cached menu.');
        });
});

// ========================================
// QR INTERNAL NAVIGATION
// ========================================
function initQrNav() {
    const navHome = document.getElementById('navHome');
    const navMenu = document.getElementById('navMenu');
    const navCart = document.getElementById('navCart');
    const navOrders = document.getElementById('navOrders');
    if (!navHome || !navMenu || !navCart || !navOrders) return;
    const navAll = [navHome, navMenu, navCart, navOrders];

    navHome.addEventListener('click', (e) => {
        e.preventDefault();
        document.getElementById('menuOrderScreen').style.display = 'none';
        document.getElementById('orderSummaryBar').style.display = 'none';
        document.getElementById('tableSelectionScreen').style.display = 'block';
        setActiveNav(navHome);
    });

    navMenu.addEventListener('click', (e) => {
        e.preventDefault();
        document.getElementById('tableSelectionScreen').style.display = 'none';
        document.getElementById('menuOrderScreen').style.display = 'block';
        document.getElementById('orderSummaryBar').style.display = 'block';
        setActiveNav(navMenu);
    });

    navCart.addEventListener('click', (e) => {
        e.preventDefault();
        const panel = document.getElementById('orderItemsPanel');
        const icon = document.getElementById('orderToggleIcon');
        panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
        icon.classList.toggle('open', panel.style.display !== 'none');
        setActiveNav(navCart);
    });

    navOrders.addEventListener('click', (e) => {
        e.preventDefault();
        window.location.href = window.orderStatusUrl || '/customer/order-status';
    });

    function setActiveNav(active) {
        navAll.forEach(n => n.classList.remove('active'));
        active.classList.add('active');
    }
}

// ========================================
// TABLE & PAX SCROLLERS
// ========================================
function initScrollers() {
    document.querySelectorAll('.scroller-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const target = this.dataset.target;
            const isUp = this.classList.contains('scroller-up');

            if (target === 'table') {
                currentTable += isUp ? 1 : -1;
                if (currentTable > MAX_TABLE) currentTable = 1;
                if (currentTable < 1) currentTable = MAX_TABLE;
                document.getElementById('tableValue').textContent = currentTable;
            } else if (target === 'pax') {
                currentPax += isUp ? 1 : -1;
                if (currentPax > MAX_PAX) currentPax = 1;
                if (currentPax < 1) currentPax = MAX_PAX;
                document.getElementById('paxValue').textContent = currentPax;
            }
        });
    });
}

// ========================================
// DINE IN BUTTON
// ========================================
function initDineIn() {
    document.getElementById('btnDineIn').addEventListener('click', () => {
        document.getElementById('tableSelectionScreen').style.display = 'none';
        document.getElementById('menuOrderScreen').style.display = 'block';
        document.getElementById('orderSummaryBar').style.display = 'block';
        document.getElementById('displayTableNumber').textContent = currentTable;
        document.getElementById('displayPax').textContent = currentPax + ' pax';
        document.getElementById('confirmTable').textContent = currentTable;
        document.getElementById('confirmPax').textContent = currentPax;

        initSearch();
        renderMenu(menuItems);
        initCategoryFilter();
        initOrderPanel();
        initPlaceOrder();
        initChangeTable();
        initMobileMenu();
    });
}

// ========================================
// SEARCH FUNCTIONALITY
// ========================================
function initSearch() {
    const searchInput = document.getElementById('menuSearch');
    const searchClear = document.getElementById('searchClear');

    if (!searchInput) return;

    searchInput.addEventListener('input', function () {
        searchQuery = this.value.trim().toLowerCase();
        if (searchClear) searchClear.style.display = searchQuery ? 'block' : 'none';
        renderMenu(menuItems);
    });

    if (searchClear) {
        searchClear.addEventListener('click', function () {
            searchInput.value = '';
            searchQuery = '';
            this.style.display = 'none';
            renderMenu(menuItems);
        });
    }
}

// ========================================
// CHANGE TABLE
// ========================================
function initChangeTable() {
    document.getElementById('btnChangeTable').addEventListener('click', () => {
        document.getElementById('tableSelectionScreen').style.display = 'flex';
        document.getElementById('menuOrderScreen').style.display = 'none';
        document.getElementById('orderSummaryBar').style.display = 'none';
    });
}

// ========================================
// RENDER MENU (with search support)
// ========================================
function renderMenu(items) {
    const grid = document.getElementById('menuGrid');
    const noResults = document.getElementById('noResults');

    // Filter by category
    let filtered = activeCategory === 'all' ? items : items.filter(i => i.category === activeCategory);

    // Filter by search query
    if (searchQuery) {
        filtered = filtered.filter(i => i.name.toLowerCase().includes(searchQuery));
    }

    if (filtered.length === 0) {
        grid.innerHTML = '';
        noResults.style.display = 'block';
        return;
    }
    noResults.style.display = 'none';

    grid.innerHTML = filtered.map(item => {
        const inOrder = currentOrder.find(o => o.id === item.id);
        const qty = inOrder ? inOrder.quantity : 0;
        return `
            <div class="menu-item-card">
                <div class="menu-item-image">
                    <img src="${getMenuItemImage(item.id)}" onerror="this.src='${getFallbackImage()}'" alt="${item.name}">
                    ${item.badge ? `<span class="menu-item-badge badge-${item.badge}">${getBadge(item.badge)}</span>` : ''}
                </div>
                <div class="menu-item-body">
                    <div class="menu-item-name">${item.name}</div>
                    <div class="menu-item-price">RM ${item.price.toFixed(2)}</div>
                    <div class="menu-item-footer">
                        ${qty > 0 ? `<span class="quantity-added">x${qty}</span>` : '<span></span>'}
                        <button class="btn-add-item ${qty > 0 ? 'added' : ''}" onclick="addToOrder(${item.id})">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
    }).join('');
}

function getBadge(b) { const m = { bestseller: '🔥', new: '✨', spicy: '🌶️' }; return m[b] || ''; }

function initCategoryFilter() {
    document.querySelectorAll('#categoryFilter .filter-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            if (this.id === 'btnMore') return; // Skip More button

            document.querySelectorAll('#categoryFilter .filter-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            activeCategory = this.dataset.category;
            renderMenu(menuItems);
        });
    });

    // More button toggle
    const btnMore = document.getElementById('btnMore');
    const moreCategories = document.getElementById('moreCategories');
    if (btnMore && moreCategories) {
        btnMore.addEventListener('click', function () {
            const isOpen = moreCategories.style.display !== 'none';
            moreCategories.style.display = isOpen ? 'none' : 'inline';
            const icon = btnMore.querySelector('i');
            icon.className = isOpen ? 'fas fa-chevron-down' : 'fas fa-chevron-up';
            btnMore.innerHTML = isOpen
                ? '<i class="fas fa-chevron-down"></i> More'
                : '<i class="fas fa-chevron-up"></i> Less';
        });
    }
}

// ========================================
// ORDER MANAGEMENT
// ========================================
function addToOrder(id) {
    const item = menuItems.find(i => i.id === id);
    const existing = currentOrder.find(o => o.id === id);
    existing ? existing.quantity++ : currentOrder.push({ id: item.id, name: item.name, price: item.price, quantity: 1 });
    renderMenu(menuItems);
    updateOrderSummary();
    showToast(`${item.name} added!`);
}

function removeFromOrder(id) {
    const existing = currentOrder.find(o => o.id === id);
    if (existing) {
        existing.quantity--;
        if (existing.quantity <= 0) currentOrder = currentOrder.filter(o => o.id !== id);
    }
    renderMenu(menuItems);
    updateOrderSummary();
}

function initOrderPanel() {
    const btnToggle = document.getElementById('btnToggleOrder');
    const panel = document.getElementById('orderItemsPanel');
    const icon = document.getElementById('orderToggleIcon');

    btnToggle.addEventListener('click', () => {
        const isOpen = panel.style.display !== 'none';
        panel.style.display = isOpen ? 'none' : 'block';
        icon.classList.toggle('open', !isOpen);
    });

    document.getElementById('btnClearOrder').addEventListener('click', () => {
        currentOrder = [];
        renderMenu(menuItems);
        updateOrderSummary();
        panel.style.display = 'none';
        icon.classList.remove('open');
    });
}

function updateOrderSummary() {
    const count = currentOrder.reduce((s, i) => s + i.quantity, 0);
    const total = currentOrder.reduce((s, i) => s + i.price * i.quantity, 0);
    document.getElementById('orderCountBadge').textContent = count;
    document.getElementById('orderTotal').textContent = `RM ${total.toFixed(2)}`;
    document.getElementById('btnPlaceOrder').disabled = count === 0;

    const list = document.getElementById('orderItemsList');
    const empty = document.getElementById('orderEmpty');
    if (count === 0) {
        list.innerHTML = '';
        empty.style.display = 'block';
    } else {
        empty.style.display = 'none';
        list.innerHTML = currentOrder.map(o => `
            <div class="order-item-row">
                <span>${o.name}</span>
                <div style="display:flex;align-items:center;gap:0.5rem;">
                    <button class="qty-btn" onclick="removeFromOrder(${o.id})">−</button>
                    <span>${o.quantity}</span>
                    <button class="qty-btn" onclick="addToOrder(${o.id})">+</button>
                </div>
                <span class="order-item-price">RM ${(o.price * o.quantity).toFixed(2)}</span>
            </div>
        `).join('');
    }
}

// ========================================
// PLACE ORDER MODAL
// ========================================
function initPlaceOrder() {
    const btnPlace = document.getElementById('btnPlaceOrder');
    const modal = document.getElementById('placeOrderModal');
    const btnCancel = document.getElementById('btnCancelOrder');
    const btnConfirm = document.getElementById('btnConfirmOrder');
    const successModal = document.getElementById('successModal');

    btnPlace.addEventListener('click', () => {
        const count = currentOrder.reduce((s, i) => s + i.quantity, 0);
        const total = currentOrder.reduce((s, i) => s + i.price * i.quantity, 0);
        document.getElementById('confirmItems').textContent = count;
        document.getElementById('confirmTotal').textContent = `RM ${total.toFixed(2)}`;
        modal.style.display = 'flex';
    });

    btnCancel.addEventListener('click', () => modal.style.display = 'none');
    modal.addEventListener('click', e => { if (e.target === modal) modal.style.display = 'none'; });

    btnConfirm.addEventListener('click', () => {
        const notes = document.getElementById('specialInstructions').value;
        
        // Save the current order to localStorage for the checkout page
        localStorage.setItem('restaurantCart', JSON.stringify(currentOrder));
        
        btnConfirm.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Redirecting to Checkout...';
        btnConfirm.disabled = true;
        
        // Redirect to checkout with table, pax, and notes in query string
        const checkoutUrl = '/customer/checkout?type=dine-in&table=' + currentTable + '&pax=' + currentPax + '&notes=' + encodeURIComponent(notes) + '&qr=1';
        window.location.href = checkoutUrl;
    });

    document.getElementById('btnCloseSuccess').addEventListener('click', () => successModal.style.display = 'none');
    successModal.addEventListener('click', e => { if (e.target === successModal) successModal.style.display = 'none'; });
}

// ========================================
// HELPERS
// ========================================
function showToast(msg) {
    const container = document.getElementById('toastContainer');
    const toast = document.createElement('div');
    toast.className = 'toast';
    toast.textContent = msg;
    container.appendChild(toast);
    setTimeout(() => { if (toast.parentNode) toast.remove(); }, 1500);
}

function updateCartBadge() {
    const cart = JSON.parse(localStorage.getItem('restaurantCart') || '[]');
    const count = cart.reduce((s, i) => s + i.quantity, 0);
    const badge = document.getElementById('cartBadge');
    if (badge) { badge.textContent = count; badge.style.display = count > 0 ? 'flex' : 'none'; }
}

function initMobileMenu() {
    const menuToggle = document.getElementById('menuToggle');
    const desktopNav = document.getElementById('desktopNav');
    if (menuToggle && desktopNav) {
        menuToggle.addEventListener('click', () => {
            desktopNav.classList.toggle('active');
            menuToggle.querySelector('i').className = desktopNav.classList.contains('active') ? 'fas fa-times' : 'fas fa-bars';
        });
    }
}
