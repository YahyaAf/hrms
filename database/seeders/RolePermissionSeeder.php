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

        // $carrierePermissions = [
        //     'create-carriere',
        //     'edit-carriere',
        //     'delete-carriere',
        //     'view-carriere',
        // ];

        // $managerCongePermission = [
        //     'view-conge',
        //     'create-conge',
        //     'view-solde-conge',
        //     'gestion-conge',
        //     'manager-validate-conge',
        //     'manager-reject-conge'
        // ];

        // $employeCongePermission = [
        //     'view-conge',
        //     'create-conge',
        //     'view-solde-conge',
        // ];

        // $rhCongePermission = [
        //     'gestion-conge',
        //     'rh-validate-conge',
        //     'rh-reject-conge',
        // ];
        
        // foreach ($carrierePermissions as $permission) {
        //     Permission::firstOrCreate(['name' => $permission]);
        // }

        // // $adminRole = Role::where('name', 'admin')->first();
        // $rhRole = Role::where('name', 'RH')->first();
        // $managerRole = Role::where('name', 'manager')->first();
        // $managerRole = Role::where('name', 'employe')->first();

        // // if ($adminRole) {
        // //     $adminRole->givePermissionTo($carrierePermissions);
        // // }

        // // if ($rhRole) {
        // //     $rhRole->givePermissionTo($carrierePermissions);
        // // }


        $commonPermissions = [
            'view-conge',
            'create-conge',
            'view-solde-conge',
        ];

        $managerCongePermission = array_merge($commonPermissions, [
            'manager-validate-conge',
            'manager-reject-conge',
        ]);

        $employeCongePermission = $commonPermissions; 

        $rhCongePermission = [
            'rh-validate-conge',
            'rh-reject-conge',
        ];

        $gestionCongePermission = [
            'gestion-conge',  
        ];

        foreach (array_merge($managerCongePermission, $employeCongePermission, $rhCongePermission, $gestionCongePermission) as $permission) {
            $perm = Permission::firstOrCreate(['name' => $permission]);
            
        }
        

        $rhRole = Role::where('name', 'RH')->first();
        $managerRole = Role::where('name', 'manager')->first();
        $employeRole = Role::where('name', 'employe')->first();

        if ($rhRole) {
            $rhRole->givePermissionTo(array_merge($rhCongePermission, $gestionCongePermission));  
        }

        if ($managerRole) {
            $managerRole->givePermissionTo(array_merge($managerCongePermission, $gestionCongePermission));  
        }

        if ($employeRole) {
            $employeRole->givePermissionTo($employeCongePermission); 
        }


    }
}
