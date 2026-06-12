-- ============================================================
-- seed_data.sql — Sample / Demo Data
-- Restoran SUP TULANG ZZ Order Management System
-- Based on actual menu images
-- ============================================================

USE restaurant_oms;

-- ─────────────────────────────────────────────
-- Users (1 admin + 2 sample customers)
-- Passwords are bcrypt hashes of 'password123'
-- ─────────────────────────────────────────────
INSERT INTO users (full_name, email, phone, password, role, address) VALUES
(
    'Admin Restoran ZZ',
    'admin@suptulangzz.com',
    '012-3456789',
    '$2y$12$u0H3VpSHJH/yOAXFb3xvf.bG0zYjf4S1o3Jh7MqK9wD.1UpX8zfVm',
    'admin',
    'Jalan Example, Taman Melaka Raya, 75000 Melaka'
),
(
    'Ahmad Farid',
    'ahmad@example.com',
    '011-2345678',
    '$2y$12$u0H3VpSHJH/yOAXFb3xvf.bG0zYjf4S1o3Jh7MqK9wD.1UpX8zfVm',
    'customer',
    'No 12, Jalan Puteri, 75350 Melaka'
),
(
    'Siti Aisyah',
    'siti@example.com',
    '013-9876543',
    '$2y$12$u0H3VpSHJH/yOAXFb3xvf.bG0zYjf4S1o3Jh7MqK9wD.1UpX8zfVm',
    'customer',
    'Apartment Harmoni, Blok B-12, 75450 Melaka'
);

-- ─────────────────────────────────────────────
-- Menu Items — from actual restaurant menu
-- Categories: soup | main | snacks | drinks | dessert
-- ─────────────────────────────────────────────

INSERT INTO menu_items (name, description, price, category, image_path, is_available) VALUES

-- ══════════════════════════════════════════
-- SUP ZZ (Signature)
-- ══════════════════════════════════════════
('Sup Gearbox Kambing', 'Signature goat gearbox bone soup, slow-cooked in rich spiced broth. Add-on: Mee/Mee Hoon/Kuey Teow +RM2.0', 19.00, 'soup', NULL, 1),
('Sup Kambing', 'Tender mutton soup slow-cooked with aromatic herbs and spices.', 20.00, 'soup', NULL, 1),
('Sup Daging', 'Beef bone soup cooked with traditional spices. Add-on set: Nasi Putih + Telur Dadar + Sambal Belacan + Ulaman +RM5.0', 8.00, 'soup', NULL, 1),
('Sup Ayam', 'Hearty chicken soup with herbs. Add-on: Roti Francis/Roti Gardenia +RM2.50', 7.00, 'soup', NULL, 1),

-- ══════════════════════════════════════════
-- MEE REBUS ZZ
-- ══════════════════════════════════════════
('Mee Rebus Gearbox Kambing', 'Noodles in thick gravy with goat gearbox bone.', 20.00, 'main', NULL, 1),
('Mee Rebus Daging', 'Noodles in thick spiced gravy with beef.', 9.50, 'main', NULL, 1),
('Mee Rebus Ayam', 'Noodles in thick gravy with chicken.', 9.00, 'main', NULL, 1),

