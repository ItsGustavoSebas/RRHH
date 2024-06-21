<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Dias_Festivos_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $diasFestivos = [
            [
                'fecha' => '2024-05-01',
                'descripcion' => 'Día del Trabajo',
            ],
            [
                'fecha' => '2024-06-19',
                'descripcion' => 'Corpus Christi',
            ],
            [
                'fecha' => '2024-06-21',
                'descripcion' => 'Año Nuevo Aymara',
            ],
            [
                'fecha' => '2024-08-06',
                'descripcion' => 'Día de la Independencia',
            ],
            [
                'fecha' => '2024-09-24',
                'descripcion' => 'Día de Santa Cruz',
            ],
            [
                'fecha' => '2025-09-24',
                'descripcion' => 'Día de Santa Cruz',
            ],
            [
                'fecha' => '2024-11-02',
                'descripcion' => 'Día de los muertos',
            ],
            [
                'fecha' => '2024-12-25',
                'descripcion' => 'Navidad',
            ],
            [
                'fecha' => '2025-01-01',
                'descripcion' => 'Año Nuevo',
            ],
            [
                'fecha' => '2025-01-22',
                'descripcion' => 'Día del Estado Plurinacional',
            ],
            [
                'fecha' => '2025-03-03',
                'descripcion' => 'Carnaval',
            ],
            [
                'fecha' => '2025-03-04',
                'descripcion' => 'Carnaval',
            ],
            [
                'fecha' => '2025-04-18',
                'descripcion' => 'Viernes Santo',
            ],
            [
                'fecha' => '2025-05-01',
                'descripcion' => 'Día del Trabajo',
            ],
            [
                'fecha' => '2025-06-19',
                'descripcion' => 'Corpus Christi',
            ],
            [
                'fecha' => '2025-06-21',
                'descripcion' => 'Año Nuevo Aymara',
            ],
            [
                'fecha' => '2025-08-06',
                'descripcion' => 'Día de la Independencia',
            ],
            [
                'fecha' => '2025-11-02',
                'descripcion' => 'Día de Todos los Difuntos',
            ],
            [
                'fecha' => '2025-11-03',
                'descripcion' => 'Vacaciones de Día de Todos los Difuntos',
            ],
            [
                'fecha' => '2025-12-25',
                'descripcion' => 'Navidad',
            ],
        ];

        DB::table('dias_festivos')->insert($diasFestivos);
    }
}
