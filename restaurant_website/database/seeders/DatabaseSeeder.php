<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Users ──────────────────────────────────────────────────────────
        DB::table('users')->insertOrIgnore([
            [
                'full_name'  => 'Admin Restoran ZZ',
                'email'      => 'admin@suptulangzz.com',
                'phone'      => '012-3456789',
                'password'   => Hash::make('password123'),
                'role'       => 'admin',
                'address'    => 'Jalan Example, Taman Melaka Raya, 75000 Melaka',
                'is_active'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name'  => 'Ahmad Farid',
                'email'      => 'ahmad@example.com',
                'phone'      => '011-2345678',
                'password'   => Hash::make('password123'),
                'role'       => 'customer',
                'address'    => 'No 12, Jalan Puteri, 75350 Melaka',
                'is_active'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name'  => 'Siti Aisyah',
                'email'      => 'siti@example.com',
                'phone'      => '013-9876543',
                'password'   => Hash::make('password123'),
                'role'       => 'customer',
                'address'    => 'Apartment Harmoni, Blok B-12, 75450 Melaka',
                'is_active'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // ── Menu Items ─────────────────────────────────────────────────────
        $items = [
            // Sup ZZ
            ['Sup Gearbox Kambing', 'Signature goat gearbox bone soup, slow-cooked in rich spiced broth.', 19.00, 'soup'],
            ['Sup Kambing', 'Tender mutton soup slow-cooked with aromatic herbs and spices.', 20.00, 'soup'],
            ['Sup Daging', 'Beef bone soup cooked with traditional spices.', 8.00, 'soup'],
            ['Sup Ayam', 'Hearty chicken soup with herbs.', 7.00, 'soup'],
            // Mee Rebus ZZ
            ['Mee Rebus Gearbox Kambing', 'Noodles in thick gravy with goat gearbox bone.', 20.00, 'main'],
            ['Mee Rebus Daging', 'Noodles in thick spiced gravy with beef.', 9.50, 'main'],
            ['Mee Rebus Ayam', 'Noodles in thick gravy with chicken.', 9.00, 'main'],
            // Sarapan Panas
            ['Lontong Kuah', 'Rice cakes in coconut vegetable curry.', 7.50, 'main'],
            ['Lontong Kering (Ayam)', 'Dry-style lontong with chicken rendang.', 9.00, 'main'],
            ['Lontong Kering (Daging)', 'Dry-style lontong with beef rendang.', 9.50, 'main'],
            ['Nasi Lemak Basmathi (Telur)', 'Fragrant basmathi coconut rice with egg.', 6.00, 'main'],
            ['Nasi Lemak Basmathi (Ayam)', 'Fragrant basmathi coconut rice with fried chicken.', 9.00, 'main'],
            ['Nasi Lemak Rendang (Ayam)', 'Coconut rice with chicken rendang.', 8.50, 'main'],
            ['Nasi Lemak Rendang (Daging)', 'Coconut rice with beef rendang.', 9.50, 'main'],
            ['Nasi Ayam Basmathi', 'Basmathi rice served with chicken.', 12.00, 'main'],
            ['Nasi Ambang', 'Traditional communal rice dish with assorted sides.', 9.50, 'main'],
            ['Bubur Nasi', 'Smooth rice porridge.', 7.50, 'main'],
            ['Bubur Ayam', 'Chicken rice porridge with condiments.', 7.00, 'main'],
            ['Laksa Johor', 'Johor-style laksa noodles.', 8.00, 'main'],
            ['Laksa Penang', 'Penang-style sour fish laksa.', 7.50, 'main'],
            ['Bakso (Mee/Mee Hoon/Nasi)', 'Indonesian-style meatball soup with choice of noodles or rice.', 7.50, 'main'],
            ['Soto (Mee/Mee Hoon/Nasi)', 'Traditional soto soup with choice of noodles or rice.', 8.00, 'main'],
            // Roti
            ['Roti Bakar', 'Classic toasted bread.', 2.50, 'snacks'],
            ['Roti Kaya', 'Toasted bread with rich kaya (coconut egg jam).', 3.50, 'snacks'],
            ['Roti Garlic', 'Toasted garlic bread.', 3.50, 'snacks'],
            ['Roti Canai Kosong', 'Plain crispy flatbread served with dhal/curry.', 1.50, 'snacks'],
            ['Roti Canai Kosong Bawang', 'Flatbread with onion.', 2.00, 'snacks'],
            ['Roti Tampal', 'Flatbread with egg patched on top.', 2.80, 'snacks'],
            ['Roti Telur', 'Flatbread with egg inside.', 2.80, 'snacks'],
            ['Roti Telur Bawang', 'Flatbread with egg and onion.', 3.50, 'snacks'],
            ['Roti Telur Double Jantan', 'Double-egg flatbread.', 5.50, 'snacks'],
            ['Roti Pisang', 'Banana flatbread.', 4.50, 'snacks'],
            ['Roti Sardin', 'Sardine-filled flatbread.', 6.00, 'snacks'],
            ['Roti Bom', 'Thick fluffy flatbread.', 2.50, 'snacks'],
            ['Roti Planta', 'Flatbread with Planta margarine.', 3.00, 'snacks'],
            ['Roti Sarang Burung Daging', 'Bird nest-style flatbread with minced meat.', 8.00, 'snacks'],
            // Set Nasi
            ['Nasi Bawal Goreng Berlado', 'Fried pomfret with chili sambal, served with rice.', 9.00, 'main'],
            ['Nasi Siakap Goreng Berlado', 'Fried sea bass with chili sambal, served with rice.', 15.00, 'main'],
            ['Nasi Keli Goreng Berlado', 'Fried catfish with chili sambal, served with rice.', 10.90, 'main'],
            ['Nasi Ayam Goreng Berlado', 'Fried chicken with chili sambal, served with rice.', 8.50, 'main'],
            // Ikan
            ['Ikan Siakap Tiga Rasa', 'Sea bass in three-flavour sauce.', 37.50, 'main'],
            ['Ikan Siakap Masam Manis', 'Sea bass in sweet and sour sauce.', 37.50, 'main'],
            ['Ikan Siakap Steam Lemon', 'Steamed sea bass with lemon sauce.', 37.50, 'main'],
            ['Ikan Siakap Laprik', 'Sea bass in spicy sambal sauce.', 37.50, 'main'],
            ['Ikan Siakap Goreng Kunyit', 'Turmeric-fried sea bass.', 37.50, 'main'],
            ['Siakap Bakar', 'Grilled sea bass.', 37.50, 'main'],
            ['Caru Bakar', 'Grilled caru fish.', 11.50, 'main'],
            ['Kerang Bakar', 'Grilled cockles.', 15.00, 'main'],
            ['Sotong Bakar', 'Grilled squid.', 15.00, 'main'],
            // Nasi Goreng
            ['Nasi Goreng Biasa', 'Classic fried rice.', 7.50, 'main'],
            ['Nasi Goreng Kampung', 'Village-style fried rice with anchovies.', 8.00, 'main'],
            ['Nasi Goreng Cina', 'Chinese-style fried rice.', 7.50, 'main'],
            ['Nasi Goreng Ikan Masin', 'Salted fish fried rice.', 8.50, 'main'],
            ['Nasi Goreng Cili Padi', 'Bird-eye chili fried rice.', 8.50, 'main'],
            ['Nasi Goreng Pattaya', 'Pattaya-style omelette-wrapped fried rice.', 8.50, 'main'],
            ['Nasi Goreng Tom Yam', 'Tom yam flavoured fried rice.', 9.00, 'main'],
            ['Nasi Goreng Belacan', 'Shrimp paste fried rice.', 12.00, 'main'],
            // Mee Goreng
            ['Mee Goreng', 'Classic stir-fried yellow noodles.', 7.50, 'main'],
            ['Mee Hoon Goreng Singapore', 'Singapore-style stir-fried rice vermicelli.', 7.50, 'main'],
            ['Char Kuey Teow', 'Wok-fried flat rice noodles.', 8.00, 'main'],
            // Sayur
            ['Kailan (Biasa)', 'Stir-fried kailan vegetables.', 7.00, 'main'],
            ['Kailan (Ikan Masin)', 'Stir-fried kailan with salted fish.', 7.00, 'main'],
            ['Kangkung (Biasa)', 'Stir-fried water spinach.', 7.00, 'main'],
            ['Kangkung Belacan', 'Stir-fried water spinach with shrimp paste.', 7.00, 'main'],
            ['Taugeh (Biasa)', 'Stir-fried bean sprouts.', 7.00, 'main'],
            ['Sawi (Biasa)', 'Stir-fried mustard greens.', 7.00, 'main'],
            ['Cendawan Goreng Biasa', 'Stir-fried mushrooms.', 7.00, 'main'],
            // Lauk Thai
            ['Ayam Black Pepper', 'Black pepper chicken.', 7.50, 'main'],
            ['Daging Black Pepper', 'Black pepper beef.', 8.50, 'main'],
            ['Sotong Black Pepper', 'Black pepper squid.', 9.50, 'main'],
            ['Ayam Sambal', 'Sambal chicken.', 7.50, 'main'],
            ['Daging Sambal', 'Sambal beef.', 8.50, 'main'],
            ['Sotong Sambal', 'Sambal squid.', 9.50, 'main'],
            ['Ayam Merah', 'Red sauce chicken.', 7.50, 'main'],
            ['Daging Merah', 'Red sauce beef.', 8.50, 'main'],
            ['Sotong Merah', 'Red sauce squid.', 9.50, 'main'],
            ['Ayam Paprik', 'Thai paprik-style chicken.', 7.50, 'main'],
            ['Daging Paprik', 'Thai paprik-style beef.', 8.50, 'main'],
            ['Sotong Paprik', 'Thai paprik-style squid.', 9.50, 'main'],
            ['Ayam Phad Khra Phao', 'Thai basil chicken stir-fry.', 8.00, 'main'],
            ['Daging Phad Khra Phao', 'Thai basil beef stir-fry.', 9.00, 'main'],
            ['Ayam Kunyit', 'Turmeric chicken.', 7.50, 'main'],
            ['Daging Kunyit', 'Turmeric beef.', 9.50, 'main'],
            ['Sotong Kunyit', 'Turmeric squid.', 9.50, 'main'],
            ['Udang Kunyit', 'Turmeric prawns.', 9.50, 'main'],
            // Goreng Tepung
            ['Ayam Goreng Tepung', 'Crispy battered fried chicken.', 10.00, 'snacks'],
            // Mee Kuah
            ['Mee Kuah Bandung', 'Bandung-style noodle soup.', 10.50, 'main'],
            ['Mee Kuah Hong Kong', 'Hong Kong-style noodle soup.', 10.50, 'main'],
            ['Mee Kuah Hailam', 'Hainanese-style noodle soup.', 10.50, 'main'],
            ['Mee Kuah Kung Fu', 'Kung Fu-style noodle soup.', 10.50, 'main'],
            // Sup & Tom Yam Ala Thai
            ['Sup Ayam Ala Thai', 'Thai-style chicken soup.', 8.00, 'soup'],
            ['Sup Daging Ala Thai', 'Thai-style beef soup.', 9.00, 'soup'],
            ['Tom Yam Ayam', 'Spicy sour chicken tom yam.', 8.00, 'soup'],
            ['Tom Yam Daging', 'Spicy sour beef tom yam.', 9.00, 'soup'],
            ['Tom Yam Ayam + Daging', 'Mixed chicken and beef tom yam.', 12.00, 'soup'],
            ['Tom Yam Seafood', 'Seafood tom yam with prawns, squid, and fish.', 13.00, 'soup'],
            ['Tom Yam Campur', 'Mixed tom yam.', 13.00, 'soup'],
            ['Tom Yam Sayur', 'Vegetable tom yam.', 8.00, 'soup'],
            ['Tom Yam Cendawan', 'Mushroom tom yam.', 8.00, 'soup'],
            // Western
            ['Chicken Chop Fried', 'Fried chicken chop with mushroom sauce and fries.', 18.50, 'main'],
            ['Chicken Chop Grill', 'Grilled chicken chop with mushroom sauce and fries.', 18.50, 'main'],
            ['Fish N Chips', 'Crispy battered fish with fries and coleslaw.', 16.50, 'main'],
            ['Lamb Chop', 'Grilled lamb chop with sauce and sides.', 30.90, 'main'],
            ['Spaghetti Aglio Olio (Seafood)', 'Garlic olive oil spaghetti with seafood.', 17.00, 'main'],
            ['Spaghetti Aglio Olio (Beef Bacon)', 'Garlic olive oil spaghetti with beef bacon.', 15.00, 'main'],
            ['Spaghetti Aglio Olio (Chicken)', 'Garlic olive oil spaghetti with chicken.', 13.00, 'main'],
            ['Spaghetti Carbonara (Seafood)', 'Creamy carbonara with seafood.', 18.00, 'main'],
            ['Spaghetti Carbonara (Beef Bacon)', 'Creamy carbonara with beef bacon.', 16.00, 'main'],
            ['Spaghetti Carbonara (Chicken)', 'Creamy carbonara with chicken.', 14.00, 'main'],
            ['Spaghetti Bolognese', 'Classic meat sauce spaghetti.', 15.00, 'main'],
            ['Mac & Cheese', 'Creamy macaroni and cheese.', 10.00, 'main'],
            ['Smash Beef Burger Single', 'Single smash beef patty burger.', 8.00, 'main'],
            ['Smash Beef Burger Double', 'Double smash beef patty burger.', 10.00, 'main'],
            ['Crispy Chicken Burger', 'Crispy fried chicken burger.', 7.50, 'main'],
            ['Fries', 'Crispy seasoned fries.', 7.50, 'snacks'],
            ['Nugget 8pcs', 'Crispy chicken nuggets (8 pieces).', 8.00, 'snacks'],
            ['Cheesy Wedges', 'Potato wedges with cheese sauce.', 8.50, 'snacks'],
            // Drinks
            ['Teh O', 'Plain black tea.', 2.50, 'drinks'],
            ['Teh Tarik', 'Malaysian pulled milk tea, hot.', 2.50, 'drinks'],
            ['Teh Halia', 'Ginger tea with milk.', 3.50, 'drinks'],
            ['Teh Sarbat', 'Spiced herbal tea.', 3.50, 'drinks'],
            ['Sirap', 'Rose syrup drink.', 2.00, 'drinks'],
            ['Sirap Selasih', 'Rose syrup with basil seeds.', 2.50, 'drinks'],
            ['Sirap Limau', 'Lime rose syrup drink.', 2.70, 'drinks'],
            ['Sirap Laici', 'Lychee syrup drink.', 5.00, 'drinks'],
            ['Sirap Bandung', 'Rose milk syrup drink.', 3.50, 'drinks'],
            ['Sirap Bandung Cincau', 'Rose milk with grass jelly.', 4.00, 'drinks'],
            ['Sirap Bandung Soda', 'Sparkling rose milk drink.', 4.00, 'drinks'],
            ['Limau', 'Fresh lime juice.', 2.70, 'drinks'],
            ['Asam Boy', 'Sour plum lime drink.', 2.70, 'drinks'],
            ['Extra Joss Susu (Anggur/Mangga)', 'Energy drink with milk - grape or mango.', 4.00, 'drinks'],
            ['Vico', 'Chocolate malt drink.', 3.00, 'drinks'],
            ['Indo Cafe O', 'Indonesian black coffee.', 3.00, 'drinks'],
            ['Indo Cafe Susu', 'Indonesian coffee with milk.', 3.50, 'drinks'],
            ['Kopi Tenggek', 'Strong traditional Malaysian coffee.', 3.50, 'drinks'],
            ['Kopi Special', 'House special coffee blend.', 4.00, 'drinks'],
            ['Jus Oren', 'Fresh orange juice.', 4.70, 'drinks'],
            ['Jus Epal', 'Fresh apple juice.', 4.70, 'drinks'],
            ['Jus Tembikai', 'Fresh watermelon juice.', 4.70, 'drinks'],
            ['Jus Laici', 'Fresh lychee juice.', 4.70, 'drinks'],
            ['Jus Lemon', 'Fresh lemonade.', 4.70, 'drinks'],
            // Dessert
            ['Cikong', 'Traditional shaved ice with syrup and toppings.', 6.00, 'dessert'],
            ['Ais Jelly Limau', 'Iced lime jelly dessert.', 6.00, 'dessert'],
            ['Cendol', 'Shaved ice with green rice flour jelly, coconut milk, and palm sugar.', 6.00, 'dessert'],
        ];

        foreach ($items as [$name, $description, $price, $category]) {
            DB::table('menu_items')->insertOrIgnore([
                'name'         => $name,
                'description'  => $description,
                'price'        => $price,
                'category'     => $category,
                'is_available' => true,
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }

        // ── Sample Orders ──────────────────────────────────────────────────
        $ahmad = DB::table('users')->where('email', 'ahmad@example.com')->value('id');
        $siti  = DB::table('users')->where('email', 'siti@example.com')->value('id');

        if ($ahmad && !DB::table('orders')->where('user_id', $ahmad)->exists()) {
            $order1 = DB::table('orders')->insertGetId([
                'user_id'        => $ahmad,
                'customer_name'  => 'Ahmad Farid',
                'customer_phone' => '011-2345678',
                'order_type'     => 'dine-in',
                'table_number'   => 5,
                'pax'            => 2,
                'payment_method' => 'cash',
                'subtotal'       => 36.00,
                'tax'            => 2.16,
                'delivery_fee'   => 0.00,
                'total'          => 38.16,
                'status'         => 'completed',
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);

            foreach (['Sup Gearbox Kambing', 'Nasi Goreng Kampung', 'Teh Tarik'] as $itemName) {
                $item = DB::table('menu_items')->where('name', $itemName)->first();
                if ($item) {
                    DB::table('order_items')->insert([
                        'order_id'     => $order1,
                        'menu_item_id' => $item->id,
                        'item_name'    => $item->name,
                        'unit_price'   => $item->price,
                        'quantity'     => 1,
                        'line_total'   => $item->price,
                    ]);
                }
            }
        }

        if ($siti && !DB::table('orders')->where('user_id', $siti)->exists()) {
            $order2 = DB::table('orders')->insertGetId([
                'user_id'          => $siti,
                'customer_name'    => 'Siti Aisyah',
                'customer_phone'   => '013-9876543',
                'order_type'       => 'delivery',
                'delivery_address' => 'Apartment Harmoni, Blok B-12, 75450 Melaka',
                'payment_method'   => 'online_transfer',
                'subtotal'         => 35.50,
                'tax'              => 2.13,
                'delivery_fee'     => 3.00,
                'total'            => 40.63,
                'status'           => 'preparing',
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);

            foreach (['Tom Yam Seafood', 'Chicken Chop Grill'] as $itemName) {
                $item = DB::table('menu_items')->where('name', $itemName)->first();
                if ($item) {
                    DB::table('order_items')->insert([
                        'order_id'     => $order2,
                        'menu_item_id' => $item->id,
                        'item_name'    => $item->name,
                        'unit_price'   => $item->price,
                        'quantity'     => 1,
                        'line_total'   => $item->price,
                    ]);
                }
            }

            $juice = DB::table('menu_items')->where('name', 'Jus Tembikai')->first();
            if ($juice) {
                DB::table('order_items')->insert([
                    'order_id'     => $order2,
                    'menu_item_id' => $juice->id,
                    'item_name'    => $juice->name,
                    'unit_price'   => $juice->price,
                    'quantity'     => 2,
                    'line_total'   => $juice->price * 2,
                ]);
            }
        }

        // ── Tables (dine-in) ───────────────────────────────────────────────
        for ($i = 1; $i <= 10; $i++) {
            DB::table('tables')->insertOrIgnore([
                'table_number' => $i,
                'capacity'     => 4,
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
    }
}
