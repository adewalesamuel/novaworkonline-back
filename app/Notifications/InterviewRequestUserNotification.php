<?php

namespace App\Notifications;

use App\Models\InterviewRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InterviewRequestUserNotification extends Notification
{
    use Queueable;

    public $interview_request;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(InterviewRequest $interview_request)
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
        $username = "$user->lastname $user->firstname";

        return (new MailMessage)
                    ->subject("Nouvelle Demande d'Entretien!")
                    ->greeting("Bonjour $username!")
                    ->line("Le recruteur $recruiter->company_name viens de faire une demande d'entretien")
                    ->line("Vous serez contacté sous peu pour passer l'entretien")
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
