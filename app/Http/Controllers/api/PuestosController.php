<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Postulante;
use App\Models\Puesto_Disponible;
use Illuminate\Http\Request;

class PuestosController extends Controller
{
    public function getPuestos()
    {
        try {
            $respuesta = Puesto_Disponible::where('disponible', '>', 0)->get();
            return response()->json($respuesta);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al procesar la solicitud de getPuestos', 'error' => $th->getMessage()], 500);
        }
    }

    public function postularse($id_user, $idpuesto)
    {
        try {
            $postulante = Postulante::where('ID_Usuario', '=', $id_user)->first();
            $postulante->ID_Puesto_Disponible = $idpuesto;
            $postulante->estado = null;
            $postulante->save();
            return response()->json(['success' => true], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al procesar la solicitud de postularse', 'error' => $th->getMessage()], 500);
        }
    }
}
