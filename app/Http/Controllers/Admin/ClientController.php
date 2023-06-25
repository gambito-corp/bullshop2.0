<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:viewAny,App\Models\User')->only('index');
        $this->middleware('can:view,App\Models\User')->only('show');
        $this->middleware('can:create,App\Models\User')->only('create');
        $this->middleware('can:update,App\Models\User')->only('update');
        $this->middleware('can:delete,App\Models\User')->only('delete');
        $this->middleware('can:erase,App\Models\User')->only('erase');
    }


    public function index()
    {
        return view('components.admin.client.index');
    }
}
