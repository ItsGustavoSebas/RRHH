<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permiso;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PermisoController extends Controller
{
    public function create()
    {
        return view('permisos.solicitud');
    }

    public function enviarSolicitud(Request $request)
    {
        // Aquí manejas la lógica para enviar la solicitud de permiso
        // Por ejemplo, puedes validar los datos del formulario
        $request->validate([
            'motivo' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
        ]);
    
        // Luego, puedes guardar los datos en la base de datos
        $permiso = new Permiso();
        $permiso->user_id = auth()->id(); // Asigna el ID del usuario actual
        $permiso->motivo = $request->motivo;
        $permiso->fecha_inicio = $request->fecha_inicio;
        $permiso->fecha_fin = $request->fecha_fin;
        $permiso->save();
    
        // Después de guardar, redirige al historial de permisos
        return redirect()->route('permisos.historial')->with('success', 'Solicitud de permiso enviada exitosamente.');
    }

    public function historial()
    {
        $user = User::find(Auth::id());
        if ($user->hasRole('Administrador')) {
            $permisos = Permiso::all();
        } else {
            $permisos = Permiso::where('user_id', Auth::id())->get();
        }
        return view('permisos.historial', compact('permisos'));
    }
    
    
    
    

    public function approve(Request $request, $id)
    {
        $permiso = Permiso::findOrFail($id);
        // Aquí puedes agregar la lógica para aprobar el permiso
        $permiso->aprobado = true;
        $permiso->save();

        // Puedes agregar notificaciones o cualquier otra acción necesaria
        return redirect()->back()->with('success', 'Permiso aprobado exitosamente.');
    }

    public function deny(Request $request, $id)
    {
        $permiso = Permiso::findOrFail($id);
        // Aquí puedes agregar la lógica para denegar el permiso
        $permiso->denegado = true; // Marcamos el permiso como denegado
        $permiso->aprobado = false; // Marcamos el permiso como no aprobado
        $permiso->save();

        // Puedes agregar notificaciones u otras acciones necesarias
        return redirect()->back()->with('success', 'Permiso denegado exitosamente.');
    }
}
