-- ============================================================
-- schema.sql — Database Schema
-- Restoran SUP TULANG ZZ Order Management System
-- Member 2 — MySQL DB creation
-- ============================================================

-- Create and select the database
CREATE DATABASE IF NOT EXISTS restaurant_oms
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE restaurant_oms;

-- ─────────────────────────────────────────────
-- Table 1: users
-- ─────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS users (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    full_name   VARCHAR(100) NOT NULL,
    email       VARCHAR(150) NOT NULL UNIQUE,
    phone       VARCHAR(20)  NOT NULL,
    password    VARCHAR(255) NOT NULL,           -- bcrypt hash
    role        ENUM('customer','staff','admin') NOT NULL DEFAULT 'customer',
    address     TEXT,
    is_active   TINYINT(1) NOT NULL DEFAULT 1,   -- soft-delete flag
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ─────────────────────────────────────────────
-- Table 2: menu_items
-- ─────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS menu_items (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(150) NOT NULL,
    description TEXT,
    price       DECIMAL(8,2) NOT NULL,
    category    ENUM('main','drinks','dessert','snacks','soup') NOT NULL,
    image_path  VARCHAR(255),
    is_available TINYINT(1) NOT NULL DEFAULT 1,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ─────────────────────────────────────────────
-- Table 3: orders
-- ─────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS orders (
    id              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id         INT UNSIGNED,                -- NULL for walk-in/QR orders
    customer_name   VARCHAR(100) NOT NULL,
    customer_phone  VARCHAR(20)  NOT NULL,
    order_type      ENUM('dine-in','takeaway','delivery') NOT NULL,
    table_number    INT UNSIGNED,               -- for dine-in
    delivery_address TEXT,                      -- for delivery
    special_notes   TEXT,
    payment_method  ENUM('cash','online_transfer') NOT NULL DEFAULT 'cash',
    receipt_path    VARCHAR(255),               -- uploaded receipt path
    subtotal        DECIMAL(8,2) NOT NULL DEFAULT 0.00,
    tax             DECIMAL(8,2) NOT NULL DEFAULT 0.00,
    delivery_fee    DECIMAL(8,2) NOT NULL DEFAULT 0.00,
    total           DECIMAL(8,2) NOT NULL DEFAULT 0.00,
    status          ENUM('pending','confirmed','preparing','ready','completed','cancelled')
                    NOT NULL DEFAULT 'pending',
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ─────────────────────────────────────────────
-- Table 4: order_items
-- ─────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS order_items (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    order_id    INT UNSIGNED NOT NULL,
    menu_item_id INT UNSIGNED NOT NULL,
    item_name   VARCHAR(150) NOT NULL,          -- snapshot at time of order
    unit_price  DECIMAL(8,2) NOT NULL,
    quantity    TINYINT UNSIGNED NOT NULL DEFAULT 1,
    line_total  DECIMAL(8,2) NOT NULL,
    FOREIGN KEY (order_id)     REFERENCES orders(id)     ON DELETE CASCADE,
    FOREIGN KEY (menu_item_id) REFERENCES menu_items(id) ON DELETE RESTRICT
) ENGINE=InnoDB;

-- ─────────────────────────────────────────────
-- Indexes for common queries
-- ─────────────────────────────────────────────
CREATE INDEX idx_orders_user_id   ON orders(user_id);
CREATE INDEX idx_orders_status    ON orders(status);
CREATE INDEX idx_orders_created   ON orders(created_at);
CREATE INDEX idx_order_items_order ON order_items(order_id);
CREATE INDEX idx_menu_category    ON menu_items(category);
