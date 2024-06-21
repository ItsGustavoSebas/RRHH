<?php

namespace Database\Seeders;

use App\Models\Dia_Horario_Empleado;
use App\Models\Horario_Empleado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HorarioEmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $horarioempleado = Horario_Empleado::create([
            'ID_Horario' => 1,
            'ID_Empleado' => 3
        ]);
        
        $horarioempleado->save();

        $horarioempleado = Horario_Empleado::create([
            'ID_Horario' => 1,
            'ID_Empleado' => 3
        ]);
        
        $horarioempleado->save();

        $horarioempleado = Horario_Empleado::create([
            'ID_Horario' => 1,
            'ID_Empleado' => 3
        ]);
        
        $horarioempleado->save();

        $horarioempleado = Horario_Empleado::create([
            'ID_Horario' => 1,
            'ID_Empleado' => 3
        ]);
        
        $horarioempleado->save();

        $horarioempleado = Horario_Empleado::create([
            'ID_Horario' => 1,
            'ID_Empleado' => 3
        ]);
        
        $horarioempleado->save();


        $diahorarioempleado = Dia_Horario_Empleado::create([
            'ID_DiaTrabajo' => 2,
            'ID_Horario_Empleado' => 1
        ]);

        $diahorarioempleado->save();

        $diahorarioempleado = Dia_Horario_Empleado::create([
            'ID_DiaTrabajo' => 3,
            'ID_Horario_Empleado' => 2
        ]);

        $diahorarioempleado->save();

        $diahorarioempleado = Dia_Horario_Empleado::create([
            'ID_DiaTrabajo' => 4,
            'ID_Horario_Empleado' => 3
        ]);

        $diahorarioempleado->save();

        $diahorarioempleado = Dia_Horario_Empleado::create([
            'ID_DiaTrabajo' => 5,
            'ID_Horario_Empleado' => 4
        ]);

        $diahorarioempleado->save();

        $diahorarioempleado = Dia_Horario_Empleado::create([
            'ID_DiaTrabajo' => 6,
            'ID_Horario_Empleado' => 5
        ]);

        $diahorarioempleado->save();

        //--------------------------------------
        $horarioempleado = Horario_Empleado::create([
            'ID_Horario' => 1,
            'ID_Empleado' => 4
        ]);
        
        $horarioempleado->save();

        $horarioempleado = Horario_Empleado::create([
            'ID_Horario' => 1,
            'ID_Empleado' => 4
        ]);
        
        $horarioempleado->save();

        $horarioempleado = Horario_Empleado::create([
            'ID_Horario' => 1,
            'ID_Empleado' => 4
        ]);
        
        $horarioempleado->save();

        $horarioempleado = Horario_Empleado::create([
            'ID_Horario' => 1,
            'ID_Empleado' => 4
        ]);
        
        $horarioempleado->save();

        $horarioempleado = Horario_Empleado::create([
            'ID_Horario' => 1,
            'ID_Empleado' => 4
        ]);
        
        $horarioempleado->save();


        $diahorarioempleado = Dia_Horario_Empleado::create([
            'ID_DiaTrabajo' => 2,
            'ID_Horario_Empleado' => 6
        ]);

        $diahorarioempleado->save();

        $diahorarioempleado = Dia_Horario_Empleado::create([
            'ID_DiaTrabajo' => 3,
            'ID_Horario_Empleado' => 7
        ]);

        $diahorarioempleado->save();

        $diahorarioempleado = Dia_Horario_Empleado::create([
            'ID_DiaTrabajo' => 4,
            'ID_Horario_Empleado' => 8
        ]);

        $diahorarioempleado->save();

        $diahorarioempleado = Dia_Horario_Empleado::create([
            'ID_DiaTrabajo' => 5,
            'ID_Horario_Empleado' => 9
        ]);

        $diahorarioempleado->save();

        $diahorarioempleado = Dia_Horario_Empleado::create([
            'ID_DiaTrabajo' => 6,
            'ID_Horario_Empleado' => 10
        ]);

        $diahorarioempleado->save();

    }
}
