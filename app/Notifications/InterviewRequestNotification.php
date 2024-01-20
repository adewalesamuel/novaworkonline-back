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
        $user = $this->interview_request->user;
        $user_name = "$user->lastname $user->firstname";
        $recruiter_name = "$recruiter->lastname $recruiter->firstname";
        $company_name = $recruiter->company_name;
        $front_path = "/demandes-entretien/" . $this->interview_request->id;

        return (new MailMessage)
                    ->subject("Nouvelle Demande d'Entretien!")
                    ->greeting('Bonjour Novawork!')
                    ->line("Le recruteur \"$recruiter_name\" de la compagnie \"$company_name\"
                    souhaite inviter le candidat \"$user_name\" pour un entretien d'embauche")
                    ->line("Veuillez l'informer dès que possible afin d'arrêter une date pour l'entretien.");
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
