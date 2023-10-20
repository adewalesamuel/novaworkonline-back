<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InterviewRequestNotification extends Notification
{
    use Queueable;

    public $interview_request;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($interview_request)
    {
        $this->interview_request = $interview_request;
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
        $recruiter = $this->interview_request->recruiter;
        $recruitername = "$recruiter->lastname $recruiter->firstname";
        $front_path = "/demandes-entretien/" . $this->interview_request->id;

        return (new MailMessage)
                    ->subject("Nouvelle Demande d'Entretien!")
                    ->greeting('Bonjour Admin!')
                    ->line("Le recruteur $recruitername viens de faire une demande d'entretien")
                    ->action('Consulter la demande', url(env('APP_ADMIN_URL') . $front_path))
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
