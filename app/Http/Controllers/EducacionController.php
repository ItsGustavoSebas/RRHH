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
        $educaciones = Educacion::where('ID_Postulante', '=', $id)->first();
        $postulante = Postulante::where('ID_Postulante', '=', $id)->first();
        return (view('Contratacion.educaciones.rinicio', compact('educaciones', 'postulantes'))) ;
    }

    public function crear()
    {
       
        return view('Contratacion.educaciones.crear');
    }

    public function guardar(REQUEST $request)
    {
        $id = Auth::id();
        $request->validate([
            'nombre_colegio', 
            'grado_diploma', 
            'campo_de_estudio', 
            'fecha_de_finalizacion', 
            'notas_adicionales', 
        ]);
        $educacion = new Educacion();
        $educacion->nombre_colegio = $request->nombre_colegio;
        $educacion->grado_diploma = $request->grado_diploma;
        $educacion->campo_de_estudio = $request->campo_de_estudio;
        $educacion->fecha_de_finalizacion = $request->fecha_de_finalizacion;
        $educacion->notas_adicionales = $request->notas_adicionales;
        $educacion->ID_Postulante = $id;



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

        return redirect(route('#'))->with('creado', 'Curso creada exitosamente');
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
        $educaciones = Educacion::where('ID_Postulante', '=', $id)->first();
        $educaciones->validate([
            'nombre_colegio', 
            'grado_diploma', 
            'campo_de_estudio', 
            'fecha_de_finalizacion', 
            'notas_adicionales', 
        ]);
        $educaciones->nombre = $request->nombre; 
        $educaciones->save();

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
        
        return redirect(route('#'))->with('actualizado', 'Educacion actualizada exitosamente');
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

        return redirect(route('cursos.inicio'))->with('eliminado', 'Educacion eliminado exitosamente');
    }
}
