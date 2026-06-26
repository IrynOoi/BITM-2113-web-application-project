// menu.js
// ========================================
// MENU PAGE JAVASCRIPT — Restoran SUP TULANG ZZ (144 items)
// ========================================

const menuData = [
    // ── SUP ZZ (Signature) ──
    { id: 1, name: "Sup Gearbox Kambing", category: "signature-sup", price: 19.00, image: "../assets/images/menu-image/item1.png", description: "Signature goat gearbox bone soup, slow-cooked in rich spiced broth.", badge: "bestseller", rating: 4.9, spicy: false },
    { id: 2, name: "Sup Kambing", category: "signature-sup", price: 20.00, image: "../assets/images/menu-image/item2.png", description: "Tender mutton soup slow-cooked with aromatic herbs and spices.", badge: "", rating: 4.7, spicy: false },
    { id: 3, name: "Sup Daging", category: "signature-sup", price: 8.00, image: "../assets/images/menu-image/item3.png", description: "Beef bone soup cooked with traditional spices.", badge: "", rating: 4.4, spicy: false },
    { id: 4, name: "Sup Ayam", category: "signature-sup", price: 7.00, image: "../assets/images/menu-image/item4.png", description: "Hearty chicken soup with herbs.", badge: "", rating: 4.3, spicy: false },

    // ── MEE REBUS ZZ ──
    { id: 5, name: "Mee Rebus Gearbox Kambing", category: "signature-mee", price: 20.00, image: "../assets/images/menu-image/item5.png", description: "Noodles in thick gravy with goat gearbox bone.", badge: "bestseller", rating: 4.8, spicy: false },
    { id: 6, name: "Mee Rebus Daging", category: "signature-mee", price: 9.50, image: "../assets/images/menu-image/item6.png", description: "Noodles in thick spiced gravy with beef.", badge: "", rating: 4.5, spicy: false },
    { id: 7, name: "Mee Rebus Ayam", category: "signature-mee", price: 9.00, image: "../assets/images/menu-image/item7.png", description: "Noodles in thick gravy with chicken.", badge: "", rating: 4.3, spicy: false },

    // ── SARAPAN — Masakan Panas ──
    { id: 8, name: "Lontong Kuah", category: "sarapan-panas", price: 7.50, image: "../assets/images/menu-image/item8.png", description: "Rice cakes in coconut vegetable curry.", badge: "", rating: 4.4, spicy: false },
    { id: 9, name: "Lontong Kering (Ayam)", category: "sarapan-panas", price: 9.00, image: "../assets/images/menu-image/item9.png", description: "Dry-style lontong with chicken rendang.", badge: "", rating: 4.2, spicy: false },
    { id: 10, name: "Lontong Kering (Daging)", category: "sarapan-panas", price: 9.50, image: "../assets/images/menu-image/item10.png", description: "Dry-style lontong with beef rendang.", badge: "", rating: 4.3, spicy: false },
    { id: 11, name: "Nasi Lemak Basmathi (Telur)", category: "sarapan-panas", price: 6.00, image: "../assets/images/menu-image/item11.png", description: "Fragrant basmathi coconut rice with egg.", badge: "", rating: 4.5, spicy: true },
    { id: 12, name: "Nasi Lemak Basmathi (Ayam)", category: "sarapan-panas", price: 9.00, image: "../assets/images/menu-image/item12.png", description: "Fragrant basmathi coconut rice with fried chicken.", badge: "bestseller", rating: 4.7, spicy: true },
    { id: 13, name: "Nasi Lemak Rendang (Ayam)", category: "sarapan-panas", price: 8.50, image: "../assets/images/menu-image/item13.png", description: "Coconut rice with chicken rendang.", badge: "", rating: 4.6, spicy: true },
    { id: 14, name: "Nasi Lemak Rendang (Daging)", category: "sarapan-panas", price: 9.50, image: "../assets/images/menu-image/item14.png", description: "Coconut rice with beef rendang.", badge: "", rating: 4.7, spicy: true },
    { id: 15, name: "Nasi Ayam Basmathi", category: "sarapan-panas", price: 12.00, image: "../assets/images/menu-image/item15.png", description: "Basmathi rice served with chicken.", badge: "", rating: 4.5, spicy: false },
    { id: 16, name: "Nasi Ambang", category: "sarapan-panas", price: 9.50, image: "../assets/images/menu-image/item16.png", description: "Traditional communal rice dish with assorted sides.", badge: "", rating: 4.4, spicy: false },
    { id: 17, name: "Bubur Nasi", category: "sarapan-panas", price: 7.50, image: "../assets/images/menu-image/item17.png", description: "Smooth rice porridge.", badge: "", rating: 4.2, spicy: false },
    { id: 18, name: "Bubur Ayam", category: "sarapan-panas", price: 7.00, image: "../assets/images/menu-image/item18.png", description: "Chicken rice porridge with condiments.", badge: "", rating: 4.3, spicy: false },
    { id: 19, name: "Laksa Johor", category: "sarapan-panas", price: 8.00, image: "../assets/images/menu-image/item19.png", description: "Johor-style laksa noodles.", badge: "", rating: 4.6, spicy: true },
    { id: 20, name: "Laksa Penang", category: "sarapan-panas", price: 7.50, image: "../assets/images/menu-image/item20.png", description: "Penang-style sour fish laksa.", badge: "", rating: 4.5, spicy: true },
    { id: 21, name: "Bakso (Mee/Mee Hoon/Nasi)", category: "sarapan-panas", price: 7.50, image: "../assets/images/menu-image/item21.png", description: "Indonesian-style meatball soup with choice of noodles or rice.", badge: "", rating: 4.3, spicy: false },
    { id: 22, name: "Soto (Mee/Mee Hoon/Nasi)", category: "sarapan-panas", price: 8.00, image: "../assets/images/menu-image/item22.png", description: "Traditional soto soup with choice of noodles or rice.", badge: "", rating: 4.4, spicy: false },

    // ── ROTI BAKAR & ROTI CANAI ──
    { id: 23, name: "Roti Bakar", category: "roti-bakar", price: 2.50, image: "../assets/images/menu-image/item23.png", description: "Classic toasted bread.", badge: "", rating: 4.0, spicy: false },
    { id: 24, name: "Roti Kaya", category: "roti-bakar", price: 3.50, image: "../assets/images/menu-image/item24.png", description: "Toasted bread with rich kaya.", badge: "", rating: 4.3, spicy: false },
    { id: 25, name: "Roti Garlic", category: "roti-bakar", price: 3.50, image: "../assets/images/menu-image/item25.png", description: "Toasted garlic bread.", badge: "", rating: 4.2, spicy: false },
    { id: 26, name: "Roti Canai Kosong", category: "roti-canai", price: 1.50, image: "../assets/images/menu-image/item26.png", description: "Plain crispy flatbread served with dhal/curry.", badge: "", rating: 4.2, spicy: false },
    { id: 27, name: "Roti Canai Kosong Bawang", category: "roti-canai", price: 2.00, image: "../assets/images/menu-image/item27.png", description: "Flatbread with onion.", badge: "", rating: 4.3, spicy: false },
    { id: 28, name: "Roti Tampal", category: "roti-canai", price: 2.80, image: "../assets/images/menu-image/item28.png", description: "Flatbread with egg patched on top.", badge: "", rating: 4.4, spicy: false },
    { id: 29, name: "Roti Telur", category: "roti-canai", price: 2.80, image: "../assets/images/menu-image/item29.png", description: "Flatbread with egg inside.", badge: "", rating: 4.4, spicy: false },
    { id: 30, name: "Roti Telur Bawang", category: "roti-canai", price: 3.50, image: "../assets/images/menu-image/item30.png", description: "Flatbread with egg and onion.", badge: "", rating: 4.5, spicy: false },
    { id: 31, name: "Roti Telur Double Jantan", category: "roti-canai", price: 5.50, image: "../assets/images/menu-image/item31.png", description: "Double-egg flatbread.", badge: "bestseller", rating: 4.7, spicy: false },
    { id: 32, name: "Roti Pisang", category: "roti-canai", price: 4.50, image: "../assets/images/menu-image/item32.png", description: "Banana flatbread.", badge: "", rating: 4.5, spicy: false },
    { id: 33, name: "Roti Sardin", category: "roti-canai", price: 6.00, image: "../assets/images/menu-image/item33.png", description: "Sardine-filled flatbread.", badge: "", rating: 4.2, spicy: false },
    { id: 34, name: "Roti Bom", category: "roti-canai", price: 2.50, image: "../assets/images/menu-image/item34.png", description: "Thick fluffy flatbread.", badge: "", rating: 4.3, spicy: false },
    { id: 35, name: "Roti Planta", category: "roti-canai", price: 3.00, image: "../assets/images/menu-image/item35.png", description: "Flatbread with Planta margarine.", badge: "", rating: 4.1, spicy: false },
    { id: 36, name: "Roti Sarang Burung Daging", category: "roti-canai", price: 8.00, image: "../assets/images/menu-image/item36.png", description: "Bird nest-style flatbread with minced meat.", badge: "bestseller", rating: 4.8, spicy: false },

    // ── SET TENGAH HARI — Set Nasi & Lauk ──
    { id: 37, name: "Nasi Bawal Goreng Berlado", category: "set-nasi", price: 9.00, image: "../assets/images/menu-image/item37.png", description: "Fried pomfret with chili sambal, served with rice.", badge: "", rating: 4.5, spicy: true },
    { id: 38, name: "Nasi Siakap Goreng Berlado", category: "set-nasi", price: 15.00, image: "../assets/images/menu-image/item38.png", description: "Fried sea bass with chili sambal, served with rice.", badge: "bestseller", rating: 4.9, spicy: true },
    { id: 39, name: "Nasi Keli Goreng Berlado", category: "set-nasi", price: 10.90, image: "../assets/images/menu-image/item39.png", description: "Fried catfish with chili sambal, served with rice.", badge: "", rating: 4.6, spicy: true },
    { id: 40, name: "Nasi Ayam Goreng Berlado", category: "set-nasi", price: 8.50, image: "../assets/images/menu-image/item40.png", description: "Fried chicken with chili sambal, served with rice.", badge: "", rating: 4.4, spicy: true },

    // ── MENU IKAN ──
    { id: 41, name: "Ikan Siakap Tiga Rasa", category: "ikan", price: 37.50, image: "../assets/images/menu-image/item41.png", description: "Sea bass in three-flavour sauce.", badge: "bestseller", rating: 4.8, spicy: true },
    { id: 42, name: "Ikan Siakap Masam Manis", category: "ikan", price: 37.50, image: "../assets/images/menu-image/item42.png", description: "Sea bass in sweet and sour sauce.", badge: "", rating: 4.6, spicy: false },
    { id: 43, name: "Ikan Siakap Steam Lemon", category: "ikan", price: 37.50, image: "../assets/images/menu-image/item43.png", description: "Steamed sea bass with lemon sauce.", badge: "", rating: 4.5, spicy: false },
    { id: 44, name: "Ikan Siakap Laprik", category: "ikan", price: 37.50, image: "../assets/images/menu-image/item44.png", description: "Sea bass in spicy sambal sauce.", badge: "", rating: 4.4, spicy: true },
    { id: 45, name: "Ikan Siakap Goreng Kunyit", category: "ikan", price: 37.50, image: "../assets/images/menu-image/item45.png", description: "Turmeric-fried sea bass.", badge: "", rating: 4.5, spicy: false },
    { id: 46, name: "Siakap Bakar", category: "ikan", price: 37.50, image: "../assets/images/menu-image/item46.png", description: "Grilled sea bass.", badge: "bestseller", rating: 4.9, spicy: true },
    { id: 47, name: "Caru Bakar", category: "ikan", price: 11.50, image: "../assets/images/menu-image/item47.png", description: "Grilled caru fish.", badge: "", rating: 4.3, spicy: true },
    { id: 48, name: "Kerang Bakar", category: "ikan", price: 15.00, image: "../assets/images/menu-image/item48.png", description: "Grilled cockles.", badge: "", rating: 4.4, spicy: true },
    { id: 49, name: "Sotong Bakar", category: "ikan", price: 15.00, image: "../assets/images/menu-image/item49.png", description: "Grilled squid.", badge: "", rating: 4.5, spicy: true },

    // ── GORENG-GORENG — Nasi Goreng ──
    { id: 50, name: "Nasi Goreng Biasa", category: "goreng-nasi", price: 7.50, image: "../assets/images/menu-image/item50.png", description: "Classic fried rice.", badge: "", rating: 4.2, spicy: false },
    { id: 51, name: "Nasi Goreng Kampung", category: "goreng-nasi", price: 8.00, image: "../assets/images/menu-image/item51.png", description: "Village-style fried rice with anchovies.", badge: "bestseller", rating: 4.6, spicy: true },
    { id: 52, name: "Nasi Goreng Cina", category: "goreng-nasi", price: 7.50, image: "../assets/images/menu-image/item52.png", description: "Chinese-style fried rice.", badge: "", rating: 4.1, spicy: false },
    { id: 53, name: "Nasi Goreng Ikan Masin", category: "goreng-nasi", price: 8.50, image: "../assets/images/menu-image/item53.png", description: "Salted fish fried rice.", badge: "", rating: 4.4, spicy: false },
    { id: 54, name: "Nasi Goreng Cili Padi", category: "goreng-nasi", price: 8.50, image: "../assets/images/menu-image/item54.png", description: "Bird-eye chili fried rice — extra spicy!", badge: "spicy", rating: 4.5, spicy: true },
    { id: 55, name: "Nasi Goreng Pattaya", category: "goreng-nasi", price: 8.50, image: "../assets/images/menu-image/item55.png", description: "Pattaya-style omelette-wrapped fried rice.", badge: "", rating: 4.4, spicy: false },
    { id: 56, name: "Nasi Goreng Tom Yam", category: "goreng-nasi", price: 9.00, image: "../assets/images/menu-image/item56.png", description: "Tom yam flavoured fried rice.", badge: "spicy", rating: 4.6, spicy: true },
    { id: 57, name: "Nasi Goreng Belacan", category: "goreng-nasi", price: 12.00, image: "../assets/images/menu-image/item57.png", description: "Shrimp paste fried rice.", badge: "", rating: 4.5, spicy: true },

    // ── GORENG-GORENG — Mee Goreng ──
    { id: 58, name: "Mee Goreng", category: "goreng-mee", price: 7.50, image: "../assets/images/menu-image/item58.png", description: "Classic stir-fried yellow noodles.", badge: "", rating: 4.2, spicy: false },
    { id: 59, name: "Mee Hoon Goreng Singapore", category: "goreng-mee", price: 7.50, image: "../assets/images/menu-image/item59.png", description: "Singapore-style stir-fried rice vermicelli.", badge: "", rating: 4.3, spicy: true },
    { id: 60, name: "Char Kuey Teow", category: "goreng-mee", price: 8.00, image: "../assets/images/menu-image/item60.png", description: "Wok-fried flat rice noodles.", badge: "bestseller", rating: 4.7, spicy: false },

    // ── ALA-CARTE — Sayur ──
    { id: 61, name: "Kailan (Biasa)", category: "alacarte-sayur", price: 7.00, image: "../assets/images/menu-image/item61.png", description: "Stir-fried kailan vegetables.", badge: "", rating: 4.2, spicy: false },
    { id: 62, name: "Kailan (Ikan Masin)", category: "alacarte-sayur", price: 7.00, image: "../assets/images/menu-image/item62.png", description: "Stir-fried kailan with salted fish.", badge: "", rating: 4.0, spicy: false },
    { id: 63, name: "Kangkung (Biasa)", category: "alacarte-sayur", price: 7.00, image: "../assets/images/menu-image/item63.png", description: "Stir-fried water spinach.", badge: "", rating: 4.3, spicy: false },
    { id: 64, name: "Kangkung Belacan", category: "alacarte-sayur", price: 7.00, image: "../assets/images/menu-image/item64.png", description: "Stir-fried water spinach with shrimp paste.", badge: "", rating: 4.4, spicy: true },
    { id: 65, name: "Taugeh (Biasa)", category: "alacarte-sayur", price: 7.00, image: "../assets/images/menu-image/item65.png", description: "Stir-fried bean sprouts.", badge: "", rating: 4.1, spicy: false },
    { id: 66, name: "Sawi (Biasa)", category: "alacarte-sayur", price: 7.00, image: "../assets/images/menu-image/item66.png", description: "Stir-fried mustard greens.", badge: "", rating: 4.0, spicy: false },
    { id: 67, name: "Cendawan Goreng Biasa", category: "alacarte-sayur", price: 7.00, image: "../assets/images/menu-image/item67.png", description: "Stir-fried mushrooms.", badge: "", rating: 4.3, spicy: false },

    // ── ALA-CARTE — Aneka Lauk Thai ──
    { id: 68, name: "Ayam Black Pepper", category: "alacarte-lauk", price: 7.50, image: "../assets/images/menu-image/item68.png", description: "Black pepper chicken.", badge: "", rating: 4.5, spicy: true },
    { id: 69, name: "Daging Black Pepper", category: "alacarte-lauk", price: 8.50, image: "../assets/images/menu-image/item69.png", description: "Black pepper beef.", badge: "", rating: 4.6, spicy: true },
    { id: 70, name: "Sotong Black Pepper", category: "alacarte-lauk", price: 9.50, image: "../assets/images/menu-image/item70.png", description: "Black pepper squid.", badge: "", rating: 4.4, spicy: true },
    { id: 71, name: "Ayam Sambal", category: "alacarte-lauk", price: 7.50, image: "../assets/images/menu-image/item71.png", description: "Sambal chicken.", badge: "", rating: 4.5, spicy: true },
    { id: 72, name: "Daging Sambal", category: "alacarte-lauk", price: 8.50, image: "../assets/images/menu-image/item72.png", description: "Sambal beef.", badge: "", rating: 4.5, spicy: true },
    { id: 73, name: "Sotong Sambal", category: "alacarte-lauk", price: 9.50, image: "../assets/images/menu-image/item73.png", description: "Sambal squid.", badge: "", rating: 4.3, spicy: true },
    { id: 74, name: "Ayam Merah", category: "alacarte-lauk", price: 7.50, image: "../assets/images/menu-image/item74.png", description: "Red sauce chicken.", badge: "", rating: 4.2, spicy: false },
    { id: 75, name: "Daging Merah", category: "alacarte-lauk", price: 8.50, image: "../assets/images/menu-image/item75.png", description: "Red sauce beef.", badge: "", rating: 4.3, spicy: false },
    { id: 76, name: "Sotong Merah", category: "alacarte-lauk", price: 9.50, image: "../assets/images/menu-image/item76.png", description: "Red sauce squid.", badge: "", rating: 4.1, spicy: false },
    { id: 77, name: "Ayam Paprik", category: "alacarte-lauk", price: 7.50, image: "../assets/images/menu-image/item77.png", description: "Thai paprik-style chicken.", badge: "", rating: 4.4, spicy: true },
    { id: 78, name: "Daging Paprik", category: "alacarte-lauk", price: 8.50, image: "../assets/images/menu-image/item78.png", description: "Thai paprik-style beef.", badge: "", rating: 4.5, spicy: true },
    { id: 79, name: "Sotong Paprik", category: "alacarte-lauk", price: 9.50, image: "../assets/images/menu-image/item79.png", description: "Thai paprik-style squid.", badge: "", rating: 4.3, spicy: true },
    { id: 80, name: "Ayam Phad Khra Phao", category: "alacarte-lauk", price: 8.00, image: "../assets/images/menu-image/item80.png", description: "Thai basil chicken stir-fry.", badge: "", rating: 4.6, spicy: true },
    { id: 81, name: "Daging Phad Khra Phao", category: "alacarte-lauk", price: 9.00, image: "../assets/images/menu-image/item81.png", description: "Thai basil beef stir-fry.", badge: "", rating: 4.7, spicy: true },
    { id: 82, name: "Ayam Kunyit", category: "alacarte-lauk", price: 7.50, image: "../assets/images/menu-image/item82.png", description: "Turmeric chicken.", badge: "", rating: 4.4, spicy: false },
    { id: 83, name: "Daging Kunyit", category: "alacarte-lauk", price: 9.50, image: "../assets/images/menu-image/item83.png", description: "Turmeric beef.", badge: "", rating: 4.5, spicy: false },
    { id: 84, name: "Sotong Kunyit", category: "alacarte-lauk", price: 9.50, image: "../assets/images/menu-image/item84.png", description: "Turmeric squid.", badge: "", rating: 4.3, spicy: false },
    { id: 85, name: "Udang Kunyit", category: "alacarte-lauk", price: 9.50, image: "../assets/images/menu-image/item85.png", description: "Turmeric prawns.", badge: "", rating: 4.6, spicy: false },

    // ── ALA-CARTE — Goreng Tepung ──
    { id: 86, name: "Ayam Goreng Tepung", category: "alacarte-tepung", price: 10.00, image: "../assets/images/menu-image/item86.png", description: "Crispy battered fried chicken.", badge: "", rating: 4.5, spicy: false },

    // ── ALA-CARTE — Mee Kuah ──
    { id: 87, name: "Mee Kuah Bandung", category: "alacarte-meekuah", price: 10.50, image: "../assets/images/menu-image/item87.png", description: "Bandung-style noodle soup.", badge: "", rating: 4.5, spicy: false },
    { id: 88, name: "Mee Kuah Hong Kong", category: "alacarte-meekuah", price: 10.50, image: "../assets/images/menu-image/item88.png", description: "Hong Kong-style noodle soup.", badge: "", rating: 4.4, spicy: false },
    { id: 89, name: "Mee Kuah Hailam", category: "alacarte-meekuah", price: 10.50, image: "../assets/images/menu-image/item89.png", description: "Hainanese-style noodle soup.", badge: "", rating: 4.3, spicy: false },
    { id: 90, name: "Mee Kuah Kung Fu", category: "alacarte-meekuah", price: 10.50, image: "../assets/images/menu-image/item90.png", description: "Kung Fu-style noodle soup.", badge: "", rating: 4.2, spicy: false },

    // ── SUP ALA THAI & TOMYAM ──
    { id: 91, name: "Sup Ayam Ala Thai", category: "alacarte-sup", price: 8.00, image: "../assets/images/menu-image/item91.png", description: "Thai-style chicken soup.", badge: "", rating: 4.3, spicy: false },
    { id: 92, name: "Sup Daging Ala Thai", category: "alacarte-sup", price: 9.00, image: "../assets/images/menu-image/item92.png", description: "Thai-style beef soup.", badge: "", rating: 4.4, spicy: false },
    { id: 93, name: "Tom Yam Ayam", category: "alacarte-tomyam", price: 8.00, image: "../assets/images/menu-image/item93.png", description: "Spicy sour chicken tom yam.", badge: "spicy", rating: 4.6, spicy: true },
    { id: 94, name: "Tom Yam Daging", category: "alacarte-tomyam", price: 9.00, image: "../assets/images/menu-image/item94.png", description: "Spicy sour beef tom yam.", badge: "spicy", rating: 4.5, spicy: true },
    { id: 95, name: "Tom Yam Ayam + Daging", category: "alacarte-tomyam", price: 12.00, image: "../assets/images/menu-image/item95.png", description: "Mixed chicken and beef tom yam.", badge: "spicy", rating: 4.7, spicy: true },
    { id: 96, name: "Tom Yam Seafood", category: "alacarte-tomyam", price: 13.00, image: "../assets/images/menu-image/item96.png", description: "Seafood tom yam with prawns, squid, and fish.", badge: "bestseller", rating: 4.8, spicy: true },
    { id: 97, name: "Tom Yam Campur", category: "alacarte-tomyam", price: 13.00, image: "../assets/images/menu-image/item97.png", description: "Mixed tom yam.", badge: "spicy", rating: 4.7, spicy: true },
    { id: 98, name: "Tom Yam Sayur", category: "alacarte-tomyam", price: 8.00, image: "../assets/images/menu-image/item98.png", description: "Vegetable tom yam.", badge: "", rating: 4.2, spicy: true },
    { id: 99, name: "Tom Yam Cendawan", category: "alacarte-tomyam", price: 8.00, image: "../assets/images/menu-image/item99.png", description: "Mushroom tom yam.", badge: "", rating: 4.3, spicy: true },

    // ── WESTERN FOOD ──
    { id: 100, name: "Chicken Chop Fried", category: "western", price: 18.50, image: "../assets/images/menu-image/item100.png", description: "Fried chicken chop with mushroom sauce and fries.", badge: "bestseller", rating: 4.7, spicy: false },
    { id: 101, name: "Chicken Chop Grill", category: "western", price: 18.50, image: "../assets/images/menu-image/item101.png", description: "Grilled chicken chop with mushroom sauce and fries.", badge: "", rating: 4.6, spicy: false },
    { id: 102, name: "Fish N Chips", category: "western", price: 16.50, image: "../assets/images/menu-image/item102.png", description: "Crispy battered fish with fries and coleslaw.", badge: "", rating: 4.4, spicy: false },
    { id: 103, name: "Lamb Chop", category: "western", price: 30.90, image: "../assets/images/menu-image/item103.png", description: "Grilled lamb chop with sauce and sides.", badge: "", rating: 4.6, spicy: false },
    { id: 104, name: "Spaghetti Aglio Olio (Seafood)", category: "western", price: 17.00, image: "../assets/images/menu-image/item104.png", description: "Garlic olive oil spaghetti with seafood.", badge: "", rating: 4.5, spicy: false },
    { id: 105, name: "Spaghetti Aglio Olio (Beef Bacon)", category: "western", price: 15.00, image: "../assets/images/menu-image/item105.png", description: "Garlic olive oil spaghetti with beef bacon.", badge: "", rating: 4.3, spicy: false },
    { id: 106, name: "Spaghetti Aglio Olio (Chicken)", category: "western", price: 13.00, image: "../assets/images/menu-image/item106.png", description: "Garlic olive oil spaghetti with chicken.", badge: "", rating: 4.2, spicy: false },
    { id: 107, name: "Spaghetti Carbonara (Seafood)", category: "western", price: 18.00, image: "../assets/images/menu-image/item107.png", description: "Creamy carbonara with seafood.", badge: "", rating: 4.6, spicy: false },
    { id: 108, name: "Spaghetti Carbonara (Beef Bacon)", category: "western", price: 16.00, image: "../assets/images/menu-image/item108.png", description: "Creamy carbonara with beef bacon.", badge: "", rating: 4.4, spicy: false },
    { id: 109, name: "Spaghetti Carbonara (Chicken)", category: "western", price: 14.00, image: "../assets/images/menu-image/item109.png", description: "Creamy carbonara with chicken.", badge: "", rating: 4.3, spicy: false },
    { id: 110, name: "Spaghetti Bolognese", category: "western", price: 15.00, image: "../assets/images/menu-image/item110.png", description: "Classic meat sauce spaghetti.", badge: "", rating: 4.2, spicy: false },
    { id: 111, name: "Mac & Cheese", category: "western", price: 10.00, image: "../assets/images/menu-image/item111.png", description: "Creamy macaroni and cheese.", badge: "", rating: 4.1, spicy: false },
    { id: 112, name: "Smash Beef Burger Single", category: "western", price: 8.00, image: "../assets/images/menu-image/item112.png", description: "Single smash beef patty burger.", badge: "", rating: 4.5, spicy: false },
    { id: 113, name: "Smash Beef Burger Double", category: "western", price: 10.00, image: "../assets/images/menu-image/item113.png", description: "Double smash beef patty burger.", badge: "bestseller", rating: 4.7, spicy: false },
    { id: 114, name: "Crispy Chicken Burger", category: "western", price: 7.50, image: "../assets/images/menu-image/item114.png", description: "Crispy fried chicken burger.", badge: "", rating: 4.4, spicy: false },
    { id: 115, name: "Fries", category: "western-sides", price: 7.50, image: "../assets/images/menu-image/item115.png", description: "Crispy seasoned fries.", badge: "", rating: 4.0, spicy: false },
    { id: 116, name: "Nugget 8pcs", category: "western-sides", price: 8.00, image: "../assets/images/menu-image/item116.png", description: "Crispy chicken nuggets (8 pieces).", badge: "", rating: 4.0, spicy: false },
    { id: 117, name: "Cheesy Wedges", category: "western-sides", price: 8.50, image: "../assets/images/menu-image/item117.png", description: "Potato wedges with cheese sauce.", badge: "", rating: 4.3, spicy: false },

    // ── DRINKS — Non-Coffee ──
    { id: 118, name: "Teh O", category: "drinks-noncoffee", price: 2.50, image: "../assets/images/menu-image/item118.png", description: "Plain black tea.", badge: "", rating: 4.0, spicy: false },
    { id: 119, name: "Teh Tarik", category: "drinks-noncoffee", price: 2.50, image: "../assets/images/menu-image/item119.png", description: "Malaysian pulled milk tea, hot.", badge: "bestseller", rating: 4.8, spicy: false },
    { id: 120, name: "Teh Halia", category: "drinks-noncoffee", price: 3.50, image: "../assets/images/menu-image/item120.png", description: "Ginger tea with milk.", badge: "", rating: 4.3, spicy: false },
    { id: 121, name: "Teh Sarbat", category: "drinks-noncoffee", price: 3.50, image: "../assets/images/menu-image/item121.png", description: "Spiced herbal tea.", badge: "", rating: 4.2, spicy: false },
    { id: 122, name: "Sirap", category: "drinks-noncoffee", price: 2.00, image: "../assets/images/menu-image/item122.png", description: "Rose syrup drink.", badge: "", rating: 3.9, spicy: false },
    { id: 123, name: "Sirap Selasih", category: "drinks-noncoffee", price: 2.50, image: "../assets/images/menu-image/item123.png", description: "Rose syrup with basil seeds.", badge: "", rating: 4.1, spicy: false },
    { id: 124, name: "Sirap Limau", category: "drinks-noncoffee", price: 2.70, image: "../assets/images/menu-image/item124.png", description: "Lime rose syrup drink.", badge: "", rating: 4.0, spicy: false },
    { id: 125, name: "Sirap Laici", category: "drinks-noncoffee", price: 5.00, image: "../assets/images/menu-image/item125.png", description: "Lychee syrup drink.", badge: "", rating: 4.3, spicy: false },
    { id: 126, name: "Sirap Bandung", category: "drinks-noncoffee", price: 3.50, image: "../assets/images/menu-image/item126.png", description: "Rose milk syrup drink.", badge: "", rating: 4.5, spicy: false },
    { id: 127, name: "Sirap Bandung Cincau", category: "drinks-noncoffee", price: 4.00, image: "../assets/images/menu-image/item127.png", description: "Rose milk with grass jelly.", badge: "", rating: 4.4, spicy: false },
    { id: 128, name: "Sirap Bandung Soda", category: "drinks-noncoffee", price: 4.00, image: "../assets/images/menu-image/item128.png", description: "Sparkling rose milk drink.", badge: "", rating: 4.4, spicy: false },
    { id: 129, name: "Limau", category: "drinks-noncoffee", price: 2.70, image: "../assets/images/menu-image/item129.png", description: "Fresh lime juice.", badge: "", rating: 4.1, spicy: false },
    { id: 130, name: "Asam Boy", category: "drinks-noncoffee", price: 2.70, image: "../assets/images/menu-image/item130.png", description: "Sour plum lime drink.", badge: "", rating: 4.0, spicy: false },
    { id: 131, name: "Extra Joss Susu (Anggur/Mangga)", category: "drinks-noncoffee", price: 4.00, image: "../assets/images/menu-image/item131.png", description: "Energy drink with milk — grape or mango.", badge: "", rating: 4.2, spicy: false },
    { id: 132, name: "Vico", category: "drinks-noncoffee", price: 3.00, image: "../assets/images/menu-image/item132.png", description: "Chocolate malt drink.", badge: "", rating: 4.0, spicy: false },

    // ── DRINKS — Coffee ──
    { id: 133, name: "Indo Cafe O", category: "drinks-coffee", price: 3.00, image: "../assets/images/menu-image/item133.png", description: "Indonesian black coffee.", badge: "", rating: 4.1, spicy: false },
    { id: 134, name: "Indo Cafe Susu", category: "drinks-coffee", price: 3.50, image: "../assets/images/menu-image/item134.png", description: "Indonesian coffee with milk.", badge: "", rating: 4.2, spicy: false },
    { id: 135, name: "Kopi Tenggek", category: "drinks-coffee", price: 3.50, image: "../assets/images/menu-image/item135.png", description: "Strong traditional Malaysian coffee.", badge: "", rating: 4.3, spicy: false },
    { id: 136, name: "Kopi Special", category: "drinks-coffee", price: 4.00, image: "../assets/images/menu-image/item136.png", description: "House special coffee blend.", badge: "", rating: 4.4, spicy: false },

    // ── DRINKS — Jus ──
    { id: 137, name: "Jus Oren", category: "drinks-jus", price: 4.70, image: "../assets/images/menu-image/item137.png", description: "Fresh orange juice.", badge: "", rating: 4.4, spicy: false },
    { id: 138, name: "Jus Epal", category: "drinks-jus", price: 4.70, image: "../assets/images/menu-image/item138.png", description: "Fresh apple juice.", badge: "", rating: 4.3, spicy: false },
    { id: 139, name: "Jus Tembikai", category: "drinks-jus", price: 4.70, image: "../assets/images/menu-image/item139.png", description: "Fresh watermelon juice.", badge: "", rating: 4.5, spicy: false },
    { id: 140, name: "Jus Laici", category: "drinks-jus", price: 4.70, image: "../assets/images/menu-image/item140.png", description: "Fresh lychee juice.", badge: "", rating: 4.4, spicy: false },
    { id: 141, name: "Jus Lemon", category: "drinks-jus", price: 4.70, image: "../assets/images/menu-image/item141.png", description: "Fresh lemonade.", badge: "", rating: 4.2, spicy: false },

    // ── COLD DESSERTS ──
    { id: 142, name: "Cikong", category: "drinks-dessert", price: 6.00, image: "../assets/images/menu-image/item142.png", description: "Traditional shaved ice with syrup and toppings.", badge: "new", rating: 4.5, spicy: false },
    { id: 143, name: "Ais Jelly Limau", category: "drinks-dessert", price: 6.00, image: "../assets/images/menu-image/item143.png", description: "Iced lime jelly dessert.", badge: "", rating: 4.3, spicy: false },
    { id: 144, name: "Cendol", category: "drinks-dessert", price: 6.00, image: "../assets/images/menu-image/item144.png", description: "Shaved ice with green rice flour jelly, coconut milk, and palm sugar.", badge: "bestseller", rating: 4.9, spicy: false },
];

