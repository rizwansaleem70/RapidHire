<?php

namespace App\Http\Resources\Tenants;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CandidateAppliedJobsResource extends JsonResource
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
            'name' => $this->job->name,
            'applied_date' => Carbon::parse($this->applied_date)->format('d-F-Y'),
            'skill' => $this->skills,
            'status' => $this->status,
            'url' => route('candidate.job.apply',$this->job->slug)
        ];
    }
}
