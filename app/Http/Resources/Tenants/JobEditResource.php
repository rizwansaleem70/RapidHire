<?php

namespace App\Http\Resources\Tenants;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobEditResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this['job']->id,
            'name' => $this['job']->name,
            'country_id' => $this['job']->country_id,
            'state_id' => $this['job']->state_id,
            'city_id' => $this['job']->city_id,
            'department_id' => $this['job']->department_id,
            'slug' => $this['job']->slug,
            'job_description' => $this['job']->job_description,
            'type' => $this['job']->type,
            'job_type' => $this['job']->job_type,
            'min_salary' => $this['job']->min_salary,
            'max_salary' => $this['job']->max_salary,
            'post_date' => $this['job']->post_date,
            'expiry_date' => $this['job']->expiry_date,
            'total_position' => $this['job']->total_position,
            'rating' => $this['job']->rating,
            'status' => $this['job']->status,
            'salary_deliver' => $this['job']->salary_deliver,
            'cover_image' => $this['job']->cover_image ? asset($this['job']->cover_image):"",
            'job_hiring_manager' => isset($this['job']->jobHiringManager) ? new JobHiringManagerResourceCollection($this['job']->jobHiringManager) : "",
            'job_question_bank' => isset($this['job']->jobQuestionBank) ? new JobQuestionBankResourceCollection($this['job']->jobQuestionBank) : "",
            'job_requirement' => isset($this['job']->requirement) ? new RequirementResourceCollection($this['job']->requirement) : "",
            'job_country' => isset($this['job']->country) ? new CountryResource($this['job']->country) : "",
            'job_state' => isset($this['job']->state) ? new StateResource($this['job']->state) : "",
            'job_city' => isset($this['job']->city) ? new CityResource($this['job']->city) : "",
            'job_department' => isset($this['job']->department) ? new DepartmentResource($this['job']->department) : "",
            'hiringManagers' => isset($this['hiringManagers'])? new JobHiringManagerResourceCollection($this['hiringManagers']): "",
            'departments' => isset($this['departments'])? new DepartmentCollection($this['departments']): "",
            'requirements' => isset($this['requirements'])? new RequirementResourceCollection($this['requirements']): "",
            'questionBanks' => isset($this['questionBanks'])? $this['questionBanks']: "",
            'countries' => isset($this['countries'])? new CountryResourceCollection($this['countries']): "",
            'states' => isset($this['states'])? new StateResourceCollection($this['states']): "",
            'cities' => isset($this['cities'])? new CityResourceCollection($this['cities']): "",
        ];
    }
}
