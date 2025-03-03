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
        $departementPermissions = [
            'create-departement',
            'edit-departement',
            'delete-departement',
            'view-departement',
        ];

        $emploisPermissions = [
            'create-emplois',
            'edit-emplois',
            'delete-emplois',
            'view-emplois',
        ];

        foreach (array_merge($emploisPermissions) as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
        $adminRole = Role::firstOrCreate(['name' => 'admin']); 
        $adminRole->givePermissionTo($departementPermissions);
        $adminRole->givePermissionTo($emploisPermissions);
    }
}
