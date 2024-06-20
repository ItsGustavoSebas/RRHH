<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    //vista usuario postulante para ver sus educaciones
    public function rinicio(){
        $id = Auth::id();

        $user = User::findOrFail($id);

        $mensajes = Message::where('emisor_id', $user->id)
            ->orWhere('receptor_id', $user->id)
            ->with('receptor', 'emisor')
            ->orderBy('created_at', 'desc')
            ->get()
            ->unique(function ($item) use ($user) {
                return $item->emisor_id === $user->id ? $item->receptor_id : $item->emisor_id;
            });

        return (view('2_Recursos_Humanos.comunicacionRRHH.rinicio', compact('mensajes'))) ;
    }


    public function crear()
    {
        $id = Auth::id();
        $user = User::find($id);
        if ($user->hasRole('Encargado') || $user->hasRole('Administrador')) {
            $usuarios = User::all();
        } else {
            $usuarios = User::role('Encargado')->get();
    
        }




        return view('2_Recursos_Humanos.comunicacionRRHH.chatCrear', compact ('usuarios'));
    }


    public function guardar(REQUEST $request)
    {
        $id = Auth::id();
        $request->validate([
            'receptor_id'=> 'required',
            'mensaje' => 'required',
        ]);
        $mensaje = new Message();
        $mensaje->receptor_id = $request->receptor_id;
        $mensaje->emisor_id = $id;
        $mensaje->mensaje= $request->mensaje;
        $mensaje->save();

        $user = User::findOrFail($id);


        $mensajes = Message::where('emisor_id', $user->id)
            ->orWhere('receptor_id', $user->id)
            ->with('receptor', 'emisor')
            ->orderBy('created_at', 'desc')
            ->get()
            ->unique(function ($item) use ($user) {
                return $item->emisor_id === $user->id ? $item->receptor_id : $item->emisor_id;
            });



        return redirect()->route('comunicacion.rinicio');
    }

    public function guardarCHAT(REQUEST $request)
    {
        $id = Auth::id();
        $request->validate([
            'receptor_id'=> 'required',
            'mensaje' => 'required',
        ]);
        $mensaje = new Message();
        $mensaje->receptor_id = $request->receptor_id;
        $mensaje->emisor_id = $id;
        $mensaje->mensaje= $request->mensaje;
        $mensaje->save();

        $user = User::findOrFail($id);


        $mensajes = Message::where('emisor_id', $user->id)
            ->orWhere('receptor_id', $user->id)
            ->with('receptor', 'emisor')
            ->orderBy('created_at', 'desc')
            ->get()
            ->unique(function ($item) use ($user) {
                return $item->emisor_id === $user->id ? $item->receptor_id : $item->emisor_id;
            });



        return redirect()->route('comunicacion.mostrar', $request->receptor_id);
    }


    public function mostrar($otro_id)
    {
        $usuario_id = Auth::id();
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

   
        return view('2_Recursos_Humanos.comunicacionRRHH.chatear', compact ('mensajes'));
    }
}
