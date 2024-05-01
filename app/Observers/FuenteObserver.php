<?php

namespace App\Observers;

use App\Models\Fuente_De_Contratacion;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

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
        
            $horaActual = Crypt::encrypt(Carbon::now()->format('H:i:s'));
            $accion = Crypt::encrypt('Crear Fuente de Contratación');
            $metodo = Crypt::encrypt('POST');
            $tabla = Crypt::encrypt('fuentes_de_contratacion');
            $registroId = Crypt::encrypt($fuente_De_Contratacion->id);
            $ruta = Crypt::encrypt(Request::url());
        
            $bitacora->detalleBitacoras()->create(compact('accion', 'metodo', 'horaActual', 'tabla', 'registroId', 'ruta'));
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
        
            $horaActual = Crypt::encrypt(Carbon::now()->format('H:i:s'));
            $accion = Crypt::encrypt('Actualizar Fuente de Contratación');
            $metodo = Crypt::encrypt('PUT');
            $tabla = Crypt::encrypt('fuentes_de_contratacion');
            $registroId = Crypt::encrypt($fuente_De_Contratacion->id);
            $ruta = Crypt::encrypt(Request::url());
        
            $bitacora->detalleBitacoras()->create(compact('accion', 'metodo', 'horaActual', 'tabla', 'registroId', 'ruta'));
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
        
            $horaActual = Crypt::encrypt(Carbon::now()->format('H:i:s'));
            $accion = Crypt::encrypt('Eliminar Fuente de Contratación');
            $metodo = Crypt::encrypt('DELETE');
            $tabla = Crypt::encrypt('fuentes_de_contratacion');
            $registroId = Crypt::encrypt($fuente_De_Contratacion->id);
            $ruta = Crypt::encrypt(Request::url());
        
            $bitacora->detalleBitacoras()->create(compact('accion', 'metodo', 'horaActual', 'tabla', 'registroId', 'ruta'));
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
