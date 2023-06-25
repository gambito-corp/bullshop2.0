<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $permissions = [
            'ver usuarios',
            'crear usuario',
            'leer usuario',
            'editar usuario',
            'actualizar usuario',
            'eliminar usuario',
            'borrar usuario',
            'desactivar usuario',
            'impersonar usuario',
            'recuperarImpersonation',
            'ver cliente',
            'leer clientes',
            'crear cliente',
            'editar cliente',
            'borrar cliente',
            'eliminar cliente',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // create roles and assign existing permissions
        $superAdmin = Role::create(['name' => 'SuperAdmin']);
        $userRole = Role::create(['name' => 'User']);

        // assign all permissions to the SuperAdmin role
        $superAdmin->givePermissionTo($permissions);

        // assign specific permissions to the User role
        $userRole->givePermissionTo('ver usuarios', 'actualizar usuario', 'desactivar usuario', 'recuperarImpersonation');

        // assign SuperAdmin role to user 1
        $superAdminUser = User::find(1);
        if ($superAdminUser) {
            $superAdminUser->assignRole($superAdmin);
        }

        // assign User role to the rest of the users
        $users = User::where('id', '>=', 2)->get();
        foreach ($users as $user) {
            $user->assignRole($userRole);
        }
    }
}
