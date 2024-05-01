<?php

namespace App\Observers;

use App\Models\Empleado;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;


class EmpleadoObserver
{
    /**
     * Handle the Empleado "created" event.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return void
     */
    public function created(Empleado $empleado)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Crear Empleado',
                'metodo' => 'POST', 
                'hora' => $horaActual,
                'tabla' => 'empleados', 
                'registroId' => $empleado->ID_Usuario,
                'ruta'=> Request::url(),
            ]);
        }
    }

    /**
     * Handle the Empleado "updated" event.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return void
     */
    public function updated(Empleado $empleado)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Actualizar Empleado',
                'metodo' => 'PUT', 
                'hora' => $horaActual,
                'tabla' => 'empleados', 
                'registroId' => $empleado->ID_Usuario,
                'ruta'=> Request::url(),
            ]);
        }
    }

    /**
     * Handle the Empleado "deleted" event.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return void
     */
    public function deleted(Empleado $empleado)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Eliminar Empleado',
                'metodo' => 'DELETE', 
                'hora' => $horaActual,
                'tabla' => 'empleados', 
                'registroId' => $empleado->ID_Usuario,
                'ruta'=> Request::url(),
            ]);
        }
    }

    /**
     * Handle the Empleado "restored" event.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return void
     */
    public function restored(Empleado $empleado)
    {
        //
    }

    /**
     * Handle the Empleado "force deleted" event.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return void
     */
    public function forceDeleted(Empleado $empleado)
    {
        //
    }
}