-- ══════════════════════════════════════════
-- SARAPAN — Masakan Panas
-- ══════════════════════════════════════════
('Lontong Kuah', 'Rice cakes in coconut vegetable curry.', 7.50, 'main', NULL, 1),
('Lontong Kering (Ayam)', 'Dry-style lontong with chicken rendang.', 9.00, 'main', NULL, 1),
('Lontong Kering (Daging)', 'Dry-style lontong with beef rendang.', 9.50, 'main', NULL, 1),
('Nasi Lemak Basmathi (Telur)', 'Fragrant basmathi coconut rice with egg.', 6.00, 'main', NULL, 1),
('Nasi Lemak Basmathi (Ayam)', 'Fragrant basmathi coconut rice with fried chicken.', 9.00, 'main', NULL, 1),
('Nasi Lemak Rendang (Ayam)', 'Coconut rice with chicken rendang.', 8.50, 'main', NULL, 1),
('Nasi Lemak Rendang (Daging)', 'Coconut rice with beef rendang.', 9.50, 'main', NULL, 1),
('Nasi Ayam Basmathi', 'Basmathi rice served with chicken.', 12.00, 'main', NULL, 1),
('Nasi Ambang', 'Traditional communal rice dish with assorted sides.', 9.50, 'main', NULL, 1),
('Bubur Nasi', 'Smooth rice porridge.', 7.50, 'main', NULL, 1),
('Bubur Ayam', 'Chicken rice porridge with condiments.', 7.00, 'main', NULL, 1),
('Laksa Johor', 'Johor-style laksa noodles.', 8.00, 'main', NULL, 1),
('Laksa Penang', 'Penang-style sour fish laksa.', 7.50, 'main', NULL, 1),
('Bakso (Mee/Mee Hoon/Nasi)', 'Indonesian-style meatball soup with choice of noodles or rice.', 7.50, 'main', NULL, 1),
('Soto (Mee/Mee Hoon/Nasi)', 'Traditional soto soup with choice of noodles or rice.', 8.00, 'main', NULL, 1),

-- ══════════════════════════════════════════
-- ROTI BAKAR & ROTI CANAI
-- ══════════════════════════════════════════
('Roti Bakar', 'Classic toasted bread.', 2.50, 'snacks', NULL, 1),
('Roti Kaya', 'Toasted bread with rich kaya (coconut egg jam).', 3.50, 'snacks', NULL, 1),
('Roti Garlic', 'Toasted garlic bread.', 3.50, 'snacks', NULL, 1),
('Roti Canai Kosong', 'Plain crispy flatbread served with dhal/curry. Available 7am–11am & 6pm–11pm.', 1.50, 'snacks', NULL, 1),
('Roti Canai Kosong Bawang', 'Flatbread with onion.', 2.00, 'snacks', NULL, 1),
('Roti Tampal', 'Flatbread with egg patched on top.', 2.80, 'snacks', NULL, 1),
('Roti Telur', 'Flatbread with egg inside.', 2.80, 'snacks', NULL, 1),
('Roti Telur Bawang', 'Flatbread with egg and onion.', 3.50, 'snacks', NULL, 1),
('Roti Telur Double Jantan', 'Double-egg flatbread.', 5.50, 'snacks', NULL, 1),
('Roti Pisang', 'Banana flatbread.', 4.50, 'snacks', NULL, 1),
('Roti Sardin', 'Sardine-filled flatbread.', 6.00, 'snacks', NULL, 1),
('Roti Bom', 'Thick fluffy flatbread.', 2.50, 'snacks', NULL, 1),
('Roti Planta', 'Flatbread with Planta margarine.', 3.00, 'snacks', NULL, 1),
('Roti Sarang Burung Daging', 'Bird nest-style flatbread with minced meat.', 8.00, 'snacks', NULL, 1),

-- ══════════════════════════════════════════
-- SET TENGAH HARI — Set Nasi & Lauk
-- ══════════════════════════════════════════
('Nasi Bawal Goreng Berlado', 'Fried pomfret with chili sambal, served with rice.', 9.00, 'main', NULL, 1),
('Nasi Siakap Goreng Berlado', 'Fried sea bass with chili sambal, served with rice.', 15.00, 'main', NULL, 1),
('Nasi Keli Goreng Berlado', 'Fried catfish with chili sambal, served with rice.', 10.90, 'main', NULL, 1),
('Nasi Ayam Goreng Berlado', 'Fried chicken with chili sambal, served with rice.', 8.50, 'main', NULL, 1),

