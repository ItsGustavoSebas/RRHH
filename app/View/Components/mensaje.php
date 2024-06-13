<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Message;
use App\Models\User;

class Mensaje extends Component
{
    public $opcional;
    public $mensajes;
    public $nombre;
    public $avatar;
    public $cargo;
    public $initial;
    /**
     * Create a new component instance.
     *
     * @param  int  $opcional
     * @return void
     */
    public function __construct($opcional)
    {

        $this->opcional = $opcional;
        $usuario_id = auth()->id();

        // Marcar mensajes como leídos
        Message::where('emisor_id', $this->opcional)
            ->where('receptor_id', $usuario_id)
            ->update(['leido' => 1]);
        // Obtener mensajes entre el usuario autenticado y $opcional
        $this->mensajes = Message::where(function ($query) use ($usuario_id) {
            $query->where('emisor_id', $usuario_id)
                ->where('receptor_id', $this->opcional);
        })->orWhere(function ($query) use ($usuario_id) {
            $query->where('emisor_id', $this->opcional)
                ->where('receptor_id', $usuario_id);
        })->orderBy('created_at', 'asc')->get();

        $otherUser = User::find($this->opcional);
        $this->nombre = $otherUser->name;
        $this->avatar = $otherUser->postulante
            ? $otherUser->postulante->ruta_imagen_e
            : ($otherUser->empleado ? $otherUser->empleado->ruta_imagen_e : null);
        $this->cargo = $otherUser->Postulante
                    ? 'Postulante'
                    : ($otherUser->empleado->cargo->nombre);
        $this->initial = strtoupper(substr($otherUser->name, 0, 1));
    }

    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount()
    {
        $this->cargarMensajes();
    }

    /**
     * Cargar los mensajes entre el usuario autenticado y $opcional.
     *
     * @return void
     */
    public function cargarMensajes()
    {
        
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('components.mensaje');
    }
}
