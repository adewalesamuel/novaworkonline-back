<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $url;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $url)
    {
        $this->url = $url;
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
                    ->subject('Réinitialisation du mot de passe')
                    ->greeting('Bonjour !')
                    ->line("Vous recevez cet e-mail parce que nousavons reçu
                    une demande de réinitialisation dumot de passe de votre compte.")
                    ->action('Nouveau mot de passe', url($this->url))
                    ->line('Ce lien de réinitialisation du mot de passe
                    expirera dans 60 minutes.')
                    ->line("Si vous n'avez pas demandé la réinitialisation de votre
                    mot de passe, aucune autre action n'est requise.");
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