-- ══════════════════════════════════════════
-- MENU IKAN
-- ══════════════════════════════════════════
('Ikan Siakap Tiga Rasa', 'Sea bass in three-flavour sauce (sweet, sour, spicy).', 37.50, 'main', NULL, 1),
('Ikan Siakap Masam Manis', 'Sea bass in sweet and sour sauce.', 37.50, 'main', NULL, 1),
('Ikan Siakap Steam Lemon', 'Steamed sea bass with lemon sauce.', 37.50, 'main', NULL, 1),
('Ikan Siakap Laprik', 'Sea bass in spicy sambal sauce.', 37.50, 'main', NULL, 1),
('Ikan Siakap Goreng Kunyit', 'Turmeric-fried sea bass.', 37.50, 'main', NULL, 1),
('Siakap Bakar', 'Grilled sea bass.', 37.50, 'main', NULL, 1),
('Caru Bakar', 'Grilled caru fish.', 11.50, 'main', NULL, 1),
('Kerang Bakar', 'Grilled cockles.', 15.00, 'main', NULL, 1),
('Sotong Bakar', 'Grilled squid.', 15.00, 'main', NULL, 1),

-- ══════════════════════════════════════════
-- GORENG-GORENG — Nasi Goreng
-- ══════════════════════════════════════════
('Nasi Goreng Biasa', 'Classic fried rice. Add: Daging +1.0 / Udang +3.0 / Sotong +3.0', 7.50, 'main', NULL, 1),
('Nasi Goreng Kampung', 'Village-style fried rice with anchovies.', 8.00, 'main', NULL, 1),
('Nasi Goreng Cina', 'Chinese-style fried rice.', 7.50, 'main', NULL, 1),
('Nasi Goreng Ikan Masin', 'Salted fish fried rice.', 8.50, 'main', NULL, 1),
('Nasi Goreng Cili Padi', 'Bird-eye chili fried rice — extra spicy!', 8.50, 'main', NULL, 1),
('Nasi Goreng Pattaya', 'Pattaya-style omelette-wrapped fried rice.', 8.50, 'main', NULL, 1),
('Nasi Goreng Tom Yam', 'Tom yam flavoured fried rice.', 9.00, 'main', NULL, 1),
('Nasi Goreng Belacan', 'Shrimp paste fried rice.', 12.00, 'main', NULL, 1),

-- GORENG-GORENG — Mee Goreng
('Mee Goreng', 'Classic stir-fried yellow noodles. Add: Daging +1.0 / Udang +3.0 / Sotong +3.0', 7.50, 'main', NULL, 1),
('Mee Hoon Goreng Singapore', 'Singapore-style stir-fried rice vermicelli.', 7.50, 'main', NULL, 1),
('Char Kuey Teow', 'Wok-fried flat rice noodles.', 8.00, 'main', NULL, 1),

-- ══════════════════════════════════════════
-- ALA-CARTE — Sayur
-- ══════════════════════════════════════════
('Kailan (Biasa)', 'Stir-fried kailan vegetables.', 7.00, 'main', NULL, 1),
('Kailan (Ikan Masin)', 'Stir-fried kailan with salted fish.', 7.00, 'main', NULL, 1),
('Kangkung (Biasa)', 'Stir-fried water spinach.', 7.00, 'main', NULL, 1),
('Kangkung Belacan', 'Stir-fried water spinach with shrimp paste.', 7.00, 'main', NULL, 1),
('Taugeh (Biasa)', 'Stir-fried bean sprouts.', 7.00, 'main', NULL, 1),
('Sawi (Biasa)', 'Stir-fried mustard greens.', 7.00, 'main', NULL, 1),
('Cendawan Goreng Biasa', 'Stir-fried mushrooms.', 7.00, 'main', NULL, 1),

