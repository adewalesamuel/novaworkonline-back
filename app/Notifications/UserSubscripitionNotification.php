<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserSubscripitionNotification extends Notification
{
    use Queueable;

    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
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
        $username = $this->user->lastname . " " . $this->user->firstname;
        $front_path = "/candidats/" . $this->user->id;

        return (new MailMessage)
                    ->subject("Nouveau Paiement Candidat!")
                    ->greeting('Bonjour Admin!')
                    ->line("Le candidat $username viens de faire un paiement")
                    ->action('Consulter son profil', url(env('APP_ADMIN_URL') . $front_path))
                    ->line("Merci d'utiliser l'application!");
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
