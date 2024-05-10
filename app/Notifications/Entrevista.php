<?php

namespace App\Notifications;

use App\Models\Entrevista as ModelsEntrevista;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Entrevista extends Notification
{
    use Queueable;

    public $entrevista;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ModelsEntrevista $entrevista)
    {
        $this->entrevista = $entrevista;
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
            ->subject('Confirmación de Selección para Entrevista')
            ->markdown('correos.entrevista', ['entrevista' => $this->entrevista, 'notifiable' => $notifiable]);
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
        'entrevista_id' => $this->entrevista->id,
        'type' => 'entrevista',
        'fecha_inicio' => $this->entrevista->fecha_inicio,
        'hora' => $this->entrevista->hora,
        'detalles' => $this->entrevista->detalles,
        ];
    }
}
