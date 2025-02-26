<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $permissions = [
            'create departement',
            'edit departement',
            'delete departement',
            'view departement',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        
        $adminRole = Role::firstOrCreate(['name' => 'admin']);


        $adminRole->syncPermissions($permissions);

        $user = \App\Models\User::first();
        if ($user) {
            $user->assignRole('admin');
        }
    }
}
