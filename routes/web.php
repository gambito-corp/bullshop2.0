<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::get('gestion-usuarios', [UserController::class, 'index'])->middleware('can:viewAny,App\Models\User')->name('admin.users.index');
Route::get('impersonar-usuarios/{id}', [UserController::class, 'impersonar'])->middleware('can:impersonar,App\Models\User')->name('admin.users.impersonar');
Route::get('recuperar-usuarios', [UserController::class, 'recuperar'])->middleware('can:recuperarImpersonation')->name('admin.users.recuperar');


// Rutas de Clientes
Route::get('gestion-clientes', [ClientController::class, 'index'])->middleware('can:viewAny,App\Models\User')->name('admin.clients.index');

// Rutas de Getion de Categorias
Route::get('gestion-categorias', [CategoryController::class, 'index'])->name('admin.categories.index');
