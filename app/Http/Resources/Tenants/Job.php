<?php

namespace App\Http\Resources\Tenants;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Job extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        dd($this);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'country_id' => $this->country_id,
            'state_id' => $this->state_id,
            'city_id' => $this->city_id,
            'department_id' => $this->department_id,
            'slug' => $this->slug,
            'job_description' => $this->job_description,
            'type' => $this->type,
            'job_type' => $this->job_type,
            'min_salary' => $this->min_salary,
            'max_salary' => $this->max_salary,
            'post_date' => $this->post_date,
            'expiry_date' => $this->expiry_date,
            'total_position' => $this->total_position,
            'is_active' => $this->is_active,
            'rating' => $this->rating,
            'status' => $this->status,
            'salary_deliver' => $this->salary_deliver,
            'cover_image' => $this->cover_image ? asset($this->cover_image):"",
        ];
    }
}
