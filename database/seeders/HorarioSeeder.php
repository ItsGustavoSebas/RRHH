<?php

namespace Database\Seeders;

use App\Models\Horario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HorarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Horario::create([
            'HoraInicio' => '07:00',
            'HoraFin' => '15:00',
            'HoraLimite' => '07:30',
        ]);

        Horario::create([
            'HoraInicio' => '08:00',
            'HoraFin' => '12:00',
            'HoraLimite' => '08:30',
        ]);
        Horario::create([
            'HoraInicio' => '10:00',
            'HoraFin' => '18:00',
            'HoraLimite' => '11:30',
        ]);
        Horario::create([
            'HoraInicio' => '13:00',
            'HoraFin' => '21:00',
            'HoraLimite' => '13:30',
        ]);
        Horario::create([
            'HoraInicio' => '14:00',
            'HoraFin' => '20:00',
            'HoraLimite' => '14:30',
        ]);
        Horario::create([
            'HoraInicio' => '20:00',
            'HoraFin' => '23:30',
            'HoraLimite' => '23:59',
        ]);
        Horario::create([
            'HoraInicio' => '00:00',
            'HoraFin' => '06:00',
            'HoraLimite' => '06:59',
        ]);
    }
}
