<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Inspiration & Style',
            'description' => 'Inspiration & Style',
            'icon' => 'fa-regular fa-bars',
            'status' => 'published',
//            'user_id' => 1000000000,
        ]);
        Category::create([
            'name' => 'Buying & Selling Guides',
            'description' => 'Buying & Selling Guides',
            'icon' => 'fa-regular fa-bars',
            'status' => 'published',
//            'user_id' => 1000000000,
        ]);
        Category::create([
            'name' => 'Leasing Guides',
            'description' => 'Leasing Guides',
            'icon' => 'fa-regular fa-bars',
            'status' => 'published',
//            'user_id' => 1000000000,
        ]);
        Category::create([
            'name' => 'Small Business Guides',
            'description' => 'Small Business Guides',
            'icon' => 'fa-regular fa-bars',
            'status' => 'published',
//            'user_id' => 1000000000,
        ]);
    }
}
