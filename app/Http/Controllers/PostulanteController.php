<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Educacion;
use App\Models\Experiencia;
use App\Models\Fuente_De_Contratacion;
use App\Models\Idioma;
use App\Models\Postulante;
use App\Models\Puesto_Disponible;
use App\Models\Reconocimiento;
use App\Models\Referencia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostulanteController extends Controller
{
       //vista admin
       public function inicio(){
        $postulante = Postulante::all();
        $fuentes = Fuente_De_Contratacion::all();
        $puestos = Puesto_Disponible::all();
        $idiomas = Idioma::all();
        return (view('Contratacion.postulantes.inicio', compact('fuentes', 'postulante', 'puestos', 'idiomas'))) ;
    }


    public function postularse()
    {
   
        $id = Auth::id();
        $postulante = Postulante::where('ID_Usuario', '=', $id)->first();


        if (!$postulante->nacionalidad) {
          // Si la nacionalidad del usuario no está completa, redirigir a la página de completar datos personales
          return redirect(route('postulantes.editar', $id));
        }

        // Luego, verificar el progreso en otras secciones del registro
        $educaciones = Educacion::where('ID_Postulante', $id)->first();
        $reconocimientos = Reconocimiento::where('ID_Postulante', $id)->first();
        $experiencias = Experiencia::where('ID_Postulante', $id)->first();
        $referencias = Referencia::where('ID_Postulante', $id)->first();

        // Ahora puedes usar un switch para redirigir a la siguiente sección que debe completar el usuario
        switch (true) {
          case !$educaciones:
             return redirect(route('educaciones.crear'));
          case !$reconocimientos:
             return redirect(route('reconocimientos.crear'));
          case !$experiencias:
             return redirect(route('experiencias.crear'));
          case !$referencias:
               return redirect(route('referencias.crear'));
          default:
           // Si el usuario ha completado todas las secciones, redirigir a algún lugar, como el dashboard
          return redirect(route('dashboard'));
}
    }

    //vista usuario postulante para ver sus datos
    public function rinicio(){

        $fuentes = Fuente_De_Contratacion::all();
        $puesto = Puesto_Disponible::all();
        $idiomas = Idioma::all();
  
        $postulante = Postulante::all();
        return (view('Contratacion.postulantes.rinicio', compact('postulante', 'fuentes', 'puesto', 'idiomas'))) ;
    }

    public function crear()
    {
       
        $fuentes = Fuente_De_Contratacion::all();
        $puesto = Puesto_Disponible::all();
        $idiomas = Idioma::all();
        return (view('Contratacion.postulantes.crear', compact('fuentes', 'puesto', 'idiomas'))) ;
    }



    public function guardar(REQUEST $request)
    {      
        $request->validate([
            'foto', 
            'fecha_de_nacimiento', 
            'nacionalidad', 
            'habilidades', 
            'ID_Fuente_De_Contratacion',
            'ID_Puesto_Disponible',
            'ID_Idioma',
        ]);
        $postulante = new Postulante();
        $postulante->ruta_imagen_e = $request->ruta_imagen_e;
        $postulante->fecha_de_nacimiento = $request->fecha_de_nacimiento;
        $postulante->nacionalidad = $request->nacionalidad;
        $postulante->habilidades = $request->habilidades;
        $postulante->ID_Fuente_De_Contratacion = $request->ID_Fuente_De_Contratacion;
        $postulante->ID_Puesto_Disponible = $request->ID_Puesto_Disponible;
        $postulante->ID_Idioma = $request->ID_Idioma;

        $postulante->save();



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
                return redirect(route('postulantes.crear'))->with('creado', 'Postulante añadida exitosamente');
                break;
            case 'guardar_y_siguiente':
                // Redirigir al dashboard
                return redirect(route('dashboard'));
                break;
            default:
                // Si no se reconoce la acción, redirigir a alguna vista por defecto
                return redirect(route('dashboard'));
        }
    }


    public function editar()
    {
        $id = Auth::id();
        $fuentes = Fuente_De_Contratacion::all();
        $puestos = Puesto_Disponible::all();
        $idiomas = Idioma::all();
        $postulante = Postulante::where('ID_Usuario', '=', $id)->first();
        return view('Contratacion.postulantes.editar', compact('postulante','fuentes','puestos','idiomas'));
    }

    public function editarGES()
    {
        $id = Auth::id();
        $fuentes = Fuente_De_Contratacion::all();
        $puestos = Puesto_Disponible::all();
        $idiomas = Idioma::all();
        $postulante = Postulante::where('ID_Usuario', '=', $id)->first();
        return view('Contratacion.postulantes.editarGES', compact('postulante','fuentes','puestos','idiomas'));
    }


    

    public function actualizar(REQUEST $request, $id)
    {
        $id = Auth::id();
        $postulante = Postulante::where('ID_Usuario', '=', $id)->first();
        $request->validate([
            'ruta_imagen_e'=> 'required',
            'fecha_de_nacimiento'=> 'required',
            'nacionalidad'=> 'required',
            'habilidades',
            'ID_Fuente_De_Contratacion'=> 'required',
            'ID_Puesto_Disponible'=> 'required',
            'ID_Idioma'=> 'required',
        ]);
        $postulante->ruta_imagen_e = $request->ruta_imagen_e; 
        $postulante->fecha_de_nacimiento = $request->fecha_de_nacimiento;
        $postulante->nacionalidad = $request->nacionalidad;
        $postulante->habilidades = $request->habilidades?? 'No tiene habilidades.';
        $postulante->ID_Fuente_De_Contratacion = $request->ID_Fuente_De_Contratacion;
        $postulante->ID_Puesto_Disponible = $request->ID_Puesto_Disponible;
        $postulante->ID_Idioma = $request->ID_Idioma;


        $postulante->save();


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
        
        return redirect(route('educaciones.crear'))->with('actualizado', 'Información añadida exitosamente');


        
    }


    public function actualizarGES(REQUEST $request, $id)
    {
        $id = Auth::id();
        $postulante = Postulante::where('ID_Usuario', '=', $id)->first();
        $request->validate([
            'ruta_imagen_e'=> 'required',
            'fecha_de_nacimiento'=> 'required',
            'nacionalidad'=> 'required',
            'habilidades',
            'ID_Fuente_De_Contratacion'=> 'required',
            'ID_Puesto_Disponible'=> 'required',
            'ID_Idioma'=> 'required',
        ]);
        $postulante->ruta_imagen_e = $request->ruta_imagen_e; 
        $postulante->fecha_de_nacimiento = $request->fecha_de_nacimiento;
        $postulante->nacionalidad = $request->nacionalidad;
        $postulante->habilidades = $request->habilidades?? 'No tiene habilidades.';
        $postulante->ID_Fuente_De_Contratacion = $request->ID_Fuente_De_Contratacion;
        $postulante->ID_Puesto_Disponible = $request->ID_Puesto_Disponible;
        $postulante->ID_Idioma = $request->ID_Idioma;


        $postulante->save();


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
        
        return redirect(route('postulantes.rinicio'))->with('actualizado', 'Información actualizada exitosamente');

    }

    // public function eliminar($id)
    // {
    //     $postulante = Postulante::where('id', '=', $id)->first();
    //     $postulante->delete();

    //     //Crear DetalleBitacora

    //     // $bitacora_id = session('bitacora_id');

    //     // if ($bitacora_id) {
    //     //     $bitacora = Bitacora::find($bitacora_id);

    //     //     $horaActual = now()->format('H:i:s');

    //     //     $bitacora->detalleBitacoras()->create([
    //     //         'accion' => 'Eliminar Marca',
    //     //         'metodo' => request()->method(), 
    //     //         'hora' => $horaActual,
    //     //         'tabla' => 'marcas',
    //     //         'registroId' => $id,
    //     //         'ruta'=> request()->fullurl(),
    //     //     ]);
    //     // }

    //     return redirect(route('educaciones.rinicio'))->with('eliminado', 'Educacion eliminado exitosamente');
    // }
}
