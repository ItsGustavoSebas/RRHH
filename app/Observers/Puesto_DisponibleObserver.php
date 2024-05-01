<?php

namespace App\Observers;

use App\Models\Puesto_Disponible;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

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
                'accion' => Crypt::encrypt('Crear Puesto Disponible'),
                'metodo' => Crypt::encrypt('POST'), 
                'hora' => Crypt::encrypt($horaActual),
                'tabla' => Crypt::encrypt('puestos_disponibles'), 
                'registroId' => Crypt::encrypt($puesto_Disponible->id),
                'ruta'=> Crypt::encrypt(Request::url()),
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
        
            $horaActual = Crypt::encrypt(Carbon::now()->format('H:i:s'));
        
            $bitacora->detalleBitacoras()->create([
                'accion' => Crypt::encrypt('Actualizar Puesto Disponible'),
                'metodo' => Crypt::encrypt('PUT'), 
                'hora' => $horaActual,
                'tabla' => Crypt::encrypt('puestos_disponibles'), 
                'registroId' => Crypt::encrypt($puesto_Disponible->id),
                'ruta'=> Crypt::encrypt(Request::url()),
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
        
            $horaActual = Crypt::encrypt(Carbon::now()->format('H:i:s'));
        
            $bitacora->detalleBitacoras()->create([
                'accion' => Crypt::encrypt('Eliminar Puesto Disponible'),
                'metodo' => Crypt::encrypt('DELETE'), 
                'hora' => $horaActual,
                'tabla' => Crypt::encrypt('puestos_disponibles'), 
                'registroId' => Crypt::encrypt($puesto_Disponible->id),
                'ruta'=> Crypt::encrypt(Request::url()),
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
