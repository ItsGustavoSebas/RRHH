<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use Illuminate\Http\Request;

class ActividadController extends Controller
{
    public function inicio()
    {
        $actividades = Actividad::all();
        return view('actividades.inicio', compact('actividades'));
    }

    public function crear()
    {
        return view('actividades.crear');
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'hora_inicio' => 'required|date_format:H:i',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
        ]);

        Actividad::create($request->all());

        return redirect()->route('actividades.inicio')->with('success', 'Actividad creada exitosamente');
    }

    public function editar($id)
    {
        $actividad = Actividad::findOrFail($id);
        return view('actividades.editar', compact('actividad'));
    }

    public function actualizar(Request $request, $id)
    {
        $actividad = Actividad::findOrFail($id);
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'hora_inicio' => 'required|date_format:H:i',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
        ]);

        $actividad->update($request->all());

        return redirect()->route('actividades.inicio')->with('success', 'Actividad actualizada exitosamente');
    }

    public function eliminar($id)
    {
        $actividad = Actividad::findOrFail($id);
        $actividad->delete();

        return redirect()->route('actividades.inicio')->with('success', 'Actividad eliminada exitosamente');
    }
}
