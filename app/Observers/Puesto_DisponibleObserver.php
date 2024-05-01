<?php

namespace App\Observers;

use App\Models\Puesto_Disponible;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;

class Puesto_DisponibleObserver
{
    /**
     * Handle the Puesto_Disponible "created" event.
     *
     * @param  \App\Models\Puesto_Disponible  $puesto_Disponible
     * @return void
     */
    public function created(Puesto_Disponible $puesto_Disponible)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Crear Puesto Disponible',
                'metodo' => 'POST', 
                'hora' => $horaActual,
                'tabla' => 'puestos_disponibles', 
                'registroId' => $puesto_Disponible->id,
                'ruta'=> Request::url(),
            ]);
        }
    }

    /**
     * Handle the Puesto_Disponible "updated" event.
     *
     * @param  \App\Models\Puesto_Disponible  $puesto_Disponible
     * @return void
     */
    public function updated(Puesto_Disponible $puesto_Disponible)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Actualizar Puesto Disponible',
                'metodo' => 'PUT', 
                'hora' => $horaActual,
                'tabla' => 'puestos_disponibles', 
                'registroId' => $puesto_Disponible->id,
                'ruta'=> Request::url(),
            ]);
        }
    }

    /**
     * Handle the Puesto_Disponible "deleted" event.
     *
     * @param  \App\Models\Puesto_Disponible  $puesto_Disponible
     * @return void
     */
    public function deleted(Puesto_Disponible $puesto_Disponible)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Eliminar Puesto Disponible',
                'metodo' => 'DELETE', 
                'hora' => $horaActual,
                'tabla' => 'puestos_disponibles', 
                'registroId' => $puesto_Disponible->id,
                'ruta'=> Request::url(),
            ]);
        }
    }

    /**
     * Handle the Puesto_Disponible "restored" event.
     *
     * @param  \App\Models\Puesto_Disponible  $puesto_Disponible
     * @return void
     */
    public function restored(Puesto_Disponible $puesto_Disponible)
    {
        //
    }

    /**
     * Handle the Puesto_Disponible "force deleted" event.
     *
     * @param  \App\Models\Puesto_Disponible  $puesto_Disponible
     * @return void
     */
    public function forceDeleted(Puesto_Disponible $puesto_Disponible)
    {
        //
    }
}
