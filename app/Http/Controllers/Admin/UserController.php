<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:viewAny,App\Models\User')->only('index');
        $this->middleware('can:impersonar,App\Models\User')->only('impersonar');
        $this->middleware('can:create,App\Models\User')->only('create');
        $this->middleware('can:view,App\Models\User')->only('show');
        $this->middleware('can:edit,App\Models\User')->only('edit');
        $this->middleware('can:update,App\Models\User')->only('update');
        $this->middleware('can:delete,App\Models\User')->only('delete');
        $this->middleware('can:erase,App\Models\User')->only('erase');
        $this->middleware('can:deactivate,App\Models\User')->only('deactivate');
    }

    public function index()
    {
        return view('components.admin.users.index');
    }

    public function impersonar($id)
    {
        // Revisar si existe la sesión Original_user
        if (Session::has('Original_user')) {
            // Obtener el id del usuario original
            $originalUserId = Session::get('Original_user');

            // Revisar si el id es igual al id recibido
            if ($id == $originalUserId) {
                // Autenticar con el id del usuario original
                Auth::loginUsingId($originalUserId);

                // Destruir la sesión Original_user
                Session::forget('Original_user');

                // Redirigir a la ruta admin.users.index
                return redirect()->route('admin.users.index');
            }
        }

        // Almacenar el usuario actual en la sesión persistente
        $originalUser = Auth::user();
        Session::put('Original_user', $originalUser);

        // Autenticar como el nuevo usuario
        $user = User::findOrFail($id);
        Auth::login($user);

        // Redirigir a la ruta admin.users.index
        return redirect()->route('admin.users.index');
    }


    public function recuperar()
    {
        $originalUser = Session::get('Original_user');

        if ($originalUser) {
            Auth::loginUsingId($originalUser->id);
            Session::forget('Original_user');
        }

        return redirect()->route('admin.users.index');
    }


    public function create()
    {
        // Lógica para mostrar el formulario de creación de usuarios
    }

    public function store(Request $request)
    {
        // Lógica para almacenar un nuevo usuario en la base de datos
    }

    public function show(User $user)
    {
        // Lógica para mostrar los detalles de un usuario específico
    }

    public function edit(User $user)
    {
        // Lógica para mostrar el formulario de edición de un usuario específico
    }

    public function update(Request $request, User $user)
    {
        // Lógica para actualizar la información de un usuario específico en la base de datos
    }

    public function delete(User $user)
    {
        // Lógica para eliminar un usuario específico de la base de datos
    }

    public function erase(User $user)
    {
        // Lógica para borrar permanentemente un usuario específico de la base de datos
    }

    public function deactivate(User $user)
    {
        // Lógica para desactivar un usuario específico
    }
}
