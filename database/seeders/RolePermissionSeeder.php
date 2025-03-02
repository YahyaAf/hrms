<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Define permissions for department management
        $permissions = [
            'create-departement',
            'edit-departement',
            'delete-departement',
            'view-departement',
        ];

        // Create permissions if they don't exist
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign all department permissions to admin
        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole) {
            $adminRole->syncPermissions($permissions);
        }
    }
}
