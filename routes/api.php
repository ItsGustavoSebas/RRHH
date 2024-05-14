<?php

use App\Http\Controllers\PermisoController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\PostulanteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Rutas de autenticación
Route::post('/sanctum/token', [AuthController::class, 'generateToken']);
Route::post('/user/revoke', [AuthController::class, 'revokeToken']);

Route::middleware('auth:sanctum')->get('/user/revoke', function (Request $request) {
    $user = $request->user();
    $user->tokens()->delete();
    return 'Tokens Eliminados';
});

// Rutas para la gestión de permisos
Route::post('/permisos/enviar-solicitud', [PermisoController::class, 'enviarSolicitud']);
Route::get('/permisos/historial', [PermisoController::class, 'historial']);
Route::put('/permisos/aprobar/{id}', [PermisoController::class, 'approve']);
Route::put('/permisos/denegar/{id}', [PermisoController::class, 'deny']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/postulante/{id}', [PostulanteController::class, 'getPostulante']);
Route::get('/getRol/{id}/{rol}', [AuthController::class, 'getRol']);
Route::get('/getPermission/{id}/{permiso}', [AuthController::class, 'getPermission']);
Route::get('/contrato/{id}', [PostulanteController::class, 'getContrato']);