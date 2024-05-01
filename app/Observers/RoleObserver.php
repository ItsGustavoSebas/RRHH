<?php

namespace App\Observers;

use Spatie\Permission\Models\Role;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;

class RoleObserver
{
    /**
     * Handle the Role "created" event.
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return void
     */
    public function created(Role $role)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Crear Rol',
                'metodo' => 'POST', 
                'hora' => $horaActual,
                'tabla' => 'roles', 
                'registroId' => $role->id,
                'ruta'=> Request::url(),
            ]);
        }
    }

    /**
     * Handle the Role "updated" event.
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return void
     */
    public function updated(Role $role)
    {
        
    }

    /**
     * Handle the Role "deleted" event.
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return void
     */
    public function deleted(Role $role)
    {
        $bitacora_id = session('bitacora_id');

        if ($bitacora_id) {
            $bitacora = Bitacora::find($bitacora_id);

            $horaActual = Carbon::now()->format('H:i:s');

            $bitacora->detalleBitacoras()->create([
                'accion' => 'Eliminar Rol',
                'metodo' => 'DELETE', 
                'hora' => $horaActual,
                'tabla' => 'roles', 
                'registroId' => $role->id,
                'ruta'=> Request::url(),
            ]);
        }
    }

    /**
     * Handle the Role "restored" event.
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return void
     */
    public function restored(Role $role)
    {
        //
    }

    /**
     * Handle the Role "force deleted" event.
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return void
     */
    public function forceDeleted(Role $role)
    {
        //
    }
}
