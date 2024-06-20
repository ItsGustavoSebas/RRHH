<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ActividadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('actividades')->insert([
            [
                'nombre' => 'Actividad 1',
                'descripcion' => 'Descripción de la Actividad 1',
                'fecha_inicio' => Carbon::now()->subDays(10)->toDateString(),
                'hora_inicio' => Carbon::now()->subDays(10)->toTimeString(),
                'fecha_fin' => Carbon::now()->addDays(10)->toDateString(),
                'hora_fin' => Carbon::now()->addDays(10)->toTimeString(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nombre' => 'Actividad 2',
                'descripcion' => 'Descripción de la Actividad 2',
                'fecha_inicio' => Carbon::now()->subDays(5)->toDateString(),
                'hora_inicio' => Carbon::now()->subDays(5)->toTimeString(),
                'fecha_fin' => Carbon::now()->addDays(15)->toDateString(),
                'hora_fin' => Carbon::now()->addDays(15)->toTimeString(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nombre' => 'Actividad 3',
                'descripcion' => 'Descripción de la Actividad 3',
                'fecha_inicio' => Carbon::now()->toDateString(),
                'hora_inicio' => Carbon::now()->toTimeString(),
                'fecha_fin' => Carbon::now()->addDays(20)->toDateString(),
                'hora_fin' => Carbon::now()->addDays(20)->toTimeString(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
