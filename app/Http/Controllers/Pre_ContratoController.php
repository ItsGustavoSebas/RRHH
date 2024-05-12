<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\Departamento;
use App\Models\Empleado;
use App\Models\Entrevista;
use App\Models\Postulante;
use App\Models\Pre_Contrato;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Barryvdh\DomPDF\Facade\Pdf;



class Pre_ContratoController extends Controller
{
    // public function inicio()
    // {
    //     $empleados= Empleado::with('usuario')->get();
    //     $departamentos = Departamento::all();
    //     $cargos = Cargo::all();
    //     return (view('usuarios.empleados.inicio', compact('empleados', 'departamentos', 'cargos')));
    // }

    public function crear($id)
    {
        $departamentos = Departamento::all();
        $postulante = Postulante::where('ID_Usuario', '=', $id)->first();
        $cargos = Cargo::all();
        $roles = Role::all();
        return view('Contratacion.pre_contrato.crear', compact('roles', 'departamentos', 'cargos', 'postulante'));
    }

    public function editar($id)
    {
        $pre_contrato = Pre_Contrato::where('ID_Postulante', '=', $id)->first();
        $postulante = Postulante::where('ID_Usuario', '=', $id)->first();
        $departamentos = Departamento::all();
        $cargos = Cargo::all();
        $roles = Role::all();
        return view('Contratacion.pre_contrato.editar', compact('pre_contrato', 'departamentos', 'cargos', 'postulante', 'roles'));
    }


    public function guardar(REQUEST $request, $idPostulante)
    {
        $id = Auth::id();

        $request->validate([
        
            'ID_Departamento' => 'required',
            'ID_Cargo' => 'required',
            'genero' => 'required',
            'rol' => 'required',
            'estadocivil'=> 'required',

        ]);

        $pre_contrato = Pre_Contrato::create([
            'ID_Departamento' => $request->ID_Departamento,
            'ID_Cargo' => $request->ID_Cargo,
            'genero' => $request->genero,
            'estadocivil' => $request->estadocivil,
            'rol' => $request->rol,
            'ID_Postulante' => $idPostulante,
            'ID_Usuario'=> $id

        ]);


        
        return redirect(route('postulantes.inicio'))->with('actualizado', 'Datos del Pre-Contrato registrado exitosamente');
    }

    public function actualizar(Request $request, $id)
    {


        $pre_contrato = Pre_Contrato::where('ID_Postulante', '=', $id)->first();
        $request->validate([
            'ID_Departamento' => 'required',
            'ID_Cargo' => 'required',
            'genero' => 'required',
            'rol' => 'required',
            'estadocivil'=> 'required',
        ]);

        $pre_contrato->ID_Departamento = $request->ID_Departamento;
        $pre_contrato->ID_Cargo = $request->ID_Cargo;
        $pre_contrato->genero = $request->genero;
        $pre_contrato->estadocivil = $request->estadocivil;
        $pre_contrato->rol = $request->rol;
        $pre_contrato->save();


        
        return redirect()->route('postulantes.inicio')->with('actualizado', 'Datos del Pre-Contrato actualizados exitosamente');
    }


    public function generarContratoPDF($id){
        $postulante = Postulante::where('ID_Usuario', '=', $id)->first();
        $pre_contrato = Pre_Contrato::where('ID_Postulante', '=', $id)->first();
        $entrevista = Entrevista::where('ID_Postulante', '=', $id)->first();
        $departamentos = Departamento::all();
        $cargos = Cargo::all();

        

        $empleado= Empleado::where('ID_Usuario', '=', $pre_contrato->usuario->id)->first();

        $data = [
            'postulante' => $postulante,
            'pre_contrato'=>$pre_contrato,
            'entrevista'=>$entrevista,
            'departamentos'=>$departamentos,
            'cargos' => $cargos,
            'empleado' => $empleado,
        ];

        $pdf = Pdf::loadView('PDF.contrato', $data);


       return $pdf->stream('contrato.pdf');
    }
}
