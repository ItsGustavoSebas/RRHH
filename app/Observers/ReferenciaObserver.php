<?php

namespace App\Observers;

use App\Models\Referencia;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

class ReferenciaObserver
{
    /**
     * Handle the Referencia "created" event.
     *
     * @param  \App\Models\Referencia  $referencia
     * @return void
     */
    public function created(Referencia $referencia)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);
        
            $horaActual = Crypt::encrypt(Carbon::now()->format('H:i:s'));
        
            $bitacora->detalleBitacoras()->create([
                'accion' => Crypt::encrypt('Crear Referencia'),
                'metodo' => Crypt::encrypt('POST'), 
                'hora' => $horaActual,
                'tabla' => Crypt::encrypt('referencias'), 
                'registroId' => Crypt::encrypt($referencia->id),
                'ruta'=> Crypt::encrypt(Request::url()),
            ]);
        }
    }

    /**
     * Handle the Referencia "updated" event.
     *
     * @param  \App\Models\Referencia  $referencia
     * @return void
     */
    public function updated(Referencia $referencia)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);
        
            $horaActual = Crypt::encrypt(Carbon::now()->format('H:i:s'));
        
            $bitacora->detalleBitacoras()->create([
                'accion' => Crypt::encrypt('Actualizar Referencia'),
                'metodo' => Crypt::encrypt('PUT'), 
                'hora' => $horaActual,
                'tabla' => Crypt::encrypt('referencias'), 
                'registroId' => Crypt::encrypt($referencia->id),
                'ruta'=> Crypt::encrypt(Request::url()),
            ]);
        }
    }

    /**
     * Handle the Referencia "deleted" event.
     *
     * @param  \App\Models\Referencia  $referencia
     * @return void
     */
    public function deleted(Referencia $referencia)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);
        
            $horaActual = Crypt::encrypt(Carbon::now()->format('H:i:s'));
        
            $bitacora->detalleBitacoras()->create([
                'accion' => Crypt::encrypt('Eliminar Referencia'),
                'metodo' => Crypt::encrypt('DELETE'), 
                'hora' => $horaActual,
                'tabla' => Crypt::encrypt('referencias'), 
                'registroId' => Crypt::encrypt($referencia->id),
                'ruta'=> Crypt::encrypt(Request::url()),
            ]);
        }
    }

    /**
     * Handle the Referencia "restored" event.
     *
     * @param  \App\Models\Referencia  $referencia
     * @return void
     */
    public function restored(Referencia $referencia)
    {
        //
    }

    /**
     * Handle the Referencia "force deleted" event.
     *
     * @param  \App\Models\Referencia  $referencia
     * @return void
     */
    public function forceDeleted(Referencia $referencia)
    {
        //
    }
}
