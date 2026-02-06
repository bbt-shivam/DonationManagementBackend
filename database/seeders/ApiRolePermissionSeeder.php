<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ApiRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            'access-roles',
            'create-role',
            'edit-role',
            'delete-role',
            'access-permission',
            'create-permission',
            'edit-permmission',
            'delete-permission',

            'access-members',
            'create-member',
            'edit-member',
            'partial-edit-member',
            'delete-member',
            'list-deleted-member',
            'restore-deleted-member',
            'list-member',

            'access-settings',
            'edit-setting-contact-details',
            'edit-setting-copyright-text',
            'edit-logo',
            'edit-setting-social-links',
            'edit-setting-maintenance',

            'access-users',
            'create-user',
            'edit-user',
            'list-user',
            'delete-user',

            'access-donation-purposes',
            'create-donation-purpose',
            'edit-donation-purpose',
            'list-donation-purpose',
            'delete-donation-purpose',

            'access-quick-qr',
            'list-quick-qr',
            'create-quick-qr',
            'print-quick-qr',
            'delete-quick-qr',

            'access-reports',
            'daily-report-pdf',
            'daily-report-excel',
            'range-report-pdf',
            'range-report-excel',
            'pending-report-pdf',
            'pending-report-excel',
            'state-report-pdf',
            'state-report-excel',
            'member-report-pdf',
            'member-report-excel',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission, 'guard_name' => 'sanctum']
            );
        }

        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'sanctum']);
        $officeAdminRole = Role::firstOrCreate(['name' => 'office-admin', 'guard_name' => 'sanctum']);
        $operatorRole = Role::firstOrCreate(['name' => 'operator', 'guard_name' => 'sanctum']);

        $adminRole->givePermissionTo(Permission::all());
        $officeAdminRole->givePermissionTo(Permission::all());
        $operatorRole->givePermissionTo('partial-edit-member');
    }
}
