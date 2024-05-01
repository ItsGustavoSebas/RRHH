<?php

namespace App\Observers;

use App\Models\Postulante;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;

class PostulanteObserver
{
    /**
     * Handle the Postulante "created" event.
     *
     * @param  \App\Models\Postulante  $postulante
     * @return void
     */
    public function created(Postulante $postulante)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Crear Postulante',
                'metodo' => 'POST', 
                'hora' => $horaActual,
                'tabla' => 'postulantes', 
                'registroId' => $postulante->ID_Usuario,
                'ruta'=> Request::url(),
            ]);
        }
    }

    /**
     * Handle the Postulante "updated" event.
     *
     * @param  \App\Models\Postulante  $postulante
     * @return void
     */
    public function updated(Postulante $postulante)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Actualizar Postulante',
                'metodo' => 'PUT', 
                'hora' => $horaActual,
                'tabla' => 'postulantes', 
                'registroId' => $postulante->ID_Usuario,
                'ruta'=> Request::url(),
            ]);
        }
    }

    /**
     * Handle the Postulante "deleted" event.
     *
     * @param  \App\Models\Postulante  $postulante
     * @return void
     */
    public function deleted(Postulante $postulante)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Eliminar Postulante',
                'metodo' => 'DELETE', 
                'hora' => $horaActual,
                'tabla' => 'postulantes', 
                'registroId' => $postulante->ID_Usuario,
                'ruta'=> Request::url(),
            ]);
        }
    }

    /**
     * Handle the Postulante "restored" event.
     *
     * @param  \App\Models\Postulante  $postulante
     * @return void
     */
    public function restored(Postulante $postulante)
    {
        //
    }

    /**
     * Handle the Postulante "force deleted" event.
     *
     * @param  \App\Models\Postulante  $postulante
     * @return void
     */
    public function forceDeleted(Postulante $postulante)
    {
        //
    }
}
