// qr-order.js

// ========================================
// QR ORDER PAGE JS — Restoran SUP TULANG ZZ
// ========================================

const menuItems = [
    // ── SIGNATURE: Sup ZZ ──
    { id: 1, name: "Sup Gearbox Kambing", category: "signature-sup", price: 19.00, image: "../../assets/images/food1.jpg", badge: "bestseller" },
    { id: 2, name: "Sup Kambing", category: "signature-sup", price: 20.00, image: "../../assets/images/food2.jpg", badge: "" },
    { id: 3, name: "Sup Daging", category: "signature-sup", price: 8.00, image: "../../assets/images/food3.jpg", badge: "" },
    { id: 4, name: "Sup Ayam", category: "signature-sup", price: 7.00, image: "../../assets/images/menu1.jpg", badge: "" },
    { id: 5, name: "Add On: Mee / Mee Hoon / Kuey Teow", category: "signature-sup", price: 2.00, image: "../../assets/images/menu2.jpg", badge: "" },
    { id: 6, name: "Add On: Nasi Putih + Telur Dadar + Sambal + Ulaman", category: "signature-sup", price: 5.00, image: "../../assets/images/menu3.jpg", badge: "" },
    { id: 7, name: "Add On: Roti Francis / Roti Gardenia", category: "signature-sup", price: 2.50, image: "../../assets/images/menu4.jpg", badge: "" },
    // ── SIGNATURE: Mee Rebus ZZ ──
    { id: 8, name: "Mee Rebus Gearbox Kambing", category: "signature-mee", price: 20.00, image: "../../assets/images/food1.jpg", badge: "bestseller" },
    { id: 9, name: "Mee Rebus Daging", category: "signature-mee", price: 9.50, image: "../../assets/images/food2.jpg", badge: "" },
    { id: 10, name: "Mee Rebus Ayam", category: "signature-mee", price: 9.00, image: "../../assets/images/food3.jpg", badge: "" },
    // ── SARAPAN: Masakan Panas ──
    { id: 11, name: "Lontong Kuah", category: "sarapan-panas", price: 7.50, image: "../../assets/images/menu1.jpg", badge: "" },
    { id: 12, name: "Lontong Kering (Ayam)", category: "sarapan-panas", price: 9.00, image: "../../assets/images/menu2.jpg", badge: "" },
    { id: 13, name: "Lontong Kering (Daging)", category: "sarapan-panas", price: 9.50, image: "../../assets/images/menu3.jpg", badge: "" },
    { id: 14, name: "Nasi Lemak Basmathi (Telur)", category: "sarapan-panas", price: 6.00, image: "../../assets/images/menu4.jpg", badge: "" },
    { id: 15, name: "Nasi Lemak Basmathi (Ayam)", category: "sarapan-panas", price: 9.00, image: "../../assets/images/food1.jpg", badge: "" },
    { id: 16, name: "Nasi Lemak Rendang (Ayam)", category: "sarapan-panas", price: 8.50, image: "../../assets/images/food2.jpg", badge: "" },
    { id: 17, name: "Nasi Lemak Rendang (Daging)", category: "sarapan-panas", price: 9.50, image: "../../assets/images/food3.jpg", badge: "" },
    { id: 18, name: "Nasi Ayam Basmathi", category: "sarapan-panas", price: 12.00, image: "../../assets/images/menu1.jpg", badge: "" },
    { id: 19, name: "Nasi Ambang", category: "sarapan-panas", price: 9.50, image: "../../assets/images/menu2.jpg", badge: "" },
    { id: 20, name: "Bubur Nasi", category: "sarapan-panas", price: 7.50, image: "../../assets/images/menu3.jpg", badge: "" },
    { id: 21, name: "Bubur Ayam", category: "sarapan-panas", price: 7.00, image: "../../assets/images/menu4.jpg", badge: "" },
    { id: 22, name: "Laksa Johor", category: "sarapan-panas", price: 8.00, image: "../../assets/images/food1.jpg", badge: "" },
    { id: 23, name: "Laksa Penang", category: "sarapan-panas", price: 7.50, image: "../../assets/images/food2.jpg", badge: "" },
    { id: 24, name: "Bakso (Mee / Mee Hoon / Nasi)", category: "sarapan-panas", price: 7.50, image: "../../assets/images/food3.jpg", badge: "" },
    { id: 25, name: "Soto (Mee / Mee Hoon / Nasi)", category: "sarapan-panas", price: 8.00, image: "../../assets/images/menu1.jpg", badge: "" },
    // ── SARAPAN: Roti Bakar ──
    { id: 26, name: "Roti Bakar", category: "sarapan-roti", price: 2.50, image: "../../assets/images/menu2.jpg", badge: "" },
    { id: 27, name: "Roti Kaya", category: "sarapan-roti", price: 3.50, image: "../../assets/images/menu3.jpg", badge: "" },
    { id: 28, name: "Roti Garlic", category: "sarapan-roti", price: 3.50, image: "../../assets/images/menu4.jpg", badge: "" },
    { id: 29, name: "Add On: Telur 1/2 Masak", category: "sarapan-roti", price: 3.50, image: "../../assets/images/food1.jpg", badge: "" },
    // ── ROTI CANAI ──
    { id: 30, name: "Roti Kosong", category: "roti-canai", price: 1.50, image: "../../assets/images/food2.jpg", badge: "" },
    { id: 31, name: "Roti Kosong Bawang", category: "roti-canai", price: 2.00, image: "../../assets/images/food3.jpg", badge: "" },
    { id: 32, name: "Roti Tampal", category: "roti-canai", price: 2.80, image: "../../assets/images/menu1.jpg", badge: "" },
    { id: 33, name: "Roti Telur", category: "roti-canai", price: 2.80, image: "../../assets/images/menu2.jpg", badge: "" },
    { id: 34, name: "Roti Telur Bawang", category: "roti-canai", price: 3.50, image: "../../assets/images/menu3.jpg", badge: "" },
    { id: 35, name: "Roti Telur Double Jantan", category: "roti-canai", price: 5.50, image: "../../assets/images/menu4.jpg", badge: "bestseller" },
    { id: 36, name: "Roti Pisang", category: "roti-canai", price: 4.50, image: "../../assets/images/food1.jpg", badge: "" },
    { id: 37, name: "Roti Sardin", category: "roti-canai", price: 6.00, image: "../../assets/images/food2.jpg", badge: "" },
    { id: 38, name: "Roti Bom", category: "roti-canai", price: 2.50, image: "../../assets/images/food3.jpg", badge: "" },
    { id: 39, name: "Roti Planta", category: "roti-canai", price: 3.00, image: "../../assets/images/menu1.jpg", badge: "" },
    { id: 40, name: "Roti Sarang Burung Daging", category: "roti-canai", price: 8.00, image: "../../assets/images/menu2.jpg", badge: "bestseller" },
    // ── SET TENGAH HARI ──
    { id: 41, name: "Nasi Bawal Goreng Berlado", category: "set-nasi", price: 9.00, image: "../../assets/images/menu3.jpg", badge: "" },
    { id: 42, name: "Nasi Siakap Goreng Berlado", category: "set-nasi", price: 15.00, image: "../../assets/images/menu4.jpg", badge: "bestseller" },
    { id: 43, name: "Nasi Keli Goreng Berlado", category: "set-nasi", price: 10.90, image: "../../assets/images/food1.jpg", badge: "" },
    { id: 44, name: "Nasi Ayam Goreng Berlado", category: "set-nasi", price: 8.50, image: "../../assets/images/food2.jpg", badge: "" },
    { id: 45, name: "Bubur Ayam", category: "set-panas", price: 6.50, image: "../../assets/images/food3.jpg", badge: "" },
    { id: 46, name: "Bubur Nasi", category: "set-panas", price: 7.50, image: "../../assets/images/menu1.jpg", badge: "" },
    { id: 47, name: "Bakso (Mee / Mee Hoon)", category: "set-panas", price: 7.50, image: "../../assets/images/menu2.jpg", badge: "" },
    { id: 48, name: "Laksa Johor", category: "set-panas", price: 8.00, image: "../../assets/images/menu3.jpg", badge: "" },
    { id: 49, name: "Laksa Penang", category: "set-panas", price: 7.50, image: "../../assets/images/menu4.jpg", badge: "" },
    { id: 50, name: "Soto (Mee / Mee Hoon)", category: "set-panas", price: 8.00, image: "../../assets/images/food1.jpg", badge: "" },
    { id: 51, name: "Nasi Lemak Basmathi (Telur)", category: "set-panas", price: 6.00, image: "../../assets/images/food2.jpg", badge: "" },
    { id: 52, name: "Nasi Lemak Basmathi (Ayam)", category: "set-panas", price: 9.00, image: "../../assets/images/food3.jpg", badge: "" },
    // ── MENU IKAN ──
    { id: 53, name: "Siakap Tiga Rasa", category: "ikan-siakap", price: 37.00, image: "../../assets/images/menu1.jpg", badge: "" },
    { id: 54, name: "Siakap Masam Manis", category: "ikan-siakap", price: 37.00, image: "../../assets/images/menu2.jpg", badge: "" },
    { id: 55, name: "Siakap Steam Lemon", category: "ikan-siakap", price: 37.00, image: "../../assets/images/menu3.jpg", badge: "" },
    { id: 56, name: "Siakap Laprik", category: "ikan-siakap", price: 37.00, image: "../../assets/images/menu4.jpg", badge: "" },
    { id: 57, name: "Siakap Goreng Kunyit", category: "ikan-siakap", price: 37.00, image: "../../assets/images/food1.jpg", badge: "" },
    { id: 58, name: "Siakap Bakar", category: "ikan-bakar", price: 37.00, image: "../../assets/images/food2.jpg", badge: "bestseller" },
    { id: 59, name: "Caru Bakar", category: "ikan-bakar", price: 12.00, image: "../../assets/images/food3.jpg", badge: "" },
    { id: 60, name: "Kerang Bakar", category: "ikan-bakar", price: 15.00, image: "../../assets/images/menu1.jpg", badge: "" },
    { id: 61, name: "Sotong Bakar", category: "ikan-bakar", price: 15.00, image: "../../assets/images/menu2.jpg", badge: "" },
    // ── ALA-CARTE ──
    { id: 62, name: "Kailan (Biasa / Ikan Masin)", category: "alacarte-sayur", price: 7.00, image: "../../assets/images/menu3.jpg", badge: "" },
    { id: 63, name: "Kangkung (Biasa / Belacan)", category: "alacarte-sayur", price: 7.00, image: "../../assets/images/menu4.jpg", badge: "" },
    { id: 64, name: "Taugeh (Biasa / Ikan Masin)", category: "alacarte-sayur", price: 7.00, image: "../../assets/images/food1.jpg", badge: "" },
    { id: 65, name: "Sawi (Biasa / Ikan Masin)", category: "alacarte-sayur", price: 7.00, image: "../../assets/images/food2.jpg", badge: "" },
    { id: 66, name: "Cendawan Goreng Biasa", category: "alacarte-sayur", price: 7.00, image: "../../assets/images/food3.jpg", badge: "" },
    { id: 67, name: "Ayam Black Pepper", category: "alacarte-lauk", price: 7.50, image: "../../assets/images/menu1.jpg", badge: "" },
    { id: 68, name: "Daging Black Pepper", category: "alacarte-lauk", price: 8.50, image: "../../assets/images/menu2.jpg", badge: "" },
    { id: 69, name: "Sotong Black Pepper", category: "alacarte-lauk", price: 9.50, image: "../../assets/images/menu3.jpg", badge: "" },
    { id: 70, name: "Ayam Sambal", category: "alacarte-lauk", price: 7.50, image: "../../assets/images/menu4.jpg", badge: "" },
    { id: 71, name: "Daging Sambal", category: "alacarte-lauk", price: 8.50, image: "../../assets/images/food1.jpg", badge: "" },
    { id: 72, name: "Sotong Sambal", category: "alacarte-lauk", price: 9.50, image: "../../assets/images/food2.jpg", badge: "" },
    { id: 73, name: "Ayam Merah", category: "alacarte-lauk", price: 7.50, image: "../../assets/images/food3.jpg", badge: "" },
    { id: 74, name: "Daging Merah", category: "alacarte-lauk", price: 8.50, image: "../../assets/images/menu1.jpg", badge: "" },
    { id: 75, name: "Sotong Merah", category: "alacarte-lauk", price: 9.50, image: "../../assets/images/menu2.jpg", badge: "" },
    { id: 76, name: "Ayam Paprik", category: "alacarte-lauk", price: 7.50, image: "../../assets/images/menu3.jpg", badge: "" },
    { id: 77, name: "Daging Paprik", category: "alacarte-lauk", price: 8.50, image: "../../assets/images/menu4.jpg", badge: "" },
    { id: 78, name: "Sotong Paprik", category: "alacarte-lauk", price: 9.50, image: "../../assets/images/food1.jpg", badge: "" },
    { id: 79, name: "Ayam Pha Khra Phao", category: "alacarte-lauk", price: 8.00, image: "../../assets/images/food2.jpg", badge: "" },
    { id: 80, name: "Daging Pha Khra Phao", category: "alacarte-lauk", price: 9.00, image: "../../assets/images/food3.jpg", badge: "" },
    { id: 81, name: "Ayam Kunyit", category: "alacarte-lauk", price: 7.50, image: "../../assets/images/menu1.jpg", badge: "" },
    { id: 82, name: "Daging Kunyit", category: "alacarte-lauk", price: 9.50, image: "../../assets/images/menu2.jpg", badge: "" },
    { id: 83, name: "Sotong Kunyit", category: "alacarte-lauk", price: 9.50, image: "../../assets/images/menu3.jpg", badge: "" },
    { id: 84, name: "Udang Kunyit", category: "alacarte-lauk", price: 9.50, image: "../../assets/images/menu4.jpg", badge: "" },
    { id: 85, name: "Add On: Nasi Putih", category: "alacarte-lauk", price: 2.00, image: "../../assets/images/food1.jpg", badge: "" },
    { id: 86, name: "Add On: Nasi Goreng", category: "alacarte-lauk", price: 3.00, image: "../../assets/images/food2.jpg", badge: "" },
    { id: 87, name: "Sotong Goreng Tepung", category: "alacarte-tepung", price: 10.50, image: "../../assets/images/food3.jpg", badge: "" },
    { id: 88, name: "Udang Goreng Tepung", category: "alacarte-tepung", price: 10.50, image: "../../assets/images/menu1.jpg", badge: "" },
    { id: 89, name: "Cendawan Goreng Tepung", category: "alacarte-tepung", price: 7.00, image: "../../assets/images/menu2.jpg", badge: "" },
    { id: 90, name: "Inokki Goreng Tepung", category: "alacarte-tepung", price: 7.00, image: "../../assets/images/menu3.jpg", badge: "" },
    { id: 91, name: "Sup Ayam Ala Thai", category: "alacarte-sup", price: 8.00, image: "../../assets/images/menu4.jpg", badge: "" },
    { id: 92, name: "Sup Daging Ala Thai", category: "alacarte-sup", price: 9.00, image: "../../assets/images/food1.jpg", badge: "" },
    { id: 93, name: "Add On: Mee / Mee Hoon / Kuey Teow", category: "alacarte-sup", price: 2.00, image: "../../assets/images/food2.jpg", badge: "" },
    { id: 94, name: "Tom Yam Ayam", category: "alacarte-tomyam", price: 8.00, image: "../../assets/images/food3.jpg", badge: "spicy" },
    { id: 95, name: "Tom Yam Daging", category: "alacarte-tomyam", price: 9.00, image: "../../assets/images/menu1.jpg", badge: "spicy" },
    { id: 96, name: "Tom Yam Ayam + Daging", category: "alacarte-tomyam", price: 12.00, image: "../../assets/images/menu2.jpg", badge: "spicy" },
    { id: 97, name: "Tom Yam Seafood", category: "alacarte-tomyam", price: 13.00, image: "../../assets/images/menu3.jpg", badge: "bestseller" },
    { id: 98, name: "Tom Yam Campur", category: "alacarte-tomyam", price: 13.00, image: "../../assets/images/menu4.jpg", badge: "spicy" },
    { id: 99, name: "Tom Yam Sayur", category: "alacarte-tomyam", price: 8.00, image: "../../assets/images/food1.jpg", badge: "" },
    { id: 100, name: "Tom Yam Cendawan", category: "alacarte-tomyam", price: 8.00, image: "../../assets/images/food2.jpg", badge: "" },
    { id: 101, name: "Add On: Mee / Mee Hoon / Kuey Teow", category: "alacarte-tomyam", price: 2.00, image: "../../assets/images/food3.jpg", badge: "" },
    { id: 102, name: "Mee Bandung", category: "alacarte-meekuah", price: 10.50, image: "../../assets/images/menu1.jpg", badge: "" },
    { id: 103, name: "Mee Hong Kong", category: "alacarte-meekuah", price: 10.50, image: "../../assets/images/menu2.jpg", badge: "" },
    { id: 104, name: "Mee Hailam", category: "alacarte-meekuah", price: 10.50, image: "../../assets/images/menu3.jpg", badge: "" },
    { id: 105, name: "Mee Kung Fu", category: "alacarte-meekuah", price: 10.50, image: "../../assets/images/menu4.jpg", badge: "" },
    // ── WESTERN ──
    { id: 106, name: "Chicken Chop (Fried/Grill)", category: "western", price: 18.50, image: "../../assets/images/food1.jpg", badge: "bestseller" },
    { id: 107, name: "Fish N Chips", category: "western", price: 16.50, image: "../../assets/images/food2.jpg", badge: "" },
    { id: 108, name: "Lamb Chop", category: "western", price: 30.90, image: "../../assets/images/food3.jpg", badge: "" },
    { id: 109, name: "Aglio Olio Seafood", category: "western", price: 17.00, image: "../../assets/images/menu1.jpg", badge: "" },
    { id: 110, name: "Aglio Olio Beef Bacon", category: "western", price: 15.00, image: "../../assets/images/menu2.jpg", badge: "" },
    { id: 111, name: "Aglio Olio Chicken", category: "western", price: 13.00, image: "../../assets/images/menu3.jpg", badge: "" },
    { id: 112, name: "Carbonara Seafood", category: "western", price: 18.00, image: "../../assets/images/menu4.jpg", badge: "" },
    { id: 113, name: "Carbonara Beef Bacon", category: "western", price: 16.00, image: "../../assets/images/food1.jpg", badge: "" },
    { id: 114, name: "Carbonara Chicken", category: "western", price: 14.00, image: "../../assets/images/food2.jpg", badge: "" },
    { id: 115, name: "Bolognesse", category: "western", price: 15.00, image: "../../assets/images/food3.jpg", badge: "" },
    { id: 116, name: "Smash Beef (Single)", category: "western", price: 8.00, image: "../../assets/images/menu1.jpg", badge: "" },
    { id: 117, name: "Smash Beef (Double)", category: "western", price: 10.00, image: "../../assets/images/menu2.jpg", badge: "" },
    { id: 118, name: "Crispy Chicken Burger", category: "western", price: 7.50, image: "../../assets/images/menu3.jpg", badge: "" },
    { id: 119, name: "Add On: Fries", category: "western", price: 2.00, image: "../../assets/images/menu4.jpg", badge: "" },
    { id: 120, name: "Fries", category: "western", price: 7.50, image: "../../assets/images/food1.jpg", badge: "" },
    { id: 121, name: "Nugget 8pcs", category: "western", price: 8.00, image: "../../assets/images/food2.jpg", badge: "" },
    { id: 122, name: "Cheesy Wedges", category: "western", price: 8.50, image: "../../assets/images/food3.jpg", badge: "" },
    // ── GORENG-GORENG ──
    { id: 123, name: "Nasi Goreng Biasa", category: "goreng-nasi", price: 7.50, image: "../../assets/images/menu1.jpg", badge: "" },
    { id: 124, name: "Nasi Goreng Kampung", category: "goreng-nasi", price: 8.00, image: "../../assets/images/menu2.jpg", badge: "bestseller" },
    { id: 125, name: "Nasi Goreng Cina", category: "goreng-nasi", price: 7.50, image: "../../assets/images/menu3.jpg", badge: "" },
    { id: 126, name: "Nasi Goreng Ikan Masin", category: "goreng-nasi", price: 8.50, image: "../../assets/images/menu4.jpg", badge: "" },
    { id: 127, name: "Nasi Goreng Cili Padi", category: "goreng-nasi", price: 8.50, image: "../../assets/images/food1.jpg", badge: "spicy" },
    { id: 128, name: "Nasi Goreng Pattaya", category: "goreng-nasi", price: 8.50, image: "../../assets/images/food2.jpg", badge: "" },
    { id: 129, name: "Nasi Goreng Tom Yam", category: "goreng-nasi", price: 9.00, image: "../../assets/images/food3.jpg", badge: "spicy" },
    { id: 130, name: "Nasi Goreng Belacan", category: "goreng-nasi", price: 12.00, image: "../../assets/images/menu1.jpg", badge: "" },
    { id: 131, name: "Mee Goreng", category: "goreng-mee", price: 7.50, image: "../../assets/images/menu2.jpg", badge: "" },
    { id: 132, name: "Mee Hoon Goreng Singapore", category: "goreng-mee", price: 7.50, image: "../../assets/images/menu3.jpg", badge: "" },
    { id: 133, name: "Char Kuey Teow", category: "goreng-mee", price: 8.00, image: "../../assets/images/menu4.jpg", badge: "" },
    // ── DRINKS ──
    { id: 134, name: "Teh O' (Hot)", category: "drinks-noncoffee", price: 2.30, image: "../../assets/images/food1.jpg", badge: "" },
    { id: 135, name: "Teh O' (Cold)", category: "drinks-noncoffee", price: 2.50, image: "../../assets/images/food1.jpg", badge: "" },
    { id: 136, name: "Teh Tarik (Hot)", category: "drinks-noncoffee", price: 2.50, image: "../../assets/images/food2.jpg", badge: "bestseller" },
    { id: 137, name: "Teh Tarik (Cold)", category: "drinks-noncoffee", price: 3.00, image: "../../assets/images/food2.jpg", badge: "" },
    { id: 138, name: "Teh Halia (Hot)", category: "drinks-noncoffee", price: 3.50, image: "../../assets/images/food3.jpg", badge: "" },
    { id: 139, name: "Teh Halia (Cold)", category: "drinks-noncoffee", price: 4.00, image: "../../assets/images/food3.jpg", badge: "" },
    { id: 140, name: "Sirap (Hot)", category: "drinks-noncoffee", price: 2.00, image: "../../assets/images/menu1.jpg", badge: "" },
    { id: 141, name: "Sirap (Cold)", category: "drinks-noncoffee", price: 2.50, image: "../../assets/images/menu1.jpg", badge: "" },
    { id: 142, name: "Sirap Bandung (Cold)", category: "drinks-noncoffee", price: 3.50, image: "../../assets/images/menu2.jpg", badge: "" },
    { id: 143, name: "Sirap Bandung Soda (Cold)", category: "drinks-noncoffee", price: 4.00, image: "../../assets/images/menu3.jpg", badge: "" },
    { id: 144, name: "Limau (Hot)", category: "drinks-noncoffee", price: 2.70, image: "../../assets/images/menu4.jpg", badge: "" },
    { id: 145, name: "Limau (Cold)", category: "drinks-noncoffee", price: 3.00, image: "../../assets/images/menu4.jpg", badge: "" },
    { id: 146, name: "Jus Orange", category: "drinks-jus", price: 5.00, image: "../../assets/images/food1.jpg", badge: "" },
    { id: 147, name: "Jus Apple", category: "drinks-jus", price: 5.00, image: "../../assets/images/food2.jpg", badge: "" },
    { id: 148, name: "Jus Watermelon", category: "drinks-jus", price: 5.00, image: "../../assets/images/food3.jpg", badge: "" },
    { id: 149, name: "Jus Lychee", category: "drinks-jus", price: 5.00, image: "../../assets/images/menu1.jpg", badge: "" },
    { id: 150, name: "Jus Lemon", category: "drinks-jus", price: 5.00, image: "../../assets/images/menu2.jpg", badge: "" },
    { id: 151, name: "Cikong", category: "drinks-dessert", price: 6.00, image: "../../assets/images/menu3.jpg", badge: "new" },
    { id: 152, name: "Ais Jelly Limau", category: "drinks-dessert", price: 6.00, image: "../../assets/images/menu4.jpg", badge: "" },
    { id: 153, name: "Cendol", category: "drinks-dessert", price: 6.00, image: "../../assets/images/food1.jpg", badge: "bestseller" },
];

