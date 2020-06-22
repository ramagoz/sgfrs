<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Persona;


class NotificarEmpleador extends Notification
{
    use Queueable;
   
    /**public static $toMailCallback;
       
    /**
     * Create a new notification instance.
     *
     * @return void
     */

    /**
     * Create a new notification instance.
     *
     * @return void
     */
   /* public function __construct(User $user)
    {
        $this->fromUser = $user;
    }*/


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
       /*  if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable);
        }*/
        //$subject = sprintf('%s: You\'ve got a new message from %s!', config('app.name'));
        $greeting = sprintf('Hola %s!', $notifiable->name);
 
        return (new MailMessage)
                    ->subject('Notificación de Firma de Recibos de Salarios Electrónico')
                    ->greeting($greeting)
                    ->salutation('Saludos Cordiales')
                    ->line('Favor ingresar al SGFRS para firmar digitalmente los recibos de salarios electrónicos importado y validado por RRHH')
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
