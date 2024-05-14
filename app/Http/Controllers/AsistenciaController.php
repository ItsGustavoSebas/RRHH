<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Empleado;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsistenciaController extends Controller
{
    public function verificarAsistencia($idEmpleado)
    {
        // Obtener el empleado
        $empleado = Empleado::findOrFail($idEmpleado);

        // Obtener los días de trabajo del empleado para el día actual
        $diaTrabajoActual = $empleado->diasTrabajo()->where('id', Carbon::now()->dayOfWeek)->first();

        // Si no hay día de trabajo para hoy, no hacer nada
        if (!$diaTrabajoActual) {
            return response()->json(['message' => 'No hay horario asignado para hoy.']);
        }

        // Obtener los horarios asignados para el día actual
        $horarios = $diaTrabajoActual->Horario_Empleados()->with('Horario')->get();

        // Si no hay horario asignado para hoy, no hacer nada
        if ($horarios->isEmpty()) {
            return response()->json(['message' => 'No hay horario asignado para hoy.']);
        }

        // Obtener la asistencia para hoy y este empleado
        $asistencia = $empleado->asistencias()->whereDate('FechaMarcada', Carbon::today())->first();

        // Si no hay asistencia para hoy, crear una nueva
        if (!$asistencia) {
            $asistencia = new Asistencia([
                'FechaMarcada' => Carbon::today(),
                'ID_Empleado' => $empleado->id,
            ]);
        }

        // Verificar el horario asignado
        foreach ($horarios as $horarioEmpleado) {
            $horaLimite = Carbon::parse($horarioEmpleado->Horario->HoraLimite);

            if (Carbon::now() >= $horaLimite) {
                // La hora actual es mayor o igual que la hora límite, marcar atraso
                $asistencia->Atraso = true;
                $asistencia->Puntual = false; // Asegurar que no se marque como puntual también
            } elseif (Carbon::now() < $horaLimite) {
                // La hora actual es menor que la hora límite, marcar puntual
                $asistencia->Puntual = true;
                $asistencia->Atraso = false; // Asegurar que no se marque como atraso también
            }
        }

        $asistencia->save();

        return redirect()->route('dashboard')->with('creado', 'Asistencia registrada correctamente.');
    }

    public function dashboard()
    {
        $asistenciaAsignada = Asistencia::where('ID_Empleado', Auth::user()->empleado->id)
            ->whereDate('FechaMarcada', Carbon::today())
            ->exists();

        return view('dashboard', compact('asistenciaAsignada'));
    }
}
