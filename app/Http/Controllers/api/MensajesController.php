<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MensajesController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

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
            return [
                'emisor_id' => $message->emisor_id,
                'receptor_id' => $message->receptor_id,
                'last_message' => $message->message,
                'name' => $otherUser->name,
                'avatar' => $otherUser->postulante
                    ? $otherUser->postulante->ruta_imagen_e
                    : ($otherUser->empleado ? $otherUser->empleado->ruta_imagen_e : null),
            ];
        });

        return response()->json($messages);
    }

    public function store(Request $request)
    {
        $message = Message::create([
            'emisor_id' => $request->user()->id,
            'receptor_id' => $request->receptor_id,
            'message' => $request->message,
        ]);

        return response()->json($message);
    }

    public function show($id)
    {
        $messages = Message::where(function ($query) use ($id) {
            $query->where('emisor_id', auth()->id())
                ->where('receptor_id', $id);
        })->orWhere(function ($query) use ($id) {
            $query->where('emisor_id', $id)
                ->where('receptor_id', auth()->id());
        })->orderBy('created_at', 'asc')->get();

        return response()->json($messages);
    }

    public function usuarios($id)
    {
        $user = User::find($id);

        if ($user->hasRole('Encargado') || $user->hasRole('Administrador')) {
            $users = User::all();
        } else {
            $users = User::role('Encargado')->get();
        }

        $respuesta = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'avatar_url' => $user->postulante
                    ? $user->postulante->ruta_imagen_e
                    : ($user->empleado ? $user->empleado->ruta_imagen_e : null),
            ];
        });

        return response()->json($respuesta);
    }
}