let currentTable = 1;
let currentPax = 1;
let currentOrder = [];
let activeCategory = "all";
let searchQuery = '';
const MAX_TABLE = 30;
const MAX_PAX = 10;

function getAssetBase() {
    return (window.restaurantAssetBase || '/assets').replace(/\/$/, '');
}

function getMenuItemImage(id) {
    return `${getAssetBase()}/images/menu-image/item${id}.png`;
}

function getFallbackImage() {
    return `${getAssetBase()}/images/Logo.jpeg`;
}

document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('table')) {
        let tbl = parseInt(urlParams.get('table'));
        if (tbl >= 1 && tbl <= MAX_TABLE) {
            currentTable = tbl;
            document.getElementById('tableValue').textContent = currentTable;
            
            // Hide the table scroller since it's already selected via QR
            const tableScrollerGroup = document.getElementById('tableScrollerGroup');
            if (tableScrollerGroup) {
                tableScrollerGroup.style.display = 'none';
            }
        }
    }

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
        window.location.href = window.orderStatusUrl || '/customer/order-status';
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
                    <img src="${getMenuItemImage(item.id)}" onerror="this.src='${getFallbackImage()}'" alt="${item.name}">
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
        const notes = document.getElementById('specialInstructions').value;
        
        // Save the current order to localStorage for the checkout page
        localStorage.setItem('restaurantCart', JSON.stringify(currentOrder));
        
        btnConfirm.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Redirecting to Checkout...';
        btnConfirm.disabled = true;
        
        // Redirect to checkout with table, pax, and notes in query string
        const checkoutUrl = '/customer/checkout?type=dine-in&table=' + currentTable + '&pax=' + currentPax + '&notes=' + encodeURIComponent(notes) + '&qr=1';
        window.location.href = checkoutUrl;
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
