// ========================================
// API HELPER - Backend Connection
// ========================================

const API_BASE = window.apiBase || '';

const api = {
    // Get menu items
    async getMenu(category = '') {
        try {
            const url = category 
                ? `${API_BASE}/api/menu?category=${category}`
                : `${API_BASE}/api/menu`;
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
            const response = await fetch(`${API_BASE}/customer/orders`, {
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
            const response = await fetch(`${API_BASE}/api/orders/status?order_id=${orderId}`);
            return await response.json();
        } catch (error) {
            console.error('Failed to get order status:', error);
            return null;
        }
    }
};
