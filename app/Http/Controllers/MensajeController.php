<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MensajeController extends Controller
{
    public function inicio(){
        $id_user = auth()->id();
        $user = User::find($id_user);
        $messages = Message::where('emisor_id', $user->id)
            ->orWhere('receptor_id', $user->id)
            ->with('receptor', 'emisor')
            ->orderBy('created_at', 'desc')
            ->get()
            ->unique(function ($item) use ($user) {
                return $item->emisor_id === $user->id ? $item->receptor_id : $item->emisor_id;
            });
        $messages = $messages->map(function ($message) use ($user) {
            $otherUser = $message->receptor_id == $user->id ? $message->emisor : $message->receptor;
            $unreadCount = Message::where('emisor_id', $otherUser->id)
                ->where('receptor_id', $user->id)
                ->where('leido', false)
                ->count();

            return [
                'id' => $otherUser->id,
                'last_message' => $message->mensaje,
                'name' => $otherUser->name,
                'avatar_url' => $otherUser->postulante
                    ? $otherUser->postulante->ruta_imagen_e
                    : ($otherUser->empleado ? $otherUser->empleado->ruta_imagen_e : null),
                'pendiente' => $unreadCount,
                'initial' => strtoupper(substr($otherUser->name, 0, 1)),
            ];
        });

        $messages = $messages->values();

        if ($user->hasRole('Encargado') || $user->hasRole('Administrador')) {
            $users = User::all();
        } else {
            $users = User::role('Encargado')->get();
        }
        $usuarios = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'cargo' => $user->Postulante
                    ? 'Postulante'
                    : ($user->empleado->cargo->nombre),
                'initial' => strtoupper(substr($user->name, 0, 1)),
                'avatar_url' => $user->postulante
                    ? $user->postulante->ruta_imagen_e
                    : ($user->empleado ? $user->empleado->ruta_imagen_e : null),
            ];
        });
        $opcional = 1;

        return view ('mensajes.inicio', compact('messages', 'usuarios', 'opcional'));
    }

    public function mostrar($otro_id)
    {
        $usuario_id = auth()->id();
        Message::where('emisor_id', $otro_id)
            ->where('receptor_id', $usuario_id)
            ->update(['leido' => 1]); 

        $mensajes = Message::where(function ($query) use ($otro_id, $usuario_id) {
            $query->where('emisor_id', $usuario_id)
                ->where('receptor_id', $otro_id);
        })->orWhere(function ($query) use ($otro_id, $usuario_id) {
            $query->where('emisor_id', $otro_id)
                ->where('receptor_id', $usuario_id);
        })->orderBy('created_at', 'asc')->get();

    }

    public function enviar(Request $request, $id)
    {
        $request->validate([
            'message' => 'required',
        ]);
        $message = Message::create([
            'emisor_id' => auth()->id(),
            'receptor_id' => $id,
            'mensaje' => $request->message,
            'leido' => 0,
        ]);
        return response()->json(['success' => true]);
    }

}