-- ALA-CARTE — Aneka Lauk Thai
('Ayam Black Pepper', 'Black pepper chicken.', 7.50, 'main', NULL, 1),
('Daging Black Pepper', 'Black pepper beef.', 8.50, 'main', NULL, 1),
('Sotong Black Pepper', 'Black pepper squid.', 9.50, 'main', NULL, 1),
('Ayam Sambal', 'Sambal chicken.', 7.50, 'main', NULL, 1),
('Daging Sambal', 'Sambal beef.', 8.50, 'main', NULL, 1),
('Sotong Sambal', 'Sambal squid.', 9.50, 'main', NULL, 1),
('Ayam Merah', 'Red sauce chicken.', 7.50, 'main', NULL, 1),
('Daging Merah', 'Red sauce beef.', 8.50, 'main', NULL, 1),
('Sotong Merah', 'Red sauce squid.', 9.50, 'main', NULL, 1),
('Ayam Paprik', 'Thai paprik-style chicken.', 7.50, 'main', NULL, 1),
('Daging Paprik', 'Thai paprik-style beef.', 8.50, 'main', NULL, 1),
('Sotong Paprik', 'Thai paprik-style squid.', 9.50, 'main', NULL, 1),
('Ayam Phad Khra Phao', 'Thai basil chicken stir-fry.', 8.00, 'main', NULL, 1),
('Daging Phad Khra Phao', 'Thai basil beef stir-fry.', 9.00, 'main', NULL, 1),
('Ayam Kunyit', 'Turmeric chicken. Add On: Nasi Putih +2.0 / Nasi Goreng +3.0', 7.50, 'main', NULL, 1),
('Daging Kunyit', 'Turmeric beef.', 9.50, 'main', NULL, 1),
('Sotong Kunyit', 'Turmeric squid.', 9.50, 'main', NULL, 1),
('Udang Kunyit', 'Turmeric prawns.', 9.50, 'main', NULL, 1),

-- ALA-CARTE — Goreng Tepung
('Ayam Goreng Tepung', 'Crispy battered fried chicken.', 10.00, 'snacks', NULL, 1),

-- ══════════════════════════════════════════
-- ALA-CARTE — Mee Kuah
-- ══════════════════════════════════════════
('Mee Kuah Bandung', 'Bandung-style noodle soup (Mee/Mee Hoon/Kuey Teow).', 10.50, 'main', NULL, 1),
('Mee Kuah Hong Kong', 'Hong Kong-style noodle soup.', 10.50, 'main', NULL, 1),
('Mee Kuah Hailam', 'Hainanese-style noodle soup.', 10.50, 'main', NULL, 1),
('Mee Kuah Kung Fu', 'Kung Fu-style noodle soup.', 10.50, 'main', NULL, 1),

-- ══════════════════════════════════════════
-- SUP ALA THAI & TOMYAM
-- ══════════════════════════════════════════
('Sup Ayam Ala Thai', 'Thai-style chicken soup. Add On: Mee/Mee Hoon/Kuey Teow +2.0', 8.00, 'soup', NULL, 1),
('Sup Daging Ala Thai', 'Thai-style beef soup.', 9.00, 'soup', NULL, 1),
('Tom Yam Ayam', 'Spicy sour chicken tom yam (Seekaw/Sideng). Add On: Mee/Mee Hoon/Kuey Teow +2.0', 8.00, 'soup', NULL, 1),
('Tom Yam Daging', 'Spicy sour beef tom yam.', 9.00, 'soup', NULL, 1),
('Tom Yam Ayam + Daging', 'Mixed chicken and beef tom yam.', 12.00, 'soup', NULL, 1),
('Tom Yam Seafood', 'Seafood tom yam with prawns, squid, and fish.', 13.00, 'soup', NULL, 1),
('Tom Yam Campur', 'Mixed tom yam.', 13.00, 'soup', NULL, 1),
('Tom Yam Sayur', 'Vegetable tom yam.', 8.00, 'soup', NULL, 1),
('Tom Yam Cendawan', 'Mushroom tom yam.', 8.00, 'soup', NULL, 1),

