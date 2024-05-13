<?php

namespace Database\Seeders;

use App\Models\Empleado;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Administador',
            'email' => 'adm@gmail.com',
            'ci' => '98716',
            'telefono' => '7789943',
            'direccion' => 'por ahí',
            'password' => bcrypt('12345678'),
            'Postulante' => false,
            'Empleado' => true,
        ])->assignRole('Administrador');

        $empleado = new Empleado([
            'ruta_imagen_e' => null,
            'ID_Cargo' => 1,
            'ID_Departamento' => 2,
            'ID_Horario' => 1,
            'fechanac' => '1990/07/01',
            'genero' => 'Masculino',
            'estadocivil' => 'Soltero',
        ]);

        $user->empleado()->save($empleado);

        $user = User::create([
            'name' => 'Encargado',
            'email' => 'encargado@gmail.com',
            'ci' => '84461',
            'telefono' => '7318578',
            'direccion' => 'plan 3000',
            'password' => bcrypt('12345678'),
            'Postulante' => false,
            'Empleado' => true,
        ])->assignRole('Encargado');

        $empleado = new Empleado([
            'ruta_imagen_e' => null,
            'ID_Cargo' => 1,
            'ID_Departamento' => 2,
            'ID_Horario' => 1,
            'fechanac' => '1990/07/01',
            'genero' => 'Masculino',
            'estadocivil' => 'Soltero',
        ]);

        $user->empleado()->save($empleado);

        $user = User::create([
            'name' => 'Daniel',
            'email' => 'empleado@gmail.com',
            'ci' => '998941',
            'telefono' => '7284693',
            'direccion' => 'zona la cuchilla',
            'password' => bcrypt('12345678'),
            'Postulante' => false,
            'Empleado' => true,
        ])->assignRole('Empleado');

        $empleado = new Empleado([
            'ruta_imagen_e' => null,
            'ID_Cargo' => 4,
            'ID_Departamento' => 2,
            'ID_Horario' => 1,
            'fechanac' => '1990/07/01',
            'genero' => 'Masculino',
            'estadocivil' => 'Soltero',
        ]);

        $user->empleado()->save($empleado);

        $user = User::create([
            'name' => 'Fernando',
            'email' => 'empleado3@gmail.com',
            'ci' => '918941',
            'telefono' => '7284693',
            'direccion' => 'zona la cuchilla',
            'password' => bcrypt('12345678'),
            'Postulante' => false,
            'Empleado' => true,
        ])->assignRole('Empleado');

        $empleado = new Empleado([
            'ID_Cargo' => '1',
            'ID_Departamento'=> '1',
            'ID_Horario' => 2,
            'fechanac' => '1990/07/01',
            'genero' => 'Masculino',
            'estadocivil' => 'Soltero',
        ]);
        $user->empleado()->save($empleado);
    }
}
