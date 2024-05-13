<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/sanctum/token', [AuthController::class, 'generateToken']);

Route::middleware('auth:sanctum')->get('/user/revoke', function (Request $request) {
    $user = $request->user();
    $user->tokens()->delete();
    return 'Tokens Eliminados';
});

Route::get('/postulante/{id}', [PostulanteController::class, 'getPostulante']);
Route::get('/getRol/{id}/{rol}', [AuthController::class, 'getRol']);
Route::get('/getPermission/{id}/{permiso}', [AuthController::class, 'getPermission']);