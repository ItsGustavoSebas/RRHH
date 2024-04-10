<?php

namespace Database\Seeders;

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
            'password' => bcrypt('12345678')
        ])->assignRole('Administrador');

        User::create([
            'name' => 'Encargado',
            'email' => 'encargado@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Encargado');

        User::create([
            'name' => 'Postulante',
            'email' => 'postulante@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Postulante');

        User::create([
            'name' => 'Empleado',
            'email' => 'empleado@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Empleado');
    }
}
