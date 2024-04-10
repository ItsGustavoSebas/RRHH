<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//ROLES

Route::get('/roles/inicio', [RoleController::class, 'inicio'])->name('roles.inicio');
Route::get('/roles/crear', [RoleController::class, 'crear'])->name('roles.crear');
Route::post('/roles/guardar', [RoleController::class, 'guardar'])->name('roles.guardar');
Route::get('/roles/editar/{id}', [RoleController::class, 'editar'])->name('roles.editar');
Route::post('/roles/actualizar/{id}', [RoleController::class, 'actualizar'])->name('roles.actualizar');
Route::post('/roles/eliminar/{id}', [RoleController::class, 'eliminar'])->name('roles.eliminar');
