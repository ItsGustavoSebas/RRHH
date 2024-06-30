<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\LlamadaAtencion;
use Illuminate\Http\Request;

class LlamadaController extends Controller
{
    public function getLlamadas($id)
    {

        try {
            $llamadas = LlamadaAtencion::where('ID_Empleado', $id)->get();
            $respuesta = $llamadas->map(function($llamada) {
                return [
                    'id' => $llamada->id,
                    'motivo' => $llamada->motivo,
                    'fecha' => $llamada->fecha,
                    'gravedad' => $llamada->gravedad,
                ];
            });

            return response()->json($respuesta);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al procesar la solicitud de getLlamadas', 'error' => $e->getMessage()], 500);
        }
    }
}
