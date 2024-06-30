<?php

namespace App\Http\Controllers;

use App\Models\Deposito;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepositoController extends Controller
{
    public function index()
    {
        $depositos = Deposito::with('empleado')->get();
        return view('depositos.index', compact('depositos'));
    }

    public function show($id)
    {
        $deposito = Deposito::with('empleado')->findOrFail($id);
        return view('depositos.show', compact('deposito'));
    }

    public function create()
    {
        $empleados = Empleado::all();
        return view('depositos.create', compact('empleados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'empleado_id' => 'required|exists:empleados,ID_Usuario',
            'fecha' => 'required|date',
            'depositado' => 'required|boolean',
            'monto' => 'required|numeric',
        ]);

        Deposito::create($request->all());

        return redirect()->route('depositos.index')->with('success', 'Depósito creado exitosamente.');
    }

    public function depositar($id)
    {
        $deposito = Deposito::findOrFail($id);
        return view('depositos.depositar', compact('deposito'));
    }

    public function procesarDeposito(Request $request, $id)
    {
        $request->validate([
            'numero_cuenta' => 'required',
        ]);
    
        $deposito = Deposito::findOrFail($id);
        $deposito->update(['depositado' => true]);
    
        return redirect()->route('depositos.index')->with('success', 'Depósito procesado exitosamente.');
    }
    

    public function edit($id)
    {
        $deposito = Deposito::findOrFail($id);
        $empleados = Empleado::all();
        return view('depositos.edit', compact('deposito', 'empleados'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'empleado_id' => 'required|exists:empleados,ID_Usuario',
            'fecha' => 'required|date',
            'depositado' => 'required|boolean',
            'monto' => 'required|numeric',
        ]);

        $deposito = Deposito::findOrFail($id);
        $deposito->update($request->all());

        return redirect()->route('depositos.index')->with('success', 'Depósito actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $deposito = Deposito::findOrFail($id);
        $deposito->delete();

        return redirect()->route('depositos.index')->with('success', 'Depósito eliminado exitosamente.');
    }

    public function misDepositos()
    {
        $userId = Auth::id(); // Obtener el ID del usuario autenticado
        $depositos = Deposito::with('empleado')
            ->where('empleado_id', $userId)
            ->get();

        return view('depositos.mis_depositos', compact('depositos'));
    }
}
