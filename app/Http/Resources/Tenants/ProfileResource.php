<?php

namespace App\Http\Resources\Tenants;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'full_name' => $this->first_name." ".$this->last_name,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'country' => $this->country->name,
            'state' => isset($this->state->name),
            'city' => isset($this->city->name),
            'address'=> $this->address,
            'application_id' => $this->applicant->id,
            'email' => $this->email,
            'mobile' => $this->phone,
            'gender' => $this->gender,
            'is_active' => $this->is_active,
            'dob' => $this->dob,
            'bio' => $this->bio,
            'current_salary' => $this->current_salary,
            'salary_type' => $this->salary_type,
            'skills' => $this->skills,
            'introduction_video_url' => $this->introduction_video_url,
            'source_detail' => $this->applicant->source_detail,
            'avatar' => asset($this->avatar),
            'resume' => asset($this->applicant->resume_path),
            'cover_letter' => asset($this->applicant->cover_letter_path),
            'experience' => new ExperienceResourceCollection($this->experience)
        ];
    }
}
