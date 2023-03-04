<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoicePaid extends Notification
{
    use Queueable;

    protected int $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(int $user) {
        $this->user = $user;
        //$this->y = $y;
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
        return (new MailMessage)
        ->greeting('Bonjour mademoiselle Facie')
        ->subject('Changement de mot de mot de passe')
                    ->line('Nous somme très content')
                    
                    ->action('Lien pour changer votre mot de passe', url('/'))
                    ->line( "This password reset link will expire in ".config('auth.passwords.users.expire')." minutes" )
                    ->line( "If you did not request a password reset, no further action is required.{$this->user}")
                    ->line('Tu es méchant');
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
            //
        ];
    }
}
