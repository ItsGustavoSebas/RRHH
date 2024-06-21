<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class NotificacionesController extends Controller
{
    public function getNotificaciones($id)
    {
        try {
            $user = User::find($id);
            $respuesta = $user->notifications;
            return response()->json($respuesta);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al procesar la solicitud de getNotificaciones', 'error' => $th->getMessage()], 500);
        }
    }

    public function marcarTodasComoLeidas($id)
    {
        try {
            $user = User::find($id);
            $user->unreadNotifications->markAsRead();
            return response()->json(['success' => true], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al procesar la solicitud de marcarTodasComoLeidas', 'error' => $th->getMessage()], 500);
        }
    }

    public function marcarComoLeida($id_user, $id_noti)
    {
        try {
            $user = User::find($id_user);
            $notification = $user->notifications->find($id_noti);
            if ($notification) {
                $notification->markAsRead();
            }
            return response()->json(['success' => true], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al procesar la solicitud de marcarComoLeida', 'error' => $th->getMessage()], 500);
        }
    }
}
