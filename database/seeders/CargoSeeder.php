<?php

namespace Database\Seeders;

use App\Models\Cargo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cargo::create([
            'nombre' => 'Representante de Ventas',
            'ID_Departamento' => '1'
        ]);

        Cargo::create([
            'nombre' => 'Director de Ventas',
            'ID_Departamento' => '1'
        ]);

        Cargo::create([
            'nombre' => 'Ejecutivo de Cuentas',
            'ID_Departamento' => '1'
        ]);

        Cargo::create([
            'nombre' => 'Especialista en Contratación',
            'ID_Departamento' => '2'
        ]);

        Cargo::create([
            'nombre' => 'Gerente de Recursos Humanos',
            'ID_Departamento' => '2'
        ]);

        Cargo::create([
            'nombre' => 'Analista Financiero',
            'ID_Departamento' => '3'
        ]);
    }
}
