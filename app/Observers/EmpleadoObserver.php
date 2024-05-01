<?php

namespace App\Observers;

use App\Models\Empleado;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

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
        
            $horaActual = Crypt::encrypt(Carbon::now()->format('H:i:s'));
            $accion = Crypt::encrypt('Crear Empleado');
            $metodo = Crypt::encrypt('POST');
            $tabla = Crypt::encrypt('empleados');
            $registroId = Crypt::encrypt($empleado->ID_Usuario);
            $ruta = Crypt::encrypt(Request::url());
        
            $bitacora->detalleBitacoras()->create(compact('accion', 'metodo', 'horaActual', 'tabla', 'registroId', 'ruta'));
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
        
            $horaActual = Crypt::encrypt(Carbon::now()->format('H:i:s'));
            $accion = Crypt::encrypt('Actualizar Empleado');
            $metodo = Crypt::encrypt('PUT');
            $tabla = Crypt::encrypt('empleados');
            $registroId = Crypt::encrypt($empleado->ID_Usuario);
            $ruta = Crypt::encrypt(Request::url());
        
            $bitacora->detalleBitacoras()->create(compact('accion', 'metodo', 'horaActual', 'tabla', 'registroId', 'ruta'));
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
        
            $horaActual = Crypt::encrypt(Carbon::now()->format('H:i:s'));
            $accion = Crypt::encrypt('Eliminar Empleado');
            $metodo = Crypt::encrypt('DELETE');
            $tabla = Crypt::encrypt('empleados');
            $registroId = Crypt::encrypt($empleado->ID_Usuario);
            $ruta = Crypt::encrypt(Request::url());
        
            $bitacora->detalleBitacoras()->create(compact('accion', 'metodo', 'horaActual', 'tabla', 'registroId', 'ruta'));
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
