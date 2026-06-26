// contact.js
// ========================================
// CONTACT PAGE JAVASCRIPT
// ========================================

document.addEventListener('DOMContentLoaded', function () {
    initMobileMenu();
    updateCartBadge();
    initContactForm();
});

// ========================================
// CONTACT FORM VALIDATION & SUBMISSION
// ========================================
function initContactForm() {
    const form = document.getElementById('contactForm');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        // Clear previous errors
        clearErrors();

        // Get form values
        const fullName = document.getElementById('fullName').value.trim();
        const email = document.getElementById('email').value.trim();
        const subject = document.getElementById('subject').value;
        const message = document.getElementById('message').value.trim();

        // Validate
        let isValid = true;

        if (!fullName) {
            showError('fullName', 'nameError', 'Please enter your full name');
            isValid = false;
        } else if (fullName.length < 3) {
            showError('fullName', 'nameError', 'Name must be at least 3 characters');
            isValid = false;
        }

        if (!email) {
            showError('email', 'emailError', 'Please enter your email address');
            isValid = false;
        } else if (!isValidEmail(email)) {
            showError('email', 'emailError', 'Please enter a valid email address');
            isValid = false;
        }

        if (!subject) {
            showError('subject', 'subjectError', 'Please select a topic');
            isValid = false;
        }

        if (!message) {
            showError('message', 'messageError', 'Please enter your message');
            isValid = false;
        } else if (message.length < 10) {
            showError('message', 'messageError', 'Message must be at least 10 characters');
            isValid = false;
        }

        if (isValid) {
            // Show success modal
            showSuccessModal();

            // Reset form
            form.reset();

            // In production, send data to backend here
            console.log('Form submitted:', { fullName, email, subject, message });
        }
    });

    // Real-time error clearing
    const inputs = form.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        input.addEventListener('input', function () {
            this.classList.remove('error');
            const errorId = this.id + 'Error';
            const errorEl = document.getElementById(errorId);
            if (errorEl) errorEl.textContent = '';
        });
    });
}

// ========================================
// SHOW ERROR
// ========================================
function showError(inputId, errorId, message) {
    const input = document.getElementById(inputId);
    const errorEl = document.getElementById(errorId);

    if (input) input.classList.add('error');
    if (errorEl) errorEl.textContent = message;
}

// ========================================
// CLEAR ERRORS
// ========================================
function clearErrors() {
    document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
    document.querySelectorAll('.error').forEach(el => el.classList.remove('error'));
}

// ========================================
// EMAIL VALIDATION
// ========================================
function isValidEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

// ========================================
// SUCCESS MODAL
// ========================================
function showSuccessModal() {
    const modal = document.getElementById('successModal');
    const closeBtn = document.getElementById('btnCloseModal');

    if (!modal) return;

    modal.style.display = 'flex';

    // Close button
    if (closeBtn) {
        closeBtn.addEventListener('click', function () {
            modal.style.display = 'none';
        });
    }

    // Close on overlay click
    modal.addEventListener('click', function (e) {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });

    // Close on Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && modal.style.display === 'flex') {
            modal.style.display = 'none';
        }
    });
}

// ========================================
// MOBILE MENU
// ========================================
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