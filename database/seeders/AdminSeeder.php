<?php

namespace Database\Seeders;

use App\Actions\Fortify\CreateNewUser;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Super Administrator',
            'username' => 'super.admin',
            'email' => 'superadmin@ryoland.com',
            'password' => Hash::make('123456789'),
            'phone' => '0963639070',
            'address' => 'Hà Nội',
        ]);
        $user->assignRole('Super Administrator');
        CreateNewUser::createTeam($user);

        $admin = User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@ryoland.com',
            'password' => Hash::make('123456789'),
            'phone' => '0963639999',
            'address' => 'Hà Nội',
        ]);
        $admin->assignRole('Administrator');
        CreateNewUser::createTeam($admin);

        $dealer = User::create([
            'name' => 'Authorized Dealer',
            'username' => 'Authorized Dealer',
            'email' => 'authorizeddealer@ryoland.com',
            'password' => Hash::make('123456789'),
            'phone' => '0963638888',
            'address' => 'Hà Nội',
        ]);
        $dealer->assignRole('Authorized Dealer');
        CreateNewUser::createTeam($dealer);
    }
}
