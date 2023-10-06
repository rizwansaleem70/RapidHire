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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'job_type' => $this->job_type,
            'min_salary' => $this->min_salary,
            'max_salary' => $this->max_salary,
            'post_date' => $this->post_date,
            'expiry_date' => $this->expiry_date,
            'is_active' => $this->is_active,
            'rating' => $this->rating,
            'status' => $this->status,
            'salary_deliver' => $this->salary_deliver,
            'image' => $this->image,
        ];
    }
}
