<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Departamento;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    public function inicio(){
        $cargos = Cargo::all();
        $departamentos = Departamento::all();
        return view ('cargos.inicio', compact('cargos', 'departamentos'));
    }

    public function crear()
    {
        $departamentos = Departamento::all();
        return view('cargos.crear', compact('departamentos'));
    }

    public function guardar(REQUEST $request)
    {
        $request->validate([
            'nombre' => 'required',
            'ID_Departamento' => 'required',
        ]);
        $cargos = new Cargo();
        $cargos->nombre = $request->nombre;
        $cargos->ID_Departamento = $request->ID_Departamento;
        $cargos->save();

        return redirect(route('cargos.inicio'))->with('creado', 'Cargo creado exitosamente');
    }

    public function editar($id)
    {
        $cargos = Cargo::find($id);
        $departamentos = Departamento::all();
        return view('cargos.editar', compact('cargos', 'departamentos'));
    }

    public function actualizar(REQUEST $request, $id)
    {
        $cargos = Cargo::find($id);
        $request->validate([
            'nombre' => 'required',
            'ID_Departamento' => 'required',
        ]);
        $cargos->nombre = $request->nombre;
        $cargos->ID_Departamento = $request->ID_Departamento;
        $cargos->save();

        return redirect(route('cargos.inicio'))->with('actualizado', 'Cargo actualizada exitosamente');
    }

    public function eliminar($id)
    {
        $cargos = Cargo::where('id', '=', $id)->first();
        $nombre = $cargos->nombre;
        $cargos->delete();


        return redirect(route('cargos.inicio'))->with('eliminado', 'Cargo ' . $nombre . ' eliminado exitosamente');
    }
}
