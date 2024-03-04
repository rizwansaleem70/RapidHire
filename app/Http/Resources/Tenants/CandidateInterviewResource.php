<?php

namespace App\Http\Resources\Tenants;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CandidateInterviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'interviewer' => optional($this->interviewer)->first_name . " " . optional($this->interviewer)->last_name,
            'interviewer_id' => $this->interviewer_id,
            'date' => $this->interview_date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'interviewer_link' => $this->interviewer_link,
            'language' => $this->language,
            'speaking' => $this->speaking,
            'behavior' => $this->behavior,
            'listening' => $this->listening,
            'interviewer_feedback' => $this->interviewer_feedback,
            'feedback_date' => $this->feedback_date
        ];
    }
}
