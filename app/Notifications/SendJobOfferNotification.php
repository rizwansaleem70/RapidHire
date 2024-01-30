<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Models\Tenants\Applicant;
use Illuminate\Support\Facades\Log;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendJobOfferNotification extends Notification
{
    use Queueable;
    public Applicant $application;
    /**
     * Create a new notification instance.
     */
    public function __construct($application)
    {
        $this->application = $application;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("Congratulations! You have received a job offer")
            ->greeting("Hi " . $this->application->user->first_name . ",")
            ->line("You had applied on " . $this->application->job->name . ". You have cleared your interview process.")
            ->line("We have sent you a job offer. Please find in attachment.")
            ->attach(storage_path("app/public/" . $this->application->job_offer_contract));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
