<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rol1 = Role::create(['name' => 'Administrador']);
        $rol2 = Role::create(['name' => 'Encargado']);
        $rol3 = Role::create(['name' => 'Postulante']);
        $rol4 = Role::create(['name' => 'Empleado']);

        //Usuarios
        Permission::create(['name' => 'Inicio Usuario'])->syncRoles([$rol1]);
        Permission::create(['name' => 'Crear Usuario'])->syncRoles([$rol1]);
        Permission::create(['name' => 'Guardar Usuario'])->syncRoles([$rol1]);
        Permission::create(['name' => 'Eliminar Usuario'])->syncRoles([$rol1]);
        Permission::create(['name' => 'Editar Usuario'])->syncRoles([$rol1]);
        Permission::create(['name' => 'Actualizar Usuario'])->syncRoles([$rol1]);

        //roles
        Permission::create(['name' => 'Inicio Rol'])->syncRoles([$rol1]);
        Permission::create(['name' => 'Crear Rol'])->syncRoles([$rol1]);
        Permission::create(['name' => 'Guardar Rol'])->syncRoles([$rol1]);
        Permission::create(['name' => 'Editar Rol'])->syncRoles([$rol1]);
        Permission::create(['name' => 'Actualizar Rol'])->syncRoles([$rol1]);
        Permission::create(['name' => 'Eliminar Rol'])->syncRoles([$rol1]);

        //postulantes
        Permission::create(['name' => 'Inicio Postulantes'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'Postularse'])->syncRoles([$rol1, $rol3]);
        Permission::create(['name' => 'Guardar Solicitud'])->syncRoles([$rol1, $rol3]);
        Permission::create(['name' => 'Avanzar en Solicitud'])->syncRoles([$rol1, $rol3]);
        Permission::create(['name' => 'Registrar Postulante'])->syncRoles([$rol1, $rol3]);
        Permission::create(['name' => 'Eliminar Postulante'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'Editar Solicitud'])->syncRoles([$rol1, $rol2, $rol3]);
        Permission::create(['name' => 'Actualizar Solicitud'])->syncRoles([$rol1, $rol2, $rol3]);

        //oferta de empleo
        Permission::create(['name' => 'Inicio Oferta'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'Crear Oferta'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'Guardar Oferta'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'Eliminar Oferta'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'Editar Oferta'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'Actualizar Oferta'])->syncRoles([$rol1, $rol2]);
    }
}
