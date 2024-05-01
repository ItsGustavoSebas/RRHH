<?php

namespace App\Observers;

use App\Models\Fuente_De_Contratacion;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;

class FuenteObserver
{
    /**
     * Handle the Fuente_De_Contratacion "created" event.
     *
     * @param  \App\Models\Fuente_De_Contratacion  $fuente_De_Contratacion
     * @return void
     */
    public function created(Fuente_De_Contratacion $fuente_De_Contratacion)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Crear Fuente de Contratación',
                'metodo' => 'POST', 
                'hora' => $horaActual,
                'tabla' => 'fuentes_de_contratacion', 
                'registroId' => $fuente_De_Contratacion->id,
                'ruta'=> Request::url(),
            ]);
        }
    }

    /**
     * Handle the Fuente_De_Contratacion "updated" event.
     *
     * @param  \App\Models\Fuente_De_Contratacion  $fuente_De_Contratacion
     * @return void
     */
    public function updated(Fuente_De_Contratacion $fuente_De_Contratacion)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Actualizar Fuente de Contratación',
                'metodo' => 'PUT', 
                'hora' => $horaActual,
                'tabla' => 'fuentes_de_contratacion', 
                'registroId' => $fuente_De_Contratacion->id,
                'ruta'=> Request::url(),
            ]);
        }
    }

    /**
     * Handle the Fuente_De_Contratacion "deleted" event.
     *
     * @param  \App\Models\Fuente_De_Contratacion  $fuente_De_Contratacion
     * @return void
     */
    public function deleted(Fuente_De_Contratacion $fuente_De_Contratacion)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Eliminar Fuente de Contratación',
                'metodo' => 'DELETE', 
                'hora' => $horaActual,
                'tabla' => 'fuentes_de_contratacion', 
                'registroId' => $fuente_De_Contratacion->id,
                'ruta'=> Request::url(),
            ]);
        }
    }

    /**
     * Handle the Fuente_De_Contratacion "restored" event.
     *
     * @param  \App\Models\Fuente_De_Contratacion  $fuente_De_Contratacion
     * @return void
     */
    public function restored(Fuente_De_Contratacion $fuente_De_Contratacion)
    {
        //
    }

    /**
     * Handle the Fuente_De_Contratacion "force deleted" event.
     *
     * @param  \App\Models\Fuente_De_Contratacion  $fuente_De_Contratacion
     * @return void
     */
    public function forceDeleted(Fuente_De_Contratacion $fuente_De_Contratacion)
    {
        //
    }
}
