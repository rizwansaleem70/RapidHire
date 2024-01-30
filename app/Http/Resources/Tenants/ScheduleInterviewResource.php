<?php

namespace App\Http\Resources\Tenants;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleInterviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "title" => "Interview Scheduled with " . $this->applicant->user->first_name . " " . $this->applicant->user->last_name,
            "interviewer_link" => $this->interviewer_link,
            "interviewee_link" => $this->interviewee_link,
            "start" => $this->interview_date . " " . $this->start_time,
            "end" => $this->interview_date . " " . $this->end_time,
            'language' => $this->language,
            'speaking' => $this->speaking,
            'behavior' => $this->behavior,
            'listening' => $this->listening,
            'interviewer_feedback' => $this->interviewer_feedback,
            'feedback_date' => $this->feedback_date
        ];
        // return parent::toArray($request);
    }
}
