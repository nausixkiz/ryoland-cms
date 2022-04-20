<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    protected array $menu = [];

    public function __construct()
    {
        $this->menu = [
            [
                'name' => 'Dashboard',
                'parent_id' => null,
                'route_name' => 'dashboard',
                'icon' => 'home',
                'slug' => Str::slug('Dashboard'),
                'badge' => null,
                'badgeClass' => null
            ],
        ];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::truncate();
        // Create menu
        Menu::create($this->menu[0]);
    }
}
