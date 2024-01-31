<?php

namespace App\Notifications;

use App\Helpers\Constant;
use Illuminate\Bus\Queueable;
use App\Models\Tenants\Applicant;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class JobAppliedNotification extends Notification
{
    use Queueable;
    public Applicant $application;
    /**
     * Create a new notification instance.
     */
    public function __construct(Applicant $application)
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
        $status = $this->application->status != Constant::QUALIFICATION ? 'Qualified' : $this->application->status;

        return (new MailMessage)
            ->subject("You have applied on a " . $this->application->job->name . " job")
            ->greeting("Hi " . $this->application->user->first_name . ", ")
            ->line('You have successfully applied to ' . $this->application->job->name . " job.")
            ->line("Current status of your application is " . $status)
            ->line('Our recruitment team will look into your application');
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
