<?php

namespace App\Observers;

use App\Models\Experiencia;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;

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

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Crear Experiencia',
                'metodo' => 'POST', 
                'hora' => $horaActual,
                'tabla' => 'experiencias', 
                'registroId' => $experiencia->id,
                'ruta'=> Request::url(),
            ]);
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

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Actualizar Experiencia',
                'metodo' => 'PUT', 
                'hora' => $horaActual,
                'tabla' => 'experiencias', 
                'registroId' => $experiencia->id,
                'ruta'=> Request::url(),
            ]);
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

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Eliminar Experiencia',
                'metodo' => 'DELETE', 
                'hora' => $horaActual,
                'tabla' => 'experiencias', 
                'registroId' => $experiencia->id,
                'ruta'=> Request::url(),
            ]);
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
