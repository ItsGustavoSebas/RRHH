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
            'nombre' => 'Limpiador',
            'informacion' => 'Encargado del aseo en la parte de las oficinas',
            'disponible' => 3
        ]);

        Puesto_Disponible::create([
            'nombre' => 'Atención al cliente',
            'informacion' => 'Encargado de atender a los clientes en las oficinas centrales',
            'disponible' => 5
        ]);
        

        Puesto_Disponible::create([
            'nombre' => 'Cocinero',
            'informacion' => 'Encargado de realizar los platos de comida para los empleados de la empresa',
            'disponible' => 2
        ]);


    }
}
