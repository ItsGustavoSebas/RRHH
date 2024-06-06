<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Dia_Asistencia;
use App\Models\DiaTrabajo;
use App\Models\Empleado;
use App\Models\Horario_Empleado;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsistenciaController extends Controller
{
    public function marcar($id)
    {
        $usuario = User::where('id', '=', $id)->first();
        $empleado = Empleado::where('ID_Usuario', '=', $id)->with('usuario')->first();
        
        // Obtener el día actual de la semana (0 para domingo, 1 para lunes, ...)
        $numeroDiaSemana = Carbon::now()->dayOfWeek;

        // El ID del DiaTrabajo corresponde al número del día de la semana + 1
        // ya que en la tabla el ID 1 es domingo, ID 2 es lunes, etc.
        $idDiaTrabajo = $numeroDiaSemana + 1;

        // Buscar el DiaTrabajo correspondiente al día actual de la semana
        
        
        $diasTrabajo = $empleado->horario_empleado;

        // Obtener la fecha y hora actuales
        $fechaActual = Carbon::now();
        // Restar 4 horas a la hora actual
        $fechaAjustada = $fechaActual->copy()->subHours(4);

        $fecha = $fechaAjustada->hour;

        // Ajustar la fecha si la hora ajustada cae en el día anterior
        if ($fechaAjustada->hour > $fechaActual->hour) {
            $idDiaTrabajo = $idDiaTrabajo-1;
            $diaTrabajoActual = DiaTrabajo::where('id', $idDiaTrabajo)->first();
            $fechaMarcada = $fechaAjustada->copy()->subDay()->toDateString();
        } else {
            $diaTrabajoActual = DiaTrabajo::where('id', $idDiaTrabajo)->first();
            $fechaMarcada = $fechaAjustada->toDateString();
        }

        // Verificar si el empleado ya marcó asistencia en la fecha ajustada
        $asistenciaExistente = Asistencia::where('ID_Empleado', $empleado->ID_Usuario)
            ->whereDate('FechaMarcada', $fechaMarcada)
            ->exists();

        // Variable booleana para verificar si ya existe la asistencia
        $asistenciaYaExiste = $asistenciaExistente ? true : false;

        

        return view('asistencias.marcar', compact('usuario', 'empleado', 'diasTrabajo', 'diaTrabajoActual', 'asistenciaYaExiste'));
    }



    public function guardarAsistencias($idEmpleado, $idDiaTrabajo)
    {
        try {
            // Obtener el empleado
            $empleado = Empleado::findOrFail($idEmpleado);
            
            // Obtener el día de trabajo
            $diaTrabajo = DiaTrabajo::findOrFail($idDiaTrabajo);

            // Verificar si el día de trabajo tiene un horario asignado para el empleado
            $horarioEmpleado = Horario_Empleado::where('ID_Empleado', $empleado->ID_Usuario)
                ->whereHas('dia_horario_empleado', function ($query) use ($idDiaTrabajo) {
                    $query->where('ID_DiaTrabajo', $idDiaTrabajo);
                })
                ->first();

            if ($horarioEmpleado) {
                // Obtener el horario asociado al día de trabajo
                $horario = $horarioEmpleado->Horario;

                // Obtener la fecha y hora actuales
                $fechaActual = Carbon::now();
                // Restar 4 horas a la hora actual
                $fechaAjustada = $fechaActual->copy()->subHours(4);

                // Ajustar la fecha si la hora ajustada cae en el día anterior
                $fechaMarcada = $fechaAjustada->toDateString();
                $horaMarcada = $fechaAjustada->toTimeString();

                // Verificar si el empleado ya marcó asistencia en la fecha ajustada
                $asistenciaExistente = Asistencia::where('ID_Empleado', $empleado->ID_Usuario)
                    ->whereDate('FechaMarcada', $fechaMarcada)
                    ->exists();

                // Variable booleana para verificar si ya existe la asistencia
                $asistenciaYaExiste = $asistenciaExistente ? true : false;

                // Verificar los tiempos de acuerdo al horario
                $horaInicio = Carbon::createFromTimeString($horario->HoraInicio);
                $horaLimite = Carbon::createFromTimeString($horario->HoraLimite);
                $horaFin = Carbon::createFromTimeString($horario->HoraFin);

                if (!$asistenciaYaExiste) {
                    // Crear una nueva asistencia
                    $asistencia = new Asistencia();
                    $asistencia->FechaMarcada = $fechaMarcada;
                    $asistencia->HoraMarcada = $horaMarcada;
                    $asistencia->ID_Empleado = $empleado->ID_Usuario;


                    // Verificar si el empleado es puntual
                    if ($fechaAjustada->between($horaInicio, $horaLimite)) {
                        $asistencia->Puntual = true;
                    }

                    // Verificar si el empleado tiene atraso
                    if ($fechaAjustada->between($horaLimite, $horaFin)) {
                        $asistencia->Atraso = true;
                    }

                    // Verificar si el empleado tiene falta injustificada
                    if ($fechaAjustada->gte($horaFin)) {
                        $asistencia->FaltaInjustificada = true;
                    }

                    // Guardar la asistencia
                    $asistencia->save();

                    // Crear el registro en la tabla Dia_Asistencia
                    $diaAsistencia = new Dia_Asistencia();
                    $diaAsistencia->ID_Asistencia = $asistencia->id;
                    $diaAsistencia->ID_Dia_Horario_Empleado = $horarioEmpleado->dia_horario_empleado->id;
                    $diaAsistencia->save();
                } elseif ($horaMarcada >= $horaFin && !$asistenciaYaExiste) {
                    // Si no se ha registrado asistencia y la hora marcada es igual o mayor que la hora de fin, registrar como falta injustificada
                    $asistenciaFalta = new Asistencia();
                    $asistenciaFalta->FechaMarcada = $fechaMarcada;
                    $asistenciaFalta->HoraMarcada = $horaMarcada;
                    $asistenciaFalta->ID_Empleado = $empleado->ID_Usuario;
                    $asistenciaFalta->FaltaInjustificada = true;
                    $asistenciaFalta->save();
                }

                return redirect()->route('dashboard')->with('creado', 'Asistencia registrada correctamente.');
            } else {
                return redirect()->route('dashboard')->with('error', 'No se encontró un horario asignado para este día de trabajo.');
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al guardar la asistencia: ' . $e->getMessage()], 500);
        }
    }

    public function verificarFaltasAutomáticas()
    {
        try {
            // Obtener la fecha y hora actuales
            $fechaActual = Carbon::now();
            $fechaAjustada = $fechaActual->copy()->subHours(4);

            // Obtener todos los empleados
            $empleados = Empleado::all();

            foreach ($empleados as $empleado) {
                // Obtener el día actual de la semana (0 para domingo, 1 para lunes, ...)
                $numeroDiaSemana = $fechaAjustada->dayOfWeek;

                // El ID del DiaTrabajo corresponde al número del día de la semana + 1
                $idDiaTrabajo = $numeroDiaSemana + 1;

                // Buscar el DiaTrabajo correspondiente al día actual de la semana
                $diaTrabajo = DiaTrabajo::where('id', $idDiaTrabajo)->first();

                if ($diaTrabajo) {
                    // Verificar si el día de trabajo tiene un horario asignado para el empleado
                    $horarioEmpleado = Horario_Empleado::where('ID_Empleado', $empleado->ID_Usuario)
                        ->whereHas('dia_horario_empleado', function ($query) use ($idDiaTrabajo) {
                            $query->where('ID_DiaTrabajo', $idDiaTrabajo);
                        })
                        ->first();

                    if ($horarioEmpleado) {
                        // Obtener el horario asociado al día de trabajo
                        $horario = $horarioEmpleado->Horario;

                        $horaFin = Carbon::createFromTimeString($horario->HoraFin);

                        // Ajustar la fecha si la hora ajustada cae en el día anterior
                        $fechaMarcada = $fechaAjustada->toDateString();
                        $horaMarcada = $fechaAjustada->toTimeString();

                        // Verificar si el empleado ya marcó asistencia en la fecha ajustada
                        $asistenciaExistente = Asistencia::where('ID_Empleado', $empleado->ID_Usuario)
                            ->whereDate('FechaMarcada', $fechaMarcada)
                            ->exists();

                        if (!$asistenciaExistente && $fechaAjustada->gte($horaFin)) {
                            // Crear una nueva asistencia con falta injustificada
                            $asistencia = new Asistencia();
                            $asistencia->FechaMarcada = $fechaMarcada;
                            $asistencia->HoraMarcada = $horaMarcada;
                            $asistencia->ID_Empleado = $empleado->ID_Usuario;
                            $asistencia->FaltaInjustificada = true;

                            // Guardar la asistencia
                            $asistencia->save();

                            // Crear el registro en la tabla Dia_Asistencia
                            $diaAsistencia = new Dia_Asistencia();
                            $diaAsistencia->ID_Asistencia = $asistencia->id;
                            $diaAsistencia->ID_Dia_Horario_Empleado = $horarioEmpleado->dia_horario_empleado->id;
                            $diaAsistencia->save();
                        }
                    }
                }
            }

            return response()->json(['mensaje' => 'Verificación de faltas automáticas completada.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al verificar las faltas automáticas: ' . $e->getMessage()], 500);
        }
    }



}
