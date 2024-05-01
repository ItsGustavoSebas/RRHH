<?php

namespace App\Observers;

use App\Models\Postulante;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

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
                'accion' => Crypt::encrypt('Crear Postulante'),
                'metodo' => Crypt::encrypt('POST'), 
                'hora' => Crypt::encrypt($horaActual),
                'tabla' => Crypt::encrypt('postulantes'), 
                'registroId' => Crypt::encrypt($postulante->ID_Usuario),
                'ruta'=> Crypt::encrypt(Request::url()),
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
                'accion' => Crypt::encryptString('Actualizar Postulante'),
                'metodo' => Crypt::encryptString('PUT'), 
                'hora' => Crypt::encryptString($horaActual),
                'tabla' => Crypt::encryptString('postulantes'), 
                'registroId' => Crypt::encryptString($postulante->ID_Usuario),
                'ruta'=> Crypt::encryptString(Request::url()),
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
                'accion' => Crypt::encryptString('Eliminar Postulante'),
                'metodo' => Crypt::encryptString('DELETE'), 
                'hora' => Crypt::encryptString($horaActual),
                'tabla' => Crypt::encryptString('postulantes'), 
                'registroId' => Crypt::encryptString($postulante->ID_Usuario),
                'ruta'=> Crypt::encryptString(Request::url()),
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
