<?php

namespace Database\Seeders\RealEstate;

use App\Models\RealEstate\Facility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['Bank', 'fas fa-university'],
            ['Mall', 'fas fa-cart-plus'],
            ['Beach', 'fas fa-umbrella-beach'],
            ['Bus Stop', 'fas fa-bus'],
            ['Railways', 'fas fa-subway'],
            ['Airport', 'fas fa-plane-departure'],
            ['Pharmacy', 'fas fa-prescription-bottle-alt'],
            ['Entertainment', 'fas fa-hotel'],
            ['School', 'fas fa-school'],
            ['Super Market', 'fas fa-cart-plus'],
        ];

        foreach ($data as $item) {
            Facility::create([
                'name' => $item[0],
                'icon' => $item[1],
            ]);
        }
    }
}
