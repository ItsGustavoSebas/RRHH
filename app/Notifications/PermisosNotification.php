<?php

namespace App\Notifications;

use App\Models\Permiso;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Ramsey\Uuid\Type\Integer;

class PermisosNotification extends Notification
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
        return ['database'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
            'type' => 'permisonuevo',
            'fecha_inicio' => $this->permiso->fecha_inicio,
            'fecha_fin' => $this->permiso->fecha_fin,
            'motivo' => $this->permiso->motivo,
            'user_id' => $this->permiso->user_id,
        ];
    }
}