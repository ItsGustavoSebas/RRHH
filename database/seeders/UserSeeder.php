<?php

namespace Database\Seeders;

use App\Models\Empleado;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Administador',
            'email' => 'adm@gmail.com',
            'ci' => '98716',
            'telefono' => '7789943',
            'direccion' => 'por ahí',
            'password' => bcrypt('12345678')
        ])->assignRole('Administrador');

        User::create([
            'name' => 'Encargado',
            'email' => 'encargado@gmail.com',
            'ci' => '84461',
            'telefono' => '7318578',
            'direccion' => 'plan 3000',
            'password' => bcrypt('12345678')
        ])->assignRole('Encargado');

        User::create([
            'name' => 'Postulante',
            'email' => 'postulante@gmail.com',
            'ci' => '546133',
            'telefono' => '7489943',
            'direccion' => 'villa primero de mayo',
            'password' => bcrypt('12345678')
        ])->assignRole('Postulante');

        $user = User::create([
            'name' => 'Empleado',
            'email' => 'empleado@gmail.com',
            'ci' => '998941',
            'telefono' => '7284693',
            'direccion' => 'zona la cuchilla',
            'password' => bcrypt('12345678')
        ])->assignRole('Empleado');

        $empleado = new Empleado([
            'ID_Cargo' => '1',
            'ID_Departamento'=> '1',
            'fechanac' => '1990/07/01',
            'genero' => 'Masculino',
            'estadocivil' => 'Soltero',
        ]);
        $user->empleado()->save($empleado);
    }
}
