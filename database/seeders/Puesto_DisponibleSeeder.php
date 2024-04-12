<?php

namespace Database\Seeders;

use App\Models\Puesto_Disponible;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Puesto_DisponibleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Puesto_Disponible::create([
            'nombre' => 'Limpiador'
        ]);

        Puesto_Disponible::create([
            'nombre' => 'Atención al cliente'
        ]);
        

        Puesto_Disponible::create([
            'nombre' => 'Cocinero'
        ]);


    }
}
