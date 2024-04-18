<?php

namespace App\Http\Controllers;

use App\Models\Puesto_Disponible;
use Illuminate\Http\Request;

class Puesto_DisponibleController extends Controller
{
    public function inicio(){
        $puesto_disponibles = Puesto_Disponible::all();
        return view ('puesto_disponibles.inicio', compact('puesto_disponibles'));
    }

    public function crear()
    {
        return view('puesto_disponibles.crear');
    }

    public function guardar(REQUEST $request)
    {
        $request->validate([
            'nombre' => 'required',
        ]);
        $puesto_disponibles = new Puesto_Disponible();
        $puesto_disponibles->nombre = $request->nombre;
        $puesto_disponibles->save();

        return redirect(route('puesto_disponibles.inicio'))->with('creado', 'Puesto Disponible creado exitosamente');
    }

    public function editar($id)
    {
        $puesto_disponibles = Puesto_Disponible::where('id', '=', $id)->first();
        return view('puesto_disponibles.editar', compact('puesto_disponibles'));
    }

    public function actualizar(REQUEST $request, $id)
    {
        $puesto_disponibles = Puesto_Disponible::where('id', '=', $id)->first();
        $request->validate([
            'nombre' => 'required',
        ]);
        $puesto_disponibles->nombre = $request->nombre;
        $puesto_disponibles->save();

        
        return redirect(route('puesto_disponibles.inicio'))->with('actualizado', 'Puesto Disponible actualizada exitosamente');
    }

    public function eliminar($id)
    {
        $puesto_disponibles = Puesto_Disponible::where('id', '=', $id)->first();
        $nombre = $puesto_disponibles->nombre;
        $puesto_disponibles->delete();


        return redirect(route('puesto_disponibles.inicio'))->with('eliminado', 'Puesto_Disponible ' . $nombre . ' eliminado exitosamente');
    }
}
