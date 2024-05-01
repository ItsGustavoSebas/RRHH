<?php

namespace App\Observers;

use App\Models\Idioma;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

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
        
            $horaActual = Crypt::encrypt(Carbon::now()->format('H:i:s'));
        
            $bitacora->detalleBitacoras()->create([
                'accion' => Crypt::encrypt('Crear Idioma'),
                'metodo' => Crypt::encrypt('POST'), 
                'hora' => $horaActual,
                'tabla' => Crypt::encrypt('idiomas'), 
                'registroId' => Crypt::encrypt($idioma->id),
                'ruta'=> Crypt::encrypt(Request::url()),
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
        
            $horaActual = Crypt::encrypt(Carbon::now()->format('H:i:s'));
        
            $bitacora->detalleBitacoras()->create([
                'accion' => Crypt::encrypt('Actualizar Idioma'),
                'metodo' => Crypt::encrypt('PUT'), 
                'hora' => $horaActual,
                'tabla' => Crypt::encrypt('idiomas'), 
                'registroId' => Crypt::encrypt($idioma->id),
                'ruta'=> Crypt::encrypt(Request::url()),
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
                'accion' => Crypt::encrypt('Eliminar Idioma'),
                'metodo' => Crypt::encrypt('DELETE'), 
                'hora' => Crypt::encrypt($horaActual),
                'tabla' => Crypt::encrypt('idiomas'), 
                'registroId' => Crypt::encrypt($idioma->id),
                'ruta'=> Crypt::encrypt(Request::url()),
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
