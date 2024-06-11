<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permiso;
use App\Models\User;
use App\Notifications\PermisoAceptadoNotification;
use App\Notifications\PermisoRechazadoNotification;
use App\Notifications\PermisosNotification;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role as ModelsRole;

class PermisoController extends Controller
{
    public function create()
    {
        return view('permisos.solicitud');
    }

    public function enviarSolicitud(Request $request)
    {
        $request->validate([
            'motivo' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
        ]);
    
        $permiso = new Permiso();
        $permiso->user_id = auth()->id(); 
        $permiso->motivo = $request->motivo;
        $permiso->fecha_inicio = $request->fecha_inicio;
        $permiso->fecha_fin = $request->fecha_fin;
        $permiso->save();
        $role = ModelsRole::where('name', 'Encargado')->first();
        if ($role) {
            $usersWithRole = $role->users()->get();
        } else {
            $usersWithRole = collect();
        }
        $usersWithRole->each(function($user) use ($permiso) {
            $user->notify(new PermisosNotification($permiso));
        });
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
        $permiso->aprobado = true;
        $permiso->save();
        $permiso->ID_Usuario = Auth::id();
        $user = User::find($permiso->user_id);
        $user->notify(new PermisoAceptadoNotification($permiso));
        return redirect()->back()->with('success', 'Permiso aprobado exitosamente.');
    }

    public function deny(Request $request, $id)
    {
        $permiso = Permiso::findOrFail($id);
        $permiso->denegado = true;
        $permiso->aprobado = false; 
        $permiso->save();
        $permiso->ID_Usuario = Auth::id();
        $user = User::find($permiso->user_id);
        $user->notify(new PermisoRechazadoNotification($permiso));
        return redirect()->back()->with('success', 'Permiso denegado exitosamente.');
    }
}
