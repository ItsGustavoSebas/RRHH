<?php

namespace Database\Seeders;

use App\Models\Fuente_De_Contratacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Fuente_De_ContratacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fuente_De_Contratacion::create([
            'nombre' => 'Facebook'
        ]);

        Fuente_De_Contratacion::create([
            'nombre' => 'Whatsapp'
        ]);
        

        Fuente_De_Contratacion::create([
            'nombre' => 'Periodico'
        ]);

        Fuente_De_Contratacion::create([
            'nombre' => 'Eventos Sociales'
        ]);

        Fuente_De_Contratacion::create([
            'nombre' => 'Carteles'
        ]);
    }
}
