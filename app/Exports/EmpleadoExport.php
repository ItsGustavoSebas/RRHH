<?php

namespace App\Exports;

use App\Models\Empleado;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmpleadoExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $empleados;

    public function __construct($empleados)
    {
        $this->empleados = $empleados;
    }

    public function collection()
    {
       return $this->empleados->map(function ($empleado) {
            return [
                'ID_Usuario' => $empleado->ID_Usuario,
                'name' => $empleado->usuario->name,
                'email' => $empleado->usuario->email,
                'ci' => $empleado->usuario->ci,
                'telefono' => $empleado->usuario->telefono,
                'direccion' => $empleado->usuario->direccion,
                'genero' => $empleado->genero,
                'estadocivil' => $empleado->estadocivil,
                'fechanac' => $empleado->fechanac,
                'Cargo' => $empleado->cargo ? $empleado->cargo->nombre : '', // Verifica si el cargo está presente
                'Departamento' => $empleado->departamento ? $empleado->departamento->nombre : '', // Verifica si el departamento está presente
            ];
        });
    }
    public function headings(): array
    {
        return [
            'ID_Usuario',
            'Nombre',
            'Email',
            'CI',
            'Telefono',
            'Direccion',
            'Género',
            'Estado Civil',
            'Fecha de Nacimiento',
            'Cargo',
            'Departamento',
        ];
    }
}
