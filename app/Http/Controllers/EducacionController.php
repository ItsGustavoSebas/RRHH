<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Educacion;
use App\Models\Postulante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducacionController extends Controller
{
    //vista admin
    public function inicio(){
        $educaciones = Educacion::all();
        $postulantes = Postulante::all();
        return (view('Contratacion.educaciones.inicio', compact('educaciones', 'postulantes'))) ;
    }


    //vista usuario postulante para ver sus educaciones
    public function rinicio(){
        $id = Auth::id();
        $educaciones = Educacion::where('ID_Postulante', '=', $id)->get();
        $postulante = $id;
        return (view('Contratacion.educaciones.rinicio', compact('educaciones', 'postulante'))) ;
    }

    public function crear()
    {
       
        return view('Contratacion.educaciones.crear');
    }

    public function crearSIG()
    {
       
        return view('Contratacion.educaciones.crearSIG');
    }    

    public function guardar(REQUEST $request)
    {
        $id = Auth::id();
        $request->validate([
            'nombre_colegio'=> 'required',
            'grado_diploma'=> 'required',
            'campo_de_estudio'=> 'required',
            'fecha_de_finalizacion'=> 'required',
        ]);
        $educacion = new Educacion();
        $educacion->nombre_colegio = $request->nombre_colegio;
        $educacion->grado_diploma = $request->grado_diploma;
        $educacion->campo_de_estudio = $request->campo_de_estudio;
        $educacion->fecha_de_finalizacion = $request->fecha_de_finalizacion;
        $educacion->notas_adicionales = $request->notas_adicionales;
        $educacion->ID_Postulante = $id;
        $educacion->save();



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
                return redirect(route('educaciones.crear'))->with('creado', 'Educación añadida exitosamente');
                break;
            case 'guardar_y_siguiente':
                // Redirigir al dashboard
                return redirect(route('reconocimientos.crear'));
                break;
            default:
                // Si no se reconoce la acción, redirigir a alguna vista por defecto
                return redirect(route('reconocimientos.crear'));
        }
    }

    public function guardarSIG(REQUEST $request)
    {
        $id = Auth::id();
        $request->validate([
            'nombre_colegio'=> 'required',
            'grado_diploma'=> 'required',
            'campo_de_estudio'=> 'required',
            'fecha_de_finalizacion'=> 'required',
        ]);
        $educacion = new Educacion();
        $educacion->nombre_colegio = $request->nombre_colegio;
        $educacion->grado_diploma = $request->grado_diploma;
        $educacion->campo_de_estudio = $request->campo_de_estudio;
        $educacion->fecha_de_finalizacion = $request->fecha_de_finalizacion;
       // Asignar notas adicionales del formulario, o un texto por defecto si es nulo
        $educacion->notas_adicionales = $request->notas_adicionales ?? 'Sin anotaciones.';


        $educacion->ID_Postulante = $id;
        $educacion->save();



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

        return redirect(route('dashboard', ['opcional' => 'educaciones']))->with('creado', 'Curso creada exitosamente');
    }    

    public function editar()
    {
        $id = Auth::id();
        $educaciones = Educacion::where('ID_Postulante', '=', $id)->first();
        return view('Contratacion.educaciones.editar', compact('educaciones'));
    }

    public function actualizar(REQUEST $request, $id)
    {
        $id = Auth::id();
        $educacion = Educacion::where('ID_Postulante', '=', $id)->first();
        $request->validate([
            'nombre_colegio'  => 'required', 
            'grado_diploma' => 'required',
            'campo_de_estudio' => 'required',
            'fecha_de_finalizacion' => 'required',
            'notas_adicionales' => 'required',
        ]);
        $educacion->nombre_colegio = $request->nombre_colegio; 
        $educacion->grado_diploma = $request->grado_diploma;
        $educacion->campo_de_estudio = $request->campo_de_estudio;
        $educacion->fecha_de_finalizacion = $request->fecha_de_finalizacion;
       // Asignar notas adicionales del formulario, o un texto por defecto si es nulo
        $educacion->notas_adicionales = $request->notas_adicionales ?? 'Sin anotaciones.';

        $educacion->save();

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
        
        return redirect(route('dashboard', ['opcional' => 'educaciones']))->with('actualizado', 'Educacion actualizada exitosamente');
    }

    public function eliminar($id)
    {
        $educacion = Educacion::where('id', '=', $id)->first();
        $educacion->delete();

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

        return redirect(route('dashboard', ['opcional' => 'educaciones']))->with('eliminado', 'Educacion eliminado exitosamente');
    }
}
