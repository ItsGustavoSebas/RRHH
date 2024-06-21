<?php

namespace Database\Seeders;

use App\Models\Asistencia;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AsistenciaSeeder extends Seeder
{
    public function run()
    {
        $fechaInicio = Carbon::parse('2024-05-01');
    
        for ($i = 0; $i < 20; $i++) {
            // Fecha de asistencia incrementada por el valor de $i días
            $fechaAsistencia = $fechaInicio->copy()->addDays($i)->toDateString();
        
            // Determinar el rango de minutos dentro de la franja horaria deseada
            $minutosDesdeInicio = 0;
            $minutosHastaFin = 40;
            
            // Generar una hora marcada aleatoria entre 07:00 y 10:00
            $horaMarcada = Carbon::parse($fechaAsistencia . ' 07:00')
                            ->addMinutes(rand($minutosDesdeInicio, $minutosHastaFin))
                            ->toTimeString();
        
            // Inicializar los valores de las asistencias
            $puntual = false;
            $atraso = false;
            $faltaInjustificada = false;
            $faltaJustificada = false;
        
            // Determinar los valores de las asistencias según la hora marcada
            $probabilidad = rand(1, 100); // Generar un número aleatorio entre 1 y 100
        
            if ($probabilidad <= 80) { // 80% de probabilidad para llegar entre 7:00-7:05
                $horaMarcada = Carbon::parse($fechaAsistencia . ' 07:00')
                                ->addMinutes(rand(0, 5))
                                ->toTimeString();
                $puntual = true;
            } elseif ($probabilidad > 80 && $probabilidad <= 95) { // 15% de probabilidad para llegar entre 7:05-7:29
                $horaMarcada = Carbon::parse($fechaAsistencia . ' 07:00')
                                ->addMinutes(rand(6, 29))
                                ->toTimeString();
                $atraso = true;
            } else { // 5% de probabilidad para llegar después de las 7:30
                $horaMarcada = Carbon::parse($fechaAsistencia . ' 07:00')
                                ->addMinutes(rand(30, 180))
                                ->toTimeString();
                $faltaInjustificada = true;
            }
        
            // Opcional: Añadir algunas faltas justificadas aleatoriamente
            if (rand(0, 9) < 0.5) { // Aproximadamente 0.5% de probabilidades
                $faltaJustificada = true;
                $puntual = $atraso = $faltaInjustificada = false; // Priorizar falta justificada
            }
        
            // Crear el registro de asistencia
            Asistencia::create([
                'FechaMarcada' => $fechaAsistencia,
                'HoraMarcada' => $horaMarcada,
                'Puntual' => $puntual,
                'Atraso' => $atraso,
                'FaltaInjustificada' => $faltaInjustificada,
                'FaltaJustificada' => $faltaJustificada,
                'ID_Empleado' => 3
            ]);
        }

        for ($i = 0; $i < 20; $i++) {
            // Fecha de asistencia incrementada por el valor de $i días
            $fechaAsistencia = $fechaInicio->copy()->addDays($i)->toDateString();
        
            // Determinar el rango de minutos dentro de la franja horaria deseada
            $minutosDesdeInicio = 0;
            $minutosHastaFin = 40;
            
            // Generar una hora marcada aleatoria entre 07:00 y 10:00
            $horaMarcada = Carbon::parse($fechaAsistencia . ' 07:00')
                            ->addMinutes(rand($minutosDesdeInicio, $minutosHastaFin))
                            ->toTimeString();
        
            // Inicializar los valores de las asistencias
            $puntual = false;
            $atraso = false;
            $faltaInjustificada = false;
            $faltaJustificada = false;
        
            // Determinar los valores de las asistencias según la hora marcada
            $probabilidad = rand(1, 100); // Generar un número aleatorio entre 1 y 100
        
            if ($probabilidad <= 60) { // 60% de probabilidad para llegar entre 7:00-7:05
                $horaMarcada = Carbon::parse($fechaAsistencia . ' 07:00')
                                ->addMinutes(rand(0, 5))
                                ->toTimeString();
                $puntual = true;
            } elseif ($probabilidad > 60 && $probabilidad <= 90) { // 30% de probabilidad para llegar entre 7:05-7:29
                $horaMarcada = Carbon::parse($fechaAsistencia . ' 07:00')
                                ->addMinutes(rand(6, 29))
                                ->toTimeString();
                $atraso = true;
            } else { // 10% de probabilidad para llegar después de las 7:30
                $horaMarcada = Carbon::parse($fechaAsistencia . ' 07:00')
                                ->addMinutes(rand(30, 180))
                                ->toTimeString();
                $faltaInjustificada = true;
            }
        
            // Opcional: Añadir algunas faltas justificadas aleatoriamente
            if (rand(0, 9) < 1) { // Aproximadamente 20% de probabilidades
                $faltaJustificada = true;
                $puntual = $atraso = $faltaInjustificada = false; // Priorizar falta justificada
            }
        
            // Crear el registro de asistencia
            Asistencia::create([
                'FechaMarcada' => $fechaAsistencia,
                'HoraMarcada' => $horaMarcada,
                'Puntual' => $puntual,
                'Atraso' => $atraso,
                'FaltaInjustificada' => $faltaInjustificada,
                'FaltaJustificada' => $faltaJustificada,
                'ID_Empleado' => 4
            ]);
        }
    }
    
}
