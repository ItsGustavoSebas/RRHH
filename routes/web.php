<?php

use App\Http\Controllers\EducacionController;
use App\Http\Controllers\ExperienciaController;
use App\Http\Controllers\PostulanteController;
use App\Http\Controllers\ReconocimientoController;
use App\Http\Controllers\ReferenciaController;
use App\Http\Controllers\RoleController;
use App\Models\Educacion;
use App\Models\Postulante;
use App\Models\Reconocimiento;
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

Route::get('/completado', function () {
    return view('contratacion.completado');
})->name('completado');



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

      //EDUCACIONES CONTROLLER
      Route::get('/educaciones/rinicio', [EducacionController::class, 'rinicio'])->name('educaciones.rinicio');
      Route::get('/educaciones/crear', [EducacionController::class, 'crear'])->name('educaciones.crear');
      Route::get('/educaciones/crearSIG', [EducacionController::class, 'crearSIG'])->name('educaciones.crearSIG');
      Route::get('/educaciones/editar/{id}', [EducacionController::class, 'editar'])->name('educaciones.editar');
      Route::post('/educaciones/actualizar/{id}', [EducacionController::class, 'actualizar'])->name('educaciones.actualizar');
      Route::post('/educaciones/eliminar/{id}', [EducacionController::class, 'eliminar'])->name('educaciones.eliminar');    
      Route::post('/educaciones/guardar', [EducacionController::class, 'guardar'])->name('educaciones.guardar');
      Route::post('/educaciones/guardarSIG', [EducacionController::class, 'guardarSIG'])->name('educaciones.guardarSIG');

      //POSTULANTES CONTROLLER
      Route::get('/postulantes/rinicio', [PostulanteController::class, 'rinicio'])->name('postulantes.rinicio');
      Route::get('/postulantes/editar/{id}', [PostulanteController::class, 'editar'])->name('postulantes.editar');
      Route::get('/postulantes/editarGES/{id}', [PostulanteController::class, 'editarGES'])->name('postulantes.editarGES');
      Route::post('/postulantes/actualizar/{id}', [PostulanteController::class, 'actualizar'])->name('postulantes.actualizar');
      Route::post('/postulantes/actualizarGES/{id}', [PostulanteController::class, 'actualizarGES'])->name('postulantes.actualizarGES');
      Route::get('/postulantes/postularse', [PostulanteController::class, 'postularse'])->name('postulantes.postularse');


      //RECONOCIMIENTOS CONTROLLER
      Route::get('/reconocimientos/rinicio', [ReconocimientoController::class, 'rinicio'])->name('reconocimientos.rinicio');
      Route::get('/reconocimientos/crear', [ReconocimientoController::class, 'crear'])->name('reconocimientos.crear');
      Route::get('/reconocimientos/crearSIG', [ReconocimientoController::class, 'crearSIG'])->name('reconocimientos.crearSIG');
      Route::get('/reconocimientos/editar/{id}', [ReconocimientoController::class, 'editar'])->name('reconocimientos.editar');
      Route::post('/reconocimientos/actualizar/{id}', [ReconocimientoController::class, 'actualizar'])->name('reconocimientos.actualizar');
      Route::post('/reconocimientos/eliminar/{id}', [ReconocimientoController::class, 'eliminar'])->name('reconocimientos.eliminar');    
      Route::post('/reconocimientos/guardar', [ReconocimientoController::class, 'guardar'])->name('reconocimientos.guardar');
      Route::post('/reconocimientos/guardarSIG', [ReconocimientoController::class, 'guardarSIG'])->name('reconocimientos.guardarSIG');


      //EXPERIENCIAS CONTROLLER
      Route::get('/experiencias/rinicio', [ExperienciaController::class, 'rinicio'])->name('experiencias.rinicio');
      Route::get('/experiencias/crear', [ExperienciaController::class, 'crear'])->name('experiencias.crear');
      Route::get('/experiencias/crearSIG', [ExperienciaController::class, 'crearSIG'])->name('experiencias.crearSIG');
      Route::get('/experiencias/editar/{id}', [ExperienciaController::class, 'editar'])->name('experiencias.editar');
      Route::post('/experiencias/actualizar/{id}', [ExperienciaController::class, 'actualizar'])->name('experiencias.actualizar');
      Route::post('/experiencias/eliminar/{id}', [ExperienciaController::class, 'eliminar'])->name('experiencias.eliminar');    
      Route::post('/experiencias/guardar', [ExperienciaController::class, 'guardar'])->name('experiencias.guardar');
      Route::post('/experiencias/guardarSIG', [ExperienciaController::class, 'guardarSIG'])->name('experiencias.guardarSIG');      


      //REFERENCIAS CONTROLLER
      Route::get('/referencias/rinicio', [ReferenciaController::class, 'rinicio'])->name('referencias.rinicio');
      Route::get('/referencias/crear', [ReferenciaController::class, 'crear'])->name('referencias.crear');
      Route::get('/referencias/crearSIG', [ReferenciaController::class, 'crearSIG'])->name('referencias.crearSIG');
      Route::get('/referencias/editar/{id}', [ReferenciaController::class, 'editar'])->name('referencias.editar');
      Route::post('/referencias/actualizar/{id}', [ReferenciaController::class, 'actualizar'])->name('referencias.actualizar');
      Route::post('/referencias/eliminar/{id}', [ReferenciaController::class, 'eliminar'])->name('referencias.eliminar');    
      Route::post('/referencias/guardar', [ReferenciaController::class, 'guardar'])->name('referencias.guardar');
      Route::post('/referencias/guardarSIG', [ReferenciaController::class, 'guardarSIG'])->name('referencias.guardarSIG');        
      
    


