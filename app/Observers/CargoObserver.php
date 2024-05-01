<?php

namespace App\Observers;

use App\Models\Bitacora;
use App\Models\Cargo;
use Carbon\Carbon;
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

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Crear Cargo',
                'metodo' => 'POST', 
                'hora' => $horaActual,
                'tabla' => 'cargos', 
                'registroId' => $cargo->id,
                'ruta'=> Request::url(),
            ]);
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

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Actualizar Cargo',
                'metodo' => 'PUT', 
                'hora' => $horaActual,
                'tabla' => 'cargos', 
                'registroId' => $cargo->id,
                'ruta'=> Request::url(),
            ]);
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

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Eliminar Cargo',
                'metodo' => 'DELETE', 
                'hora' => $horaActual,
                'tabla' => 'cargos', 
                'registroId' => $cargo->id,
                'ruta'=> Request::url(),
            ]);
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
