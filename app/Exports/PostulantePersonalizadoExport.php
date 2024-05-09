<?php

namespace App\Exports;

use App\Models\Postulante;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PostulantePersonalizadoExport implements FromCollection, WithHeadings
{
    protected $columnasp;
    protected $columnasu;
    protected $postulantes;

    public function __construct($columnasp,$columnasu,$postulantes)
    {
        $this->columnasp = $columnasp;
        $this->columnasu = $columnasu;
        $this->postulantes = $postulantes;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->postulantes->map(function ($postulante) {
            $datosPostulante = [];
            foreach ($this->columnasu as $columna) {
                            $datosPostulante[$columna] = $postulante->usuario->{$columna};
            }
            foreach ($this->columnasp as $columna) {
                if ($columna === 'ID_Fuente_De_Contratacion') {
                    $datosPostulante['Fuente'] = $postulante->fuente_de_contratacion ? $postulante->fuente_de_contratacion->nombre : '';
                }
                elseif ($columna === 'ID_Puesto_Disponible') {
                    $datosPostulante['Puesto_Disponible'] = $postulante->puesto_disponible ? $postulante->puesto_disponible->nombre : '';
                }
                elseif ($columna === 'ID_Idioma') {
                    $datosPostulante['Idioma'] = $postulante->idioma ? $postulante->idioma->nombre : '';
                }
                else {
                    $datosPostulante[$columna] = $postulante->{$columna};
                }
            }
            return $datosPostulante;
        });
    }

    public function headings(): array
    {
        $headings = [];
        foreach ($this->columnasu as $columna) {
            $headings[] = ucfirst($columna);
        }
        foreach ($this->columnasp as $columna) {
            if ($columna === 'ID_Fuente_De_Contratacion') {
                $headings[] = 'Fuente';
            }
            elseif ($columna === 'ID_Puesto_Disponible') {
                $headings[] = 'Puesto_Disponible';
            }
            elseif ($columna === 'ID_Idioma') {
                $headings[] = 'Idioma';
            }
            else {
                $headings[] = ucfirst($columna);
            }
        }
        return $headings;
    }
}
