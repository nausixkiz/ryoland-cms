<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\LaravelIgnition\Recorders\DumpRecorder\Dump;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleAndPermissionSeeder::class,
            MenuSeeder::class,
            AdminSeeder::class,
            CategorySeeder::class,
            DumpDataSeeder::class,
        ]);
    }
}
