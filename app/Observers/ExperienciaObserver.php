<?php

namespace App\Observers;

use App\Models\Experiencia;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

class ExperienciaObserver
{
    /**
     * Handle the Experiencia "created" event.
     *
     * @param  \App\Models\Experiencia  $experiencia
     * @return void
     */
    public function created(Experiencia $experiencia)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);
        
            $horaActual = Crypt::encrypt(Carbon::now()->format('H:i:s'));
            $accion = Crypt::encrypt('Crear Experiencia');
            $metodo = Crypt::encrypt('POST');
            $tabla = Crypt::encrypt('experiencias');
            $registroId = Crypt::encrypt($experiencia->id);
            $ruta = Crypt::encrypt(Request::url());
        
            $bitacora->detalleBitacoras()->create(compact('accion', 'metodo', 'horaActual', 'tabla', 'registroId', 'ruta'));
        }
    }

    /**
     * Handle the Experiencia "updated" event.
     *
     * @param  \App\Models\Experiencia  $experiencia
     * @return void
     */
    public function updated(Experiencia $experiencia)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);
        
            $horaActual = Crypt::encrypt(Carbon::now()->format('H:i:s'));
            $accion = Crypt::encrypt('Actualizar Experiencia');
            $metodo = Crypt::encrypt('PUT');
            $tabla = Crypt::encrypt('experiencias');
            $registroId = Crypt::encrypt($experiencia->id);
            $ruta = Crypt::encrypt(Request::url());
        
            $bitacora->detalleBitacoras()->create(compact('accion', 'metodo', 'horaActual', 'tabla', 'registroId', 'ruta'));
        }
    }

    /**
     * Handle the Experiencia "deleted" event.
     *
     * @param  \App\Models\Experiencia  $experiencia
     * @return void
     */
    public function deleted(Experiencia $experiencia)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);
        
            $horaActual = Crypt::encrypt(Carbon::now()->format('H:i:s'));
            $accion = Crypt::encrypt('Eliminar Experiencia');
            $metodo = Crypt::encrypt('DELETE');
            $tabla = Crypt::encrypt('experiencias');
            $registroId = Crypt::encrypt($experiencia->id);
            $ruta = Crypt::encrypt(Request::url());
        
            $bitacora->detalleBitacoras()->create(compact('accion', 'metodo', 'horaActual', 'tabla', 'registroId', 'ruta'));
        }
    }

    /**
     * Handle the Experiencia "restored" event.
     *
     * @param  \App\Models\Experiencia  $experiencia
     * @return void
     */
    public function restored(Experiencia $experiencia)
    {
        //
    }

    /**
     * Handle the Experiencia "force deleted" event.
     *
     * @param  \App\Models\Experiencia  $experiencia
     * @return void
     */
    public function forceDeleted(Experiencia $experiencia)
    {
        //
    }
}
