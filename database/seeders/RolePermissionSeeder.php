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
        // $departementPermissions = [
        //     'create-departement',
        //     'edit-departement',
        //     'delete-departement',
        //     'view-departement',
        // ];

        // $emploisPermissions = [
        //     'create-emplois',
        //     'edit-emplois',
        //     'delete-emplois',
        //     'view-emplois',
        // ];

        // $gradesPermissions = [
        //     'create-grades',
        //     'edit-grades',
        //     'delete-grades',
        //     'view-grades',
        // ];


        // $contractPermissions = [
        //     'create-contracts',
        //     'edit-contracts',
        //     'delete-contracts',
        //     'view-contracts',
        // ];

        // $usersPermissions = [
        //     'create-users',
        //     'edit-users',
        //     'delete-users',
        //     'view-users',
        // ];

        $carrierePermissions = [
            'create-carriere',
            'edit-carriere',
            'delete-carriere',
            'view-carriere',
        ];
        
        foreach ($carrierePermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $adminRole = Role::where('name', 'admin')->first();
        $rhRole = Role::where('name', 'RH')->first();
        // $managerRole = Role::where('name', 'manager')->first();

        if ($adminRole) {
            $adminRole->givePermissionTo($carrierePermissions);
        }

        if ($rhRole) {
            $rhRole->givePermissionTo($carrierePermissions);
        }

    }
}
