// main.js
// ========================================
// MAIN JAVASCRIPT - Home Page
// ========================================

// Wait for DOM to load
document.addEventListener('DOMContentLoaded', function () {
    initMobileMenu();
    updateCartBadge();
    initSmoothScroll();
    initHeaderScroll();
    initAddToCartButtons();
    loadPopularItems();
    initSearch();
    initSlider(); // 👈 新增：初始化 Slider
});

// ========================================
// IMAGE SLIDER
// ========================================
let sliderInterval;
let currentSlide = 0;
const totalSlides = 12;
const autoPlayDelay = 5000; // 5 seconds

function initSlider() {
    const sliderWrapper = document.getElementById('sliderWrapper');
    const dots = document.querySelectorAll('.slider-dot');
    const arrowLeft = document.getElementById('sliderArrowLeft');
    const arrowRight = document.getElementById('sliderArrowRight');
    const sliderContainer = document.querySelector('.slider-container');

    // Exit if slider doesn't exist on this page
    if (!sliderWrapper || dots.length === 0) return;

    console.log('🎠 Slider initialized with ' + totalSlides + ' slides');

    // Go to specific slide
    function goToSlide(index) {
        // Handle loop
        if (index < 0) {
            index = totalSlides - 1;
        } else if (index >= totalSlides) {
            index = 0;
        }

        currentSlide = index;
        sliderWrapper.style.transform = `translateX(-${currentSlide * 100}%)`;

        // Update dots
        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === currentSlide);
        });
    }

    // Next slide
    function nextSlide() {
        goToSlide(currentSlide + 1);
    }

    // Previous slide
    function prevSlide() {
        goToSlide(currentSlide - 1);
    }

    // Reset auto-play timer
    function resetAutoPlay() {
        clearInterval(sliderInterval);
        sliderInterval = setInterval(nextSlide, autoPlayDelay);
    }

    // Arrow click events
    if (arrowLeft) {
        arrowLeft.addEventListener('click', function () {
            prevSlide();
            resetAutoPlay();
        });
    }

    if (arrowRight) {
        arrowRight.addEventListener('click', function () {
            nextSlide();
            resetAutoPlay();
        });
    }

    // Dot click events
    dots.forEach(function (dot) {
        dot.addEventListener('click', function () {
            const index = parseInt(this.getAttribute('data-index'));
            goToSlide(index);
            resetAutoPlay();
        });
    });

    // Touch/Swipe support for mobile
    let touchStartX = 0;
    let touchEndX = 0;

    sliderWrapper.addEventListener('touchstart', function (e) {
        touchStartX = e.changedTouches[0].screenX;
    }, { passive: true });

    sliderWrapper.addEventListener('touchend', function (e) {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    }, { passive: true });

    function handleSwipe() {
        const swipeThreshold = 50;
        const diff = touchStartX - touchEndX;

        if (Math.abs(diff) > swipeThreshold) {
            if (diff > 0) {
                nextSlide(); // Swipe left → go to next
            } else {
                prevSlide(); // Swipe right → go to previous
            }
            resetAutoPlay();
        }
    }

    // Keyboard navigation
    document.addEventListener('keydown', function (e) {
        const sliderSection = document.querySelector('.image-slider-section');
        if (!sliderSection) return;

        const rect = sliderSection.getBoundingClientRect();
        const isInView = rect.top < window.innerHeight && rect.bottom > 0;

        if (isInView) {
            if (e.key === 'ArrowLeft') {
                prevSlide();
                resetAutoPlay();
            } else if (e.key === 'ArrowRight') {
                nextSlide();
                resetAutoPlay();
            }
        }
    });

    // Pause on hover
    if (sliderContainer) {
        sliderContainer.addEventListener('mouseenter', function () {
            clearInterval(sliderInterval);
        });

        sliderContainer.addEventListener('mouseleave', function () {
            sliderInterval = setInterval(nextSlide, autoPlayDelay);
        });
    }

    // Start auto-play
    sliderInterval = setInterval(nextSlide, autoPlayDelay);
}

// ========================================
// MOBILE MENU TOGGLE
// ========================================
function initMobileMenu() {
    const menuToggle = document.getElementById('menuToggle');
    const desktopNav = document.getElementById('desktopNav');

    if (menuToggle && desktopNav) {
        menuToggle.addEventListener('click', function () {
            desktopNav.classList.toggle('active');

            // Change icon
            const icon = menuToggle.querySelector('i');
            if (desktopNav.classList.contains('active')) {
                icon.className = 'fas fa-times';
            } else {
                icon.className = 'fas fa-bars';
            }
        });

        // Close menu when clicking outside
        document.addEventListener('click', function (event) {
            if (!menuToggle.contains(event.target) && !desktopNav.contains(event.target)) {
                desktopNav.classList.remove('active');
                const icon = menuToggle.querySelector('i');
                icon.className = 'fas fa-bars';
            }
        });
    }
}

// ========================================
// CART MANAGEMENT
// ========================================
// Get cart from localStorage
function getCart() {
    const cart = localStorage.getItem('restaurantCart');
    return cart ? JSON.parse(cart) : [];
}

// Save cart to localStorage
function saveCart(cart) {
    localStorage.setItem('restaurantCart', JSON.stringify(cart));
}

