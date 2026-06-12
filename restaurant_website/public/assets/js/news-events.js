// ========================================
// NEWS & EVENTS PAGE JAVASCRIPT
// ========================================

document.addEventListener('DOMContentLoaded', function() {
    initNewsFilter();
    initMobileMenu();
    updateCartBadge();
});

// ========================================
// FILTER FUNCTIONALITY
// ========================================
function initNewsFilter() {
    const filterBtns = document.querySelectorAll('.news-filter-btn');
    const newsCards = document.querySelectorAll('.news-card');
    const noResults = document.getElementById('newsNoResults');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Update active button
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            const filter = this.dataset.filter;
            let visibleCount = 0;
            
            // Filter cards
            newsCards.forEach(card => {
                if (filter === 'all' || card.dataset.category === filter) {
                    card.classList.remove('hidden');
                    visibleCount++;
                } else {
                    card.classList.add('hidden');
                }
            });
            
            // Show/hide no results
            if (noResults) {
                noResults.style.display = visibleCount === 0 ? 'block' : 'none';
            }
        });
    });
}

// ========================================
// MOBILE MENU
// ========================================
function initMobileMenu() {
    const menuToggle = document.getElementById('menuToggle');
    const desktopNav = document.getElementById('desktopNav');
    
    if (menuToggle && desktopNav) {
        menuToggle.addEventListener('click', function() {
            desktopNav.classList.toggle('active');
            const icon = menuToggle.querySelector('i');
            icon.className = desktopNav.classList.contains('active') ? 'fas fa-times' : 'fas fa-bars';
        });
        
        document.addEventListener('click', function(event) {
            if (!menuToggle.contains(event.target) && !desktopNav.contains(event.target)) {
                desktopNav.classList.remove('active');
                menuToggle.querySelector('i').className = 'fas fa-bars';
            }
        });
    }
}

// ========================================
// CART BADGE
// ========================================
function updateCartBadge() {
    const cart = JSON.parse(localStorage.getItem('restaurantCart') || '[]');
    const count = cart.reduce((sum, item) => sum + item.quantity, 0);
    
    const badge = document.getElementById('cartBadge');
    if (badge) {
        badge.textContent = count;
        badge.style.display = count > 0 ? 'flex' : 'none';
    }
}