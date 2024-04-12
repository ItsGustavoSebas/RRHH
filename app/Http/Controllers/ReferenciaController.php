<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Postulante;
use App\Models\Referencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReferenciaController extends Controller
{
           //vista admin
        public function inicio(){
            $referencias = Referencia::all();
            $postulantes = Postulante::all();
            return (view('Contratacion.referencias.inicio', compact('referencias', 'postulantes'))) ;
        }
    
    
        //vista usuario postulante para ver sus referencias
        public function rinicio(){
            $id = Auth::id();
            $referencias = Referencia::where('ID_Postulante', '=', $id)->get();
            $postulante = $id;
            return (view('Contratacion.referencias.rinicio', compact('referencias', 'postulante'))) ;
        }
    
        public function crear()
        {
           
            return view('Contratacion.referencias.crear');
        }
    
        public function crearSIG()
        {
           
            return view('Contratacion.referencias.crearSIG');
        }    
    
        public function guardar(REQUEST $request)
        {
            $id = Auth::id();
            $request->validate([
                'nombre' => 'required',
                'telefono' => 'required',
            
            ]);
            $Referencia = new Referencia();
            $Referencia->nombre = $request->nombre;
            $Referencia->telefono = $request->telefono;
            $Referencia->ID_Postulante = $id;
            $Referencia->save();
    
    
    
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
                    return redirect(route('referencias.crear'))->with('creado', 'Educación añadida exitosamente');
                    break;
                case 'guardar_y_siguiente':
                    // Redirigir al dashboard
                    return redirect(route('completado'));
                    break;
                default:
                    // Si no se reconoce la acción, redirigir a alguna vista por defecto
                    return redirect(route('completado'));
            }
        }
    
        public function guardarSIG(REQUEST $request)
        {
            $id = Auth::id();
            $request->validate([
                'nombre' => 'required',
                'telefono' => 'required',
            ]);
            $Referencia = new Referencia();
            $Referencia->nombre = $request->nombre;
            $Referencia->telefono = $request->telefono;
            $Referencia->ID_Postulante = $id;
            $Referencia->save();
    
    
    
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
    
            return redirect(route('referencias.rinicio'))->with('creado', 'Curso creada exitosamente');
        }    
    
        public function editar()
        {
            $id = Auth::id();
            $referencias = Referencia::where('ID_Postulante', '=', $id)->first();
            return view('Contratacion.referencias.editar', compact('referencias'));
        }
    
        public function actualizar(REQUEST $request, $id)
        {
            $id = Auth::id();
            $Referencia = Referencia::where('ID_Postulante', '=', $id)->first();
            $request->validate([
                'nombre' => 'required',
                'telefono' => 'required',
            ]);
            $Referencia->nombre = $request->nombre;
            $Referencia->telefono = $request->telefono;
            $Referencia->ID_Postulante = $id;
    
            $Referencia->save();
    
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
            
            return redirect(route('referencias.rinicio'))->with('actualizado', 'Referencia actualizada exitosamente');
        }
    
        public function eliminar($id)
        {
            $Referencia = Referencia::where('id', '=', $id)->first();
            $Referencia->delete();
    
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
    
            return redirect(route('referencias.rinicio'))->with('eliminado', 'Referencia eliminado exitosamente');
        }
}
