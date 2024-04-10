<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function inicio(){
        $roles = Role::all();
        return (view('roles.inicio', compact('roles')));
    }

    public function crear(){
        $permissions = Permission::all();
        return view('roles.crear', compact('permissions'));
    }

    public function editar($id){
        $rol = Role::find($id);
        $permissions = Permission::all();
        return view('roles.editar', compact('rol', 'permissions'));
    }

    public function actualizar(Request $request, $id){
        $request->validate([
            'name' => 'required|min:4|max:100',
            'permissions' => 'required'
        ]);

        $rol = Role::find($id);
        $rol->name = $request->name;
        $rol->save();
        $rol->permissions()->sync($request->permissions);
        return redirect()->route('roles.inicio', $id)->with('actualizado', "Rol Editado Correctamente");
    }

    public function eliminar($id){
        $rol = Role::find($id);
        $rol->delete();
        return redirect()->route('roles.inicio')->with('eliminado', "Rol Eliminado Correctamente");
    }

    public $permisosSeleccionados = [];
    public $name,$filtro;

    public function guardar(Request $request){
        $request->validate([
            'name' => 'required|min:4|max:100|unique:roles',
            'permissions' => 'required'
        ]);

        $rol = Role::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        $rol->permissions()->sync($request->permissions);

        return redirect()->route('roles.inicio')->with('creado', "Rol Creado Correctamente");

    }   
}
