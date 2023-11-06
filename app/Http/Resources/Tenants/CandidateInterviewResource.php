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
            'date' => $this->interview_date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'interviewer_link' => $this->interviewer_link,
            'interviewee_link' => $this->interviewee_link
        ];
    }
}
