<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RecruiterSubscripitionNotification extends Notification
{
    use Queueable;

    public $recruiter;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($recruiter)
    {
        $this->recruiter = $recruiter;
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
        $recruitername = $this->recruiter->lastname . ' ' . $this->recruiter->firstname;
        $front_path = "/recruteurs/" . $this->recruiter->id;

        return (new MailMessage)
                    ->subject("Nouveau Paiement Recruteur!")
                    ->greeting('Bonjour Admin!')
                    ->line("Le recruteur $recruitername viens de faire un paiement")
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
