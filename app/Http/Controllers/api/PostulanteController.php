<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\Departamento;
use App\Models\Empleado;
use App\Models\Entrevista;
use App\Models\Postulante;
use App\Models\Pre_Contrato;
use Barryvdh\DomPDF\Facade\Pdf;
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
                        } else {
                            if ($postulante->entrevista) {
                                $postulante->estado = 'entrevista';
                            } else {
                                $postulante->estado = 'entrevistado';
                            }
                        }
                    }
                }
            }
            $respuesta = [
                'id' => $postulante->ID_Usuario,
                'nombre' => $postulante->usuario->name,
                'email' => $postulante->usuario->email,
                'puesto' => $postulante->puesto_disponible ? $postulante->puesto_disponible->nombre : '',
                'estado' => $postulante->estado,
                'ci' => $postulante->usuario->ci,
                'telefono   ' => $postulante->usuario->telefono,
                'direccion' => $postulante->usuario->direccion,
                'fecha_de_nacimiento' => $postulante->fecha_de_nacimiento,
                'nacionalidad' => $postulante->nacionalidad,
                'habilidades' => $postulante->habilidades,
                'fuenteDeContratacion' => $postulante->fuente_de_contratacion ? $postulante->fuente_de_contratacion->nombre : '',
                'idioma' => $postulante->idioma ? $postulante->idioma->nombre : '',
                'nivel_idioma' => $postulante->nivel_idioma ? $postulante->nivel_idioma->categoria : '',
                'foto' => $postulante->ruta_imagen_e,
            ];
            return response()->json($respuesta);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al procesar la solicitud de getPostulante', 'error' => $th->getMessage()], 500);
        }
    }

    public function getContrato($id)
    {
        try {
            $postulante = Postulante::where('ID_Usuario', '=', $id)->first();
            $pre_contrato = Pre_Contrato::where('ID_Postulante', '=', $id)->first();
            $entrevista = Entrevista::where('ID_Postulante', '=', $id)->first();
            $departamentos = Departamento::all();
            $cargos = Cargo::all();



            $empleado = Empleado::where('ID_Usuario', '=', $pre_contrato->usuario->id)->first();

            $data = [
                'postulante' => $postulante,
                'pre_contrato' => $pre_contrato,
                'entrevista' => $entrevista,
                'departamentos' => $departamentos,
                'cargos' => $cargos,
                'empleado' => $empleado,
            ];
            $pdf = Pdf::loadView('PDF.contrato', $data);
            return $pdf->download('contrato.pdf');
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al procesar la solicitud de getContrato', 'error' => $th->getMessage()], 500);
        }
    }

    public function getEducaciones($id){
        try {
            $postulante = Postulante::find($id);
            $respuesta = $postulante->educaciones;
            return response()->json($respuesta);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al procesar la solicitud de getEducaciones', 'error' => $th->getMessage()], 500);
        }
    }

    public function getReconocimientos($id){
        try {
            $postulante = Postulante::find($id);
            $respuesta = $postulante->reconocimientos;
            return response()->json($respuesta);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al procesar la solicitud de getReconocimientos', 'error' => $th->getMessage()], 500);
        }
    }

    public function getExperiencias($id){
        try {
            $postulante = Postulante::find($id);
            $respuesta = $postulante->experiencias;
            return response()->json($respuesta);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al procesar la solicitud de getExperiencias', 'error' => $th->getMessage()], 500);
        }
    }

    public function getReferencias($id){
        try {
            $postulante = Postulante::find($id);
            $respuesta = $postulante->referencias;
            return response()->json($respuesta);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al procesar la solicitud de getReferencias', 'error' => $th->getMessage()], 500);
        }
    }
}
