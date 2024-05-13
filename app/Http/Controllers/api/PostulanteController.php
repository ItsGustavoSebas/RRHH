<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Postulante;
use Illuminate\Http\Request;

class PostulanteController extends Controller
{
    public function getPostulante($id)
    {

        try {
            $postulante = Postulante::find($id);
            if ($postulante->referencias->isEmpty()) {
                $postulante->estado = 'incompleto';
            } else {
                if ($postulante->estado === 0) {
                    $postulante->estado = 'rechazado';
                } else {
                    if ($postulante->contrato) {
                        $postulante->estado = 'oferta';
                    } else {
                        if (!$postulante->entrevista && !$postulante->contrato) {
                            $postulante->estado = 'pendiente';
                        }
                        if ($postulante->entrevista) {
                            $postulante->estado = 'entrevista';
                        } else {
                            $postulante->estado = 'entrevistado';
                        }
                    }
                }
            }
            $respuesta = [
                'id' => $postulante->ID_Usuario,
                'nombre' => $postulante->usuario->name,
                'email' => $postulante->usuario->email,
                'puesto' => $postulante->puesto_disponible->nombre,
                'estado' => $postulante->estado,
                'ci' => $postulante->usuario->ci,
                'telefono   ' => $postulante->usuario->telefono,
                'direccion' => $postulante->usuario->direccion,
                'fecha_de_nacimiento' => $postulante->fecha_de_nacimiento,
                'nacionalidad' => $postulante->nacionalidad,
                'habilidades' => $postulante->habilidades,
                'fuenteDeContratacion' => $postulante->fuente_de_contratacion->nombre,
                'idioma' => $postulante->idioma->nombre,
                'nivel_idioma' => $postulante->nivel_idioma->categoria,
            ];
            return response()->json($respuesta);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al procesar la solicitud de getPostulante', 'error' => $th->getMessage()], 500);
        }
    }
}
