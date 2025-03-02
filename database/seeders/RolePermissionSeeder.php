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
    public function run()
    {
        // // Define permissions
        // $permissions = [
        //     'create departement',
        //     'edit departement',
        //     'delete departement',
        //     'view departement',
        // ];

        // Create permissions if they don't exist
        // foreach ($permissions as $permission) {
        //     Permission::firstOrCreate(['name' => $permission]);
        // }

        // Create roles
        $roles = ['RH', 'manager', 'employe'];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        // // Assign all permissions to admin
        // $adminRole = Role::where('name', 'admin')->first();
        // if ($adminRole) {
        //     $adminRole->syncPermissions($permissions);
        // }

        // // Assign admin role to the first user (optional)
        // $user = \App\Models\User::first();
        // if ($user) {
        //     $user->assignRole('admin');
        // }
    }
}