-- ══════════════════════════════════════════
-- WESTERN FOOD
-- ══════════════════════════════════════════
('Chicken Chop Fried', 'Fried chicken chop with mushroom sauce and fries.', 18.50, 'main', NULL, 1),
('Chicken Chop Grill', 'Grilled chicken chop with mushroom sauce and fries.', 18.50, 'main', NULL, 1),
('Fish N Chips', 'Crispy battered fish with fries and coleslaw.', 16.50, 'main', NULL, 1),
('Lamb Chop', 'Grilled lamb chop with sauce and sides.', 30.90, 'main', NULL, 1),
('Spaghetti Aglio Olio (Seafood)', 'Garlic olive oil spaghetti with seafood.', 17.00, 'main', NULL, 1),
('Spaghetti Aglio Olio (Beef Bacon)', 'Garlic olive oil spaghetti with beef bacon.', 15.00, 'main', NULL, 1),
('Spaghetti Aglio Olio (Chicken)', 'Garlic olive oil spaghetti with chicken.', 13.00, 'main', NULL, 1),
('Spaghetti Carbonara (Seafood)', 'Creamy carbonara with seafood.', 18.00, 'main', NULL, 1),
('Spaghetti Carbonara (Beef Bacon)', 'Creamy carbonara with beef bacon.', 16.00, 'main', NULL, 1),
('Spaghetti Carbonara (Chicken)', 'Creamy carbonara with chicken.', 14.00, 'main', NULL, 1),
('Spaghetti Bolognese', 'Classic meat sauce spaghetti.', 15.00, 'main', NULL, 1),
('Mac & Cheese', 'Creamy macaroni and cheese.', 10.00, 'main', NULL, 1),
('Smash Beef Burger Single', 'Single smash beef patty burger.', 8.00, 'main', NULL, 1),
('Smash Beef Burger Double', 'Double smash beef patty burger.', 10.00, 'main', NULL, 1),
('Crispy Chicken Burger', 'Crispy fried chicken burger.', 7.50, 'main', NULL, 1),
('Fries', 'Crispy seasoned fries. Add On: Cheese +2.0', 7.50, 'snacks', NULL, 1),
('Nugget 8pcs', 'Crispy chicken nuggets (8 pieces).', 8.00, 'snacks', NULL, 1),
('Cheesy Wedges', 'Potato wedges with cheese sauce.', 8.50, 'snacks', NULL, 1),

-- ══════════════════════════════════════════
-- DRINKS — Non-Coffee
-- ══════════════════════════════════════════
('Teh O', 'Plain black tea.', 2.50, 'drinks', NULL, 1),
('Teh Tarik', 'Malaysian pulled milk tea, hot.', 2.50, 'drinks', NULL, 1),
('Teh Halia', 'Ginger tea with milk.', 3.50, 'drinks', NULL, 1),
('Teh Sarbat', 'Spiced herbal tea.', 3.50, 'drinks', NULL, 1),
('Sirap', 'Rose syrup drink.', 2.00, 'drinks', NULL, 1),
('Sirap Selasih', 'Rose syrup with basil seeds.', 2.50, 'drinks', NULL, 1),
('Sirap Limau', 'Lime rose syrup drink.', 2.70, 'drinks', NULL, 1),
('Sirap Laici', 'Lychee syrup drink.', 5.00, 'drinks', NULL, 1),
('Sirap Bandung', 'Rose milk syrup drink.', 3.50, 'drinks', NULL, 1),
('Sirap Bandung Cincau', 'Rose milk with grass jelly.', 4.00, 'drinks', NULL, 1),
('Sirap Bandung Soda', 'Sparkling rose milk drink.', 4.00, 'drinks', NULL, 1),
('Limau', 'Fresh lime juice.', 2.70, 'drinks', NULL, 1),
('Asam Boy', 'Sour plum lime drink.', 2.70, 'drinks', NULL, 1),
('Extra Joss Susu (Anggur/Mangga)', 'Energy drink with milk — grape or mango.', 4.00, 'drinks', NULL, 1),
('Vico', 'Chocolate malt drink.', 3.00, 'drinks', NULL, 1),

