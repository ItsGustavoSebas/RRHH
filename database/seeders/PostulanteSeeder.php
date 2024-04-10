<?php

namespace Database\Seeders;

use App\Models\Postulante;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostulanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'postulante1',
            'email' => 'post@gmail.com',
            'ci' => '1213123',
            'telefono' => '13223',
            'direccion' => 'plan 3000',        
            'Postulante' => true,         
            'password' => bcrypt('12345678')
        ]);

        $postulante = new Postulante();
        $user->postulante()->save($postulante);
    }
}
