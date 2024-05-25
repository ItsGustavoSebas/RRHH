<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\Departamento;
use App\Models\Educacion;
use App\Models\Empleado;
use App\Models\Entrevista;
use App\Models\Experiencia;
use App\Models\Fuente_De_Contratacion;
use App\Models\Idioma;
use App\Models\Nivel_Idioma;
use App\Models\Postulante;
use App\Models\Pre_Contrato;
use App\Models\Puesto_Disponible;
use App\Models\Reconocimiento;
use App\Models\Referencia;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostulanteController extends Controller
{
    public function getPostulante($id)
    {

        try {
            $postulante = Postulante::find($id);
            if ($postulante->referencias->isEmpty()) {
                $postulante->estado = 'incompleto';
            } else {
                if ($postulante->estado === 0) {
                    $postulante->estado = 'rechazado';
                } else {
                    if ($postulante->contrato) {
                        $postulante->estado = 'oferta';
                    } else {
                        if (!$postulante->entrevista && !$postulante->contrato) {
                            $postulante->estado = 'pendiente';
                        } else {
                            if (!$postulante->entrevista->puntos) {
                                $postulante->estado = 'entrevista';
                            } else {
                                $postulante->estado = 'entrevistado';
                            }
                        }
                    }
                }
            }
            $respuesta = [
                'id' => $postulante->ID_Usuario,
                'nombre' => $postulante->usuario->name,
                'email' => $postulante->usuario->email,
                'puesto' => $postulante->puesto_disponible ? $postulante->puesto_disponible->nombre : '',
                'estado' => $postulante->estado,
                'ci' => $postulante->usuario->ci,
                'telefono   ' => $postulante->usuario->telefono,
                'direccion' => $postulante->usuario->direccion,
                'fecha_de_nacimiento' => $postulante->fecha_de_nacimiento,
                'nacionalidad' => $postulante->nacionalidad,
                'habilidades' => $postulante->habilidades,
                'fuenteDeContratacion' => $postulante->fuente_de_contratacion ? $postulante->fuente_de_contratacion->nombre : '',
                'idioma' => $postulante->idioma ? $postulante->idioma->nombre : '',
                'nivel_idioma' => $postulante->nivel_idioma ? $postulante->nivel_idioma->categoria : '',
                'foto' => $postulante->ruta_imagen_e,
            ];
            return response()->json($respuesta);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al procesar la solicitud de getPostulante', 'error' => $th->getMessage()], 500);
        }
    }

    public function getContrato($id)
    {
        try {
            $postulante = Postulante::where('ID_Usuario', '=', $id)->first();
            $pre_contrato = Pre_Contrato::where('ID_Postulante', '=', $id)->first();
            $entrevista = Entrevista::where('ID_Postulante', '=', $id)->first();
            $departamentos = Departamento::all();
            $cargos = Cargo::all();



            $empleado = Empleado::where('ID_Usuario', '=', $pre_contrato->usuario->id)->first();

            $data = [
                'postulante' => $postulante,
                'pre_contrato' => $pre_contrato,
                'entrevista' => $entrevista,
                'departamentos' => $departamentos,
                'cargos' => $cargos,
                'empleado' => $empleado,
            ];
            $pdf = Pdf::loadView('PDF.contrato', $data);
            return $pdf->download('contrato.pdf');
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al procesar la solicitud de getContrato', 'error' => $th->getMessage()], 500);
        }
    }

    public function getEducaciones($id){
        try {
            $postulante = Postulante::find($id);
            $respuesta = $postulante->educaciones;
            return response()->json($respuesta);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al procesar la solicitud de getEducaciones', 'error' => $th->getMessage()], 500);
        }
    }

    public function getEducacionesID($id){
        try {
            $respuesta = Educacion::where('id',$id)->first();
            return response()->json($respuesta);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al procesar la solicitud de getEducacionesID', 'error' => $th->getMessage()], 500);
        }
    }

    public function getReconocimientos($id){
        try {
            $postulante = Postulante::find($id);
            $respuesta = $postulante->reconocimientos;
            return response()->json($respuesta);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al procesar la solicitud de getReconocimientos', 'error' => $th->getMessage()], 500);
        }
    }

    public function getExperiencias($id){
        try {
            $postulante = Postulante::find($id);
            $respuesta = $postulante->experiencias;
            return response()->json($respuesta);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al procesar la solicitud de getExperiencias', 'error' => $th->getMessage()], 500);
        }
    }

    public function getReferencias($id){
        try {
            $postulante = Postulante::find($id);
            $respuesta = $postulante->referencias;
            return response()->json($respuesta);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al procesar la solicitud de getReferencias', 'error' => $th->getMessage()], 500);
        }
    }

    public function actualizar(Request $request, $id)
    {
      try {

        $postulante = Postulante::where('ID_Usuario', $id)->first();


        $request->validate([
            'ruta_imagen_e' => 'required|image', 
            'fecha_de_nacimiento' => 'required|date',
            'nacionalidad' => 'required|string|max:255',
            'habilidades' => 'nullable|string',
            'ID_Fuente_De_Contratacion' => 'required|integer',
            'ID_Puesto_Disponible' => 'required|integer',
            'ID_Idioma' => 'required|integer',
            'ID_NivelIdioma' => 'required|integer',
        ]);


        // Actualiza
        $postulante->fecha_de_nacimiento = $request->input('fecha_de_nacimiento');
        $postulante->nacionalidad = $request->input('nacionalidad');
        $postulante->habilidades = $request->input('habilidades', 'No tiene habilidades.');
        $postulante->estado = $request->has('estado') ? false : null;
        $postulante->ID_Fuente_De_Contratacion = $request->input('ID_Fuente_De_Contratacion');
        $postulante->ID_Puesto_Disponible = $request->input('ID_Puesto_Disponible');
        $postulante->ID_Idioma = $request->input('ID_Idioma');
        $postulante->ID_NivelIdioma = $request->input('ID_NivelIdioma');

   
        $nombreImagen = time() . '_' . $request->file('ruta_imagen_e')->getClientOriginalName();
        $ruta = $request->file('ruta_imagen_e')->storeAs('public/imagenes/postulantes', $nombreImagen);
        $url = Storage::url($ruta);
        $postulante->ruta_imagen_e = $url;
  

        $postulante->save();
        return response()->json(['message' => 'Información actualizada exitosamente'], 200);

      } catch (\Throwable $th) {
        return response()->json(['message' => 'Error al procesar la solicitud de actualización', 'error' => $th->getMessage()], 500);
      }
    }


    public function getIdiomas(){
        try {
            $idiomas = Idioma::all();
            return response()->json($idiomas);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al procesar la solicitud de getIdiomas', 'error' => $th->getMessage()], 500);
        }
    }

    public function getNivelIdiomas(){
        try {
            $NivelIdiomas = Nivel_Idioma::all();
            return response()->json($NivelIdiomas);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al procesar la solicitud de getNivelIdiomas', 'error' => $th->getMessage()], 500);
        }
    }

    public function getPuestoDisponible(){
        try {
            $PuestoDisponible = Puesto_Disponible::all();
            return response()->json($PuestoDisponible);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al procesar la solicitud de getPuestoDisponible', 'error' => $th->getMessage()], 500);
        }
    }

    public function getFuenteDeContratacion(){
        try {
            $FuenteDeContratacion = Fuente_De_Contratacion::all();
            return response()->json($FuenteDeContratacion);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al procesar la solicitud de getFuenteDeContratacion', 'error' => $th->getMessage()], 500);
        }
    }

    public function guardarEducacion(Request $request, $id)
    {
  
      $request->validate([
        'nombre_colegio' => 'required|string',
        'grado_diploma' => 'required|string',
        'campo_de_estudio' => 'required|string',
        'fecha_de_finalizacion' => 'required|date',
        'notas_adicionales' => 'nullable|string',
      ]);

      try {
        $educacion = new Educacion();
        $educacion->nombre_colegio = $request->nombre_colegio;
        $educacion->grado_diploma = $request->grado_diploma;
        $educacion->campo_de_estudio = $request->campo_de_estudio;
        $educacion->fecha_de_finalizacion = $request->fecha_de_finalizacion;
        $educacion->notas_adicionales = $request->notas_adicionales;
        $educacion->ID_Postulante = $id;
        $educacion->save();

        return response()->json(['message' => 'Educación creada exitosamente','educacion' => $educacion], 200);
      } catch (\Throwable $th) {
        return response()->json(['message' => 'Error al procesar la solicitud de guardarEducacion','error' => $th->getMessage()], 500);
      }
    }


    public function actualizarEducacion(Request $request, $id)
    {

      $educacion = Educacion::where('id', $id)->first();
      $request->validate([
        'nombre_colegio' => 'required|string',
        'grado_diploma' => 'required|string',
        'campo_de_estudio' => 'required|string',
        'fecha_de_finalizacion' => 'required|date',
        'notas_adicionales' => 'nullable|string',
      ]);

      try {
        
        
        $educacion->nombre_colegio = $request->nombre_colegio;
        $educacion->grado_diploma = $request->grado_diploma;
        $educacion->campo_de_estudio = $request->campo_de_estudio;
        $educacion->fecha_de_finalizacion = $request->fecha_de_finalizacion;
        $educacion->notas_adicionales = $request->notas_adicionales;
  
        $educacion->save();

        return response()->json(['message' => 'Educación creada exitosamente','educacion' => $educacion], 200);
      } catch (\Throwable $th) {
        return response()->json(['message' => 'Error al procesar la solicitud de actualizarEducacion','error' => $th->getMessage()], 500);
      }
    }


    public function eliminarEducacion($id)
    {
      // Buscar la educación por su ID
      $educacion = Educacion::where('id', $id)->first();

      // Verificar si la educación existe
      if (!$educacion) {
        return response()->json(['message' => 'Educación no encontrada'], 404);
      }
      try {
        // Eliminar la educación
        $educacion->delete();

        return response()->json(['message' => 'Educación eliminada exitosamente'], 200);
      } catch (\Throwable $th) {
        return response()->json(['message' => 'Error al procesar la solicitud de eliminarEducacion', 'error' => $th->getMessage()], 500);
      }
    }



    public function guardarReconocimiento(Request $request, $id)
    {
  
      $request->validate([
        'nombre' => 'required|string',
        'descripcion' => 'required|string',
 
      ]);

      try {
        $reconocimiento = new Reconocimiento();
        $reconocimiento->nombre = $request->nombre;
        $reconocimiento->descripcion = $request->descripcion;
        $reconocimiento->ID_Postulante = $id;

        $reconocimiento->save();

        return response()->json(['message' => 'Educación creada exitosamente','reconocimiento' => $reconocimiento], 200);
      } catch (\Throwable $th) {
        return response()->json(['message' => 'Error al procesar la solicitud de guardarreconocimiento','error' => $th->getMessage()], 500);
      }
    }


    public function actualizarReconocimiento(Request $request, $id)
    {

      $reconocimiento = Reconocimiento::where('id', $id)->first();
      $request->validate([
        'nombre' => 'required|string',
        'descripcion' => 'required|string',

      ]);

      try {
        
        
        $reconocimiento->nombre = $request->nombre;
        $reconocimiento->descripcion = $request->descripcion;

  
        $reconocimiento->save();

        return response()->json(['message' => 'Educación creada exitosamente','reconocimiento' => $reconocimiento], 200);
      } catch (\Throwable $th) {
        return response()->json(['message' => 'Error al procesar la solicitud de actualizarReconocimiento','error' => $th->getMessage()], 500);
      }
    }


    public function eliminarReconocimiento($id)
    {
    
      $reconocimiento = Reconocimiento::where('id', $id)->first();


      if (!$reconocimiento) {
        return response()->json(['message' => 'Reconocimiento no encontrada'], 404);
      }
      try {
  
        $reconocimiento->delete();

        return response()->json(['message' => 'Reconocimiento eliminado exitosamente'], 200);
      } catch (\Throwable $th) {
        return response()->json(['message' => 'Error al procesar la solicitud de eliminarReconocimiento', 'error' => $th->getMessage()], 500);
      }
    }



    public function guardarExperiencia(Request $request, $id)
    {
  
      $request->validate([
        'cargo' => 'required|string',
        'descripcion' => 'required|string',
        'años' => 'required|integer',
        'lugar' => 'required|string',
 
      ]);

      try {
        $experiencia = new Experiencia();
        $experiencia->cargo = $request->cargo;
        $experiencia->descripcion = $request->descripcion;
        $experiencia->años = $request->años;
        $experiencia->lugar = $request->lugar;
        $experiencia->ID_Postulante = $id;

        $experiencia->save();

        return response()->json(['message' => 'Educación creada exitosamente','Experiencia' => $experiencia], 200);
      } catch (\Throwable $th) {
        return response()->json(['message' => 'Error al procesar la solicitud de guardarExperiencia','error' => $th->getMessage()], 500);
      }
    }


    public function actualizarExperiencia(Request $request, $id)
    {

      $experiencia = Experiencia::where('id', $id)->first();
      $request->validate([
        'cargo' => 'required|string',
        'descripcion' => 'required|string',
        'años' => 'required|integer',
        'lugar' => 'required|string',

      ]);

      try {
        
        
        $experiencia->cargo = $request->cargo;
        $experiencia->descripcion = $request->descripcion;
        $experiencia->años = $request->años;
        $experiencia->lugar = $request->lugar;

  
        $experiencia->save();

        return response()->json(['message' => 'Educación creada exitosamente','experiencia' => $experiencia], 200);
      } catch (\Throwable $th) {
        return response()->json(['message' => 'Error al procesar la solicitud de actualizarExperiencia','error' => $th->getMessage()], 500);
      }
    }


    public function eliminarExperiencia($id)
    {
    
      $experiencia = Experiencia::where('id', $id)->first();


      if (!$experiencia) {
        return response()->json(['message' => 'experiencia no encontrada'], 404);
      }
      try {
  
        $experiencia->delete();

        return response()->json(['message' => 'experiencia eliminado exitosamente'], 200);
      } catch (\Throwable $th) {
        return response()->json(['message' => 'Error al procesar la solicitud de eliminarexperiencia', 'error' => $th->getMessage()], 500);
      }
    }





    public function guardarReferencia(Request $request, $id)
    {
  
      $request->validate([
        'nombre' => 'required|string',
        'descripcion' => 'required|string',
        'telefono' => 'required|string',

 
      ]);

      try {
        $referencia = new Referencia();
        $referencia->nombre = $request->nombre;
        $referencia->descripcion = $request->descripcion;
        $referencia->telefono = $request->telefono;
        $referencia->ID_Postulante = $id;

        $referencia->save();

        return response()->json(['message' => 'Educación creada exitosamente','referencia' => $referencia], 200);
      } catch (\Throwable $th) {
        return response()->json(['message' => 'Error al procesar la solicitud de guardarreferencia','error' => $th->getMessage()], 500);
      }
    }


    public function actualizarReferencia(Request $request, $id)
    {

      $referencia = Referencia::where('id', $id)->first();
      $request->validate([
        'nombre' => 'required|string',
        'descripcion' => 'required|string',
        'telefono' => 'required|string',

      ]);

      try {
        
        
        $referencia->nombre = $request->nombre;
        $referencia->descripcion = $request->descripcion;
        $referencia->telefono = $request->telefono;

  
        $referencia->save();

        return response()->json(['message' => 'Educación creada exitosamente','referencia' => $referencia], 200);
      } catch (\Throwable $th) {
        return response()->json(['message' => 'Error al procesar la solicitud de actualizarreferencia','error' => $th->getMessage()], 500);
      }
    }


    public function eliminarReferencia($id)
    {
    
      $referencia = Referencia::where('id', $id)->first();


      if (!$referencia) {
        return response()->json(['message' => 'referencia no encontrada'], 404);
      }
      try {
  
        $referencia->delete();

        return response()->json(['message' => 'referencia eliminado exitosamente'], 200);
      } catch (\Throwable $th) {
        return response()->json(['message' => 'Error al procesar la solicitud de eliminarreferencia', 'error' => $th->getMessage()], 500);
      }
    }








}
