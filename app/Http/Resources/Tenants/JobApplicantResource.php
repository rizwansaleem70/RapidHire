<?php

namespace App\Http\Resources\Tenants;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobApplicantResource extends JsonResource
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
            'user_id' => $this->user_id,
            'job_id' => $this->job_id,
            'name' => $this->first_name . " " . $this->last_name,
            'email' => $this->email,
            'at_score' => $this->ats ?? 0,
            'applied_date' => Carbon::parse($this->applied_date)->format('d-F-Y'),
            'skill' => $this->skills,
            'status' => $this->status
        ];
    }
}
