<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create System Role
        Role::create(['name' => 'Super Administrator']);
        Role::create(['name' => 'Administrator']);
        Role::create(['name' => 'Moderator']);
        Role::create(['name' => 'Investor']);
        Role::create(['name' => 'Consultant']);
        Role::create(['name' => 'Authorized Dealer']);
        Role::create(['name' => 'Member']);
    }
}
