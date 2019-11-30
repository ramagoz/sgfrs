<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Persona;

class NotificarEmpleados extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $greeting = sprintf('Hola %s!', $notifiable->name);
 
        return (new MailMessage)
                    ->subject('Notificación de Firma de Recibos de Salarios Electrónico')
                    ->greeting($greeting)
                    ->salutation('Saludos Cordiales')
                    ->line('Tienes disponible Recibos de Salarios firmados por el Empleador, favor ingresar, verificar y firmar digitalmente en el sistema SGFRS')
                    ->action('Ingresar al SGFRS', url('/'))
                    ->line('Gracias por utilizar el SGFRS');
    
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
     public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
    }
}
