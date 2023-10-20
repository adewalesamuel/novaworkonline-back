<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MailNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $notifiable;
    public $notification_instance;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($notifiable, $notification_instance)
    {
        $this->notifiable = $notifiable;
        $this->notification_instance = $notification_instance;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->notifiable.notify($notification_instance);
    }
}
