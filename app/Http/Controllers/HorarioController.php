<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function inicio()
    {
        $horarios = Horario::all();
        return view('horarios.inicio', compact('horarios'));
    }

    public function crear()
    {
        $horarios = Horario::all();
        return view('horarios.crear', compact('horarios'));
    }

    public function editar($id)
    {
        $horarios = Horario::where('id', '=', $id)->first();
        return view('horarios.editar', compact('horarios'));
    }

    public function eliminar($id)
    {
        $horarios = Horario::where('id', '=', $id)->first();
        $horarios->delete();

        return redirect(route('horarios.inicio'))->with('eliminado', 'Horario eliminado exitosamente');
    }

    public function guardar(REQUEST $request)
    {

        // Realizar validaciones

        $request->validate([
            'HoraInicio' => 'required',
            'HoraFin' => 'required',
        ], [
            'HoraInicio.required' => 'Debes ingresar la Hora de Inicio.',
            'HoraFin.required' => 'Debes ingresar la Hora de Finalización.',
        ]);

        $horarios = Horario::create([
            'HoraInicio' => $request->HoraInicio,
            'HoraFin' => $request->HoraFin,
            'HoraLimite' => $request->HoraLimite,
        ]);

        $horarios->save();

        
        return redirect(route('horarios.inicio'))->with('creado', 'Horario registrado exitosamente');
    }

    public function actualizar(Request $request, $id)
    {

        $request->validate([
            'HoraInicio' => 'required',
            'HoraFin' => 'required',
        ], [
            'HoraInicio.required' => 'Debes ingresar la hora de Inicio.',
            'HoraFin.required' => 'Debes ingresar la Hora de Finalización.',

        ]);

        $horarios = Horario::where('id', '=', $id)->first();  /* User::findOrFail($id) esto es para regresar un valor null en un error de base de datos */

        $horarios->update([
            'HoraInicio' => $request->HoraInicio,
            'HoraFin' => $request->HoraFin,
            'HoraLimite' => $request->HoraLimite,
        ]);


        $horarios->save();


        return redirect()->route('horarios.inicio')->with('actualizado', 'Horario actualizado exitosamente');
    }
}
