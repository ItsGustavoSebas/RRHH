<?php

namespace App\Notifications;

use App\Models\Permiso;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PermisoRechazadoNotification extends Notification
{
    use Queueable;
    public $permiso;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Permiso $permiso)
    {
        $this->permiso = $permiso;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Confirmación de Oermiso Rechazado')
            ->markdown('correos.permisorechazado', ['permiso' => $this->permiso, 'notifiable' => $notifiable]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'notifiable' => $notifiable,
            'permiso_id' => $this->permiso->id,
            'type' => 'Permiso Rechazado',
            'fecha_inicio' => $this->permiso->fecha_inicio,
            'fecha_fin' => $this->permiso->fecha_fin,
            'motivo' => $this->permiso->motivo,
        ];
    }
}
