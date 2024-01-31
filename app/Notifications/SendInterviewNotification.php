<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Tenants\CandidateInterviews;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendInterviewNotification extends Notification
{
    use Queueable;
    public CandidateInterviews $interview;
    /**
     * Create a new notification instance.
     */
    public function __construct(CandidateInterviews $interview)
    {
        $this->interview = $interview;
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
            ->subject("You have scheduled an interview time slot")
            ->greeting("Hi " . $this->interview->applicant->first_name . ",")
            ->line('You had applied on ' . $this->interview->applicant->job->name . " job. You have been selected for the interview")
            ->line("You have selected the following time slot for the interview")
            ->line("Interview Date: " . $this->interview->interview_date)
            ->line("Interview Start Time: " . $this->interview->start_time)
            ->line("Interview End Time: " . $this->interview->end_time)
            ->line("Interview Link: " . $this->interview->interviewee_link)
            ->line("Please be available on specified date and time. ")
            ->line("Good Luck!");
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
