<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use App\Models\Empleado;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MemorandumController extends Controller
{
    public function inicio()
    {
        $id = Auth::id();
        $empleados = Empleado::all();
        $departamentos = Departamento::all();
        $yo = User::Where('id', $id)->first();
        return view('2_Recursos_Humanos.comunicacionRRHH.memorandum', compact('empleados', 'yo', 'departamentos'));
    }



   
}
