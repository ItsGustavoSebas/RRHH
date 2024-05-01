<?php

namespace App\Observers;

use App\Models\Bitacora;
use App\Models\Departamento;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;

class DepartamentoObserver
{
    /**
     * Handle the Departamento "created" event.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return void
     */
    public function created(Departamento $departamento)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Crear Departamento',
                'metodo' => 'POST', 
                'hora' => $horaActual,
                'tabla' => 'departamentos', 
                'registroId' => $departamento->id,
                'ruta'=> Request::url(),
            ]);
        }
    }

    /**
     * Handle the Departamento "updated" event.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return void
     */
    public function updated(Departamento $departamento)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Actualizar Departamento',
                'metodo' => 'PUT', 
                'hora' => $horaActual,
                'tabla' => 'departamentos', 
                'registroId' => $departamento->id,
                'ruta'=> Request::url(),
            ]);
        }
    }

    /**
     * Handle the Departamento "deleted" event.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return void
     */
    public function deleted(Departamento $departamento)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Eliminar Departamento',
                'metodo' => 'DELETE', 
                'hora' => $horaActual,
                'tabla' => 'departamentos', 
                'registroId' => $departamento->id,
                'ruta'=> Request::url(),
            ]);
        }
    }

    /**
     * Handle the Departamento "restored" event.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return void
     */
    public function restored(Departamento $departamento)
    {
        //
    }

    /**
     * Handle the Departamento "force deleted" event.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return void
     */
    public function forceDeleted(Departamento $departamento)
    {
        //
    }
}
