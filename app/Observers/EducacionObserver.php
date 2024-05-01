<?php

namespace App\Observers;

use App\Models\Educacion;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;

class EducacionObserver
{
    /**
     * Handle the Educacion "created" event.
     *
     * @param  \App\Models\Educacion  $educacion
     * @return void
     */
    public function created(Educacion $educacion)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Crear Educacion',
                'metodo' => 'POST', 
                'hora' => $horaActual,
                'tabla' => 'educaciones', 
                'registroId' => $educacion->id,
                'ruta'=> Request::url(),
            ]);
        }
    }

    /**
     * Handle the Educacion "updated" event.
     *
     * @param  \App\Models\Educacion  $educacion
     * @return void
     */
    public function updated(Educacion $educacion)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Actualizar Educacion',
                'metodo' => 'PUT', 
                'hora' => $horaActual,
                'tabla' => 'educaciones', 
                'registroId' => $educacion->id,
                'ruta'=> Request::url(),
            ]);
        }
    }

    /**
     * Handle the Educacion "deleted" event.
     *
     * @param  \App\Models\Educacion  $educacion
     * @return void
     */
    public function deleted(Educacion $educacion)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Eliminar Educacion',
                'metodo' => 'DELETE', 
                'hora' => $horaActual,
                'tabla' => 'educaciones', 
                'registroId' => $educacion->id,
                'ruta'=> Request::url(),
            ]);
        }
    }

    /**
     * Handle the Educacion "restored" event.
     *
     * @param  \App\Models\Educacion  $educacion
     * @return void
     */
    public function restored(Educacion $educacion)
    {
        //
    }

    /**
     * Handle the Educacion "force deleted" event.
     *
     * @param  \App\Models\Educacion  $educacion
     * @return void
     */
    public function forceDeleted(Educacion $educacion)
    {
        //
    }
}
