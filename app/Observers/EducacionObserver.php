<?php

namespace App\Observers;

use App\Models\Educacion;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

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
        
            $horaActual = Crypt::encrypt(Carbon::now()->format('H:i:s'));
        
            $detalleBitacoraData = [
                'accion' => Crypt::encrypt('Crear Educacion'),
                'metodo' => Crypt::encrypt('POST'),
                'hora' => $horaActual,
                'tabla' => Crypt::encrypt('educaciones'),
                'registroId' => Crypt::encrypt($educacion->id),
                'ruta' => Crypt::encrypt(Request::url()),
            ];
        
            $bitacora->detalleBitacoras()->create($detalleBitacoraData);
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
        
            $horaActual = Crypt::encrypt(Carbon::now()->format('H:i:s'));
        
            $detalleBitacoraData = [
                'accion' => Crypt::encrypt('Actualizar Educacion'),
                'metodo' => Crypt::encrypt('PUT'),
                'hora' => $horaActual,
                'tabla' => Crypt::encrypt('educaciones'),
                'registroId' => Crypt::encrypt($educacion->id),
                'ruta' => Crypt::encrypt(Request::url()),
            ];
        
            $bitacora->detalleBitacoras()->create($detalleBitacoraData);
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
        
            $horaActual = Crypt::encrypt(Carbon::now()->format('H:i:s'));
        
            $detalleBitacoraData = [
                'accion' => Crypt::encrypt('Eliminar Educacion'),
                'metodo' => Crypt::encrypt('DELETE'),
                'hora' => $horaActual,
                'tabla' => Crypt::encrypt('educaciones'),
                'registroId' => Crypt::encrypt($educacion->id),
                'ruta' => Crypt::encrypt(Request::url()),
            ];
        
            $bitacora->detalleBitacoras()->create($detalleBitacoraData);
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
