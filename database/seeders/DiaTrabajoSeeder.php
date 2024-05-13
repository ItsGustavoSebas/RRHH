<?php

namespace Database\Seeders;

use App\Models\DiaTrabajo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiaTrabajoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DiaTrabajo::create([
            'Nombre' => 'Lunes',
        ]);
        DiaTrabajo::create([
            'Nombre' => 'Martes',
        ]);
        DiaTrabajo::create([
            'Nombre' => 'Miércoles',
        ]);
        DiaTrabajo::create([
            'Nombre' => 'Jueves',
        ]);
        DiaTrabajo::create([
            'Nombre' => 'Viernes',
        ]);
        DiaTrabajo::create([
            'Nombre' => 'Sábado',
        ]);
        DiaTrabajo::create([
            'Nombre' => 'Domingo',
        ]);
    }
}
