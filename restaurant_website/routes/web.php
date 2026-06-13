<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PageController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\StaffController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/menu', [PageController::class, 'menu'])->name('menu');
Route::get('/news-events', [PageController::class, 'newsEvents'])->name('news-events');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
    Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
    Route::get('/customer/cart', [CustomerController::class, 'cart'])->name('customer.cart');
    Route::get('/customer/checkout', [CustomerController::class, 'checkout'])->name('customer.checkout');
    Route::post('/customer/orders', [CustomerController::class, 'storeOrder'])->name('customer.orders.store');
    Route::get('/customer/order-confirm', [CustomerController::class, 'orderConfirm'])->name('customer.order-confirm');
    Route::get('/customer/order-status', [CustomerController::class, 'orderStatus'])->name('customer.order-status');
    Route::get('/customer/order-history', [CustomerController::class, 'orderHistory'])->name('customer.order-history');
    Route::get('/customer/profile', [CustomerController::class, 'profile'])->name('customer.profile');
    Route::patch('/customer/profile', [CustomerController::class, 'updateProfile'])->name('customer.profile.update');
    Route::get('/customer/qr-order', [CustomerController::class, 'qrOrder'])->name('customer.qr-order');

    Route::get('/staff/dashboard', [StaffController::class, 'dashboard'])->name('staff.dashboard');
    Route::get('/staff/manage-orders', [StaffController::class, 'orders'])->name('staff.orders');
    Route::patch('/staff/orders/{order}/status', [StaffController::class, 'updateOrderStatus'])->name('staff.orders.status');
    Route::get('/staff/manage-menu', [StaffController::class, 'menu'])->name('staff.menu');
    Route::post('/staff/menu', [StaffController::class, 'storeMenuItem'])->name('staff.menu.store');
    Route::put('/staff/menu/{menuItem}', [StaffController::class, 'updateMenuItem'])->name('staff.menu.update');
    Route::patch('/staff/menu/{menuItem}/toggle', [StaffController::class, 'toggleMenuAvailability'])->name('staff.menu.toggle');
    Route::delete('/staff/menu/{menuItem}', [StaffController::class, 'destroyMenuItem'])->name('staff.menu.destroy');
    Route::get('/staff/manage-tables', [StaffController::class, 'tables'])->name('staff.tables');
    Route::post('/staff/tables', [StaffController::class, 'storeTable'])->name('staff.tables.store');
    Route::delete('/staff/tables/{table}', [StaffController::class, 'destroyTable'])->name('staff.tables.destroy');
    Route::get('/staff/manage-users', [StaffController::class, 'users'])->name('staff.users');
    Route::patch('/staff/users/{user}/toggle-status', [StaffController::class, 'toggleUserStatus'])->name('staff.users.toggle');
    Route::get('/staff/reports', [StaffController::class, 'reports'])->name('staff.reports');

    Route::get('/api/orders/status', [CustomerController::class, 'orderStatusJson'])->name('api.orders.status');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
