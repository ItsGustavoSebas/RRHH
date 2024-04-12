<?php

namespace Database\Seeders;

use App\Models\Idioma;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IdiomaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Idioma::create([
            'nombre' => 'Ingles'
        ]);

        Idioma::create([
            'nombre' => 'Frances'
        ]);
        

        Idioma::create([
            'nombre' => 'Portuges'
        ]);

        Idioma::create([
            'nombre' => 'Chino'
        ]);

        Idioma::create([
            'nombre' => 'Indio'
        ]);
    }
}
