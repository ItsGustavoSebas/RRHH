<?php

namespace App\Observers;

use App\Models\Postulante_Idioma;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;

class Postulante_IdiomaObserver
{
    /**
     * Handle the Postulante_Idioma "created" event.
     *
     * @param  \App\Models\Postulante_Idioma  $postulante_Idioma
     * @return void
     */
    public function created(Postulante_Idioma $postulante_Idioma)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Crear Idioma de Postulante',
                'metodo' => 'POST', 
                'hora' => $horaActual,
                'tabla' => 'postulante_idiomas', 
                'registroId' => $postulante_Idioma->id,
                'ruta'=> Request::url(),
            ]);
        }
    }

    /**
     * Handle the Postulante_Idioma "updated" event.
     *
     * @param  \App\Models\Postulante_Idioma  $postulante_Idioma
     * @return void
     */
    public function updated(Postulante_Idioma $postulante_Idioma)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Actualizar Idioma de Postulante',
                'metodo' => 'PUT', 
                'hora' => $horaActual,
                'tabla' => 'postulante_idiomas', 
                'registroId' => $postulante_Idioma->id,
                'ruta'=> Request::url(),
            ]);
        }
    }

    /**
     * Handle the Postulante_Idioma "deleted" event.
     *
     * @param  \App\Models\Postulante_Idioma  $postulante_Idioma
     * @return void
     */
    public function deleted(Postulante_Idioma $postulante_Idioma)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Eliminar Idioma de Postulante',
                'metodo' => 'DELETE', 
                'hora' => $horaActual,
                'tabla' => 'postulante_idiomas', 
                'registroId' => $postulante_Idioma->id,
                'ruta'=> Request::url(),
            ]);
        }
    }

    /**
     * Handle the Postulante_Idioma "restored" event.
     *
     * @param  \App\Models\Postulante_Idioma  $postulante_Idioma
     * @return void
     */
    public function restored(Postulante_Idioma $postulante_Idioma)
    {
        //
    }

    /**
     * Handle the Postulante_Idioma "force deleted" event.
     *
     * @param  \App\Models\Postulante_Idioma  $postulante_Idioma
     * @return void
     */
    public function forceDeleted(Postulante_Idioma $postulante_Idioma)
    {
        //
    }
}
