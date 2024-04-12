<?php

use App\Http\Controllers\CargoController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\PostulanteController;

use App\Http\Controllers\RoleController;
use App\Models\Departamento;
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

    //POSTULANTE CONTROLLER
    Route::get('/postulantes/inicio', [PostulanteController::class, 'inicio'])->name('postulantes.inicio');
    // Route::get('/docentes/crear', [PostulanteController::class, 'crear'])->name('docentes.crear');
     Route::get('/postulantes/editar/{id}', [PostulanteController::class, 'editar'])->name('postulantes.editar');
     Route::post('/postulantes/actualizar/{id}', [PostulanteController::class, 'actualizar'])->name('postulantes.actualizar');
     Route::post('/postulantes/eliminar/{id}', [PostulanteController::class, 'eliminar'])->name('postulantes.eliminar');    
     //Route::post('/docentes/guardar', [PostulanteController::class, 'guardar'])->name('docentes.guardar');

       //ROLES

    Route::get('/roles/inicio', [RoleController::class, 'inicio'])->name('roles.inicio');
    Route::get('/roles/crear', [RoleController::class, 'crear'])->name('roles.crear');
    Route::post('/roles/guardar', [RoleController::class, 'guardar'])->name('roles.guardar');
    Route::get('/roles/editar/{id}', [RoleController::class, 'editar'])->name('roles.editar');
    Route::post('/roles/actualizar/{id}', [RoleController::class, 'actualizar'])->name('roles.actualizar');
    Route::post('/roles/eliminar/{id}', [RoleController::class, 'eliminar'])->name('roles.eliminar');


    //DEPARTAMENTOS
    Route::get('/departamentos/inicio', [DepartamentoController::class, 'inicio'])->name('departamentos.inicio');
    Route::get('/departamentos/crear', [DepartamentoController::class, 'crear'])->name('departamentos.crear');
    Route::post('/departamentos/guardar', [DepartamentoController::class, 'guardar'])->name('departamentos.guardar');
    Route::get('/departamentos/editar/{id}', [DepartamentoController::class, 'editar'])->name('departamentos.editar');
    Route::post('/departamentos/actualizar/{id}', [DepartamentoController::class, 'actualizar'])->name('departamentos.actualizar');
    Route::post('/departamentos/eliminar/{id}', [DepartamentoController::class, 'eliminar'])->name('departamentos.eliminar');


    //CARGOS
    Route::get('/cargos/inicio', [CargoController::class, 'inicio'])->name('cargos.inicio');
    Route::get('/cargos/crear', [CargoController::class, 'crear'])->name('cargos.crear');
    Route::post('/cargos/guardar', [CargoController::class, 'guardar'])->name('cargos.guardar');
    Route::get('/cargos/editar/{id}', [CargoController::class, 'editar'])->name('cargos.editar');
    Route::post('/cargos/actualizar/{id}', [CargoController::class, 'actualizar'])->name('cargos.actualizar');
    Route::post('/cargos/eliminar/{id}', [CargoController::class, 'eliminar'])->name('cargos.eliminar');

    //EMPLEADOS
    Route::get('/usuarios/empleados/crear', [EmpleadoController::class, 'crear'])->name('empleados.crear');
    Route::post('/usuarios/empleados/guardar', [EmpleadoController::class, 'guardar'])->name('empleados.guardar');
    Route::get('/usuarios/empleados/inicio', [EmpleadoController::class, 'inicio'])->name('empleados.inicio');
    Route::get('/usuarios/empleados/editar/{id}', [EmpleadoController::class, 'editar'])->name('empleados.editar');
    Route::post('/usuarios/empleados/actualizar/{id}', [EmpleadoController::class, 'actualizar'])->name('empleados.actualizar');
    Route::post('/usuarios/empleados/eliminar/{id}', [EmpleadoController::class, 'eliminar'])->name('empleados.eliminar');

});



      

