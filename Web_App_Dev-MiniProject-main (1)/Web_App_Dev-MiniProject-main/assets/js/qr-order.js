// qr-order.js
// ========================================
// QR ORDER PAGE JS — Restoran SUP TULANG ZZ
// ========================================

const menuItems = [
    // ── SUP ZZ ──
    { id: 1, name: "Sup Gearbox Kambing", category: "signature-sup", price: 19.00, image: "../../assets/images/menu-image/item1.png", badge: "bestseller" },
    { id: 2, name: "Sup Kambing", category: "signature-sup", price: 20.00, image: "../../assets/images/menu-image/item2.png", badge: "" },
    { id: 3, name: "Sup Daging", category: "signature-sup", price: 8.00, image: "../../assets/images/menu-image/item3.png", badge: "" },
    { id: 4, name: "Sup Ayam", category: "signature-sup", price: 7.00, image: "../../assets/images/menu-image/item4.png", badge: "" },
    // ── MEE REBUS ZZ ──
    { id: 5, name: "Mee Rebus Gearbox Kambing", category: "signature-mee", price: 20.00, image: "../../assets/images/menu-image/item5.png", badge: "bestseller" },
    { id: 6, name: "Mee Rebus Daging", category: "signature-mee", price: 9.50, image: "../../assets/images/menu-image/item6.png", badge: "" },
    { id: 7, name: "Mee Rebus Ayam", category: "signature-mee", price: 9.00, image: "../../assets/images/menu-image/item7.png", badge: "" },
    // ── SARAPAN: Masakan Panas ──
    { id: 8, name: "Lontong Kuah", category: "sarapan-panas", price: 7.50, image: "../../assets/images/menu-image/item8.png", badge: "" },
    { id: 9, name: "Lontong Kering (Ayam)", category: "sarapan-panas", price: 9.00, image: "../../assets/images/menu-image/item9.png", badge: "" },
    { id: 10, name: "Lontong Kering (Daging)", category: "sarapan-panas", price: 9.50, image: "../../assets/images/menu-image/item10.png", badge: "" },
    { id: 11, name: "Nasi Lemak Basmathi (Telur)", category: "sarapan-panas", price: 6.00, image: "../../assets/images/menu-image/item11.png", badge: "" },
    { id: 12, name: "Nasi Lemak Basmathi (Ayam)", category: "sarapan-panas", price: 9.00, image: "../../assets/images/menu-image/item12.png", badge: "" },
    { id: 13, name: "Nasi Lemak Rendang (Ayam)", category: "sarapan-panas", price: 8.50, image: "../../assets/images/menu-image/item13.png", badge: "" },
    { id: 14, name: "Nasi Lemak Rendang (Daging)", category: "sarapan-panas", price: 9.50, image: "../../assets/images/menu-image/item14.png", badge: "" },
    { id: 15, name: "Nasi Ayam Basmathi", category: "sarapan-panas", price: 12.00, image: "../../assets/images/menu-image/item15.png", badge: "" },
    { id: 16, name: "Nasi Ambang", category: "sarapan-panas", price: 9.50, image: "../../assets/images/menu-image/item16.png", badge: "" },
    { id: 17, name: "Bubur Nasi", category: "sarapan-panas", price: 7.50, image: "../../assets/images/menu-image/item17.png", badge: "" },
    { id: 18, name: "Bubur Ayam", category: "sarapan-panas", price: 7.00, image: "../../assets/images/menu-image/item18.png", badge: "" },
    { id: 19, name: "Laksa Johor", category: "sarapan-panas", price: 8.00, image: "../../assets/images/menu-image/item19.png", badge: "" },
    { id: 20, name: "Laksa Penang", category: "sarapan-panas", price: 7.50, image: "../../assets/images/menu-image/item20.png", badge: "" },
    { id: 21, name: "Bakso (Mee/Mee Hoon/Nasi)", category: "sarapan-panas", price: 7.50, image: "../../assets/images/menu-image/item21.png", badge: "" },
    { id: 22, name: "Soto (Mee/Mee Hoon/Nasi)", category: "sarapan-panas", price: 8.00, image: "../../assets/images/menu-image/item22.png", badge: "" },
    // ── ROTI BAKAR & ROTI CANAI ──
    { id: 23, name: "Roti Bakar", category: "sarapan-roti", price: 2.50, image: "../../assets/images/menu-image/item23.png", badge: "" },
    { id: 24, name: "Roti Kaya", category: "sarapan-roti", price: 3.50, image: "../../assets/images/menu-image/item24.png", badge: "" },
    { id: 25, name: "Roti Garlic", category: "sarapan-roti", price: 3.50, image: "../../assets/images/menu-image/item25.png", badge: "" },
    { id: 26, name: "Roti Canai Kosong", category: "roti-canai", price: 1.50, image: "../../assets/images/menu-image/item26.png", badge: "" },
    { id: 27, name: "Roti Canai Kosong Bawang", category: "roti-canai", price: 2.00, image: "../../assets/images/menu-image/item27.png", badge: "" },
    { id: 28, name: "Roti Tampal", category: "roti-canai", price: 2.80, image: "../../assets/images/menu-image/item28.png", badge: "" },
    { id: 29, name: "Roti Telur", category: "roti-canai", price: 2.80, image: "../../assets/images/menu-image/item29.png", badge: "" },
    { id: 30, name: "Roti Telur Bawang", category: "roti-canai", price: 3.50, image: "../../assets/images/menu-image/item30.png", badge: "" },
    { id: 31, name: "Roti Telur Double Jantan", category: "roti-canai", price: 5.50, image: "../../assets/images/menu-image/item31.png", badge: "bestseller" },
    { id: 32, name: "Roti Pisang", category: "roti-canai", price: 4.50, image: "../../assets/images/menu-image/item32.png", badge: "" },
    { id: 33, name: "Roti Sardin", category: "roti-canai", price: 6.00, image: "../../assets/images/menu-image/item33.png", badge: "" },
    { id: 34, name: "Roti Bom", category: "roti-canai", price: 2.50, image: "../../assets/images/menu-image/item34.png", badge: "" },
    { id: 35, name: "Roti Planta", category: "roti-canai", price: 3.00, image: "../../assets/images/menu-image/item35.png", badge: "" },
    { id: 36, name: "Roti Sarang Burung Daging", category: "roti-canai", price: 8.00, image: "../../assets/images/menu-image/item36.png", badge: "bestseller" },
    // ── SET TENGAH HARI ──
    { id: 37, name: "Nasi Bawal Goreng Berlado", category: "set-nasi", price: 9.00, image: "../../assets/images/menu-image/item37.png", badge: "" },
    { id: 38, name: "Nasi Siakap Goreng Berlado", category: "set-nasi", price: 15.00, image: "../../assets/images/menu-image/item38.png", badge: "bestseller" },
    { id: 39, name: "Nasi Keli Goreng Berlado", category: "set-nasi", price: 10.90, image: "../../assets/images/menu-image/item39.png", badge: "" },
    { id: 40, name: "Nasi Ayam Goreng Berlado", category: "set-nasi", price: 8.50, image: "../../assets/images/menu-image/item40.png", badge: "" },
    // ── MENU IKAN ──
    { id: 41, name: "Ikan Siakap Tiga Rasa", category: "ikan", price: 37.50, image: "../../assets/images/menu-image/item41.png", badge: "bestseller" },
    { id: 42, name: "Ikan Siakap Masam Manis", category: "ikan", price: 37.50, image: "../../assets/images/menu-image/item42.png", badge: "" },
    { id: 43, name: "Ikan Siakap Steam Lemon", category: "ikan", price: 37.50, image: "../../assets/images/menu-image/item43.png", badge: "" },
    { id: 44, name: "Ikan Siakap Laprik", category: "ikan", price: 37.50, image: "../../assets/images/menu-image/item44.png", badge: "" },
    { id: 45, name: "Ikan Siakap Goreng Kunyit", category: "ikan", price: 37.50, image: "../../assets/images/menu-image/item45.png", badge: "" },
    { id: 46, name: "Siakap Bakar", category: "ikan", price: 37.50, image: "../../assets/images/menu-image/item46.png", badge: "bestseller" },
    { id: 47, name: "Caru Bakar", category: "ikan", price: 11.50, image: "../../assets/images/menu-image/item47.png", badge: "" },
    { id: 48, name: "Kerang Bakar", category: "ikan", price: 15.00, image: "../../assets/images/menu-image/item48.png", badge: "" },
    { id: 49, name: "Sotong Bakar", category: "ikan", price: 15.00, image: "../../assets/images/menu-image/item49.png", badge: "" },
    // ── GORENG-GORENG: Nasi Goreng ──
    { id: 50, name: "Nasi Goreng Biasa", category: "goreng-nasi", price: 7.50, image: "../../assets/images/menu-image/item50.png", badge: "" },
    { id: 51, name: "Nasi Goreng Kampung", category: "goreng-nasi", price: 8.00, image: "../../assets/images/menu-image/item51.png", badge: "bestseller" },
    { id: 52, name: "Nasi Goreng Cina", category: "goreng-nasi", price: 7.50, image: "../../assets/images/menu-image/item52.png", badge: "" },
    { id: 53, name: "Nasi Goreng Ikan Masin", category: "goreng-nasi", price: 8.50, image: "../../assets/images/menu-image/item53.png", badge: "" },
    { id: 54, name: "Nasi Goreng Cili Padi", category: "goreng-nasi", price: 8.50, image: "../../assets/images/menu-image/item54.png", badge: "spicy" },
    { id: 55, name: "Nasi Goreng Pattaya", category: "goreng-nasi", price: 8.50, image: "../../assets/images/menu-image/item55.png", badge: "" },
    { id: 56, name: "Nasi Goreng Tom Yam", category: "goreng-nasi", price: 9.00, image: "../../assets/images/menu-image/item56.png", badge: "spicy" },
    { id: 57, name: "Nasi Goreng Belacan", category: "goreng-nasi", price: 12.00, image: "../../assets/images/menu-image/item57.png", badge: "" },
    // ── GORENG-GORENG: Mee Goreng ──
    { id: 58, name: "Mee Goreng", category: "goreng-mee", price: 7.50, image: "../../assets/images/menu-image/item58.png", badge: "" },
    { id: 59, name: "Mee Hoon Goreng Singapore", category: "goreng-mee", price: 7.50, image: "../../assets/images/menu-image/item59.png", badge: "" },
    { id: 60, name: "Char Kuey Teow", category: "goreng-mee", price: 8.00, image: "../../assets/images/menu-image/item60.png", badge: "bestseller" },
    // ── SAYUR ──
    { id: 61, name: "Kailan (Biasa)", category: "alacarte-sayur", price: 7.00, image: "../../assets/images/menu-image/item61.png", badge: "" },
    { id: 62, name: "Kailan (Ikan Masin)", category: "alacarte-sayur", price: 7.00, image: "../../assets/images/menu-image/item62.png", badge: "" },
    { id: 63, name: "Kangkung (Biasa)", category: "alacarte-sayur", price: 7.00, image: "../../assets/images/menu-image/item63.png", badge: "" },
    { id: 64, name: "Kangkung Belacan", category: "alacarte-sayur", price: 7.00, image: "../../assets/images/menu-image/item64.png", badge: "" },
    { id: 65, name: "Taugeh (Biasa)", category: "alacarte-sayur", price: 7.00, image: "../../assets/images/menu-image/item65.png", badge: "" },
    { id: 66, name: "Sawi (Biasa)", category: "alacarte-sayur", price: 7.00, image: "../../assets/images/menu-image/item66.png", badge: "" },
    { id: 67, name: "Cendawan Goreng Biasa", category: "alacarte-sayur", price: 7.00, image: "../../assets/images/menu-image/item67.png", badge: "" },
    // ── LAUK THAI ──
    { id: 68, name: "Ayam Black Pepper", category: "alacarte-lauk", price: 7.50, image: "../../assets/images/menu-image/item68.png", badge: "" },
    { id: 69, name: "Daging Black Pepper", category: "alacarte-lauk", price: 8.50, image: "../../assets/images/menu-image/item69.png", badge: "" },
    { id: 70, name: "Sotong Black Pepper", category: "alacarte-lauk", price: 9.50, image: "../../assets/images/menu-image/item70.png", badge: "" },
    { id: 71, name: "Ayam Sambal", category: "alacarte-lauk", price: 7.50, image: "../../assets/images/menu-image/item71.png", badge: "" },
    { id: 72, name: "Daging Sambal", category: "alacarte-lauk", price: 8.50, image: "../../assets/images/menu-image/item72.png", badge: "" },
    { id: 73, name: "Sotong Sambal", category: "alacarte-lauk", price: 9.50, image: "../../assets/images/menu-image/item73.png", badge: "" },
    { id: 74, name: "Ayam Merah", category: "alacarte-lauk", price: 7.50, image: "../../assets/images/menu-image/item74.png", badge: "" },
    { id: 75, name: "Daging Merah", category: "alacarte-lauk", price: 8.50, image: "../../assets/images/menu-image/item75.png", badge: "" },
    { id: 76, name: "Sotong Merah", category: "alacarte-lauk", price: 9.50, image: "../../assets/images/menu-image/item76.png", badge: "" },
    { id: 77, name: "Ayam Paprik", category: "alacarte-lauk", price: 7.50, image: "../../assets/images/menu-image/item77.png", badge: "" },
    { id: 78, name: "Daging Paprik", category: "alacarte-lauk", price: 8.50, image: "../../assets/images/menu-image/item78.png", badge: "" },
    { id: 79, name: "Sotong Paprik", category: "alacarte-lauk", price: 9.50, image: "../../assets/images/menu-image/item79.png", badge: "" },
    { id: 80, name: "Ayam Phad Khra Phao", category: "alacarte-lauk", price: 8.00, image: "../../assets/images/menu-image/item80.png", badge: "" },
    { id: 81, name: "Daging Phad Khra Phao", category: "alacarte-lauk", price: 9.00, image: "../../assets/images/menu-image/item81.png", badge: "" },
    { id: 82, name: "Ayam Kunyit", category: "alacarte-lauk", price: 7.50, image: "../../assets/images/menu-image/item82.png", badge: "" },
    { id: 83, name: "Daging Kunyit", category: "alacarte-lauk", price: 9.50, image: "../../assets/images/menu-image/item83.png", badge: "" },
    { id: 84, name: "Sotong Kunyit", category: "alacarte-lauk", price: 9.50, image: "../../assets/images/menu-image/item84.png", badge: "" },
    { id: 85, name: "Udang Kunyit", category: "alacarte-lauk", price: 9.50, image: "../../assets/images/menu-image/item85.png", badge: "" },
    // ── GORENG TEPUNG ──
    { id: 86, name: "Ayam Goreng Tepung", category: "alacarte-tepung", price: 10.00, image: "../../assets/images/menu-image/item86.png", badge: "" },
    // ── MEE KUAH ──
    { id: 87, name: "Mee Kuah Bandung", category: "alacarte-meekuah", price: 10.50, image: "../../assets/images/menu-image/item87.png", badge: "" },
    { id: 88, name: "Mee Kuah Hong Kong", category: "alacarte-meekuah", price: 10.50, image: "../../assets/images/menu-image/item88.png", badge: "" },
    { id: 89, name: "Mee Kuah Hailam", category: "alacarte-meekuah", price: 10.50, image: "../../assets/images/menu-image/item89.png", badge: "" },
    { id: 90, name: "Mee Kuah Kung Fu", category: "alacarte-meekuah", price: 10.50, image: "../../assets/images/menu-image/item90.png", badge: "" },
    // ── SUP ALA THAI & TOMYAM ──
    { id: 91, name: "Sup Ayam Ala Thai", category: "alacarte-sup", price: 8.00, image: "../../assets/images/menu-image/item91.png", badge: "" },
    { id: 92, name: "Sup Daging Ala Thai", category: "alacarte-sup", price: 9.00, image: "../../assets/images/menu-image/item92.png", badge: "" },
    { id: 93, name: "Tom Yam Ayam", category: "alacarte-tomyam", price: 8.00, image: "../../assets/images/menu-image/item93.png", badge: "spicy" },
    { id: 94, name: "Tom Yam Daging", category: "alacarte-tomyam", price: 9.00, image: "../../assets/images/menu-image/item94.png", badge: "spicy" },
    { id: 95, name: "Tom Yam Ayam + Daging", category: "alacarte-tomyam", price: 12.00, image: "../../assets/images/menu-image/item95.png", badge: "spicy" },
    { id: 96, name: "Tom Yam Seafood", category: "alacarte-tomyam", price: 13.00, image: "../../assets/images/menu-image/item96.png", badge: "bestseller" },
    { id: 97, name: "Tom Yam Campur", category: "alacarte-tomyam", price: 13.00, image: "../../assets/images/menu-image/item97.png", badge: "spicy" },
    { id: 98, name: "Tom Yam Sayur", category: "alacarte-tomyam", price: 8.00, image: "../../assets/images/menu-image/item98.png", badge: "" },
    { id: 99, name: "Tom Yam Cendawan", category: "alacarte-tomyam", price: 8.00, image: "../../assets/images/menu-image/item99.png", badge: "" },
    // ── WESTERN ──
    { id: 100, name: "Chicken Chop Fried", category: "western", price: 18.50, image: "../../assets/images/menu-image/item100.png", badge: "bestseller" },
    { id: 101, name: "Chicken Chop Grill", category: "western", price: 18.50, image: "../../assets/images/menu-image/item101.png", badge: "" },
    { id: 102, name: "Fish N Chips", category: "western", price: 16.50, image: "../../assets/images/menu-image/item102.png", badge: "" },
    { id: 103, name: "Lamb Chop", category: "western", price: 30.90, image: "../../assets/images/menu-image/item103.png", badge: "" },
    { id: 104, name: "Spaghetti Aglio Olio (Seafood)", category: "western", price: 17.00, image: "../../assets/images/menu-image/item104.png", badge: "" },
    { id: 105, name: "Spaghetti Aglio Olio (Beef Bacon)", category: "western", price: 15.00, image: "../../assets/images/menu-image/item105.png", badge: "" },
    { id: 106, name: "Spaghetti Aglio Olio (Chicken)", category: "western", price: 13.00, image: "../../assets/images/menu-image/item106.png", badge: "" },
    { id: 107, name: "Spaghetti Carbonara (Seafood)", category: "western", price: 18.00, image: "../../assets/images/menu-image/item107.png", badge: "" },
    { id: 108, name: "Spaghetti Carbonara (Beef Bacon)", category: "western", price: 16.00, image: "../../assets/images/menu-image/item108.png", badge: "" },
    { id: 109, name: "Spaghetti Carbonara (Chicken)", category: "western", price: 14.00, image: "../../assets/images/menu-image/item109.png", badge: "" },
    { id: 110, name: "Spaghetti Bolognese", category: "western", price: 15.00, image: "../../assets/images/menu-image/item110.png", badge: "" },
    { id: 111, name: "Mac & Cheese", category: "western", price: 10.00, image: "../../assets/images/menu-image/item111.png", badge: "" },
    { id: 112, name: "Smash Beef Burger Single", category: "western", price: 8.00, image: "../../assets/images/menu-image/item112.png", badge: "" },
    { id: 113, name: "Smash Beef Burger Double", category: "western", price: 10.00, image: "../../assets/images/menu-image/item113.png", badge: "bestseller" },
    { id: 114, name: "Crispy Chicken Burger", category: "western", price: 7.50, image: "../../assets/images/menu-image/item114.png", badge: "" },
    { id: 115, name: "Fries", category: "western", price: 7.50, image: "../../assets/images/menu-image/item115.png", badge: "" },
    { id: 116, name: "Nugget 8pcs", category: "western", price: 8.00, image: "../../assets/images/menu-image/item116.png", badge: "" },
    { id: 117, name: "Cheesy Wedges", category: "western", price: 8.50, image: "../../assets/images/menu-image/item117.png", badge: "" },
    // ── DRINKS: Non-Coffee ──
    { id: 118, name: "Teh O", category: "drinks-noncoffee", price: 2.50, image: "../../assets/images/menu-image/item118.png", badge: "" },
    { id: 119, name: "Teh Tarik", category: "drinks-noncoffee", price: 2.50, image: "../../assets/images/menu-image/item119.png", badge: "bestseller" },
    { id: 120, name: "Teh Halia", category: "drinks-noncoffee", price: 3.50, image: "../../assets/images/menu-image/item120.png", badge: "" },
    { id: 121, name: "Teh Sarbat", category: "drinks-noncoffee", price: 3.50, image: "../../assets/images/menu-image/item121.png", badge: "" },
    { id: 122, name: "Sirap", category: "drinks-noncoffee", price: 2.00, image: "../../assets/images/menu-image/item122.png", badge: "" },
    { id: 123, name: "Sirap Selasih", category: "drinks-noncoffee", price: 2.50, image: "../../assets/images/menu-image/item123.png", badge: "" },
    { id: 124, name: "Sirap Limau", category: "drinks-noncoffee", price: 2.70, image: "../../assets/images/menu-image/item124.png", badge: "" },
    { id: 125, name: "Sirap Laici", category: "drinks-noncoffee", price: 5.00, image: "../../assets/images/menu-image/item125.png", badge: "" },
    { id: 126, name: "Sirap Bandung", category: "drinks-noncoffee", price: 3.50, image: "../../assets/images/menu-image/item126.png", badge: "" },
    { id: 127, name: "Sirap Bandung Cincau", category: "drinks-noncoffee", price: 4.00, image: "../../assets/images/menu-image/item127.png", badge: "" },
    { id: 128, name: "Sirap Bandung Soda", category: "drinks-noncoffee", price: 4.00, image: "../../assets/images/menu-image/item128.png", badge: "" },
    { id: 129, name: "Limau", category: "drinks-noncoffee", price: 2.70, image: "../../assets/images/menu-image/item129.png", badge: "" },
    { id: 130, name: "Asam Boy", category: "drinks-noncoffee", price: 2.70, image: "../../assets/images/menu-image/item130.png", badge: "" },
    { id: 131, name: "Extra Joss Susu (Anggur/Mangga)", category: "drinks-noncoffee", price: 4.00, image: "../../assets/images/menu-image/item131.png", badge: "" },
    { id: 132, name: "Vico", category: "drinks-noncoffee", price: 3.00, image: "../../assets/images/menu-image/item132.png", badge: "" },
    // ── DRINKS: Coffee ──
    { id: 133, name: "Indo Cafe O", category: "drinks-coffee", price: 3.00, image: "../../assets/images/menu-image/item133.png", badge: "" },
    { id: 134, name: "Indo Cafe Susu", category: "drinks-coffee", price: 3.50, image: "../../assets/images/menu-image/item134.png", badge: "" },
    { id: 135, name: "Kopi Tenggek", category: "drinks-coffee", price: 3.50, image: "../../assets/images/menu-image/item135.png", badge: "" },
    { id: 136, name: "Kopi Special", category: "drinks-coffee", price: 4.00, image: "../../assets/images/menu-image/item136.png", badge: "" },
    // ── JUS ──
    { id: 137, name: "Jus Oren", category: "drinks-jus", price: 4.70, image: "../../assets/images/menu-image/item137.png", badge: "" },
    { id: 138, name: "Jus Epal", category: "drinks-jus", price: 4.70, image: "../../assets/images/menu-image/item138.png", badge: "" },
    { id: 139, name: "Jus Tembikai", category: "drinks-jus", price: 4.70, image: "../../assets/images/menu-image/item139.png", badge: "" },
    { id: 140, name: "Jus Laici", category: "drinks-jus", price: 4.70, image: "../../assets/images/menu-image/item140.png", badge: "" },
    { id: 141, name: "Jus Lemon", category: "drinks-jus", price: 4.70, image: "../../assets/images/menu-image/item141.png", badge: "" },
    // ── COLD DESSERTS ──
    { id: 142, name: "Cikong", category: "drinks-dessert", price: 6.00, image: "../../assets/images/menu-image/item142.png", badge: "new" },
    { id: 143, name: "Ais Jelly Limau", category: "drinks-dessert", price: 6.00, image: "../../assets/images/menu-image/item143.png", badge: "" },
    { id: 144, name: "Cendol", category: "drinks-dessert", price: 6.00, image: "../../assets/images/menu-image/item144.png", badge: "bestseller" },
];

let currentTable = 1;
let currentPax = 1;
let currentOrder = [];
let activeCategory = "all";
let searchQuery = '';
const MAX_TABLE = 30;
const MAX_PAX = 10;

document.addEventListener('DOMContentLoaded', () => {
    initScrollers();
    initDineIn();
    updateCartBadge();
    initQrNav();
});

// ========================================
// QR INTERNAL NAVIGATION
// ========================================
function initQrNav() {
    const navHome = document.getElementById('navHome');
    const navMenu = document.getElementById('navMenu');
    const navCart = document.getElementById('navCart');
    const navOrders = document.getElementById('navOrders');
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
        window.location.href = 'order-status.php';
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
                    <img src="${item.image}" alt="${item.name}">
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
        modal.style.display = 'none';
        successModal.style.display = 'flex';
        document.getElementById('successOrderId').textContent = '#' + Math.floor(Math.random() * 9000 + 1000);
        currentOrder = [];
        renderMenu(menuItems);
        updateOrderSummary();
        document.getElementById('orderItemsPanel').style.display = 'none';
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