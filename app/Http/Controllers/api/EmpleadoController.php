<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Permiso;
use App\Notifications\PermisosNotification;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role as ModelsRole;

class EmpleadoController extends Controller
{
    public function getPermisosEmpleado($id)
    {
      try {
        $permisos = Permiso::where('user_id', $id)->get();

        return response()->json($permisos);
    } catch (\Throwable $th) {
        return response()->json(['message' => 'Error al procesar la solicitud de getPermisosEmpleado', 'error' => $th->getMessage()], 500);
    }

    }


    public function guardarPermiso(Request $request, $id)
    {
  
      $request->validate([
        'motivo' => 'required|string',
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date',
  
      ]);
  
      try {
        $permiso = new Permiso();
        $permiso->motivo = $request->motivo;
        $permiso->fecha_inicio = $request->fecha_inicio;
        $permiso->fecha_fin = $request->fecha_fin;
        $permiso->user_id = $id;
  
        $permiso->save();
  
        $role = ModelsRole::where('name', 'Encargado')->first();
        if ($role) {
          $usersWithRole = $role->users()->get();
        } else {
          $usersWithRole = collect();
        }
        $usersWithRole->each(function ($user) use ($permiso) {
          $user->notify(new PermisosNotification($permiso));
        });
  
        return response()->json(['message' => 'Educación creada exitosamente', '´Permiso' => $permiso], 200);
      } catch (\Throwable $th) {
        return response()->json(['message' => 'Error al procesar la solicitud de guardar´Permiso', 'error' => $th->getMessage()], 500);
      }
    }


    public function actualizarPermiso(Request $request, $id)
    {

      $permiso = Permiso::where('id', $id)->first();
      $request->validate([
        'motivo' => 'required|string',
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date',
      ]);

      try {
        
        
        $permiso->motivo = $request->motivo;
        $permiso->fecha_inicio = $request->fecha_inicio;
        $permiso->fecha_fin = $request->fecha_fin;
        $permiso->save();

        return response()->json(['message' => 'Permiso editado exitosamente','experiencia' => $permiso], 200);
      } catch (\Throwable $th) {
        return response()->json(['message' => 'Error al procesar la solicitud de actualizarPermiso','error' => $th->getMessage()], 500);
      }
    }


    public function eliminarPermiso($id)
    {
    
      $permiso = Permiso::where('id', $id)->first();


      if (!$permiso) {
        return response()->json(['message' => 'permiso no encontrado'], 404);
      }
      try {
  
        $permiso->delete();

        return response()->json(['message' => 'permiso eliminado exitosamente'], 200);
      } catch (\Throwable $th) {
        return response()->json(['message' => 'Error al procesar la solicitud de eliminarpermiso', 'error' => $th->getMessage()], 500);
      }
    }
}
