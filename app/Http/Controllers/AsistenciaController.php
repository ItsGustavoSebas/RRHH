<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Calificacion_Empleado;
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
        $fechaAjustada = $fechaActual->copy()->subHours(0);
       // dd($fechaAjustada->hour);
      

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

    public function verificarFaltasAutomaticas()
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


    // //Vista Evaluacion
    // public function evaluarInicio(){

    //     // Obtener el mes actual
    //     $mesActual = Carbon::now()->format('m'); // Obtienes el número del mes (por ejemplo, '06' para junio)

    //     // Obtener todos los empleados registrados
    //     $empleados = Empleado::all();

    //     // Recorrer cada empleado
    //     foreach ($empleados as $empleado) {
    //         // Verificar si ya existe una calificación para este mes y este empleado
    //         $calificacionExistente = Calificacion_Empleado::where('mes', $mesActual)
    //             ->where('ID_Empleado', $empleado->ID_Usuario)
    //             ->first();

                
    //             // Obtener las asistencias del empleado
    //             $asistenciasEmpleado = Asistencia::where('ID_Empleado', $empleado->ID_Usuario)->get();

    //             $horario_empleado = Horario_Empleado::where('ID_Empleado', $empleado->ID_Usuario)->get();

    //             $cantidad = $horario_empleado->count();

    //             // Contadores para las asistencias
    //             $cantAsisPuntuales = 0;
    //             $cantAsisAtraso = 0;
    //             $cantFaltInjustificada = 0;
    //             $cantFaltaJustificada = 0;




    //             // Calcular las cantidades
    //             foreach ($asistenciasEmpleado as $asistencia) {
    //             if ($asistencia->Puntual) {
    //                $cantAsisPuntuales++;
    //             }
    //             if ($asistencia->Atraso) {
    //                $cantAsisAtraso++;
    //             }
    //             if ($asistencia->FaltaInjustificada) {
    //                $cantFaltInjustificada++;
    //             }
    //             if ($asistencia->FaltaJustificada) {
    //                $cantFaltaJustificada++;
    //             }
    //             }


    //             if ($cantidad > 0) {
    //                 // Porcentaje de asistencias puntuales
    //                 $porcentajePuntuales = ($cantAsisPuntuales / $cantidad) * 100;
    //                 // Porcentaje de asistencias con atraso
    //                 $porcentajeAtraso = ($cantAsisAtraso / $cantidad) * 100;
    //                 // Porcentaje de faltas injustificadas
    //                 $porcentajeFaltInjustificada = ($cantFaltInjustificada / $cantidad) * 100;
    //                 // Porcentaje de faltas justificadas
    //                 $porcentajeFaltaJustificada = ($cantFaltaJustificada / $cantidad) * 100;
                

    //                 $pesoPuntuales = 0.5;
    //                 $pesoAtraso = 0.3;
    //                 $pesoFaltInjustificada = 0.1;
    //                 $pesoFaltaJustificada = 0.1;
                
    //                 // Calcular el puntaje final
    //                 $puntaje = ($porcentajePuntuales * $pesoPuntuales) + 
    //                            ($porcentajeAtraso * $pesoAtraso) - 
    //                            ($porcentajeFaltInjustificada * $pesoFaltInjustificada) - 
    //                            ($porcentajeFaltaJustificada * $pesoFaltaJustificada);
                
    //                 // Asegurar que el puntaje esté dentro del rango [0, 100]
    //                 $puntaje = max(0, min(100, $puntaje));
    //             } else {
    //                 $puntaje = null; // Manejar caso donde no hay asistencias esperadas
    //             }    
                

    //         // Si no existe, crear una nueva calificación
    //         if (!$calificacionExistente) {
    //             $nuevaCalificacion = new Calificacion_Empleado([
    //                 'cantAsisTotalesEsperadas' => $cantidad,
    //                 'cantAsisPuntuales' => $cantAsisPuntuales,
    //                 'cantAsisAtraso' => $cantAsisAtraso,
    //                 'cantFaltInjustificada' => $cantFaltInjustificada,
    //                 'cantFaltaJustificada' => $cantFaltaJustificada,
    //                 'mes' => $mesActual,
    //                 'puntaje' => $puntaje, // Aquí debes calcular el puntaje según tus reglas de negocio
    //                 'ID_Empleado' => $empleado->ID_Usuario,
    //             ]);

    //             $nuevaCalificacion->save();

                

    
    //         }

            
    //     }

    //     $calificaciones_Empleados = Calificacion_Empleado::all();
    //     return view ('calificacionEmpleados.inicio', compact('calificaciones_Empleados'));

    // }



    public function evaluarInicio()
    {
        // Obtener el mes actual
        $mesActual = Carbon::now()->format('m');
        $anioActual = Carbon::now()->format('Y');
    
        // Obtener todos los empleados registrados
        $empleados = Empleado::all();
    
        foreach ($empleados as $empleado) {
            // Obtener las asistencias del empleado
            $asistenciasEmpleado = Asistencia::where('ID_Empleado', $empleado->ID_Usuario)->get();

            $horario_empleado = Horario_Empleado::where('ID_Empleado', $empleado->ID_Usuario)->get();

            $cantidad = $horario_empleado->count();

            $calificacionExistente = Calificacion_Empleado::where('mes', $mesActual)
            ->where('anio', $anioActual)
            ->where('ID_Empleado', $empleado->ID_Usuario)
            ->first();
    
            // Contadores para las asistencias
            $cantAsisPuntuales = 0;
            $cantAsisAtraso = 0;
            $cantFaltInjustificada = 0;
            $cantFaltaJustificada = 0;
    
            // Calcular las cantidades
            foreach ($asistenciasEmpleado as $asistencia) {
                if ($asistencia->Puntual) {
                    $cantAsisPuntuales++;
                }
                if ($asistencia->Atraso) {
                    $cantAsisAtraso++;
                }
                if ($asistencia->FaltaInjustificada) {
                    $cantFaltInjustificada++;
                }
                if ($asistencia->FaltaJustificada) {
                    $cantFaltaJustificada++;
                }
            }
    

            if ($cantidad > 0) {
                $porcentajePuntuales = ($cantAsisPuntuales / $cantidad) * 100;
                $porcentajeAtraso = ($cantAsisAtraso / $cantidad) * 100;
                $porcentajeFaltInjustificada = ($cantFaltInjustificada / $cantidad) * 100;
                $porcentajeFaltaJustificada = ($cantFaltaJustificada / $cantidad) * 100;
    
                $pesoPuntuales = 0.5;
                $pesoAtraso = 0.3;
                $pesoFaltInjustificada = 0.1;
                $pesoFaltaJustificada = 0.1;
    
                $puntaje = ($porcentajePuntuales * $pesoPuntuales) +
                           ($porcentajeAtraso * $pesoAtraso) -
                           ($porcentajeFaltInjustificada * $pesoFaltInjustificada) -
                           ($porcentajeFaltaJustificada * $pesoFaltaJustificada);
    
                $puntaje = max(0, min(100, $puntaje));
            } else {
                $puntaje = null; // Manejar caso donde no hay asistencias esperadas
            }
    
        // Si no existe, crear una nueva calificación
        if (!$calificacionExistente) {
            $nuevaCalificacion = new Calificacion_Empleado([
                'cantAsisTotalesEsperadas' => $cantidad,
                'cantAsisPuntuales' => $cantAsisPuntuales,
                'cantAsisAtraso' => $cantAsisAtraso,
                'cantFaltInjustificada' => $cantFaltInjustificada,
                'cantFaltaJustificada' => $cantFaltaJustificada,
                'mes' => $mesActual,
                'anio' => $anioActual,
                'puntaje' => $puntaje, // Aquí debes calcular el puntaje según tus reglas de negocio
                'ID_Empleado' => $empleado->ID_Usuario,
            ]);

            $nuevaCalificacion->save();
        } else {
            // Actualizar la calificación existente, excluyendo el campo 'mes'
            $calificacionExistente->update([
                'cantAsisTotalesEsperadas' => $cantidad,
                'cantAsisPuntuales' => $cantAsisPuntuales,
                'cantAsisAtraso' => $cantAsisAtraso,
                'cantFaltInjustificada' => $cantFaltInjustificada,
                'cantFaltaJustificada' => $cantFaltaJustificada,
                'puntaje' => $puntaje, 
            ]);
        }
        }

        // Obtener todas las calificaciones de empleados actualizadas
        $calificaciones_Empleados = Calificacion_Empleado::all();

        // Retornar la vista con las calificaciones actualizadas
        return view('asistencias.evaluarInicio', compact('calificaciones_Empleados'));
    
        
    }
    



}
