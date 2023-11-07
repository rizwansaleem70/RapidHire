<?php

namespace App\Http\Resources\Tenants;

use App\Models\Tenants\JobQualification;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RequirementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $is_qualification = JobQualification::where('job_id', $this->job_id)->where('name', $this->name)->count();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'input_type' => $this->input_type,
            'option' => $this->option,
            'is_selected' => $is_qualification > 1 ? true : false
        ];
    }
}
