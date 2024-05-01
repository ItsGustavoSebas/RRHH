<?php

namespace App\Observers;

use App\Models\Reconocimiento;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

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
        
            $horaActual = Crypt::encrypt(Carbon::now()->format('H:i:s'));
        
            $bitacora->detalleBitacoras()->create([
                'accion' => Crypt::encrypt('Crear Reconocimiento'),
                'metodo' => Crypt::encrypt('POST'), 
                'hora' => $horaActual,
                'tabla' => Crypt::encrypt('reconocimientos'), 
                'registroId' => Crypt::encrypt($reconocimiento->id),
                'ruta'=> Crypt::encrypt(Request::url()),
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
        
            $horaActual = Crypt::encrypt(Carbon::now()->format('H:i:s'));
        
            $bitacora->detalleBitacoras()->create([
                'accion' => Crypt::encrypt('Actualizar Reconocimiento'),
                'metodo' => Crypt::encrypt('PUT'), 
                'hora' => $horaActual,
                'tabla' => Crypt::encrypt('reconocimientos'), 
                'registroId' => Crypt::encrypt($reconocimiento->id),
                'ruta'=> Crypt::encrypt(Request::url()),
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
        
            $horaActual = Crypt::encrypt(Carbon::now()->format('H:i:s'));
        
            $bitacora->detalleBitacoras()->create([
                'accion' => Crypt::encrypt('Eliminar Reconocimiento'),
                'metodo' => Crypt::encrypt('DELETE'), 
                'hora' => $horaActual,
                'tabla' => Crypt::encrypt('reconocimientos'), 
                'registroId' => Crypt::encrypt($reconocimiento->id),
                'ruta'=> Crypt::encrypt(Request::url()),
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
