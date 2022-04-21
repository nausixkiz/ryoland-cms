<?php

namespace Database\Seeders\RealEstate;

use App\Models\RealEstate\Category;
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
        $data = [
            ['Apartment', 'Apartment'],
            ['Villa', 'Villa'],
            ['Condo', 'Condo'],
            ['House', 'House'],
            ['Land', 'Land'],
            ['Commercial property', 'Commercial property'],
        ];

        foreach ($data as $item){
            Category::create([
                'name' => $item[0],
                'description' => $item[1],
            ]);
        }
    }
}