let activeCategory = 'all';
let searchQuery = '';

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
                <img src="${item.image}" alt="${item.name}" loading="lazy">
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
                    <button class="btn-view-detail" onclick="viewDetail(${item.id})">
                        <i class="fas fa-info-circle"></i> Details
                    </button>
                    <button class="btn-add-cart-sm" onclick="addToCartHandler(${item.id}, '${item.name}', ${item.price}, '${item.image}')">
                        <i class="fas fa-plus"></i> Add
                    </button>
                </div>
            </div>
        </div>
    `).join('');
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
function addToCartHandler(id, name, price, image) {
    const cart = JSON.parse(localStorage.getItem('restaurantCart') || '[]');

    // Convert relative image path to absolute URL so it works from any page depth
    // e.g. "../assets/images/menu-image/item1.png" (relative to pages/)
    // becomes "/webapppj/assets/images/menu-image/item1.png"
    const absoluteImage = image
        ? new URL(image, window.location.href).pathname
        : '';

    const existingItem = cart.find(item => item.id === id);
    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({ id, name, price, image: absoluteImage, quantity: 1 });
    }

    localStorage.setItem('restaurantCart', JSON.stringify(cart));
    updateCartBadge();
    updateFloatingCart();
    showToast(`${name} added to cart!`);

    const buttons = document.querySelectorAll('.btn-add-cart-sm');
    buttons.forEach(btn => {
        if (btn.getAttribute('onclick') && btn.getAttribute('onclick').includes(`(${id},`)) {
            btn.classList.add('added');
            btn.innerHTML = '<i class="fas fa-check"></i> Added';
            setTimeout(() => {
                btn.classList.remove('added');
                btn.innerHTML = '<i class="fas fa-plus"></i> Add';
            }, 1500);
        }
    });
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