<?php

namespace Database\Seeders\RealEstate;

use App\Models\RealEstate\Feature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeaturedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['Spa & Massage'],
            ['Pets Allow'],
            ['Laundry Room'],
            ['Central Heating'],
            ['Air Conditioning'],
            ['Fitness center'],
            ['Security'],
            ['Garden'],
            ['Balcony'],
            ['Swimming pool']
        ];

        foreach ($data as $item) {
            Feature::create([
                'name' => $item[0]
            ]);
        }
    }
}
