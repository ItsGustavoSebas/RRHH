<?php

namespace App\Exports;

use App\Models\Postulante;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PostulanteExport implements FromCollection, WithHeadings
{
    protected $postulantes;

    public function __construct($postulantes)
    {
        $this->postulantes = $postulantes;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->postulantes->map(function ($postulante) {
            return [
                'ID_Usuario' => $postulante->ID_Usuario,
                'name' => $postulante->usuario->name,
                'email' => $postulante->usuario->email,
                'ci' => $postulante->usuario->ci,
                'telefono' => $postulante->usuario->telefono,
                'direccion' => $postulante->usuario->direccion,
                'fecha_de_nacimiento' => $postulante->fecha_de_nacimiento,
                'nacionalidad' => $postulante->nacionalidad,
                'habilidades' => $postulante->habilidades,
                'puntos' => $postulante->puntos,
                'Fuente_De_Contratacion' => $postulante->fuente_de_contratacion ? $postulante->fuente_de_contratacion->nombre : '',
                'Puesto_Disponible' => $postulante->puesto_disponible ? $postulante->puesto_disponible->nombre : '',
                'Idioma' => $postulante->idioma ? $postulante->idioma->nombre : '',
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
            'Fecha de Nacimiento',
            'Nacionalidad',
            'Habilidades',
            'Puntos',
            'Fuente_De_Contratacion',
            'Puesto_Disponible',
            'Idioma',
        ];
    }
}


