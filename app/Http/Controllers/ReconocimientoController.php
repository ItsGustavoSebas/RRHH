<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Postulante;
use App\Models\Reconocimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReconocimientoController extends Controller
{
       //vista admin
       public function inicio(){
        $reconocimientos = Reconocimiento::all();
        $postulantes = Postulante::all();
        return (view('Contratacion.reconocimientos.inicio', compact('reconocimientos', 'postulantes'))) ;
    }


    //vista usuario postulante para ver sus reconocimientos
    public function rinicio(){
        $id = Auth::id();
        $reconocimientos = Reconocimiento::where('ID_Postulante', '=', $id)->get();
        $postulante = $id;
        return (view('Contratacion.reconocimientos.rinicio', compact('reconocimientos', 'postulante'))) ;
    }

    public function crear()
    {
       
        return view('Contratacion.reconocimientos.crear');
    }

    public function crearSIG()
    {
       
        return view('Contratacion.reconocimientos.crearSIG');
    }    

    public function guardar(REQUEST $request)
    {
        $id = Auth::id();
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
        
        ]);
        $Reconocimiento = new Reconocimiento();
        $Reconocimiento->nombre = $request->nombre;
        $Reconocimiento->descripcion = $request->descripcion;
        $Reconocimiento->ID_Postulante = $id;
        $Reconocimiento->save();



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
                return redirect(route('reconocimientos.crear'))->with('creado', 'Educación añadida exitosamente');
                break;
            case 'guardar_y_siguiente':
                // Redirigir al dashboard
                return redirect(route('experiencias.crear'));
                break;
            default:
                // Si no se reconoce la acción, redirigir a alguna vista por defecto
                return redirect(route('experiencias.crear'));
        }
    }

    public function guardarSIG(REQUEST $request)
    {
        $id = Auth::id();
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);
        $Reconocimiento = new Reconocimiento();
        $Reconocimiento->nombre = $request->nombre;
        $Reconocimiento->descripcion = $request->descripcion;
        $Reconocimiento->ID_Postulante = $id;
        $Reconocimiento->save();



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

        return redirect(route('reconocimientos.rinicio'))->with('creado', 'Curso creada exitosamente');
    }    

    public function editar()
    {
        $id = Auth::id();
        $reconocimientos = Reconocimiento::where('ID_Postulante', '=', $id)->first();
        return view('Contratacion.reconocimientos.editar', compact('reconocimientos'));
    }

    public function actualizar(REQUEST $request, $id)
    {
        $id = Auth::id();
        $Reconocimiento = Reconocimiento::where('ID_Postulante', '=', $id)->first();
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);
        $Reconocimiento->nombre = $request->nombre;
        $Reconocimiento->descripcion = $request->descripcion;
        $Reconocimiento->ID_Postulante = $id;

        $Reconocimiento->save();

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
        
        return redirect(route('reconocimientos.rinicio'))->with('actualizado', 'Reconocimiento actualizada exitosamente');
    }

    public function eliminar($id)
    {
        $Reconocimiento = Reconocimiento::where('id', '=', $id)->first();
        $Reconocimiento->delete();

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

        return redirect(route('reconocimientos.rinicio'))->with('eliminado', 'Reconocimiento eliminado exitosamente');
    }
}
