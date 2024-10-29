<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'super@admin.com',
            'phone' => '01029524081',
            'role_id' => 1, // super admin's role = 1
            'password' => bcrypt('password'), 
        ]);
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'phone' => '01029524082',
            'role_id' => 2, //  admin's role = 2
            'password' => bcrypt('password'), 
        ]);
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'user@user.com',
            'phone' => '01029524083',
            'role_id' => 3, // user's role = 3
            'password' => bcrypt('password'), 
        ]);


    }
}
