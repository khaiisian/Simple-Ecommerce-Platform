<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Item::create([
            'item_name' => 'Apple iPhone 14 Pro Max 256GB',
            'item_desc' => 'Latest iPhone with A16 chip, 256GB storage.',
            'item_price' => '2199000',
            'image' => 'iphone14_pro_max.png',
            'stock' => 50,
            'category_id' => 1,
        ]);

        Item::create([
            'item_name' => 'Dell XPS 13 Laptop',
            'item_desc' => 'Premium ultrabook with Intel i7, 16GB RAM.',
            'item_price' => '2290000',
            'image' => 'dell_xps_13.png',
            'stock' => 30,
            'category_id' => 1,
        ]);

        Item::create([
            'item_name' => 'Samsung Galaxy S22 Ultra 128GB',
            'item_desc' => 'Android flagship phone with Snapdragon 8 Gen 1.',
            'item_price' => '1599000',
            'image' => 'samsung_galaxy_s22.png',
            'stock' => 70,
            'category_id' => 1,
        ]);

        Item::create([
            'item_name' => 'Asus ROG Strix Gaming Laptop',
            'item_desc' => 'Gaming laptop with RTX 3060, 16GB RAM, and 512GB SSD.',
            'item_price' => '1850000',
            'image' => 'asus_rog_strix.png',
            'stock' => 20,
            'category_id' => 1,
        ]);

        Item::create([
            'item_name' => 'Men’s Wool Winter Jacket',
            'item_desc' => 'Stylish wool jacket with a cozy hood.',
            'item_price' => '199000',
            'image' => 'wool_jacket_men.png',
            'stock' => 100,
            'category_id' => 2,
        ]);

        Item::create([
            'item_name' => 'Nike Air Zoom Running Shoes',
            'item_desc' => 'Comfortable running shoes, size 9.',
            'item_price' => '159000',
            'image' => 'nike_air_zoom_pegasus.png',
            'stock' => 120,
            'category_id' => 2,
        ]);

        Item::create([
            'item_name' => 'Breville Espresso Machine',
            'item_desc' => 'Automatic espresso machine with milk frother.',
            'item_price' => '299000',
            'image' => 'breville_espresso_machine.png',
            'stock' => 40,
            'category_id' => 3,
        ]);

        Item::create([
            'item_name' => 'Dyson V11 Cordless Vacuum',
            'item_desc' => 'Powerful cordless vacuum for deep cleaning.',
            'item_price' => '450000',
            'image' => 'dyson_v11_vacuum.png',
            'stock' => 50,
            'category_id' => 3,
        ]);

        Item::create([
            'item_name' => 'Canon EOS R5 Camera',
            'item_desc' => 'Mirrorless digital camera with 45MP sensor and 8K video.',
            'item_price' => '3499000',
            'image' => 'canon_eos_r5.png',
            'stock' => 15,
            'category_id' => 4,
        ]);

        Item::create([
            'item_name' => 'GoPro HERO10 Black',
            'item_desc' => 'Action camera with 5.3K video and HyperSmooth stabilization.',
            'item_price' => '350000',
            'image' => 'gopro_hero10.png',
            'stock' => 40,
            'category_id' => 4,
        ]);

        Item::create([
            'item_name' => 'Sony 55-inch 4K LED TV',
            'item_desc' => 'Smart TV with HDR and Android TV.',
            'item_price' => '899000',
            'image' => 'sony_55_inch_tv.png',
            'stock' => 25,
            'category_id' => 4,
        ]);

        Item::create([
            'item_name' => 'Nintendo Switch OLED',
            'item_desc' => 'Portable gaming console with a 7-inch OLED display.',
            'item_price' => '500000',
            'image' => 'nintendo_switch_oled.png',
            'stock' => 60,
            'category_id' => 5,
        ]);
    }
}