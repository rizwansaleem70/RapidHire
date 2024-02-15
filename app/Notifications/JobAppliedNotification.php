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
            ->subject("Acknowledgement of Job Application")
            ->greeting("Hi " . $this->application->user->first_name ." ".$this->application->user->last_name.",")
            ->line("Thank you for your recent application for the ". $this->application->job->name . "role at ".(settings()->group(Constant::ORGANIZATION)->get("name")? ucfirst(settings()->group(Constant::ORGANIZATION)->get("name")) : "Rapid Hire.").".We appreciate the time and effort you put into submitting your application.")
            // ->line("Thank you for your recent application for the " . $this->application->job->name . " role at ".settings()->group(Constant::ORGANIZATION)->get("name") ? ucfirst(settings()->group(Constant::ORGANIZATION)->get("name")) : "Rapid Hire"." We appreciate the time and effort you put into submitting your application.")
            ->line("Your application is now under review by our hiring team.We carefully consider each candidate and will reach out to those whose qualifications best match the requirements of the position.")
            ->line("While we strive to respond to all applicants in a timely manner, the selection process may take some time. We kindly ask for your patience during this period.")
            ->line("Should your qualifications and experience meet our needs, we will contact you to discuss the next steps in the hiring process. In the meantime, if you have any questions or would like to follow up on your application, feel free to reach out to us at ".(settings()->group(Constant::ORGANIZATION)->get("phone") ?? "0000000000"))
            ->line("Once again, thank you for your interest in joining our team at ".(settings()->group(Constant::ORGANIZATION)->get("name") ? ucfirst(settings()->group(Constant::ORGANIZATION)->get("name")) : " Rapid Hire ").". We appreciate your interest and look forward to the possibility of working together.")
            ->salutation(nl2br("Best Regards,<br>Hiring Team or Department <br>".(settings()->group(Constant::ORGANIZATION)->get("name")? ucfirst(settings()->group(Constant::ORGANIZATION)->get("name")) : "Rapid Hire.")));
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