// Add item to cart
function addToCart(id, name, price, image = '') {
    const cart = getCart();

    // Check if item already exists
    const existingItem = cart.find(item => item.id === id);

    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({
            id: id,
            name: name,
            price: price,
            image: image,
            quantity: 1
        });
    }

    saveCart(cart);
    updateCartBadge();

    // Show success animation
    showAddToCartAnimation(name);
}

// Remove item from cart
function removeFromCart(id) {
    let cart = getCart();
    cart = cart.filter(item => item.id !== id);
    saveCart(cart);
    updateCartBadge();
}

// Update quantity
function updateQuantity(id, quantity) {
    const cart = getCart();
    const item = cart.find(item => item.id === id);

    if (item) {
        item.quantity = quantity;
        if (item.quantity <= 0) {
            removeFromCart(id);
        } else {
            saveCart(cart);
        }
    }

    updateCartBadge();
}

// Get cart total
function getCartTotal() {
    const cart = getCart();
    return cart.reduce((total, item) => total + (item.price * item.quantity), 0);
}

// Get cart count
function getCartCount() {
    const cart = getCart();
    return cart.reduce((count, item) => count + item.quantity, 0);
}

// Update cart badge
function updateCartBadge() {
    const badges = document.querySelectorAll('.cart-badge');
    const count = getCartCount();

    badges.forEach(badge => {
        badge.textContent = count;

        // Hide badge if cart is empty
        if (count === 0) {
            badge.style.display = 'none';
        } else {
            badge.style.display = 'flex';
            // Add pulse animation
            badge.style.animation = 'pulse 0.3s ease';
            setTimeout(() => {
                badge.style.animation = '';
            }, 300);
        }
    });
}

// Show animation when adding to cart
function showAddToCartAnimation(itemName) {
    // Create toast notification
    const toast = document.createElement('div');
    toast.className = 'cart-toast';
    toast.innerHTML = `
        <i class="fas fa-check-circle"></i>
        <span>${itemName} added to cart!</span>
    `;

    // Style the toast
    toast.style.cssText = `
        position: fixed;
        bottom: 100px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #28A745;
        color: white;
        padding: 12px 24px;
        border-radius: 25px;
        font-weight: 600;
        font-size: 0.95rem;
        z-index: 9999;
        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        animation: fadeInUp 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    `;

    document.body.appendChild(toast);

    // Remove after 2 seconds
    setTimeout(() => {
        toast.style.animation = 'fadeOutDown 0.3s ease';
        setTimeout(() => {
            document.body.removeChild(toast);
        }, 300);
    }, 2000);
}

// Add fadeOutDown animation
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeOutDown {
        from {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }
        to {
            opacity: 0;
            transform: translateX(-50%) translateY(20px);
        }
    }
`;
document.head.appendChild(style);

// ========================================
// INIT ADD TO CART BUTTONS
// ========================================
function initAddToCartButtons() {
    document.addEventListener('click', function (event) {
        if (event.target.closest('.btn-add-cart')) {
            const button = event.target.closest('.btn-add-cart');
        }
    });
}

// ========================================
// SMOOTH SCROLL
// ========================================
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href !== '#') {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });
}

// ========================================
// HEADER SCROLL EFFECT
// ========================================
function initHeaderScroll() {
    const header = document.querySelector('.header');

    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;

        if (currentScroll > 50) {
            header.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.1)';
        } else {
            header.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.05)';
        }
    });
}

// ========================================
// SEARCH FUNCTIONALITY
// ========================================
function initSearch() {
    const searchInput = document.querySelector('.search-bar input');

    if (searchInput) {
        searchInput.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                const query = this.value.trim();
                if (query) {
                    window.location.href = `pages/menu.php?search=${encodeURIComponent(query)}`;
                }
            }
        });
    }
}

// ========================================
// POPULAR ITEMS - DYNAMIC LOADING
// ========================================
function loadPopularItems() {
    // Static data for now
}

function renderPopularItems(items) {
    const popularGrid = document.querySelector('.popular-grid');
    if (!popularGrid) return;

    popularGrid.innerHTML = items.map(item => `
        <div class="popular-item">
            <img src="${item.image}" alt="${item.name}">
            <h3>${item.name}</h3>
            <span class="rating">⭐ ${item.rating}</span>
        </div>
    `).join('');
}

// ========================================
// VIDEO FALLBACK
// ========================================
function initVideoFallback() {
    const videos = document.querySelectorAll('video');

    videos.forEach(video => {
        video.addEventListener('error', function () {
            const fallback = this.querySelector('img');
            if (fallback) {
                this.style.display = 'none';
                fallback.style.display = 'block';
            }
        });
    });
}

initVideoFallback();

// ========================================
// LAZY LOADING IMAGES
// ========================================
function initLazyLoading() {
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                    }
                    imageObserver.unobserve(img);
                }
            });
        });

        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }
}

initLazyLoading();

// ========================================
// UTILITY FUNCTIONS
// ========================================
function formatCurrency(amount) {
    return 'RM ' + parseFloat(amount).toFixed(2);
}

function getUrlParameter(name) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
}

function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// ========================================
// EXPORT FUNCTIONS FOR OTHER PAGES
// ========================================
window.restaurantApp = {
    getCart,
    saveCart,
    addToCart,
    removeFromCart,
    updateQuantity,
    getCartTotal,
    getCartCount,
    updateCartBadge,
    formatCurrency,
    getUrlParameter
};

console.log('🍽️ Restaurant Order Management System');
console.log('Frontend initialized successfully!');
console.log('Cart items:', getCartCount());