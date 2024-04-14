<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Departamento;
use App\Models\Empleado;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class EmpleadoController extends Controller
{


    public function inicio()
    {
        $empleados= Empleado::with('usuario')->get();
        $departamentos = Departamento::all();
        $cargos = Cargo::all();
        return (view('usuarios.empleados.inicio', compact('empleados', 'departamentos', 'cargos')));
    }

    public function crear()
    {
        $roles = Role::all();
        $departamentos = Departamento::all();
        $cargos = Cargo::all();
        return view('usuarios.empleados.crear', compact('roles', 'departamentos', 'cargos'));
    }

    public function editar($id)
    {
        $roles = Role::all();
        $usuarios = User::where('id', '=', $id)->first();
        $empleados = Empleado::where('ID_Usuario', '=', $id)->with('usuario')->first();
        $departamentos = Departamento::all();
        $cargos = Cargo::all();
        return view('usuarios.empleados.editar', compact('roles', 'usuarios', 'empleados', 'departamentos', 'cargos'));
    }

    public function eliminar($id)
    {
        $usuarios = User::where('id', '=', $id)->first();
        $nombre = $usuarios->nombre;
        $usuarios->delete();

        
        return redirect(route('empleados.inicio'))->with('eliminado', 'Usuario ' . $nombre . 'eliminado exitosamente');
    }

    public function guardar(REQUEST $request)
    {

        // Realizar validaciones

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'telefono' => 'required|unique:users,telefono',
            'ci' => 'required|unique:users,ci',
            'direccion' => 'required',
            'password' => 'required',
            'ID_Departamento' => 'required',
            'ID_Cargo' => 'required',
            'ruta_imagen_e' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'roles' => 'required|array',
        ], [
            'name.required' => 'Debes ingresar el nombre.',
            'email.required' => 'Debes ingresar el correo electrónico.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'telefono.required' => 'Debes ingresar el teléfono.',
            'ci.required' => 'Debes ingresar el C.I.',
            'direccion.required' => 'Debes ingresar la dirección.',
            'ci.unique' => 'La Cédula de Identidad ya está registrada.',
            'telefono.unique' => 'El número de teléfono ya está en uso.',
            'ID_Departamento.required' => 'Debes ingresar el Departamento.',
            'ID_Cargo.required' => 'Debes ingresar el Cargo.',
            'roles.required' => 'Debes ingresar al menos un rol',
        ]);

        $usuarios = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'ci' => $request->ci,
            'Postulante' => false,
            'Empleado' => true,
            'direccion' => $request->direccion,
            'password' => bcrypt($request->password),
        ])->syncRoles($request->roles);

        if ($request->ruta_imagen_e) {
            $nombreImagen = time() . '_' . $request->ruta_imagen_e->getClientOriginalName();
            $ruta = $request->ruta_imagen_e->storeAs('public/imagenes/empleados', $nombreImagen);
            $url = Storage::url($ruta);
        }else{
            $url = null;
        }

        $empleados = new Empleado([
            'ID_Departamento' => $request->ID_Departamento,
            'ID_Cargo' => $request->ID_Cargo,
            'ruta_imagen_e' => $url,
        ]);

        $usuarios->empleado()->save($empleados);

        
        return redirect(route('empleados.inicio'))->with('creado', 'Empleado registrado exitosamente');
    }

    public function actualizar(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'telefono' => 'required|unique:users,telefono,' . $id,
            'ci' => 'required|unique:users,ci,' . $id,
            'direccion' => 'required',
            'ID_Departamento' => 'required',
            'ID_Cargo' => 'required',
            'roles' => 'required|array',
        ], [
            'name.required' => 'Debes ingresar el nombre.',
            'email.required' => 'Debes ingresar el correo electrónico.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'telefono.required' => 'Debes ingresar el teléfono.',
            'ci.required' => 'Debes ingresar el C.I.',
            'direccion.required' => 'Debes ingresar la dirección.',
            'ci.unique' => 'La Cédula de Identidad ya está registrada.',
            'telefono.unique' => 'El número de teléfono ya está en uso.',
            'ID_Departamento.required' => 'Debes ingresar el departamento.',
            'ID_Cargo.required' => 'Debes ingresar el Cargo.',
            'roles.required' => 'Debes ingresar al menos un rol',
        ]);

        $usuarios = User::where('id', '=', $id)->first();  /* User::findOrFail($id) esto es para regresar un valor null en un error de base de datos */

        $usuarios->update([
            'name' => $request->name,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'ci' => $request->ci,
            'direccion' => $request->direccion,
        ]);

        if ($request->password) {
            $usuarios->update([
                'password' => bcrypt($request->password),
            ]);
        }

        $usuarios->save();
        $roles = Role::whereIn('id', $request->roles)->pluck('name')->toArray();
        $usuarios->syncRoles($roles);

        $empleados = Empleado::where('ID_Usuario', '=', $usuarios->id)->first();

        if ($request->hasFile('ruta_imagen_e')) {
            $nombreImagen = time() . '_' . $request->ruta_imagen_e->getClientOriginalName();
            $ruta = $request->ruta_imagen_e->storeAs('public/imagenes/empleados', $nombreImagen);
            $url = Storage::url($ruta);
            $empleados->update([
                'ruta_imagen_e' => $url,
            ]);
        }

        $empleados->update([
            'ID_Departamento' => $request->ID_Departamento,
            'ID_Cargo' => $request->ID_Cargo,
        ]);

        $empleados->save();


        return redirect()->route('empleados.inicio')->with('actualizado', 'Usuario actualizado exitosamente');
    }
}