<?php

namespace App\Http\Resources\Tenants;

use Carbon\Carbon;
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
//            'country' => $this->country ? $this->country->name :"",
//            'state' => $this->state ? $this->state->name : "",
//            'city' => $this->city ? $this->city->name : "",
            'country_id' => $this->country_id,
            'state_id' => $this->state_id,
            'city_id' => $this->city_id,
            'address'=> $this->address,
            'application_id' => isset($this->applicant) ? $this->applicant->id : "",
            'email' => $this->email,
            'mobile' => $this->phone,
            'gender' => $this->gender,
            'is_active' => $this->is_active,
            'facebook' => $this->facebook,
            'linkedin' => $this->linkedin,
            'twitter' => $this->twitter,
            'instagram' => $this->instagram,
            'pinterest' => $this->pinterest,
            'youtube' => $this->youtube,
            'dob' => Carbon::parse($this->dob)->format('Y-m-d'),
            'bio' => $this->bio,
            'current_salary' => $this->current_salary,
            'salary_type' => $this->salary_type,
            'skills' => $this->skills,
            'introduction_video_url' => $this->introduction_video_url,
            'avatar' => $this->avatar ? asset($this->avatar) : "",
            'resume' => $this->resume_path ? asset($this->resume_path) :"",
            'experience' => new ExperienceResourceCollection($this->experience),
            'eduction' =>   new EducationResourceCollection($this->education)
        ];
    }
}
