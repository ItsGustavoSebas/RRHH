<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Asistencia;
use App\Models\Dia_Asistencia;
use App\Models\DiaTrabajo;
use App\Models\Empleado;
use App\Models\Horario_Empleado;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AsistenciasController extends Controller
{
    public function getHorario($idEmpleado)
    {
        try {
            $empleado = Empleado::findOrFail($idEmpleado);

            $diasTrabajo = $empleado->diasTrabajo();
            $horarios = [];

            foreach ($diasTrabajo as $diaTrabajo) {
                $horarioEmpleado = Horario_Empleado::where('ID_Empleado', $empleado->ID_Usuario)
                    ->whereHas('dia_horario_empleado', function ($query) use ($diaTrabajo) {
                        $query->where('ID_DiaTrabajo', $diaTrabajo->id);
                    })
                    ->first();

                if ($horarioEmpleado) {
                    $horarios[] = [
                        'Dia' => $diaTrabajo->Nombre,
                        'HoraInicio' => $horarioEmpleado->Horario->HoraInicio,
                        'HoraFin' => $horarioEmpleado->Horario->HoraFin,
                        'HoraLimite' => $horarioEmpleado->Horario->HoraLimite,
                    ];
                }
            }

            return response()->json(['horarios' => $horarios], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los horarios: ' . $e->getMessage()], 500);
        }
    }

    // Otras funciones existentes adaptadas a API móvil
    public function marcar($id)
    {
        try {
            $usuario = User::where('id', '=', $id)->first();
            $empleado = Empleado::where('ID_Usuario', '=', $id)->with('usuario')->first();
            $numeroDiaSemana = Carbon::now()->dayOfWeek;
            $idDiaTrabajo = $numeroDiaSemana + 1;
            $diasTrabajo = $empleado->horario_empleado;
            $fechaActual = Carbon::now();
            $fechaAjustada = $fechaActual->copy()->subHours(4);

            if ($fechaAjustada->hour > $fechaActual->hour) {
                $idDiaTrabajo = $idDiaTrabajo-1;
                $diaTrabajoActual = DiaTrabajo::where('id', $idDiaTrabajo)->first();
                $fechaMarcada = $fechaAjustada->copy()->subDay()->toDateString();
            } else {
                $diaTrabajoActual = DiaTrabajo::where('id', $idDiaTrabajo)->first();
                $fechaMarcada = $fechaAjustada->toDateString();
            }

            $asistenciaExistente = Asistencia::where('ID_Empleado', $empleado->ID_Usuario)
                ->whereDate('FechaMarcada', $fechaMarcada)
                ->exists();

            $asistenciaYaExiste = $asistenciaExistente ? true : false;

            return response()->json([
                'usuario' => $usuario,
                'empleado' => $empleado,
                'diasTrabajo' => $diasTrabajo,
                'diaTrabajoActual' => $diaTrabajoActual,
                'asistenciaYaExiste' => $asistenciaYaExiste
            ], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener datos para marcar asistencia: ' . $e->getMessage()], 500);
        }
    }

    public function guardarAsistencias($idEmpleado, $idDiaTrabajo)
    {
        try {
            $empleado = Empleado::findOrFail($idEmpleado);
            $diaTrabajo = DiaTrabajo::findOrFail($idDiaTrabajo);
            $horarioEmpleado = Horario_Empleado::where('ID_Empleado', $empleado->ID_Usuario)
                ->whereHas('dia_horario_empleado', function ($query) use ($idDiaTrabajo) {
                    $query->where('ID_DiaTrabajo', $idDiaTrabajo);
                })
                ->first();

            if ($horarioEmpleado) {
                $horario = $horarioEmpleado->Horario;
                $fechaActual = Carbon::now();
                $fechaAjustada = $fechaActual->copy()->subHours(4);
                $fechaMarcada = $fechaAjustada->toDateString();
                $horaMarcada = $fechaAjustada->toTimeString();
                $asistenciaExistente = Asistencia::where('ID_Empleado', $empleado->ID_Usuario)
                    ->whereDate('FechaMarcada', $fechaMarcada)
                    ->exists();

                $asistenciaYaExiste = $asistenciaExistente ? true : false;
                $horaInicio = Carbon::createFromTimeString($horario->HoraInicio);
                $horaLimite = Carbon::createFromTimeString($horario->HoraLimite);
                $horaFin = Carbon::createFromTimeString($horario->HoraFin);

                if (!$asistenciaYaExiste) {
                    $asistencia = new Asistencia();
                    $asistencia->FechaMarcada = $fechaMarcada;
                    $asistencia->HoraMarcada = $horaMarcada;
                    $asistencia->ID_Empleado = $empleado->ID_Usuario;

                    if ($fechaAjustada->between($horaInicio, $horaLimite)) {
                        $asistencia->Puntual = true;
                    }
                    if ($fechaAjustada->between($horaLimite, $horaFin)) {
                        $asistencia->Atraso = true;
                    }
                    if ($fechaAjustada->gte($horaFin)) {
                        $asistencia->FaltaInjustificada = true;
                    }

                    $asistencia->save();

                    $diaAsistencia = new Dia_Asistencia();
                    $diaAsistencia->ID_Asistencia = $asistencia->id;
                    $diaAsistencia->ID_Dia_Horario_Empleado = $horarioEmpleado->dia_horario_empleado->id;
                    $diaAsistencia->save();
                } elseif ($horaMarcada >= $horaFin && !$asistenciaYaExiste) {
                    $asistenciaFalta = new Asistencia();
                    $asistenciaFalta->FechaMarcada = $fechaMarcada;
                    $asistenciaFalta->HoraMarcada = $horaMarcada;
                    $asistenciaFalta->ID_Empleado = $empleado->ID_Usuario;
                    $asistenciaFalta->FaltaInjustificada = true;
                    $asistenciaFalta->save();
                }

                return response()->json(['message' => 'Asistencia registrada correctamente.'], 200);
            } else {
                return response()->json(['error' => 'No se encontró un horario asignado para este día de trabajo.'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al guardar la asistencia: ' . $e->getMessage()], 500);
        }
    }

    public function verificarFaltasAutomaticas()
    {
        try {
            $fechaActual = Carbon::now();
            $fechaAjustada = $fechaActual->copy()->subHours(4);
            $empleados = Empleado::all();

            foreach ($empleados as $empleado) {
                $numeroDiaSemana = $fechaAjustada->dayOfWeek;
                $idDiaTrabajo = $numeroDiaSemana + 1;
                $diaTrabajo = DiaTrabajo::where('id', $idDiaTrabajo)->first();

                if ($diaTrabajo) {
                    $horarioEmpleado = Horario_Empleado::where('ID_Empleado', $empleado->ID_Usuario)
                        ->whereHas('dia_horario_empleado', function ($query) use ($idDiaTrabajo) {
                            $query->where('ID_DiaTrabajo', $idDiaTrabajo);
                        })
                        ->first();

                    if ($horarioEmpleado) {
                        $horario = $horarioEmpleado->Horario;
                        $horaFin = Carbon::createFromTimeString($horario->HoraFin);
                        $fechaMarcada = $fechaAjustada->toDateString();
                        $horaMarcada = $fechaAjustada->toTimeString();
                        $asistenciaExistente = Asistencia::where('ID_Empleado', $empleado->ID_Usuario)
                            ->whereDate('FechaMarcada', $fechaMarcada)
                            ->exists();

                        if (!$asistenciaExistente && $fechaAjustada->gte($horaFin)) {
                            $asistencia = new Asistencia();
                            $asistencia->FechaMarcada = $fechaMarcada;
                            $asistencia->HoraMarcada = $horaMarcada;
                            $asistencia->ID_Empleado = $empleado->ID_Usuario;
                            $asistencia->FaltaInjustificada = true;
                            $asistencia->save();

                            $diaAsistencia = new Dia_Asistencia();
                            $diaAsistencia->ID_Asistencia = $asistencia->id;
                            $diaAsistencia->ID_Dia_Horario_Empleado = $horarioEmpleado->dia_horario_empleado->id;
                            $diaAsistencia->save();
                        }
                    }
                }
            }

            return response()->json(['message' => 'Verificación de faltas automáticas realizada correctamente.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al verificar faltas automáticas: ' . $e->getMessage()], 500);
        }
    }
}
