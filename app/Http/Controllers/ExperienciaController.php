<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Experiencia;
use App\Models\Postulante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExperienciaController extends Controller
{
       //vista admin
    public function inicio(){
        $experiencias = Experiencia::all();
        $postulantes = Postulante::all();
        return (view('Contratacion.experiencias.inicio', compact('experiencias', 'postulantes'))) ;
    }


    //vista usuario postulante para ver sus experiencias
    public function rinicio(){
        $id = Auth::id();
        $experiencias = Experiencia::where('ID_Postulante', '=', $id)->get();
        $postulante = $id;
        return (view('Contratacion.experiencias.rinicio', compact('experiencias', 'postulante'))) ;
    }

    public function crear()
    {
       
        return view('Contratacion.experiencias.crear');
    }

    public function crearSIG()
    {
       
        return view('Contratacion.experiencias.crearSIG');
    }    

    public function guardar(REQUEST $request)
    {
        $id = Auth::id();
        $request->validate([
            'cargo' => 'required',
            'descripcion' => 'required',
            'años' => 'required',
            'lugar' => 'required',

        
        ]);
        $Experiencia = new Experiencia();
        $Experiencia->cargo = $request->cargo;
        $Experiencia->descripcion = $request->descripcion;
        $Experiencia->años = $request->años;
        $Experiencia->lugar = $request->lugar;
        $Experiencia->ID_Postulante = $id;
        $Experiencia->save();



        //Crear DetalleBitacora

        // $bitacora_id = session('bitacora_id');

        // if ($bitacora_id) {
        //     $bitacora = Bitacora::find($bitacora_id);

        //     $horaActual = now()->format('H:i:s');

        //     $bitacora->detalleBitacoras()->create([
        //         'accion' => 'Crear Marca',
        //         'metodo' => $request->method(),
        //         'hora' => $horaActual,
        //         'tabla' => 'marcas',
        //         'registroId' => $marca->id,
        //         'ruta'=> request()->fullurl(),
        //     ]);
        // }

        switch ($request->input('action')) {
            case 'guardar_y_anadir_otro':
                // Redirigir a la misma vista para añadir otra educación
                return redirect(route('experiencias.crear'))->with('creado', 'Educación añadida exitosamente');
                break;
            case 'guardar_y_siguiente':
                // Redirigir al dashboard
                return redirect(route('referencias.crear'));
                break;
            default:
                // Si no se reconoce la acción, redirigir a alguna vista por defecto
                return redirect(route('referencias.crear'));
        }
    }

    public function guardarSIG(REQUEST $request)
    {
        $id = Auth::id();
        $request->validate([
            'cargo' => 'required',
            'descripcion' => 'required',
            'años' => 'required',
            'lugar' => 'required',
        ]);
        $Experiencia = new Experiencia();
        $Experiencia->cargo = $request->cargo;
        $Experiencia->descripcion = $request->descripcion;
        $Experiencia->años = $request->años;
        $Experiencia->lugar = $request->lugar;
        $Experiencia->ID_Postulante = $id;
        $Experiencia->save();



        //Crear DetalleBitacora

        // $bitacora_id = session('bitacora_id');

        // if ($bitacora_id) {
        //     $bitacora = Bitacora::find($bitacora_id);

        //     $horaActual = now()->format('H:i:s');

        //     $bitacora->detalleBitacoras()->create([
        //         'accion' => 'Crear Marca',
        //         'metodo' => $request->method(),
        //         'hora' => $horaActual,
        //         'tabla' => 'marcas',
        //         'registroId' => $marca->id,
        //         'ruta'=> request()->fullurl(),
        //     ]);
        // }

        return redirect(route('dashboard', ['opcional' => 'experiencias']))->with('creado', 'Curso creada exitosamente');
    }    

    public function editar()
    {
        $id = Auth::id();
        $experiencias = Experiencia::where('ID_Postulante', '=', $id)->first();
        return view('Contratacion.experiencias.editar', compact('experiencias'));
    }

    public function actualizar(REQUEST $request, $id)
    {
        $id = Auth::id();
        $Experiencia = Experiencia::where('ID_Postulante', '=', $id)->first();
        $request->validate([
            'cargo' => 'required',
            'descripcion' => 'required',
            'años' => 'required',
            'lugar' => 'required',
        ]);
        $Experiencia->cargo = $request->cargo;
        $Experiencia->descripcion = $request->descripcion;
        $Experiencia->años = $request->años;
        $Experiencia->lugar = $request->lugar;
        $Experiencia->ID_Postulante = $id;

        $Experiencia->save();

        //Crear DetalleBitacora

        // $bitacora_id = session('bitacora_id');

        // if ($bitacora_id) {
        //     $bitacora = Bitacora::find($bitacora_id);

        //     $horaActual = now()->format('H:i:s');

        //     $bitacora->detalleBitacoras()->create([
        //         'accion' => 'Editar Marca',
        //         'metodo' => $request->method(),
        //         'hora' => $horaActual,
        //         'tabla' => 'marcas',
        //         'registroId' => $marca->id,
        //         'ruta'=> request()->fullurl(),
        //     ]);
        // }
        
        return redirect(route('dashboard', ['opcional' => 'experiencias']))->with('actualizado', 'Experiencia actualizada exitosamente');
    }

    public function eliminar($id)
    {
        $Experiencia = Experiencia::where('id', '=', $id)->first();
        $Experiencia->delete();

        //Crear DetalleBitacora

        // $bitacora_id = session('bitacora_id');

        // if ($bitacora_id) {
        //     $bitacora = Bitacora::find($bitacora_id);

        //     $horaActual = now()->format('H:i:s');

        //     $bitacora->detalleBitacoras()->create([
        //         'accion' => 'Eliminar Marca',
        //         'metodo' => request()->method(), 
        //         'hora' => $horaActual,
        //         'tabla' => 'marcas',
        //         'registroId' => $id,
        //         'ruta'=> request()->fullurl(),
        //     ]);
        // }

        return redirect(route('dashboard', ['opcional' => 'experiencias']))->with('eliminado', 'Experiencia eliminado exitosamente');
    }
}
