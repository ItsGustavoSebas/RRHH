<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Entrevista;
use App\Models\Postulante;
use App\Models\User;
use App\Notifications\Entrevista as NotificationsEntrevista;
use Illuminate\Http\Request;

class EntrevistaController extends Controller
{
    public function inicio(){
        $entrevistas = Entrevista::all();

        return view ('Contratacion.entrevistas.inicio', compact('entrevistas'));
    }

    public function crear($id)
    {
        $postulante = Postulante::where('ID_Usuario',  $id)->first();
        return view('Contratacion.entrevistas.crear', compact('postulante'));
    }

    public function guardar(REQUEST $request, $id)
    {
        $request->validate([
            'fecha_inicio' => 'required',
            'hora' => 'required',
            'fecha_fin' => 'required',
            'detalles' => 'required',
        
        ]);
        $entrevista = new Entrevista();
        $entrevista->fecha_inicio= $request->fecha_inicio;
        $entrevista->hora= $request->hora;
        $entrevista->fecha_fin= $request->fecha_fin;
        $entrevista->detalles= $request->detalles;
        $entrevista->ID_Postulante= $id;
        $entrevista->save();
        $user = User::find($id);
        $user->notify(new NotificationsEntrevista($entrevista));

        return redirect(route('entrevistas.inicio'))->with('creado', 'Entrevista creada exitosamente');
    }

    public function editar($id)
    {
        $entrevistas = Entrevista::where('id', '=', $id)->first();
        return view('Contratacion.entrevistas.editar', compact('entrevistas'));
    }

    public function actualizar(REQUEST $request, $id)
    {
        $entrevistas = Entrevista::where('id', '=', $id)->first();
        $request->validate([
            'fecha_inicio' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'detalles' => 'required',
        ]);
        $entrevistas->fecha_inicio= $request->fecha_inicio;
        $entrevistas->hora= $request->hora;
        $entrevistas->fecha_fin= $request->fecha_fin;
        $entrevistas->detalles= $request->detalles;
        $entrevistas->save();

        
        return redirect(route('entrevistas.inicio'))->with('actualizado', 'Entrevista actualizada exitosamente');
    }

    public function eliminar($id)
    {
        $entrevistas = Entrevista::where('id', '=', $id)->first();
        $entrevistas->delete();


        return redirect(route('entrevistas.inicio'))->with('eliminado', 'Entrevista eliminada exitosamente');
    }
}
