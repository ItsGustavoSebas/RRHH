<?php

namespace App\Listeners;

use App\Models\Bitacora;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogSuccessfulLogout
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $bitacora = Bitacora::where('ID_Usuario', $event->user->id)
            ->latest()
            ->first();

        if ($bitacora) {
            $bitacora->update([
                'salida' => now(),
            ]);
        }

        $horaActual = Carbon::now()->format('H:i:s');

        $bitacora->detalleBitacoras()->create([
            'accion' => 'Cerrar Sesión',
            'metodo' => request()->method(),
            'hora' => $horaActual,
            'tabla'=> 'usuarios',
            'registroId' => null,
            'ruta'=> request()->fullurl(),
        ]);
    }
}
