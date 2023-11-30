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
            'application_id' => $this->id ?? "",
            'user_id' => $this->user_id ?? "",
            'first_name' => $this->first_name ?? "",
            'last_name' =>  $this->last_name ?? "",
            'email' => $this->user->email ?? "",
            'dob' => $this->user->dob ? Carbon::parse($this->user->dob)->format('Y-m-d') : "",
            'bio' => $this->user->bio ?? "",
            'avatar' => $this->user->avatar ? asset($this->user->avatar) : "",
            'phone' =>  $this->phone ?? "",
            'address' =>  $this->address ?? "",
            'gender' =>  $this->gender ?? "",
            'status' => $this->status ?? "",
            'skills' => $this->skills ?? "",
            'source_detail' => $this->source_detail ?? "",
            'applied_date' => $this->applied_date ?? "",
            'ATS_source' => $this->ats ?? 0,
            'country' => $this->country->name ?? "",
            'state' => $this->state->name ?? "",
            'city' => $this->city->name ?? "",
            'resume' => isset($this->job_resume_path) ? asset($this->job_resume_path) : "",
            'cover_letter' => isset($this->cover_letter_path) ? asset($this->cover_letter_path) : "",
            'experience' => isset($this->jobExperience) ? new ExperienceResourceCollection($this->jobExperience) : ""
        ];
    }
}
