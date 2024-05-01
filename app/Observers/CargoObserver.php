<?php

namespace App\Observers;

use App\Models\Bitacora;
use App\Models\Cargo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Request;

class CargoObserver
{
    /**
     * Handle the Cargo "created" event.
     *
     * @param  \App\Models\Cargo  $cargo
     * @return void
     */
    public function created(Cargo $cargo)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);
        
            $horaActual = Crypt::encrypt(Carbon::now()->format('H:i:s'));
        
            // Detalle de la bitácora encriptado
            $detalleBitacoraData = [
                'accion' => Crypt::encrypt('Crear Cargo'),
                'metodo' => Crypt::encrypt('POST'), 
                'hora' => $horaActual,
                'tabla' => Crypt::encrypt('cargos'), 
                'registroId' => Crypt::encrypt($cargo->id), 
                'ruta' => Crypt::encrypt(Request::url()),
            ];
        
            $bitacora->detalleBitacoras()->create($detalleBitacoraData);
        }
    }

    /**
     * Handle the Cargo "updated" event.
     *
     * @param  \App\Models\Cargo  $cargo
     * @return void
     */
    public function updated(Cargo $cargo)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);
        
            $horaActual = Crypt::encrypt(Carbon::now()->format('H:i:s'));
        
            $detalleBitacoraData = [
                'accion' => Crypt::encrypt('Actualizar Cargo'),
                'metodo' => Crypt::encrypt('PUT'),
                'hora' => $horaActual,
                'tabla' => Crypt::encrypt('cargos'),
                'registroId' => Crypt::encrypt($cargo->id),
                'ruta' => Crypt::encrypt(Request::url()),
            ];
        
            $bitacora->detalleBitacoras()->create($detalleBitacoraData);
        }
    }

    /**
     * Handle the Cargo "deleted" event.
     *
     * @param  \App\Models\Cargo  $cargo
     * @return void
     */
    public function deleted(Cargo $cargo)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);
        
            $horaActual = Crypt::encrypt(Carbon::now()->format('H:i:s'));
        
            $detalleBitacoraData = [
                'accion' => Crypt::encrypt('Eliminar Cargo'),
                'metodo' => Crypt::encrypt('DELETE'),
                'hora' => $horaActual,
                'tabla' => Crypt::encrypt('cargos'),
                'registroId' => Crypt::encrypt($cargo->id),
                'ruta' => Crypt::encrypt(Request::url()),
            ];
        
            $bitacora->detalleBitacoras()->create($detalleBitacoraData);
        }
    }

    /**
     * Handle the Cargo "restored" event.
     *
     * @param  \App\Models\Cargo  $cargo
     * @return void
     */
    public function restored(Cargo $cargo)
    {
        //
    }

    /**
     * Handle the Cargo "force deleted" event.
     *
     * @param  \App\Models\Cargo  $cargo
     * @return void
     */
    public function forceDeleted(Cargo $cargo)
    {
        //
    }
}
