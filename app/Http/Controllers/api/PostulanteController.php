<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Postulante;
use Illuminate\Http\Request;

class PostulanteController extends Controller
{
    public function getPostulante($id){
        
        try {
            $postulante = Postulante::find($id);
            $postulante->educaciones;
            $postulante->usuario;
            $postulante->fuente_de_contratacion;
            $postulante->contrato;
            $postulante->puesto_disponible;
            $postulante->idioma;
            $postulante->nivel_idioma;
            $postulante->referencias;
            $postulante->educaciones;
            $postulante->reconocimientos;
            $postulante->experiencias;
            $postulante->entrevista;
            if($postulante->referencias->isEmpty()){
                $postulante->estado = 'incompleto';
            }else{
                if($postulante->estado === 0){
                    $postulante->estado = 'rechazado';
                }else{
                    if($postulante->contrato){
                        $postulante->estado = 'oferta';
                    }
                    if(!$postulante->entrevista && !$postulante->contrato){
                        $postulante->estado = 'pendiente';
                    }
                    if($postulante->entrevista){
                        $postulante->estado = 'entrevista';
                    }else{
                        $postulante->estado = 'entrevistado';
                    }
                }
            }
            return response()->json($postulante);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al procesar la solicitud de getPostulante', 'error' => $th->getMessage()], 500);
        }
    }
}
