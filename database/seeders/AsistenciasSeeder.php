<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Asistencia;
use App\Models\Empleado;
use Carbon\Carbon;

class AsistenciasSeeder extends Seeder
{
    public function run()
    {
        $empleados = Empleado::with(['horario_empleado.Horario', 'horario_empleado.dia_horario_empleado.DiaTrabajo'])
            ->whereIn('ID_Usuario', [1, 2, 3, 4])
            ->get();

        $fechaInicio = Carbon::parse('2024-05-01');
        $fechaFin = Carbon::parse('2024-5-30');
        $diasSemana = [
            'Monday' => 'Lunes',
            'Tuesday' => 'Martes',
            'Wednesday' => 'Miércoles',
            'Thursday' => 'Jueves',
            'Friday' => 'Viernes'
        ];

        foreach ($empleados as $empleado) {
            foreach ($empleado->horario_empleado as $horarioEmpleado) {
                $diaTrabajo = $horarioEmpleado->dia_horario_empleado->DiaTrabajo->Nombre;
                $horaInicio = $horarioEmpleado->Horario->HoraInicio;
                $horaFin = $horarioEmpleado->Horario->HoraFin;

                for ($date = $fechaInicio->copy(); $date->lte($fechaFin); $date->addDay()) {
                    if (isset($diasSemana[$date->englishDayOfWeek]) && $diasSemana[$date->englishDayOfWeek] == $diaTrabajo) {
                        $puntual = false;
                        $atraso = false;
                        $faltaInjustificada = false;
                        $faltaJustificada = false;

                        $probabilidad = rand(1, 100); 

                        if ($probabilidad <= 80) { // 80% de probabilidad para llegar entre 7:00-7:05
                            $horaMarcada = Carbon::parse($date->toDateString() . ' ' . $horaInicio)
                                ->addMinutes(rand(0, 5))
                                ->toTimeString();
                            $puntual = true;
                        } elseif ($probabilidad > 80 && $probabilidad <= 95) { // 15% de probabilidad para llegar entre 7:05-7:29
                            $horaMarcada = Carbon::parse($date->toDateString() . ' ' . $horaInicio)
                                ->addMinutes(rand(6, 29))
                                ->toTimeString();
                            $atraso = true;
                        } else { // 5% de probabilidad para llegar después de las 7:30
                            $horaMarcada = Carbon::parse($date->toDateString() . ' ' . $horaInicio)
                                ->addMinutes(rand(30, 180))
                                ->toTimeString();
                            $faltaInjustificada = true;
                        }

 
                        if (rand(0, 9) < 1) { // Aproximadamente 10% de probabilidades
                            $faltaJustificada = true;
                            $puntual = $atraso = $faltaInjustificada = false; 
                        }

                        // Crear el registro de asistencia
                        Asistencia::create([
                            'FechaMarcada' => $date->toDateString(),
                            'HoraMarcada' => $horaMarcada,
                            'Puntual' => $puntual,
                            'Atraso' => $atraso,
                            'FaltaInjustificada' => $faltaInjustificada,
                            'FaltaJustificada' => $faltaJustificada,
                            'ID_Empleado' => $empleado->ID_Usuario,
                            'horaFin' => $horaFin,
                        ]);
                    }
                }
            }
        }
    }
}
