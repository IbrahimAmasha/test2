<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionAssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::where('name', 'super_admin')->first();
        $admin = Role::where('name', 'admin')->first();
        $user = Role::where('name', 'user')->first();

        // asssign all permissions to super admin
        $allPermissions = Permission::all();
        $superAdmin->permissions()->attach($allPermissions);


        // assign less permissions to admin
        $adminPermissions = Permission::whereIn('name', [
            'view_profile',
            'edit_profile',
            'view_users',
            'edit_users',
            'delete_users',
        ])->get();

        $admin->permissions()->attach($adminPermissions);


        // assign permissions to user only related to their profile
        $userPermissions = Permission::whereIn('name', [
            'view_profile',
            'edit_profile',
        ])->get();

        $user->permissions()->attach($userPermissions);
    }
}
