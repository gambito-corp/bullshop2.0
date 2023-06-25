<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->hasRole('SuperAdmin')) {
            return true;
        }
    }

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('ver usuarios');
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo('crear usuario');
    }

    public function view(User $user, User $model)
    {
        return $user->hasPermissionTo('leer usuario');
    }

    public function edit(User $user, User $model)
    {
        return $user->hasPermissionTo('editar usuario') || $user->hasPermissionTo('actualizar usuario');
    }

    public function update(User $user, User $model)
    {
        return $user->hasPermissionTo('actualizar usuario') || $user->hasPermissionTo('actualizar usuario');
    }

    public function delete(User $user, User $model)
    {
        return $user->hasPermissionTo('eliminar usuario') || $user->hasPermissionTo('borrar usuario');
    }

    public function erase(User $user, User $model)
    {
        return $user->hasPermissionTo('borrar usuario') || $user->hasPermissionTo('borrar usuario');
    }

    public function deactivate(User $user, User $model)
    {
        return $user->hasPermissionTo('desactivar usuario');
    }

    public function impersonar(User $user, User $model)
    {
        return $user->hasPermissionTo('impersonar usuario');
    }
}
