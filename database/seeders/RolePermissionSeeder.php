<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [

            // Dashboard
            'dashboard.view',

            // Categories
            'category.view',
            'category.create',
            'category.edit',
            'category.delete',

            // Products
            'product.view',
            'product.create',
            'product.edit',
            'product.delete',

            // Orders
            'order.view',
            'order.update',
            'order.delete',

            // Users
            'user.view',
            'user.edit',
            'user.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web'
            ]);
        }

        $admin = Role::firstOrCreate([
            'name' => 'Admin',
            'guard_name' => 'web'
        ]);

        $customer = Role::firstOrCreate([
            'name' => 'Customer',
            'guard_name' => 'web'
        ]);

        $admin->givePermissionTo(Permission::all());
    }
}