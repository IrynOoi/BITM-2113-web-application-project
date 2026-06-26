// api.js
// ========================================
// API HELPER - Backend Connection
// ========================================

const API_BASE = 'http://localhost/WebMiniProject/backend/api';

const api = {
    // Get menu items
    async getMenu(category = '') {
        try {
            const url = category
                ? `${API_BASE}/menu.php?category=${category}`
                : `${API_BASE}/menu.php`;
            const response = await fetch(url);
            return await response.json();
        } catch (error) {
            console.error('Failed to fetch menu:', error);
            return [];
        }
    },

    // Place an order
    async placeOrder(orderData) {
        try {
            const response = await fetch(`${API_BASE}/orders.php`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(orderData)
            });
            return await response.json();
        } catch (error) {
            console.error('Failed to place order:', error);
            return { success: false, message: 'Network error' };
        }
    },

    // Get order status
    async getOrderStatus(orderId) {
        try {
            const response = await fetch(`${API_BASE}/orders.php?order_id=${orderId}`);
            return await response.json();
        } catch (error) {
            console.error('Failed to get order status:', error);
            return null;
        }
    }
};