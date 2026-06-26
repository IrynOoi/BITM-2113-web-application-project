//menu.js
// ========================================
// MENU PAGE JAVASCRIPT — Restoran SUP TULANG ZZ
// ========================================

const menuData = [
    // ── SIGNATURE: Sup ZZ ──
    { id: 1, name: "Sup Gearbox Kambing", category: "signature-sup", price: 19.00, image: "../assets/images/food1.jpg", description: "Signature lamb gearbox soup with rich traditional broth", badge: "bestseller", rating: 4.9, spicy: false },
    { id: 2, name: "Sup Kambing", category: "signature-sup", price: 20.00, image: "../assets/images/food2.jpg", description: "Tender lamb soup with aromatic spices", badge: "", rating: 4.7, spicy: false },
    { id: 3, name: "Sup Daging", category: "signature-sup", price: 8.00, image: "../assets/images/food3.jpg", description: "Hearty beef soup with vegetables", badge: "", rating: 4.4, spicy: false },
    { id: 4, name: "Sup Ayam", category: "signature-sup", price: 7.00, image: "../assets/images/menu1.jpg", description: "Comforting chicken soup with herbs", badge: "", rating: 4.3, spicy: false },
    { id: 5, name: "Add: Mee / Mee Hoon / Kuey Teow", category: "signature-sup", price: 2.00, image: "../assets/images/menu2.jpg", description: "Add noodles to your soup", badge: "", rating: 0, spicy: false },
    { id: 6, name: "Add: Nasi Putih + Telur Dadar + Sambal + Ulam", category: "signature-sup", price: 5.00, image: "../assets/images/menu3.jpg", description: "Rice set with egg, sambal, and ulam", badge: "", rating: 4.5, spicy: true },
    { id: 7, name: "Add: Roti Francis / Gardenia", category: "signature-sup", price: 2.50, image: "../assets/images/menu4.jpg", description: "Bread to accompany your soup", badge: "", rating: 0, spicy: false },

    // ── SIGNATURE: Mee Rebus ZZ ──
    { id: 8, name: "Mee Rebus Gearbox Kambing", category: "signature-mee", price: 20.00, image: "../assets/images/food1.jpg", description: "Thick gravy noodles with lamb gearbox bone", badge: "bestseller", rating: 4.8, spicy: false },
    { id: 9, name: "Mee Rebus Daging", category: "signature-mee", price: 9.50, image: "../assets/images/food2.jpg", description: "Thick gravy noodles with beef", badge: "", rating: 4.5, spicy: false },
    { id: 10, name: "Mee Rebus Ayam", category: "signature-mee", price: 9.00, image: "../assets/images/food3.jpg", description: "Thick gravy noodles with chicken", badge: "", rating: 4.3, spicy: false },

    // ── SARAPAN: Masakan Panas ──
    { id: 11, name: "Lontong Kuah", category: "sarapan-panas", price: 7.50, image: "../assets/images/menu1.jpg", description: "Compressed rice cakes in coconut gravy", badge: "", rating: 4.4, spicy: false },
    { id: 12, name: "Lontong Kering (Ayam)", category: "sarapan-panas", price: 9.00, image: "../assets/images/menu2.jpg", description: "Dry lontong with chicken", badge: "", rating: 4.2, spicy: false },
    { id: 13, name: "Lontong Kering (Daging)", category: "sarapan-panas", price: 9.50, image: "../assets/images/menu3.jpg", description: "Dry lontong with beef", badge: "", rating: 4.3, spicy: false },
    { id: 14, name: "Nasi Lemak Basmathi (Telur)", category: "sarapan-panas", price: 6.00, image: "../assets/images/menu4.jpg", description: "Fragrant basmathi rice with egg and sambal", badge: "", rating: 4.5, spicy: true },
    { id: 15, name: "Nasi Lemak Basmathi (Ayam)", category: "sarapan-panas", price: 9.00, image: "../assets/images/food1.jpg", description: "Fragrant basmathi rice with fried chicken", badge: "bestseller", rating: 4.7, spicy: true },
    { id: 16, name: "Nasi Lemak Rendang (Ayam)", category: "sarapan-panas", price: 8.50, image: "../assets/images/food2.jpg", description: "Coconut rice with chicken rendang", badge: "", rating: 4.6, spicy: true },
    { id: 17, name: "Nasi Lemak Rendang (Daging)", category: "sarapan-panas", price: 9.50, image: "../assets/images/food3.jpg", description: "Coconut rice with beef rendang", badge: "", rating: 4.7, spicy: true },
    { id: 18, name: "Nasi Ayam Basmathi", category: "sarapan-panas", price: 12.00, image: "../assets/images/menu1.jpg", description: "Steamed chicken with fragrant basmathi rice", badge: "", rating: 4.5, spicy: false },
    { id: 19, name: "Nasi Ambang", category: "sarapan-panas", price: 9.50, image: "../assets/images/menu2.jpg", description: "Traditional Javanese mixed rice platter", badge: "", rating: 4.4, spicy: false },
    { id: 20, name: "Bubur Nasi", category: "sarapan-panas", price: 7.50, image: "../assets/images/menu3.jpg", description: "Savoury rice porridge with toppings", badge: "", rating: 4.2, spicy: false },
    { id: 21, name: "Bubur Ayam", category: "sarapan-panas", price: 7.00, image: "../assets/images/menu4.jpg", description: "Chicken porridge with shredded chicken", badge: "", rating: 4.3, spicy: false },
    { id: 22, name: "Laksa Johor", category: "sarapan-panas", price: 8.00, image: "../assets/images/food1.jpg", description: "Spaghetti-like laksa with fish gravy", badge: "", rating: 4.6, spicy: true },
    { id: 23, name: "Laksa Penang", category: "sarapan-panas", price: 7.50, image: "../assets/images/food2.jpg", description: "Tangy tamarind fish noodle soup", badge: "", rating: 4.5, spicy: true },
    { id: 24, name: "Bakso (Mee/Mee Hoon/Nasi)", category: "sarapan-panas", price: 7.50, image: "../assets/images/food3.jpg", description: "Indonesian meatball soup with noodles or rice", badge: "", rating: 4.3, spicy: false },
    { id: 25, name: "Soto (Mee/Mee Hoon/Nasi)", category: "sarapan-panas", price: 8.00, image: "../assets/images/menu1.jpg", description: "Aromatic spiced soup with noodles or rice", badge: "", rating: 4.4, spicy: false },

    // ── SARAPAN: Roti Bakar ──
    { id: 26, name: "Roti Bakar", category: "sarapan-roti", price: 2.50, image: "../assets/images/menu2.jpg", description: "Classic toasted bread with butter", badge: "", rating: 4.0, spicy: false },
    { id: 27, name: "Roti Kaya", category: "sarapan-roti", price: 3.50, image: "../assets/images/menu3.jpg", description: "Toasted bread with coconut jam", badge: "", rating: 4.3, spicy: false },
    { id: 28, name: "Roti Garlic", category: "sarapan-roti", price: 3.50, image: "../assets/images/menu4.jpg", description: "Toasted bread with garlic butter", badge: "", rating: 4.2, spicy: false },
    { id: 29, name: "Add: Telur 1/2 Masak", category: "sarapan-roti", price: 3.50, image: "../assets/images/food1.jpg", description: "Soft-boiled eggs", badge: "", rating: 4.0, spicy: false },

    // ── ROTI CANAI ──
    { id: 30, name: "Roti Kosong", category: "roti-canai", price: 1.50, image: "../assets/images/food2.jpg", description: "Plain crispy flatbread", badge: "", rating: 4.2, spicy: false },
    { id: 31, name: "Roti Kosong Bawang", category: "roti-canai", price: 2.00, image: "../assets/images/food3.jpg", description: "Plain flatbread with onions", badge: "", rating: 4.3, spicy: false },
    { id: 32, name: "Roti Tampal", category: "roti-canai", price: 2.80, image: "../assets/images/menu1.jpg", description: "Flatbread topped with egg", badge: "", rating: 4.4, spicy: false },
    { id: 33, name: "Roti Telur", category: "roti-canai", price: 2.80, image: "../assets/images/menu2.jpg", description: "Flatbread with egg inside", badge: "", rating: 4.4, spicy: false },
    { id: 34, name: "Roti Telur Bawang", category: "roti-canai", price: 3.50, image: "../assets/images/menu3.jpg", description: "Egg flatbread with onions", badge: "", rating: 4.5, spicy: false },
    { id: 35, name: "Roti Telur Double Jantan", category: "roti-canai", price: 5.50, image: "../assets/images/menu4.jpg", description: "Flatbread with double eggs", badge: "bestseller", rating: 4.7, spicy: false },
    { id: 36, name: "Roti Pisang", category: "roti-canai", price: 4.50, image: "../assets/images/food1.jpg", description: "Flatbread filled with banana", badge: "", rating: 4.5, spicy: false },
    { id: 37, name: "Roti Sardin", category: "roti-canai", price: 6.00, image: "../assets/images/food2.jpg", description: "Flatbread with sardine filling", badge: "", rating: 4.2, spicy: false },
    { id: 38, name: "Roti Bom", category: "roti-canai", price: 2.50, image: "../assets/images/food3.jpg", description: "Small sweet flatbread with sugar", badge: "", rating: 4.3, spicy: false },
    { id: 39, name: "Roti Planta", category: "roti-canai", price: 3.00, image: "../assets/images/menu1.jpg", description: "Flatbread with margarine", badge: "", rating: 4.1, spicy: false },
    { id: 40, name: "Roti Sarang Burung Daging", category: "roti-canai", price: 8.00, image: "../assets/images/menu2.jpg", description: "Birds nest flatbread with minced beef & egg", badge: "bestseller", rating: 4.8, spicy: false },

    // ── SET TENGAH HARI: Nasi & Lauk ──
    { id: 41, name: "Nasi Bawal Goreng Berlado", category: "set-nasi", price: 9.00, image: "../assets/images/menu3.jpg", description: "Fried pomfret fish with spicy berlado sauce", badge: "", rating: 4.5, spicy: true },
    { id: 42, name: "Nasi Siakap Goreng Berlado", category: "set-nasi", price: 15.00, image: "../assets/images/menu4.jpg", description: "Fried barramundi with spicy berlado sauce", badge: "bestseller", rating: 4.9, spicy: true },
    { id: 43, name: "Nasi Keli Goreng Berlado", category: "set-nasi", price: 10.90, image: "../assets/images/food1.jpg", description: "Fried catfish with spicy berlado sauce", badge: "", rating: 4.6, spicy: true },
    { id: 44, name: "Nasi Ayam Goreng Berlado", category: "set-nasi", price: 8.50, image: "../assets/images/food2.jpg", description: "Fried chicken with spicy berlado sauce", badge: "", rating: 4.4, spicy: true },
    { id: 45, name: "Bubur Ayam", category: "set-panas", price: 6.50, image: "../assets/images/food3.jpg", description: "Chicken porridge", badge: "", rating: 4.2, spicy: false },
    { id: 46, name: "Bubur Nasi", category: "set-panas", price: 7.50, image: "../assets/images/menu1.jpg", description: "Rice porridge with toppings", badge: "", rating: 4.1, spicy: false },
    { id: 47, name: "Bakso (Mee/Mee Hoon)", category: "set-panas", price: 7.50, image: "../assets/images/menu2.jpg", description: "Meatball soup with noodles", badge: "", rating: 4.3, spicy: false },
    { id: 48, name: "Laksa Johor", category: "set-panas", price: 8.00, image: "../assets/images/menu3.jpg", description: "Spaghetti-like laksa with fish gravy", badge: "", rating: 4.5, spicy: true },
    { id: 49, name: "Laksa Penang", category: "set-panas", price: 7.50, image: "../assets/images/menu4.jpg", description: "Tangy tamarind fish noodle soup", badge: "", rating: 4.4, spicy: true },
    { id: 50, name: "Soto (Mee/Mee Hoon)", category: "set-panas", price: 8.00, image: "../assets/images/food1.jpg", description: "Aromatic spiced soup with noodles", badge: "", rating: 4.3, spicy: false },
    { id: 51, name: "Nasi Lemak Basmathi (Telur)", category: "set-panas", price: 6.00, image: "../assets/images/food2.jpg", description: "Basmathi coconut rice with egg", badge: "", rating: 4.4, spicy: true },
    { id: 52, name: "Nasi Lemak Basmathi (Ayam)", category: "set-panas", price: 9.00, image: "../assets/images/food3.jpg", description: "Basmathi coconut rice with chicken", badge: "", rating: 4.6, spicy: true },

    // ── MENU IKAN: Siakap ──
    { id: 53, name: "Siakap Tiga Rasa", category: "ikan-siakap", price: 37.00, image: "../assets/images/menu1.jpg", description: "Barramundi in sweet, sour, spicy three-flavour sauce", badge: "bestseller", rating: 4.8, spicy: true },
    { id: 54, name: "Siakap Masam Manis", category: "ikan-siakap", price: 37.00, image: "../assets/images/menu2.jpg", description: "Barramundi in sweet and sour sauce", badge: "", rating: 4.6, spicy: false },
    { id: 55, name: "Siakap Steam Lemon", category: "ikan-siakap", price: 37.00, image: "../assets/images/menu3.jpg", description: "Steamed barramundi with lemon", badge: "", rating: 4.5, spicy: false },
    { id: 56, name: "Siakap Laprik", category: "ikan-siakap", price: 37.00, image: "../assets/images/menu4.jpg", description: "Barramundi in spicy laprik style", badge: "", rating: 4.4, spicy: true },
    { id: 57, name: "Siakap Goreng Kunyit", category: "ikan-siakap", price: 37.00, image: "../assets/images/food1.jpg", description: "Turmeric fried barramundi", badge: "", rating: 4.5, spicy: false },

    // ── MENU IKAN: Bakar-Bakar ──
    { id: 58, name: "Siakap Bakar", category: "ikan-bakar", price: 37.00, image: "../assets/images/food2.jpg", description: "Grilled barramundi with sambal", badge: "bestseller", rating: 4.9, spicy: true },
    { id: 59, name: "Caru Bakar", category: "ikan-bakar", price: 12.00, image: "../assets/images/food3.jpg", description: "Grilled trevally fish", badge: "", rating: 4.3, spicy: true },
    { id: 60, name: "Kerang Bakar", category: "ikan-bakar", price: 15.00, image: "../assets/images/menu1.jpg", description: "Grilled cockles with sambal", badge: "", rating: 4.4, spicy: true },
    { id: 61, name: "Sotong Bakar", category: "ikan-bakar", price: 15.00, image: "../assets/images/menu2.jpg", description: "Grilled squid with sambal", badge: "", rating: 4.5, spicy: true },

    // ── ALA-CARTE: Sayur ──
    { id: 62, name: "Kailan (Biasa/Ikan Masin)", category: "alacarte-sayur", price: 7.00, image: "../assets/images/menu3.jpg", description: "Stir-fried kale plain or with salted fish", badge: "", rating: 4.2, spicy: false },
    { id: 63, name: "Kangkung (Biasa/Belacan)", category: "alacarte-sayur", price: 7.00, image: "../assets/images/menu4.jpg", description: "Water spinach plain or with shrimp paste", badge: "", rating: 4.4, spicy: true },
    { id: 64, name: "Taugeh (Biasa/Ikan Masin)", category: "alacarte-sayur", price: 7.00, image: "../assets/images/food1.jpg", description: "Beansprouts plain or with salted fish", badge: "", rating: 4.1, spicy: false },
    { id: 65, name: "Sawi (Biasa/Ikan Masin)", category: "alacarte-sayur", price: 7.00, image: "../assets/images/food2.jpg", description: "Mustard greens plain or with salted fish", badge: "", rating: 4.0, spicy: false },
    { id: 66, name: "Cendawan Goreng Biasa", category: "alacarte-sayur", price: 7.00, image: "../assets/images/food3.jpg", description: "Fried mushrooms", badge: "", rating: 4.3, spicy: false },

    // ── ALA-CARTE: Lauk Thai ──
    { id: 67, name: "Ayam Black Pepper", category: "alacarte-lauk", price: 7.50, image: "../assets/images/menu1.jpg", description: "Chicken in black pepper sauce", badge: "", rating: 4.5, spicy: true },
    { id: 68, name: "Daging Black Pepper", category: "alacarte-lauk", price: 8.50, image: "../assets/images/menu2.jpg", description: "Beef in black pepper sauce", badge: "", rating: 4.6, spicy: true },
    { id: 69, name: "Sotong Black Pepper", category: "alacarte-lauk", price: 9.50, image: "../assets/images/menu3.jpg", description: "Squid in black pepper sauce", badge: "", rating: 4.4, spicy: true },
    { id: 70, name: "Ayam Sambal", category: "alacarte-lauk", price: 7.50, image: "../assets/images/menu4.jpg", description: "Chicken in spicy sambal", badge: "", rating: 4.5, spicy: true },
    { id: 71, name: "Daging Sambal", category: "alacarte-lauk", price: 8.50, image: "../assets/images/food1.jpg", description: "Beef in spicy sambal", badge: "", rating: 4.5, spicy: true },
    { id: 72, name: "Sotong Sambal", category: "alacarte-lauk", price: 9.50, image: "../assets/images/food2.jpg", description: "Squid in spicy sambal", badge: "", rating: 4.3, spicy: true },
    { id: 73, name: "Ayam Merah", category: "alacarte-lauk", price: 7.50, image: "../assets/images/food3.jpg", description: "Chicken in red tomato sauce", badge: "", rating: 4.2, spicy: false },
    { id: 74, name: "Daging Merah", category: "alacarte-lauk", price: 8.50, image: "../assets/images/menu1.jpg", description: "Beef in red tomato sauce", badge: "", rating: 4.3, spicy: false },
    { id: 75, name: "Sotong Merah", category: "alacarte-lauk", price: 9.50, image: "../assets/images/menu2.jpg", description: "Squid in red tomato sauce", badge: "", rating: 4.1, spicy: false },
    { id: 76, name: "Ayam Paprik", category: "alacarte-lauk", price: 7.50, image: "../assets/images/menu3.jpg", description: "Chicken in Thai paprik sauce", badge: "", rating: 4.4, spicy: true },
    { id: 77, name: "Daging Paprik", category: "alacarte-lauk", price: 8.50, image: "../assets/images/menu4.jpg", description: "Beef in Thai paprik sauce", badge: "", rating: 4.5, spicy: true },
    { id: 78, name: "Sotong Paprik", category: "alacarte-lauk", price: 9.50, image: "../assets/images/food1.jpg", description: "Squid in Thai paprik sauce", badge: "", rating: 4.3, spicy: true },
    { id: 79, name: "Ayam Pha Khra Phao", category: "alacarte-lauk", price: 8.00, image: "../assets/images/food2.jpg", description: "Chicken in Thai basil sauce", badge: "", rating: 4.6, spicy: true },
    { id: 80, name: "Daging Pha Khra Phao", category: "alacarte-lauk", price: 9.00, image: "../assets/images/food3.jpg", description: "Beef in Thai basil sauce", badge: "", rating: 4.7, spicy: true },
    { id: 81, name: "Ayam Kunyit", category: "alacarte-lauk", price: 7.50, image: "../assets/images/menu1.jpg", description: "Turmeric fried chicken", badge: "", rating: 4.4, spicy: false },
    { id: 82, name: "Daging Kunyit", category: "alacarte-lauk", price: 9.50, image: "../assets/images/menu2.jpg", description: "Turmeric fried beef", badge: "", rating: 4.5, spicy: false },
    { id: 83, name: "Sotong Kunyit", category: "alacarte-lauk", price: 9.50, image: "../assets/images/menu3.jpg", description: "Turmeric fried squid", badge: "", rating: 4.3, spicy: false },
    { id: 84, name: "Udang Kunyit", category: "alacarte-lauk", price: 9.50, image: "../assets/images/menu4.jpg", description: "Turmeric fried prawns", badge: "", rating: 4.6, spicy: false },
    { id: 85, name: "Add: Nasi Putih", category: "alacarte-lauk", price: 2.00, image: "../assets/images/food1.jpg", description: "Steamed white rice", badge: "", rating: 0, spicy: false },
    { id: 86, name: "Add: Nasi Goreng", category: "alacarte-lauk", price: 3.00, image: "../assets/images/food2.jpg", description: "Fried rice", badge: "", rating: 4.0, spicy: false },

    // ── ALA-CARTE: Goreng Tepung ──
    { id: 87, name: "Sotong Goreng Tepung", category: "alacarte-tepung", price: 10.50, image: "../assets/images/food3.jpg", description: "Crispy fried squid", badge: "", rating: 4.5, spicy: false },
    { id: 88, name: "Udang Goreng Tepung", category: "alacarte-tepung", price: 10.50, image: "../assets/images/menu1.jpg", description: "Crispy fried prawns", badge: "", rating: 4.6, spicy: false },
    { id: 89, name: "Cendawan Goreng Tepung", category: "alacarte-tepung", price: 7.00, image: "../assets/images/menu2.jpg", description: "Crispy fried mushrooms", badge: "", rating: 4.3, spicy: false },
    { id: 90, name: "Inokki Goreng Tepung", category: "alacarte-tepung", price: 7.00, image: "../assets/images/menu3.jpg", description: "Crispy fried enoki mushrooms", badge: "", rating: 4.2, spicy: false },

    // ── ALA-CARTE: Sup & Tomyam ──
    { id: 91, name: "Sup Ayam Ala Thai", category: "alacarte-sup", price: 8.00, image: "../assets/images/menu4.jpg", description: "Thai-style chicken soup", badge: "", rating: 4.3, spicy: false },
    { id: 92, name: "Sup Daging Ala Thai", category: "alacarte-sup", price: 9.00, image: "../assets/images/food1.jpg", description: "Thai-style beef soup", badge: "", rating: 4.4, spicy: false },
    { id: 93, name: "Add: Mee/Mee Hoon/Kuey Teow", category: "alacarte-sup", price: 2.00, image: "../assets/images/food2.jpg", description: "Add noodles to your soup", badge: "", rating: 0, spicy: false },
    { id: 94, name: "Tom Yam Ayam", category: "alacarte-tomyam", price: 8.00, image: "../assets/images/food3.jpg", description: "Spicy sour chicken soup", badge: "spicy", rating: 4.6, spicy: true },
    { id: 95, name: "Tom Yam Daging", category: "alacarte-tomyam", price: 9.00, image: "../assets/images/menu1.jpg", description: "Spicy sour beef soup", badge: "spicy", rating: 4.5, spicy: true },
    { id: 96, name: "Tom Yam Ayam + Daging", category: "alacarte-tomyam", price: 12.00, image: "../assets/images/menu2.jpg", description: "Spicy sour chicken & beef soup", badge: "spicy", rating: 4.7, spicy: true },
    { id: 97, name: "Tom Yam Seafood", category: "alacarte-tomyam", price: 13.00, image: "../assets/images/menu3.jpg", description: "Spicy sour seafood soup", badge: "bestseller", rating: 4.8, spicy: true },
    { id: 98, name: "Tom Yam Campur", category: "alacarte-tomyam", price: 13.00, image: "../assets/images/menu4.jpg", description: "Mixed spicy sour soup", badge: "spicy", rating: 4.7, spicy: true },
    { id: 99, name: "Tom Yam Sayur", category: "alacarte-tomyam", price: 8.00, image: "../assets/images/food1.jpg", description: "Spicy sour vegetable soup", badge: "", rating: 4.2, spicy: true },
    { id: 100, name: "Tom Yam Cendawan", category: "alacarte-tomyam", price: 8.00, image: "../assets/images/food2.jpg", description: "Spicy sour mushroom soup", badge: "", rating: 4.3, spicy: true },
    { id: 101, name: "Add: Mee/Mee Hoon/Kuey Teow", category: "alacarte-tomyam", price: 2.00, image: "../assets/images/food3.jpg", description: "Add noodles to tomyam", badge: "", rating: 0, spicy: false },

    // ── ALA-CARTE: Mee Kuah ──
    { id: 102, name: "Mee Bandung", category: "alacarte-meekuah", price: 10.50, image: "../assets/images/menu1.jpg", description: "Thick gravy noodles with prawns and beef", badge: "", rating: 4.5, spicy: false },
    { id: 103, name: "Mee Hong Kong", category: "alacarte-meekuah", price: 10.50, image: "../assets/images/menu2.jpg", description: "Hong Kong style gravy noodles", badge: "", rating: 4.4, spicy: false },
    { id: 104, name: "Mee Hailam", category: "alacarte-meekuah", price: 10.50, image: "../assets/images/menu3.jpg", description: "Hainanese style gravy noodles", badge: "", rating: 4.3, spicy: false },
    { id: 105, name: "Mee Kung Fu", category: "alacarte-meekuah", price: 10.50, image: "../assets/images/menu4.jpg", description: "Kung Fu style gravy noodles", badge: "", rating: 4.2, spicy: false },

    // ── WESTERN ──
    { id: 106, name: "Chicken Chop (Fried/Grill)", category: "western", price: 18.50, image: "../assets/images/food1.jpg", description: "Fried or grilled chicken chop with mushroom sauce", badge: "bestseller", rating: 4.7, spicy: false },
    { id: 107, name: "Fish N Chips", category: "western", price: 16.50, image: "../assets/images/food2.jpg", description: "Battered fish with fries and tartar sauce", badge: "", rating: 4.4, spicy: false },
    { id: 108, name: "Lamb Chop", category: "western", price: 30.90, image: "../assets/images/food3.jpg", description: "Grilled lamb chop with black pepper sauce", badge: "", rating: 4.6, spicy: false },
    { id: 109, name: "Aglio Olio Seafood", category: "western", price: 17.00, image: "../assets/images/menu1.jpg", description: "Spaghetti with seafood, garlic, and olive oil", badge: "", rating: 4.5, spicy: false },
    { id: 110, name: "Aglio Olio Beef Bacon", category: "western", price: 15.00, image: "../assets/images/menu2.jpg", description: "Spaghetti with beef bacon, garlic, and olive oil", badge: "", rating: 4.3, spicy: false },
    { id: 111, name: "Aglio Olio Chicken", category: "western", price: 13.00, image: "../assets/images/menu3.jpg", description: "Spaghetti with chicken, garlic, and olive oil", badge: "", rating: 4.2, spicy: false },
    { id: 112, name: "Carbonara Seafood", category: "western", price: 18.00, image: "../assets/images/menu4.jpg", description: "Creamy spaghetti with seafood", badge: "", rating: 4.6, spicy: false },
    { id: 113, name: "Carbonara Beef Bacon", category: "western", price: 16.00, image: "../assets/images/food1.jpg", description: "Creamy spaghetti with beef bacon", badge: "", rating: 4.4, spicy: false },
    { id: 114, name: "Carbonara Chicken", category: "western", price: 14.00, image: "../assets/images/food2.jpg", description: "Creamy spaghetti with chicken", badge: "", rating: 4.3, spicy: false },
    { id: 115, name: "Bolognesse", category: "western", price: 15.00, image: "../assets/images/food3.jpg", description: "Spaghetti in meat sauce", badge: "", rating: 4.2, spicy: false },
    { id: 116, name: "Smash Beef (Single)", category: "western", price: 8.00, image: "../assets/images/menu1.jpg", description: "Single smashed beef burger patty", badge: "", rating: 4.5, spicy: false },
    { id: 117, name: "Smash Beef (Double)", category: "western", price: 10.00, image: "../assets/images/menu2.jpg", description: "Double smashed beef burger patties", badge: "bestseller", rating: 4.7, spicy: false },
    { id: 118, name: "Crispy Chicken Burger", category: "western", price: 7.50, image: "../assets/images/menu3.jpg", description: "Crispy fried chicken burger", badge: "", rating: 4.4, spicy: false },
    { id: 119, name: "Add: Fries", category: "western", price: 2.00, image: "../assets/images/menu4.jpg", description: "Add fries to your burger", badge: "", rating: 0, spicy: false },
    { id: 120, name: "Fries", category: "western", price: 7.50, image: "../assets/images/food1.jpg", description: "Golden french fries", badge: "", rating: 4.0, spicy: false },
    { id: 121, name: "Nugget 8pcs", category: "western", price: 8.00, image: "../assets/images/food2.jpg", description: "Chicken nuggets 8 pieces", badge: "", rating: 4.0, spicy: false },
    { id: 122, name: "Cheesy Wedges", category: "western", price: 8.50, image: "../assets/images/food3.jpg", description: "Potato wedges with cheese sauce", badge: "", rating: 4.3, spicy: false },

    // ── GORENG-GORENG: Nasi Goreng ──
    { id: 123, name: "Nasi Goreng Biasa", category: "goreng-nasi", price: 7.50, image: "../assets/images/menu1.jpg", description: "Classic fried rice", badge: "", rating: 4.2, spicy: false },
    { id: 124, name: "Nasi Goreng Kampung", category: "goreng-nasi", price: 8.00, image: "../assets/images/menu2.jpg", description: "Village-style fried rice with anchovies", badge: "bestseller", rating: 4.6, spicy: true },
    { id: 125, name: "Nasi Goreng Cina", category: "goreng-nasi", price: 7.50, image: "../assets/images/menu3.jpg", description: "Chinese-style fried rice", badge: "", rating: 4.1, spicy: false },
    { id: 126, name: "Nasi Goreng Ikan Masin", category: "goreng-nasi", price: 8.50, image: "../assets/images/menu4.jpg", description: "Fried rice with salted fish", badge: "", rating: 4.4, spicy: false },
    { id: 127, name: "Nasi Goreng Cili Padi", category: "goreng-nasi", price: 8.50, image: "../assets/images/food1.jpg", description: "Spicy bird eye chili fried rice", badge: "spicy", rating: 4.5, spicy: true },
    { id: 128, name: "Nasi Goreng Pattaya", category: "goreng-nasi", price: 8.50, image: "../assets/images/food2.jpg", description: "Fried rice wrapped in egg", badge: "", rating: 4.4, spicy: false },
    { id: 129, name: "Nasi Goreng Tom Yam", category: "goreng-nasi", price: 9.00, image: "../assets/images/food3.jpg", description: "Tom yum flavoured fried rice", badge: "spicy", rating: 4.6, spicy: true },
    { id: 130, name: "Nasi Goreng Belacan", category: "goreng-nasi", price: 12.00, image: "../assets/images/menu1.jpg", description: "Shrimp paste fried rice", badge: "", rating: 4.5, spicy: true },

    // ── GORENG-GORENG: Mee Goreng ──
    { id: 131, name: "Mee Goreng", category: "goreng-mee", price: 7.50, image: "../assets/images/menu2.jpg", description: "Classic fried noodles", badge: "", rating: 4.2, spicy: false },
    { id: 132, name: "Mee Hoon Goreng Singapore", category: "goreng-mee", price: 7.50, image: "../assets/images/menu3.jpg", description: "Singapore-style fried vermicelli", badge: "", rating: 4.3, spicy: true },
    { id: 133, name: "Char Kuey Teow", category: "goreng-mee", price: 8.00, image: "../assets/images/menu4.jpg", description: "Stir-fried flat rice noodles", badge: "bestseller", rating: 4.7, spicy: false },

    // ── DRINKS: Non-Coffee ──
    { id: 134, name: "Teh O' (Hot)", category: "drinks-noncoffee", price: 2.30, image: "../assets/images/food1.jpg", description: "Hot tea without milk", badge: "", rating: 4.0, spicy: false },
    { id: 135, name: "Teh O' (Cold)", category: "drinks-noncoffee", price: 2.50, image: "../assets/images/food1.jpg", description: "Iced tea without milk", badge: "", rating: 4.1, spicy: false },
    { id: 136, name: "Teh Tarik (Hot)", category: "drinks-noncoffee", price: 2.50, image: "../assets/images/food2.jpg", description: "Hot pulled milk tea", badge: "bestseller", rating: 4.8, spicy: false },
    { id: 137, name: "Teh Tarik (Cold)", category: "drinks-noncoffee", price: 3.00, image: "../assets/images/food2.jpg", description: "Iced pulled milk tea", badge: "", rating: 4.7, spicy: false },
    { id: 138, name: "Teh Halia (Hot)", category: "drinks-noncoffee", price: 3.50, image: "../assets/images/food3.jpg", description: "Hot ginger tea with milk", badge: "", rating: 4.3, spicy: false },
    { id: 139, name: "Teh Halia (Cold)", category: "drinks-noncoffee", price: 4.00, image: "../assets/images/food3.jpg", description: "Iced ginger tea with milk", badge: "", rating: 4.2, spicy: false },
    { id: 140, name: "Sirap (Hot)", category: "drinks-noncoffee", price: 2.00, image: "../assets/images/menu1.jpg", description: "Hot rose syrup drink", badge: "", rating: 3.9, spicy: false },
    { id: 141, name: "Sirap (Cold)", category: "drinks-noncoffee", price: 2.50, image: "../assets/images/menu1.jpg", description: "Iced rose syrup drink", badge: "", rating: 4.0, spicy: false },
    { id: 142, name: "Sirap Bandung (Cold)", category: "drinks-noncoffee", price: 3.50, image: "../assets/images/menu2.jpg", description: "Iced rose syrup with milk", badge: "", rating: 4.5, spicy: false },
    { id: 143, name: "Sirap Bandung Soda (Cold)", category: "drinks-noncoffee", price: 4.00, image: "../assets/images/menu3.jpg", description: "Sparkling rose milk drink", badge: "", rating: 4.4, spicy: false },
    { id: 144, name: "Limau (Hot)", category: "drinks-noncoffee", price: 2.70, image: "../assets/images/menu4.jpg", description: "Hot lime juice", badge: "", rating: 4.0, spicy: false },
    { id: 145, name: "Limau (Cold)", category: "drinks-noncoffee", price: 3.00, image: "../assets/images/menu4.jpg", description: "Iced lime juice", badge: "", rating: 4.2, spicy: false },

    // ── DRINKS: Jus ──
    { id: 146, name: "Jus Orange", category: "drinks-jus", price: 5.00, image: "../assets/images/food1.jpg", description: "Fresh orange juice", badge: "", rating: 4.4, spicy: false },
    { id: 147, name: "Jus Apple", category: "drinks-jus", price: 5.00, image: "../assets/images/food2.jpg", description: "Fresh apple juice", badge: "", rating: 4.3, spicy: false },
    { id: 148, name: "Jus Watermelon", category: "drinks-jus", price: 5.00, image: "../assets/images/food3.jpg", description: "Fresh watermelon juice", badge: "", rating: 4.5, spicy: false },
    { id: 149, name: "Jus Lychee", category: "drinks-jus", price: 5.00, image: "../assets/images/menu1.jpg", description: "Sweet lychee juice", badge: "", rating: 4.4, spicy: false },
    { id: 150, name: "Jus Lemon", category: "drinks-jus", price: 5.00, image: "../assets/images/menu2.jpg", description: "Fresh lemon juice", badge: "", rating: 4.2, spicy: false },

    // ── DRINKS: Cold Dessert ──
    { id: 151, name: "Cikong", category: "drinks-dessert", price: 6.00, image: "../assets/images/menu3.jpg", description: "Refreshing traditional dessert drink", badge: "new", rating: 4.5, spicy: false },
    { id: 152, name: "Ais Jelly Limau", category: "drinks-dessert", price: 6.00, image: "../assets/images/menu4.jpg", description: "Lime jelly ice dessert", badge: "", rating: 4.3, spicy: false },
    { id: 153, name: "Cendol", category: "drinks-dessert", price: 6.00, image: "../assets/images/food1.jpg", description: "Shaved ice with pandan jelly and coconut milk", badge: "bestseller", rating: 4.9, spicy: false },
];

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
                <img src="${getMenuItemImage(item.id)}" onerror="this.src='${getFallbackImage()}'" alt="${item.name}" loading="lazy">
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
                    <button class="btn-view-detail" data-item-id="${item.id}">
                        <i class="fas fa-info-circle"></i> Details
                    </button>
                    <button class="btn-add-cart-sm" data-item-id="${item.id}">
                        <i class="fas fa-plus"></i> Add
                    </button>
                </div>
            </div>
        </div>
    `).join('');

    menuGrid.querySelectorAll('.btn-view-detail').forEach(button => {
        button.addEventListener('click', () => viewDetail(Number(button.dataset.itemId)));
    });

    menuGrid.querySelectorAll('.btn-add-cart-sm').forEach(button => {
        button.addEventListener('click', () => {
            const item = menuData.find(menuItem => menuItem.id === Number(button.dataset.itemId));
            if (item) addToCartHandler(item, button);
        });
    });
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
    const image = getMenuItemImage(item.id);

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

function viewDetail(id) {
    const item = menuData.find(i => i.id === id);
    if (item) {
        alert(`${item.name}\n\n${item.description}\n\nPrice: RM ${item.price.toFixed(2)}\n${item.rating > 0 ? 'Rating: ⭐ ' + item.rating : ''}`);
    }
}

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
