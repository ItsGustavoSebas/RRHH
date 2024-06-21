<?php

namespace App\Http\Controllers;

use App\Exports\SueldosExport;
use App\Models\Asistencia;
use App\Models\Empleado;
use App\Models\Dias_Festivos;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use Maatwebsite\Excel\Facades\Excel;

class SueldoController extends Controller
{
    public function inicio1()
    {
        return view('sueldosfechas');
    }

    public function inicio(Request $request)
    {
        $fechaInicio = Carbon::parse($request->input('fecha_inicio'))->startOfDay();
        $fechaFin = Carbon::parse($request->input('fecha_fin'))->endOfDay();
        // Obtener días festivos
        $diasFestivos = Dias_Festivos::whereBetween('fecha', [$fechaInicio, $fechaFin])->pluck('fecha')->toArray();
        $empleados = Empleado::with([
            'usuario',
            'asistencias' => function ($query) use ($fechaInicio, $fechaFin, $diasFestivos) {
                $query->whereBetween('FechaMarcada', [$fechaInicio->toDateString(), $fechaFin->toDateString()])
                    ->whereNotIn('FechaMarcada', $diasFestivos);
            },
            'sueldo',
            'horario_empleado.Horario',
            'horario_empleado.dia_horario_empleado.DiaTrabajo'
        ])->get();

        $smn = 2500; // Salario mínimo nacional
        $bonoAntiguedadPorcentajes = [
            [0, 2, 0],
            [2, 5, 5],
            [5, 8, 11],
            [8, 11, 18],
            [11, 15, 26],
            [15, 20, 34],
            [20, 25, 42],
            [25, PHP_INT_MAX, 50]
        ];

        $empleadosCalculados = [];

        foreach ($empleados as $empleado) {
            // Calcular días trabajados
            $diasTrabajados = $empleado->asistencias->filter(function ($asistencia) {
                return $asistencia->Puntual || $asistencia->Atraso || $asistencia->FaltaJustificada;
            })->count();

            // Calcular haber básico
            $haberBasico = ($empleado->sueldo->sueldo_basico / $empleado->sueldo->dias_pagados) * $diasTrabajados;

            // Calcular bono antigüedad
            $antiguedadAnios = $empleado->created_at->diffInYears($fechaFin);
            $bonoAntiguedad = $this->calcularBonoAntiguedad($antiguedadAnios, $bonoAntiguedadPorcentajes, $smn);

            // Calcular dominical y festivos trabajados
            $dominical_feriado = $this->calcularDominicalYFestivos($empleado, $fechaInicio, $fechaFin, $diasFestivos);

            // Calcular horas extras
            $horasExtras = $this->calcularHorasExtras($empleado, $fechaInicio, $fechaFin);

            // Calcular pago por hora
            $pagoPorHora = $empleado->sueldo->sueldo_basico / $empleado->sueldo->dias_pagados / $empleado->sueldo->horas_diarias;

            // Calcular pago por horas extras
            $pagoPorHorasExtras = $horasExtras * $pagoPorHora * 2;

            // Calcular pago dominical y feriado
            $pagoDominicalYFeriado = ($empleado->sueldo->sueldo_basico / $empleado->sueldo->dias_pagados) * $dominical_feriado * 3;

            // Calcular total ganado
            $totalGanado = $haberBasico + $bonoAntiguedad + $pagoPorHorasExtras + $pagoDominicalYFeriado;

            // Asignar variables calculadas al empleado
            $empleadosCalculados[] = [
                'empleado' => $empleado,
                'dias_trabajados' => $diasTrabajados,
                'haber_basico' => $haberBasico,
                'bono_antiguedad' => $bonoAntiguedad,
                'dominical_feriado' => $dominical_feriado,
                'horas_extras' => $horasExtras,
                'pago_por_hora' => $pagoPorHora,
                'pago_por_horas_extras' => $pagoPorHorasExtras,
                'pago_dominical_feriado' => $pagoDominicalYFeriado,
                'total_ganado' => $totalGanado,
            ];
        }

        return view('sueldos', [
            'empleadosCalculados' => $empleadosCalculados
        ]);
    }

    public function descargarPdf(Request $request)
    {
        $empleadosCalculados = $this->inicio($request)->getData()['empleadosCalculados'];
        $pdf = Pdf::loadView('PDF.sueldos', compact('empleadosCalculados'))->setPaper('a4', 'landscape');
        return $pdf->download('sueldos.pdf');
    }
    

    public function descargarExcel(Request $request)
{
    $empleadosCalculados = $this->inicio($request)->getData()['empleadosCalculados'];
    return Excel::download(new SueldosExport($empleadosCalculados), 'sueldos.xlsx');
}




    private function calcularBonoAntiguedad($antiguedadAnios, $bonoAntiguedadPorcentajes, $smn)
    {
        foreach ($bonoAntiguedadPorcentajes as $rango) {
            if ($antiguedadAnios >= $rango[0] && $antiguedadAnios < $rango[1]) {
                return ($rango[2] / 100) * 3 * $smn;
            }
        }
        return 0;
    }

    private function calcularDominicalYFestivos($empleado, $fechaInicio, $fechaFin, $diasFestivos)
    {
        $diasTrabajados = collect();
        foreach ($empleado->asistencias as $asistencia) {
            $fechaAsistencia = Carbon::parse($asistencia->FechaMarcada);
            if ($fechaAsistencia->between($fechaInicio, $fechaFin)) {
                if ($fechaAsistencia->isSunday() || in_array($fechaAsistencia->toDateString(), $diasFestivos)) {
                    $diasTrabajados->push($fechaAsistencia);
                }
            }
        }
        return $diasTrabajados->count();
    }


    private function calcularHorasExtras($empleado, $fechaInicio, $fechaFin)
    {
        $horasExtras = 0;
        foreach ($empleado->asistencias as $asistencia) {
            $fechaAsistencia = Carbon::parse($asistencia->FechaMarcada);
            if ($fechaAsistencia->between($fechaInicio->toDateString(), $fechaFin->toDateString())) {
                $horaInicio = Carbon::parse($asistencia->HoraMarcada);
                $horaFin = Carbon::parse($asistencia->horaFin);
                $minutosTrabajados = $horaFin->diffInMinutes($horaInicio);
                $horasTrabajadas = $minutosTrabajados / 60; // Convertir minutos a horas decimales
                if ($horasTrabajadas > $empleado->sueldo->horas_diarias) {
                    $horasExtras += $horasTrabajadas - $empleado->sueldo->horas_diarias;
                }
            }
        }
        return round($horasExtras, 2); // Redondear a 2 decimales
    }
}
