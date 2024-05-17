<?php

use App\Http\Controllers\PermisoController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\MensajesController;
use App\Http\Controllers\api\PostulanteController;
use App\Models\User;
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
    $user = User::find($request->user()->id);
    $user->foto = $user->Postulante
        ? $request->user()->postulante->ruta_imagen_e
        : $request->user()->empleado->ruta_imagen_e;
    return $user;
});
Route::get('/postulante/{id}', [PostulanteController::class, 'getPostulante']);
Route::get('/getRol/{id}/{rol}', [AuthController::class, 'getRol']);
Route::get('/getPermission/{id}/{permiso}', [AuthController::class, 'getPermission']);
Route::get('/contrato/{id}', [PostulanteController::class, 'getContrato']);
Route::get('/postulante/educaciones/{id}', [PostulanteController::class, 'getEducaciones']);
Route::get('/postulante/reconocimientos/{id}', [PostulanteController::class, 'getReconocimientos']);
Route::get('/postulante/experiencias/{id}', [PostulanteController::class, 'getExperiencias']);
Route::get('/postulante/referencias/{id}', [PostulanteController::class, 'getReferencias']);

Route::get('/messages/{id}', [MensajesController::class, 'index']);
Route::post('/messages/enviar/{id}', [MensajesController::class, 'store']);
Route::get('/messages/{usuario_id}/{otro_id}', [MensajesController::class, 'show']);
Route::get('/messages/usuarios/{id}', [MensajesController::class, 'usuarios']);
