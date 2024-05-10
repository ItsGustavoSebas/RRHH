<?php

namespace Database\Seeders;

use App\Models\Nivel_Idioma;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Nivel_IdiomaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Nivel_Idioma::create([
            'categoria' => 'Basico'
        ]);

        Nivel_Idioma::create([
            'categoria' => 'Intermedio'
        ]);


        Nivel_Idioma::create([
            'categoria' => 'Avanzado'
        ]);

        Nivel_Idioma::create([
            'categoria' => 'Fluido'
        ]);

        Nivel_Idioma::create([
            'categoria' => 'Nativo'
        ]);
    }
}
