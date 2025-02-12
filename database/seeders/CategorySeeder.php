<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Category::create(['category_name' => 'Electronics']);
        Category::create(['category_name' => 'Clothing']);
        Category::create(['category_name' => 'Home & Kitchen']);
        Category::create(['category_name' => 'Beauty & Health']);
        Category::create(['category_name' => 'Sports & Outdoors']);
    }
}