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
            'status' => 'published',
        ]);
        Category::create([
            'name' => 'Buying & Selling Guides',
            'description' => 'Buying & Selling Guides',
            'status' => 'published',
        ]);
        Category::create([
            'name' => 'Leasing Guides',
            'description' => 'Leasing Guides',
            'status' => 'published',
        ]);
        Category::create([
            'name' => 'Small Business Guides',
            'description' => 'Small Business Guides',
            'status' => 'published',
        ]);
    }
}
