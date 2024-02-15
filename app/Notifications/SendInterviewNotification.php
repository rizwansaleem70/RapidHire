<?php

namespace App\Notifications;

use App\Helpers\Constant;
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
            ->greeting("Hi " . $this->interview->applicant->first_name ." ".$this->interview->applicant->last_name.",")
            ->line("You have selected " . $this->interview->interview_date. " and ".$this->interview->start_time." or your interview.You would be interviewed by ".$this->interview->interviewer->first_name." ".$this->interview->interviewer->last_name.".")
            ->line("You can find the interview link below, Please be advise to show up 5 minutes before the interview. In case of cancelation please inform the ".$this->interview->interviewer->first_name." ".$this->interview->interviewer->last_name." by email 1 hour before the interview, otherwise your application would be rejected.")
            ->line("We wish you the best of luck, and hope to see you in our ranks.")
            ->salutation(nl2br("Best Regards,<br>".(settings()->group(Constant::ORGANIZATION)->get("name")? ucfirst(settings()->group(Constant::ORGANIZATION)->get("name")) : "Rapid Hire.")));
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
