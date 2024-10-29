<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\RoleTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $superAdminRole = Role::create(['name' => 'super_admin']);
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // create translations for each role
        RoleTranslation::create([
            'role_id' => $superAdminRole->id,
            'locale' => 'en',
            'name' => 'Super Admin',
        ]);
        RoleTranslation::create([
            'role_id' => $superAdminRole->id,
            'locale' => 'ar',
            'name' => 'المشرف العام',
        ]);
        RoleTranslation::create([
            'role_id' => $adminRole->id,
            'locale' => 'en',
            'name' => 'Admin',
        ]);
        RoleTranslation::create([
            'role_id' => $adminRole->id,
            'locale' => 'ar',
            'name' => 'مدير',
        ]);
        RoleTranslation::create([
            'role_id' => $userRole->id,
            'locale' => 'en',
            'name' => 'User',
        ]);
        RoleTranslation::create([
            'role_id' => $userRole->id,
            'locale' => 'ar',
            'name' => 'مستخدم',
        ]);
    }
}
