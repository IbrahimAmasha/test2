<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use App\Models\PermissionTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'view_profile',
            'edit_profile',
            'view_users',
            'edit_users',
            'delete_users',
            'manage_roles',
            'manage_permissions',
        ];
        
        $translations = [
            'ar' => [
                'view_profile' => 'عرض الملف الشخصي',
                'edit_profile' => 'تعديل الملف الشخصي',
                'view_users' => 'عرض المستخدمين',
                'edit_users' => 'تعديل المستخدمين',
                'delete_users' => 'حذف المستخدمين',
                'manage_roles' => 'إدارة الأدوار',
                'manage_permissions' => 'إدارة الأذونات',
            ],
            'en' => [
                'view_profile' => 'View Profile',
                'edit_profile' => 'Edit Profile',
                'view_users' => 'View Users',
                'edit_users' => 'Edit Users',
                'delete_users' => 'Delete Users',
                'manage_roles' => 'Manage Roles',
                'manage_permissions' => 'Manage Permissions',
            ],
        ];

        foreach ($permissions as $permission) {
            $perm = Permission::create(['name' => $permission]);

            foreach ($translations as $locale => $names) {
                PermissionTranslation::create([
                    'permission_id' => $perm->id,
                    'locale' => $locale,
                    'name' => $names[$permission],
                ]);
            }
        }
    }
}
