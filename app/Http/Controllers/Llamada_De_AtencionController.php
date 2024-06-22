<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Empleado;
use App\Models\LlamadaAtencion;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Llamada_De_AtencionController extends Controller
{
    public function inicio()
    {
        $id = Auth::id();
        $empleados = Empleado::all();

        $yo = User::Where('id', $id)->first();
        return view('2_Recursos_Humanos.comunicacionRRHH.memoLlamada', compact('empleados', 'yo'));
    }

    public function guardar(REQUEST $request)
    {

        $request->validate([
            'motivo' => 'required',
            'gravedad' => 'required',
            'ID_Empleado' => 'required',

        ]);

        $atencion = new LlamadaAtencion();

        $atencion->motivo = $request->motivo;
        $atencion->fecha = Carbon::now();
        $atencion->gravedad = $request->gravedad;
        $atencion->ID_Empleado = $request->ID_Empleado;

        $atencion->save();

        return redirect(url('/Memorandum'))->with('creado', 'Llamada de atención enviado exitosamente');
    }

    public function inicioGes()
    {
        $llamadas = LlamadaAtencion::all();
        return view('2_Recursos_Humanos.comunicacionRRHH.llamadasInicio', compact('llamadas'));
    }


    public function editar($id)
    {
        $llamadas = LlamadaAtencion::where('id', '=', $id)->first();
        return view('2_Recursos_Humanos.comunicacionRRHH.llamadasEditar', compact('llamadas'));
    }

    public function actualizar(REQUEST $request, $id)
    {
        $llamada = LlamadaAtencion::where('id', '=', $id)->first();
        $request->validate([
            'motivo' => 'required',
            'gravedad' => 'required',
        ]);

        $llamada->motivo = $request->motivo;
        $llamada->gravedad = $request->gravedad;

        $llamada->save();


        return redirect(route('memorandumLlamada.inicioGes'))->with('actualizado', 'Llamada de atención actualizada exitosamente');
    }

    public function eliminar($id)
    {
        $llamadas = LlamadaAtencion::where('id', '=', $id)->first();
        $llamadas->delete();


        return redirect(route('memorandumLlamada.inicioGes'))->with('eliminado', 'Llamada de atención eliminado exitosamente');
    }
}
