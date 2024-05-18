<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Postulante;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function generateToken(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);
        if (!DB::table('users')->where('email', $request->email)->exists()) {
            return response()->json(['message' => 'Correo Electronico Inexistente'], 404);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        //hash para ver si son iguales
        if ($user->Docente || $user->Postulante || $user->Empleado) {
            if (Hash::check($request->password, $user->password)) {
                return $user->createToken($request->device_name)->plainTextToken;
            } else {
                return response()->json(['message' => 'Contraseña Incorrecta'], 404);
            }
        } else {
            return response()->json(['message' => 'Rol no permitido'], 404);
        }
    }

    public function getRol($id, $role){
        
        try {
            $user = User::find($id);
            $respuesta = $user->hasRole($role);
            return response()->json($respuesta);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al procesar la solicitud de getRol', 'error' => $th->getMessage()], 500);
        }
    }

    public function getPermission($id, $permiso){
        
        try {
            $user = User::find($id);
            $respuesta = $user->hasPermission($permiso);
            return response()->json($respuesta);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al procesar la solicitud de getPermission', 'error' => $th->getMessage()], 500);
        }
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'ci' => 'required|string',
            'telefono' => 'required|string',
            'direccion' => 'required|string',
            'password' => 'required|string|min:8',

        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'ci' => $request->input('ci'),
            'telefono' => $request->input('telefono'),
            'direccion' => $request->input('direccion'),
            'password' => Hash::make($request->input('password')),
            'Postulante' => true,
            'Empleado' => false,
        ]);

        $postulante = new Postulante();
        $postulante->ID_Usuario =  $user->id;
        $postulante->save();
        
        return $user->createToken('AuthToken')->plainTextToken;
    }
}
