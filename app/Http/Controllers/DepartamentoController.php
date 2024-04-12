<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    public function inicio(){
        $departamentos = Departamento::all();
        return view ('departamentos.inicio', compact('departamentos'));
    }

    public function crear()
    {
        return view('departamentos.crear');
    }

    public function guardar(REQUEST $request)
    {
        $request->validate([
            'nombre' => 'required',
        ]);
        $departamentos = new Departamento();
        $departamentos->nombre = $request->nombre;
        $departamentos->save();

        return redirect(route('departamentos.inicio'))->with('creado', 'Departamento creado exitosamente');
    }

    public function editar($id)
    {
        $departamentos = Departamento::where('id', '=', $id)->first();
        return view('departamentos.editar', compact('departamentos'));
    }

    public function actualizar(REQUEST $request, $id)
    {
        $departamentos = Departamento::where('id', '=', $id)->first();
        $request->validate([
            'nombre' => 'required',
        ]);
        $departamentos->nombre = $request->nombre;
        $departamentos->save();

        
        return redirect(route('departamentos.inicio'))->with('actualizado', 'Departamento actualizada exitosamente');
    }

    public function eliminar($id)
    {
        $departamentos = Departamento::where('id', '=', $id)->first();
        $nombre = $departamentos->nombre;
        $departamentos->delete();


        return redirect(route('departamentos.inicio'))->with('eliminado', 'Departamento ' . $nombre . ' eliminado exitosamente');
    }
}
