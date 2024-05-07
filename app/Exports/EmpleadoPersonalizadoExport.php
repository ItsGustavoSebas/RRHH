<?php

namespace App\Exports;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Facades\Excel;

class EmpleadoPersonalizadoExport implements FromCollection, WithHeadings
{
    protected $columnasSeleccionadas;

    public function __construct($columnasSeleccionadas)
    {
        $this->columnasSeleccionadas = $columnasSeleccionadas;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Seleccionar solo las columnas especificadas
        return Empleado::select($this->columnasSeleccionadas)->get();
    }

    public function headings(): array
    {
        // Encabezados de las columnas basados en las columnas seleccionadas
        $headings = [];
        foreach ($this->columnasSeleccionadas as $columna) {
            // Aquí puedes modificar los nombres de las columnas si es necesario
            $headings[] = ucfirst($columna);
        }
        return $headings;
    }
}

