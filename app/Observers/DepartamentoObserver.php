<?php

namespace App\Observers;

use App\Models\Bitacora;
use App\Models\Departamento;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
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
        
            $horaActual = Crypt::encrypt(Carbon::now()->format('H:i:s'));
        
            $detalleBitacoraData = [
                'accion' => Crypt::encrypt('Crear Departamento'),
                'metodo' => Crypt::encrypt('POST'),
                'hora' => $horaActual,
                'tabla' => Crypt::encrypt('departamentos'),
                'registroId' => Crypt::encrypt($departamento->id),
                'ruta' => Crypt::encrypt(Request::url()),
            ];
        
            $bitacora->detalleBitacoras()->create($detalleBitacoraData);
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

            $horaActual = Crypt::encrypt(Carbon::now()->format('H:i:s'));

            $detalleBitacoraData = [
                'accion' => Crypt::encrypt('Actualizar Departamento'),
                'metodo' => Crypt::encrypt('PUT'),
                'hora' => $horaActual,
                'tabla' => Crypt::encrypt('departamentos'),
                'registroId' => Crypt::encrypt($departamento->id),
                'ruta' => Crypt::encrypt(Request::url()),
            ];

            $bitacora->detalleBitacoras()->create($detalleBitacoraData);
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
        
            $horaActual = Crypt::encrypt(Carbon::now()->format('H:i:s'));
        
            $detalleBitacoraData = [
                'accion' => Crypt::encrypt('Eliminar Departamento'),
                'metodo' => Crypt::encrypt('DELETE'),
                'hora' => $horaActual,
                'tabla' => Crypt::encrypt('departamentos'),
                'registroId' => Crypt::encrypt($departamento->id),
                'ruta' => Crypt::encrypt(Request::url()),
            ];
        
            $bitacora->detalleBitacoras()->create($detalleBitacoraData);
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
