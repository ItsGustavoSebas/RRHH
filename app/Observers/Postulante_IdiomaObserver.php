<?php

namespace App\Observers;

use App\Models\Postulante_Idioma;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

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
        
            $horaActual = Crypt::encrypt(Carbon::now()->format('H:i:s'));
        
            $bitacora->detalleBitacoras()->create([
                'accion' => Crypt::encrypt('Crear Idioma de Postulante'),
                'metodo' => Crypt::encrypt('POST'), 
                'hora' => $horaActual,
                'tabla' => Crypt::encrypt('postulante_idiomas'), 
                'registroId' => Crypt::encrypt($postulante_Idioma->id),
                'ruta'=> Crypt::encrypt(Request::url()),
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
                'accion' => Crypt::encrypt('Actualizar Idioma de Postulante'),
                'metodo' => Crypt::encrypt('PUT'), 
                'hora' => Crypt::encrypt($horaActual),
                'tabla' => Crypt::encrypt('postulante_idiomas'), 
                'registroId' => Crypt::encrypt($postulante_Idioma->id),
                'ruta'=> Crypt::encrypt(Request::url()),
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
        
            $horaActual = Crypt::encrypt(Carbon::now()->format('H:i:s'));
        
            $bitacora->detalleBitacoras()->create([
                'accion' => Crypt::encrypt('Eliminar Idioma de Postulante'),
                'metodo' => Crypt::encrypt('DELETE'), 
                'hora' => $horaActual,
                'tabla' => Crypt::encrypt('postulante_idiomas'), 
                'registroId' => Crypt::encrypt($postulante_Idioma->id),
                'ruta'=> Crypt::encrypt(Request::url()),
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
