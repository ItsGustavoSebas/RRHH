<?php

namespace Database\Seeders;

use App\Models\Departamento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Departamento::create([
            'nombre' => 'Ventas',
        ]);

        Departamento::create([
            'nombre' => 'Recursos Humanos',
        ]);

        Departamento::create([
            'nombre' => 'Finanzas',
        ]);
    }
}
