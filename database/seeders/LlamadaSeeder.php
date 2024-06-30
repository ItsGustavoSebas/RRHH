<?php

namespace Database\Seeders;

use App\Models\LlamadaAtencion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LlamadaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $llamada = new LlamadaAtencion();
        $llamada->motivo = 'Llegar 1 hora tarde';
        $llamada->gravedad = 'Media';
        $llamada->fecha = '2024-06-20';
        $llamada->ID_Empleado = '4';

        $llamada->save();

        $llamada = new LlamadaAtencion();
        $llamada->motivo = 'No presentar el informe';
        $llamada->gravedad = 'Alta';
        $llamada->fecha = '2024-06-22';
        $llamada->ID_Empleado = '4';

        $llamada->save();
    }
}
