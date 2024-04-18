<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Departamento;
use App\Models\Empleado;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InformacionPersonalController extends Controller
{
    //

    public function inicio($id)
    {
        $empleado = Empleado::where('ID_Usuario', '=', $id)->with('usuario')->first();
        $departamentos = Departamento::all();
        $departamento = $empleado->departamento;
        $cargos = Cargo::all();
        $cargo = $empleado->cargo;
        return (view('2_Recursos_Humanos.informacionpersonal.inicio', compact('empleado','departamento','departamentos','cargo', 'cargos')));
    }

    public function actualizarDepartamento(Request $request, $id)
    {
        $request->validate([
            'ID_Departamento' => 'required',
        ], [
            'ID_Departamento.required' => 'Debes ingresar el departamento.',
        ]);

        $empleado = Empleado::where('ID_Usuario', '=', $id)->first();

        $empleado->update([
            'ID_Departamento' => $request->ID_Departamento,
        ]);

        $empleado->save();


        return redirect()->route('informacionpersonal.inicio',$id)->with('actualizado', 'Usuario actualizado exitosamente');
    }

    public function actualizarCargo(Request $request, $id)
    {
        $request->validate([
            'ID_Cargo' => 'required',
        ], [
            'ID_Cargo.required' => 'Debes ingresar el cargo.',
        ]);

        $empleado = Empleado::where('ID_Usuario', '=', $id)->first();

        $empleado->update([
            'ID_Cargo' => $request->ID_Cargo,
        ]);

        $empleado->save();


        return redirect()->route('informacionpersonal.inicio',$id)->with('actualizado', 'Usuario actualizado exitosamente');
    }

    public function actualizarTelefono(Request $request, $id)
    {
        $request->validate([
            'telefono' => 'required',
        ], [
            'telefono.required' => 'Debes ingresar el departamento.',
        ]);

        $empleado = User::where('id', '=', $id)->first();

        $empleado->update([
            'telefono' => $request->telefono,
        ]);

        $empleado->save();


        return redirect()->route('informacionpersonal.inicio',$id)->with('actualizado', 'Usuario actualizado exitosamente');
    }

}
