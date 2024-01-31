<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Tenants\CandidateInterviews;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendInterviewNotificationToInterviewer extends Notification
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
            ->subject("An interview has been scheduled for you.")
            ->greeting("Hi " . $this->interview->interviewer->first_name . ",")
            ->line($this->interview->applicant->first_name . ' has scheduled an interview on the following date and time')
            ->line("You have selected the following time slot for the interview")
            ->line("Interview Date: " . $this->interview->interview_date)
            ->line("Interview Start Time: " . $this->interview->start_time)
            ->line("Interview End Time: " . $this->interview->end_time)
            ->line("Interview Link: " . $this->interview->interviewee_link)
            ->line("Please be available on specified date and time. ");
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
