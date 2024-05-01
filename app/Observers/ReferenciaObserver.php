<?php

namespace App\Observers;

use App\Models\Referencia;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;

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

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Crear Referencia',
                'metodo' => 'POST', 
                'hora' => $horaActual,
                'tabla' => 'referencias', 
                'registroId' => $referencia->id,
                'ruta'=> Request::url(),
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

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Actualizar Referencia',
                'metodo' => 'PUT', 
                'hora' => $horaActual,
                'tabla' => 'referencias', 
                'registroId' => $referencia->id,
                'ruta'=> Request::url(),
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

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Eliminar Referencia',
                'metodo' => 'DELETE', 
                'hora' => $horaActual,
                'tabla' => 'referencias', 
                'registroId' => $referencia->id,
                'ruta'=> Request::url(),
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
