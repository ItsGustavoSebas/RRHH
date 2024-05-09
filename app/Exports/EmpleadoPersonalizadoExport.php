<?php

namespace App\Exports;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Facades\Excel;

class EmpleadoPersonalizadoExport implements FromCollection, WithHeadings
{
    protected $columnase;
    protected $columnasu;
    protected $empleados;

    public function __construct($columnase,$columnasu,$empleados)
    {
        $this->columnase = $columnase;
        $this->columnasu = $columnasu;
        $this->empleados = $empleados;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->empleados->map(function ($empleado) {
            $datosEmpleado = [];
            foreach ($this->columnasu as $columna) {
                            $datosEmpleado[$columna] = $empleado->usuario->{$columna};
                        }
            foreach ($this->columnase as $columna) {
                if ($columna === 'ID_Cargo') {
                    $datosEmpleado['Cargo'] = $empleado->cargo ? $empleado->cargo->nombre : '';
                }
                elseif ($columna === 'ID_Departamento') {
                    $datosEmpleado['Departamento'] = $empleado->departamento ? $empleado->departamento->nombre : '';
                }
                else {
                    $datosEmpleado[$columna] = $empleado->{$columna};
                }
            }
            return $datosEmpleado;
        });
    }

    public function headings(): array
    {
        $headings = [];
        foreach ($this->columnasu as $columna) {
            $headings[] = ucfirst($columna);
        }
        foreach ($this->columnase as $columna) {
            if ($columna === 'ID_Cargo') {
                $headings[] = 'Cargo';
            }
            elseif ($columna === 'ID_Departamento') {
                $headings[] = 'Departamento';
            }
            else {
                $headings[] = ucfirst($columna);
            }
        }
        return $headings;
    }
}

