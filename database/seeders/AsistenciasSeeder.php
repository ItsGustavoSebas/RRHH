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

        $fechaInicio = Carbon::parse('2024-05-20');
        $fechaFin = Carbon::parse('2024-06-20');
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
                            Asistencia::create([
                                'FechaMarcada' => $date->toDateString(),
                                'HoraMarcada' => $horaInicio,
                                'Puntual' => true,
                                'Atraso' => false,
                                'FaltaInjustificada' => false,
                                'FaltaJustificada' => false,
                                'ID_Empleado' => $empleado->ID_Usuario,
                                'horaFin' => $horaFin,
                            ]);
                        }
                    }
                
            }
        }
    }
}
