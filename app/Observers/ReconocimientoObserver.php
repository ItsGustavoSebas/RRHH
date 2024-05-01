<?php

namespace App\Observers;

use App\Models\Reconocimiento;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;

class ReconocimientoObserver
{
    /**
     * Handle the Reconocimiento "created" event.
     *
     * @param  \App\Models\Reconocimiento  $reconocimiento
     * @return void
     */
    public function created(Reconocimiento $reconocimiento)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Crear Reconocimiento',
                'metodo' => 'POST', 
                'hora' => $horaActual,
                'tabla' => 'reconocimientos', 
                'registroId' => $reconocimiento->id,
                'ruta'=> Request::url(),
            ]);
        }
    }

    /**
     * Handle the Reconocimiento "updated" event.
     *
     * @param  \App\Models\Reconocimiento  $reconocimiento
     * @return void
     */
    public function updated(Reconocimiento $reconocimiento)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Actualizar Reconocimiento',
                'metodo' => 'PUT', 
                'hora' => $horaActual,
                'tabla' => 'reconocimientos', 
                'registroId' => $reconocimiento->id,
                'ruta'=> Request::url(),
            ]);
        }
    }

    /**
     * Handle the Reconocimiento "deleted" event.
     *
     * @param  \App\Models\Reconocimiento  $reconocimiento
     * @return void
     */
    public function deleted(Reconocimiento $reconocimiento)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Eliminar Reconocimiento',
                'metodo' => 'DELETE', 
                'hora' => $horaActual,
                'tabla' => 'reconocimientos', 
                'registroId' => $reconocimiento->id,
                'ruta'=> Request::url(),
            ]);
        }
    }

    /**
     * Handle the Reconocimiento "restored" event.
     *
     * @param  \App\Models\Reconocimiento  $reconocimiento
     * @return void
     */
    public function restored(Reconocimiento $reconocimiento)
    {
        //
    }

    /**
     * Handle the Reconocimiento "force deleted" event.
     *
     * @param  \App\Models\Reconocimiento  $reconocimiento
     * @return void
     */
    public function forceDeleted(Reconocimiento $reconocimiento)
    {
        //
    }
}
