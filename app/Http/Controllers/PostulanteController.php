<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Calificacion;
use App\Models\Educacion;
use App\Models\Experiencia;
use App\Models\Fuente_De_Contratacion;
use App\Models\Idioma;
use App\Models\Nivel_Idioma;
use App\Models\Postulante;
use App\Models\Puesto_Disponible;
use App\Models\Reconocimiento;
use App\Models\Referencia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostulanteController extends Controller
{
    //vista admin
    public function inicio(){
        $postulantes = Postulante::all();
        $puestosDisponibles = Puesto_Disponible::all();
    
        return (view('Contratacion.postulantes.inicio', compact('postulantes', 'puestosDisponibles'))) ;
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

        $id = Auth::id();
        $postulante = Postulante::where('ID_Usuario', $id)->first();

 
        $fuentes = Fuente_De_Contratacion::all();
        $puesto = Puesto_Disponible::all();
        $idiomas = Idioma::all();
  

        return (view('Contratacion.postulantes.rinicio', compact('postulante', 'fuentes', 'puesto', 'idiomas'))) ;
    }


    //vista usuario postulante evaluación para ver sus datos
    public function evaluarInicio($id){

        $postulante = Postulante::where('ID_Usuario', $id)->first();
    
        $calificaciones = Calificacion::where('ID_Postulante', $id)->first();

        return (view('Contratacion.postulantes.EvaluarInicio', compact('postulante', 'calificaciones'))) ;
    }

    

    public function evaluar(Request $request){

        $postulantes = Postulante::all();
        
        // Valores predeterminados
        $defaultIdioma = 1;
        $defaultEducaciones = 2;
        $defaultReconocimientos = 2;
        $defaultExperiencias = 3;
        $defaultReferencias = 1;
    
        foreach ($postulantes as $postulante) {
    
            // Verificar si tiene un idioma
            $puntosIdioma = 0;
            if ($postulante->ID_Idioma !== null) {
                switch ($postulante->ID_NivelIdioma) {
                    case 1: // Básico
                    case 2: // Intermedio
                        $puntosIdioma = 1 * ($request->input('Puntos_Idioma') ?? $defaultIdioma);
                        break;
                    case 3: // Avanzado
                    case 4: // Fluido
                        $puntosIdioma = 2 * ($request->input('Puntos_Idioma') ?? $defaultIdioma);
                        break;
                    case 5: // Nativo
                        $puntosIdioma = 3 * ($request->input('Puntos_Idioma') ?? $defaultIdioma);
                        break;
                    default:
                        // No hacer nada, mantener los puntos en 0
                        break;
                }
            }
    
            // Contar educaciones relacionadas con el postulante
            $educaciones = Educacion::where('ID_Postulante', $postulante->ID_Usuario)->count();
            $puntosEducacion = $educaciones * ($request->input('Puntos_Educaciones') ?? $defaultEducaciones);
    
            // Contar reconocimientos relacionados con el postulante
            $reconocimientos = Reconocimiento::where('ID_Postulante', $postulante->ID_Usuario)->count();
            $puntosReconocimiento = $reconocimientos * ($request->input('Puntos_Reconocimientos') ?? $defaultReconocimientos);
    
            // Contar experiencias relacionadas con el postulante
            $experiencias = Experiencia::where('ID_Postulante', $postulante->ID_Usuario)->count();
            $promedio_anios = Experiencia::where('ID_Postulante', $postulante->ID_Usuario)->avg('años');

          //  dd($request->input('Puntos_Reconocimientos'));

            
            if (!empty($request->input('Puntos_Experiencias')) && (int)$request->input('Puntos_Experiencias') === 0) {
                $puntosExperiencia = 0;

            } else {
        
                $puntosExperiencia = ($experiencias + ($request->input('Puntos_Experiencias') ?? $defaultExperiencias)) * $promedio_anios;

            }
            
            
    
            // Contar referencias relacionadas con el postulante
            $referencias = Referencia::where('ID_Postulante', $postulante->ID_Usuario)->count();
            $puntosReferencia = ($referencias >= 3) ? 1 * ($request->input('Puntos_Referencias') ?? $defaultReferencias) : 0;
    
            // Buscar si ya existe una entrada de calificación para este postulante
            $calificacion = Calificacion::where('ID_Postulante', $postulante->ID_Usuario)->first();
    
            // Si no existe, crea una nueva entrada; de lo contrario, actualiza los puntos
            if ($calificacion === null) {
                Calificacion::create([
                    'ptIdioma' => $puntosIdioma,
                    'ptEducacion' => $puntosEducacion,
                    'ptReconocimiento' => $puntosReconocimiento,
                    'ptExperiencia' => $puntosExperiencia,
                    'ptReferencia' => $puntosReferencia,
                    'ID_Postulante' => $postulante->ID_Usuario,
                ]);
            } else {
                $calificacion->update([
                    'ptIdioma' => $puntosIdioma,
                    'ptEducacion' => $puntosEducacion,
                    'ptReconocimiento' => $puntosReconocimiento,
                    'ptExperiencia' => $puntosExperiencia,
                    'ptReferencia' => $puntosReferencia,
                ]);
            }

            $postulante->puntos = $puntosIdioma+$puntosEducacion+$puntosReconocimiento+$puntosExperiencia+$puntosReferencia;
            $postulante->save();
        }
    
        return redirect()->route('postulantes.inicio')
        ->with('evaluados', 'Postulantes evaluados de forma automática')
        ->with('postulantes', $postulantes);
    }
    




    //vista de los idiomas evaluados
    public function evaluacionEducacion($id){

        $postulante = Postulante::where('ID_Usuario', $id)->first();
    
        // Contar reconocimientos relacionados con el postulante
        $educaciones = Educacion::where('ID_Postulante', $postulante->ID_Usuario)->get();
        $educacionesCant = Educacion::where('ID_Postulante', $postulante->ID_Usuario)->count();
      
    
        return (view('Contratacion.evaluacion.evaluacionEducacion', compact('postulante', 'educaciones', 'educacionesCant'))) ;
    }


    //vista de los idiomas evaluados
    public function evaluacionReconocimiento($id){

        $postulante = Postulante::where('ID_Usuario', $id)->first();
        $reconocimientos = Reconocimiento::where('ID_Postulante', $postulante->ID_Usuario)->get();
      
    
        return (view('Contratacion.evaluacion.evaluacionReconocimiento', compact('postulante', 'reconocimientos'))) ;
    }



    //vista de los idiomas evaluados
    public function evaluacionExperiencia($id){

        $postulante = Postulante::where('ID_Usuario', $id)->first();
        $experiencias = Experiencia::where('ID_Postulante', $postulante->ID_Usuario)->get();
      
    
        return (view('Contratacion.evaluacion.evaluacionExperiencia', compact('postulante', 'experiencias'))) ;
    }


        //vista de las referencias del postulante
    public function evaluacionReferencia($id){

        $postulante = Postulante::where('ID_Usuario', $id)->first();
        $referencias = Referencia::where('ID_Postulante', $postulante->ID_Usuario)->get();
      
    
        return (view('Contratacion.evaluacion.evaluacionReferencia', compact('postulante', 'referencias'))) ;
    }



    public function actualizarEvaluacionEducacion($idPostulante, $nuevoValor)
    {
        $postulantes = Postulante::all();
        $postulante = Postulante::where('ID_Usuario', '=', $idPostulante)->first();
        $postulante->puntos =  $postulante->puntos - $nuevoValor;
        $postulante->save();

        return (view('Contratacion.postulantes.inicio', compact('postulantes'))) ;
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
            'ruta_imagen_e' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'fecha_de_nacimiento', 
            'nacionalidad', 
            'habilidades', 
            'ID_Fuente_De_Contratacion',
            'ID_Puesto_Disponible',
            'ID_Idioma',
        ]);

        if ($request->ruta_imagen_e) {
            $nombreImagen = time() . '_' . $request->ruta_imagen_e->getClientOriginalName();
            $ruta = $request->ruta_imagen_e->storeAs('public/imagenes/postulantes', $nombreImagen);
            $url = Storage::url($ruta);
        }else{
            $url = asset('postulantes/default.png');
        }

        $postulante = new Postulante();
        $postulante->ruta_imagen_e = $url;
        $postulante->fecha_de_nacimiento = $request->fecha_de_nacimiento;
        $postulante->nacionalidad = $request->nacionalidad;
        $postulante->habilidades = $request->habilidades;
        $postulante->ID_Fuente_De_Contratacion = $request->ID_Fuente_De_Contratacion;
        $postulante->ID_Puesto_Disponible = $request->ID_Puesto_Disponible;
        $postulante->ID_Idioma = $request->ID_Idioma;

        $postulante->save();




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
        $nivelIdiomas = Nivel_Idioma::all();
        $postulante = Postulante::where('ID_Usuario', '=', $id)->first();
        return view('Contratacion.postulantes.editar', compact('postulante','fuentes','puestos','idiomas', 'nivelIdiomas'));
    }

    public function editarGES()
    {
        $id = Auth::id();
        $fuentes = Fuente_De_Contratacion::all();
        $puestos = Puesto_Disponible::all();
        $idiomas = Idioma::all();
        $nivelIdiomas = Nivel_Idioma::all();
        $postulante = Postulante::where('ID_Usuario', '=', $id)->first();
        return view('Contratacion.postulantes.editarGES', compact('postulante','fuentes','puestos','idiomas', 'nivelIdiomas'));
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
            'ID_NivelIdioma'=> 'required',
            
        ]);

        $postulante->fecha_de_nacimiento = $request->fecha_de_nacimiento;
        $postulante->nacionalidad = $request->nacionalidad;
        $postulante->habilidades = $request->habilidades?? 'No tiene habilidades.';
        $postulante->ID_Fuente_De_Contratacion = $request->ID_Fuente_De_Contratacion;
        $postulante->ID_Puesto_Disponible = $request->ID_Puesto_Disponible;
        $postulante->ID_Idioma = $request->ID_Idioma;
        $postulante->ID_NivelIdioma = $request->ID_NivelIdioma;


        if ($request->hasFile('ruta_imagen_e')) {
            $nombreImagen = time() . '_' . $request->ruta_imagen_e->getClientOriginalName();
            $ruta = $request->ruta_imagen_e->storeAs('public/imagenes/postulantes', $nombreImagen);
            $url = Storage::url($ruta);
         
            $postulante->update([
                'ruta_imagen_e' => $url,
            ]);
        }


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
            'fecha_de_nacimiento'=> 'required',
            'nacionalidad'=> 'required',
            'ID_Fuente_De_Contratacion'=> 'required',
            'ID_Puesto_Disponible'=> 'required',
            'ID_Idioma'=> 'required',
            'ID_NivelIdioma'=> 'required',
        ]);
        
        $postulante->fecha_de_nacimiento = $request->fecha_de_nacimiento;
        $postulante->nacionalidad = $request->nacionalidad;
        $postulante->habilidades = $request->habilidades?? 'No tiene habilidades.';
        $postulante->ID_Fuente_De_Contratacion = $request->ID_Fuente_De_Contratacion;
        $postulante->ID_Puesto_Disponible = $request->ID_Puesto_Disponible;
        $postulante->ID_Idioma = $request->ID_Idioma;
        $postulante->ID_NivelIdioma = $request->ID_NivelIdioma;


        
        if ($request->hasFile('ruta_imagen_e')) {
            $nombreImagen = time() . '_' . $request->ruta_imagen_e->getClientOriginalName();
            $ruta = $request->ruta_imagen_e->storeAs('public/imagenes/postulantes', $nombreImagen);
            $url = Storage::url($ruta);
     
            $postulante->update([
                'ruta_imagen_e' => $url
            ]);
        }
     
        $postulante->save();


        
        return redirect(route('dashboard'))->with('actualizado', 'Información actualizada exitosamente');

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
