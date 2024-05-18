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
        $diaTrabajoActual = DiaTrabajo::where('id', $idDiaTrabajo)->first();
        
        $diasTrabajo = $empleado->horario_empleado;
        
        return view('asistencias.marcar', compact('usuario', 'empleado', 'diasTrabajo', 'diaTrabajoActual'));
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

                // Obtener la fecha actual
                $fechaActual = Carbon::now();

                // Verificar si el empleado marcó asistencia en este día
                $asistenciaExistente = Asistencia::where('ID_Empleado', $empleado->ID_Usuario)
                    ->whereDate('FechaMarcada', $fechaActual->toDateString())
                    ->first();

                if (!$asistenciaExistente) {
                    // Crear una nueva asistencia
                    $asistencia = new Asistencia();
                    $asistencia->FechaMarcada = $fechaActual;
                    $asistencia->ID_Empleado = $empleado->ID_Usuario;

                    // Verificar si el empleado es puntual
                    if ($fechaActual->gte(Carbon::createFromTimeString($horario->HoraInicio)) &&
                        $fechaActual->lt(Carbon::createFromTimeString($horario->HoraLimite))) {
                        $asistencia->Puntual = true;
                    }

                    // Verificar si el empleado tiene atraso
                    if ($fechaActual->gte(Carbon::createFromTimeString($horario->HoraLimite)) &&
                        $fechaActual->lt(Carbon::createFromTimeString($horario->HoraFin))) {
                        $asistencia->Atraso = true;
                    }

                    // Verificar si el empleado tiene falta injustificada
                    if ($fechaActual->gte(Carbon::createFromTimeString($horario->HoraFin))) {
                        $asistencia->FaltaInjustificada = true;
                    }

                    // Guardar la asistencia
                    $asistencia->save();

                    // Crear el registro en la tabla Dia_Asistencia
                    $diaAsistencia = new Dia_Asistencia();
                    $diaAsistencia->ID_Asistencia = $asistencia->id;
                    $diaAsistencia->ID_Dia_Horario_Empleado = $horarioEmpleado->dia_horario_empleado->id;
                    $diaAsistencia->save();
                }
            }

            return redirect()->route('dashboard')->with('creado', 'Asistencia registrada correctamente.');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al guardar la asistencia: ' . $e->getMessage()], 500);
        }
    }

    public function historial($idEmpleado)
    {
        try {
            // Buscar al empleado por su ID
            $empleado = Empleado::findOrFail($idEmpleado);
            
            // Obtener el historial de asistencia del empleado
            $historialAsistencia = Asistencia::where('ID_Empleado', $empleado->ID_Usuario)->orderBy('FechaMarcada', 'desc')->get();
            
            // Devolver la vista con los datos del historial de asistencia
            return view('asistencias.historial', compact('empleado', 'historialAsistencia'));
        } catch (\Exception $e) {
            // Manejar cualquier error y devolver una respuesta de error
            return response()->json(['error' => 'Error al obtener el historial de asistencia: ' . $e->getMessage()], 500);
        }
    }

}
