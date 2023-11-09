<?php

namespace App\Http\Resources\Tenants;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class ProfileHeaderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'application_id' => $this->id,
            'user_id' => $this->user_id,
            'job_id' => $this->job_id,
            'status' => $this->status,
            'skills' => $this->skills,
            'applied_date' => $this->applied_date,
            'name' => $this->user->first_name." ".$this->user->last_name,
            'email' => $this->user->email,
            'address' => $this->user->address,
            'ATS_source' => 0,
            'BPO_experience' => 0,
            'hiring_chance' => 0,
            'avatar' => $this->user->avatar,
            'country' => $this->user->country->name,
            'state' => isset($this->user->state->name),
            'city' => isset($this->user->city->name),
            'resume' => asset($this->resume_path),
            'cover_letter' => asset($this->cover_letter_path),
            'experience' => new ExperienceResourceCollection($this->user->experience)
        ];
    }
}
