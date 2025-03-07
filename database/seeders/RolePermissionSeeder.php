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
        // Assign permissions to roles
        $rolePermissions = [
            'admin' => array_merge(
                ['create-departement', 'edit-departement', 'delete-departement', 'view-departement'],
                ['create-emplois', 'edit-emplois', 'delete-emplois', 'view-emplois'],
                ['create-grades', 'edit-grades', 'delete-grades', 'view-grades'],
                ['create-contracts', 'edit-contracts', 'delete-contracts', 'view-contracts'],
                ['create-users', 'edit-users', 'delete-users', 'view-users'],
                ['create-carriere', 'edit-carriere', 'delete-carriere', 'view-carriere'],
                ['view-formations', 'create-formations', 'edit-formations', 'delete-formations']
            ),
            'rh' => [
                'create-contracts', 'edit-contracts', 'delete-contracts', 'view-contracts',
                'create-users', 'edit-users', 'delete-users', 'view-users',
                'create-carriere', 'edit-carriere', 'delete-carriere', 'view-carriere',
                'gestion-conge', 'rh-validate-conge', 'rh-reject-conge',
                'gestion-recuperation', 'validate-recuperation', 'reject-recuperation'
            ],
            'manager' => [
                'view-formations', 'create-formations', 'edit-formations', 'delete-formations',
                'view-conge', 'create-conge', 'view-solde-conge', 'gestion-conge',
                'manager-validate-conge', 'manager-reject-conge',
                'view-recuperation', 'create-recuperation'
            ],
            'employe' => [
                'view-conge', 'create-conge', 'view-solde-conge',
                'view-recuperation', 'create-recuperation'
            ]
        ];

        foreach ($rolePermissions as $role => $permissions) {
            $roleInstance = Role::findByName($role);
            if ($roleInstance) {
                $roleInstance->syncPermissions($permissions);
            }
        }
    }
}
