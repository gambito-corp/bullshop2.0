<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Client;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->hasRole('SuperAdmin')) {
            return true;
        }
    }

    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('ver cliente');
    }

    public function view(User $user, Client $client)
    {
        return $user->hasPermissionTo('leer clientes');
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo('crear cliente');
    }

    public function update(User $user, Client $client)
    {
        return $user->hasPermissionTo('editar cliente');
    }

    public function delete(User $user, Client $client)
    {
        return $user->hasPermissionTo('borrar cliente');
    }

    public function erase(User $user, Client $client)
    {
        return $user->hasPermissionTo('eliminar cliente');
    }
}
