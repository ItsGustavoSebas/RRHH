<?php

namespace App\Observers;

use App\Models\Idioma;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;

class IdiomaObserver
{
    /**
     * Handle the Idioma "created" event.
     *
     * @param  \App\Models\Idioma  $idioma
     * @return void
     */
    public function created(Idioma $idioma)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Crear Idioma',
                'metodo' => 'POST', 
                'hora' => $horaActual,
                'tabla' => 'idiomas', 
                'registroId' => $idioma->id,
                'ruta'=> Request::url(),
            ]);
        }
    }

    /**
     * Handle the Idioma "updated" event.
     *
     * @param  \App\Models\Idioma  $idioma
     * @return void
     */
    public function updated(Idioma $idioma)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Actualizar Idioma',
                'metodo' => 'PUT', 
                'hora' => $horaActual,
                'tabla' => 'idiomas', 
                'registroId' => $idioma->id,
                'ruta'=> Request::url(),
            ]);
        }
    }

    /**
     * Handle the Idioma "deleted" event.
     *
     * @param  \App\Models\Idioma  $idioma
     * @return void
     */
    public function deleted(Idioma $idioma)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Eliminar Idioma',
                'metodo' => 'DELETE', 
                'hora' => $horaActual,
                'tabla' => 'idiomas', 
                'registroId' => $idioma->id,
                'ruta'=> Request::url(),
            ]);
        }
    }

    /**
     * Handle the Idioma "restored" event.
     *
     * @param  \App\Models\Idioma  $idioma
     * @return void
     */
    public function restored(Idioma $idioma)
    {
        //
    }

    /**
     * Handle the Idioma "force deleted" event.
     *
     * @param  \App\Models\Idioma  $idioma
     * @return void
     */
    public function forceDeleted(Idioma $idioma)
    {
        //
    }
}