-- DRINKS — Coffee
('Indo Cafe O', 'Indonesian black coffee.', 3.00, 'drinks', NULL, 1),
('Indo Cafe Susu', 'Indonesian coffee with milk.', 3.50, 'drinks', NULL, 1),
('Kopi Tenggek', 'Strong traditional Malaysian coffee.', 3.50, 'drinks', NULL, 1),
('Kopi Special', 'House special coffee blend.', 4.00, 'drinks', NULL, 1),

-- DRINKS — Jus (Juice)
('Jus Oren', 'Fresh orange juice.', 4.70, 'drinks', NULL, 1),
('Jus Epal', 'Fresh apple juice.', 4.70, 'drinks', NULL, 1),
('Jus Tembikai', 'Fresh watermelon juice.', 4.70, 'drinks', NULL, 1),
('Jus Laici', 'Fresh lychee juice.', 4.70, 'drinks', NULL, 1),
('Jus Lemon', 'Fresh lemonade.', 4.70, 'drinks', NULL, 1),

-- ══════════════════════════════════════════
-- COLD DESSERTS
-- ══════════════════════════════════════════
('Cikong', 'Traditional shaved ice with syrup and toppings.', 6.00, 'dessert', NULL, 1),
('Ais Jelly Limau', 'Iced lime jelly dessert.', 6.00, 'dessert', NULL, 1),
('Cendol', 'Shaved ice with green rice flour jelly, coconut milk, and palm sugar.', 6.00, 'dessert', NULL, 1);

-- ─────────────────────────────────────────────
-- Sample Orders (2 orders for demo)
-- ─────────────────────────────────────────────
INSERT INTO orders (user_id, customer_name, customer_phone, order_type, table_number,
                    payment_method, subtotal, tax, delivery_fee, total, status) VALUES
(
    2, 'Ahmad Farid', '011-2345678',
    'dine-in', 5,
    'cash',
    36.00, 2.16, 0.00, 38.16,
    'completed'
),
(
    3, 'Siti Aisyah', '013-9876543',
    'delivery', NULL,
    'online_transfer',
    35.50, 2.13, 3.00, 40.63,
    'preparing'
);

-- ─────────────────────────────────────────────
-- Order Items for the 2 sample orders
-- ─────────────────────────────────────────────
INSERT INTO order_items (order_id, menu_item_id, item_name, unit_price, quantity, line_total)
SELECT 1, id, name, price, 1, price FROM menu_items WHERE name = 'Sup Gearbox Kambing';
INSERT INTO order_items (order_id, menu_item_id, item_name, unit_price, quantity, line_total)
SELECT 1, id, name, price, 1, price FROM menu_items WHERE name = 'Nasi Goreng Kampung';
INSERT INTO order_items (order_id, menu_item_id, item_name, unit_price, quantity, line_total)
SELECT 1, id, name, price, 1, price FROM menu_items WHERE name = 'Teh Tarik';

INSERT INTO order_items (order_id, menu_item_id, item_name, unit_price, quantity, line_total)
SELECT 2, id, name, price, 1, price FROM menu_items WHERE name = 'Tom Yam Seafood';
INSERT INTO order_items (order_id, menu_item_id, item_name, unit_price, quantity, line_total)
SELECT 2, id, name, price, 1, price FROM menu_items WHERE name = 'Chicken Chop Grill';
INSERT INTO order_items (order_id, menu_item_id, item_name, unit_price, quantity, line_total)
SELECT 2, id, name, price, 2, price*2 FROM menu_items WHERE name = 'Jus Tembikai';

-- ─────────────────────────────────────────────
-- Verification
-- ─────────────────────────────────────────────
-- SELECT COUNT(*) AS total_users   FROM users;       -- 3
-- SELECT COUNT(*) AS total_items   FROM menu_items;  -- ~120
-- SELECT COUNT(*) AS total_orders  FROM orders;      -- 2
-- SELECT COUNT(*) AS total_oi      FROM order_items; -- 6
