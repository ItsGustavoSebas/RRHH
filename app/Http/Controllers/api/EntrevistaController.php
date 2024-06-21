<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\Departamento;
use App\Models\Empleado;
use App\Models\Entrevista;
use App\Models\Postulante;
use App\Models\Pre_Contrato;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class EntrevistaController extends Controller
{
    public function getEntrevista($id)
    {
        try {
            $postulante = User::findOrFail($id);
            $entrevista = Entrevista::where('ID_Postulante', $id)->firstOrFail();
            $usuario = User::findOrFail($entrevista->ID_Usuario);
            $respuesta = [
                'id' => $entrevista->id,
                'fecha_inicio' => $entrevista->fecha_inicio,
                'hora' => $entrevista->hora,
                'fecha_fin' => $entrevista->fecha_fin,
                'detalles' => $entrevista->detalles,
                'puntos' => $entrevista->puntos ?? 0,
                'postulante' => [
                    'nombre' => $postulante->name,
                ],
                'usuario' => [
                    'nombre' => $usuario->name,
                    'cargo' => $usuario->empleado->cargo->nombre ?? '',
                ]
            ];

            return response()->json($respuesta);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al procesar la solicitud de getEntrevista', 'error' => $e->getMessage()], 500);
        }
    }


    public function getContrato($id)
    {
        try {
            $postulante = Postulante::where('ID_Usuario', $id)->first();
            $pre_contrato = Pre_Contrato::where('ID_Postulante', $id)->first();
            $entrevista = Entrevista::where('ID_Postulante', $id)->first();
            $departamentos = Departamento::all();
            $cargos = Cargo::all();
            $empleado = Empleado::where('ID_Usuario', $pre_contrato->usuario->id)->first();

            $data = [
                'postulante' => $postulante,
                'pre_contrato' => $pre_contrato,
                'entrevista' => $entrevista,
                'departamentos' => $departamentos,
                'cargos' => $cargos,
                'empleado' => $empleado,
            ];

            // Generar el PDF usando domPDF
            $pdf = PDF::loadView('PDF.contrato', $data);

            // Devolver el contenido del PDF como una respuesta HTTP
            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->output();
            }, 'contrato.pdf');

        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al procesar la solicitud de getContrato', 'error' => $th->getMessage()], 500);
        }
    }
}