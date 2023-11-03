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
            'user_id' => $this->user->id,
            'job_id' => $this->job_id,
            'name' => $this->user->first_name.$this->user->last_name,
            'at_score' => 0,
            'applied_date' => Carbon::parse($this->applied_date)->format('d-F-Y'),
            'skill' => $this->skills,
            'status' => $this->status
        ];
    }
}
