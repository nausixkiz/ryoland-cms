<?php

namespace Database\Seeders\RealEstate;

use App\Models\RealEstate\Investor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvestorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Investor::create([
            'name' => 'National Pension Service',
        ]);

        Investor::create([
            'name' => '	Generali',
        ]);

        Investor::create([
            'name' => 'Temasek',
        ]);

        Investor::create([
            'name' => 'China Investment Corporation',
        ]);

        Investor::create([
            'name' => 'Government Pension Fund Global',
        ]);

        Investor::create([
            'name' => 'PSP Investments',
        ]);

        Investor::create([
            'name' => 'MEAG Munich ERGO',
        ]);

        Investor::create([
            'name' => '	HOOPP',
        ]);

        Investor::create([
            'name' => '	BT Group',
        ]);

        Investor::create([
            'name' => '	Ping An',
        ]);
    }
}
