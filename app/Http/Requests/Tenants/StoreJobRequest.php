<?php

namespace App\Http\Requests\Tenants;

use Carbon\Carbon;
use App\Abstracts\FormRequest;

class StoreJobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'department_id' => 'required|exists:departments,id',
            'requirement_id.*' => 'required|exists:requirements,id',
            'job_hiring_manager_id.*' => 'nullable|exists:users,id',
            'question_bank_id.*' => 'required|exists:question_banks,id',
            'name' => 'required|string',
            'job_description' => 'required|string',
            'type' => 'required|in:contract,full-time,temporary,part-time',
            'job_type' => 'required|in:onSite,remote,hybrid',
            'min_salary' => 'required',
            'max_salary' => 'required|gte:min_salary',
            'expiry_date' => 'required|date|after:today',
            'total_position' => 'required',
            'rating' => 'nullable',
            'status' => 'required|in:published,draft',
            'salary_deliver' => 'required|in:monthly,yearly,weekly,hourly',
            'cover_image' => 'nullable',
            'ats_threshold' => 'required',
            'currency' => 'required'
        ];
    }

    public function prepareRequest(): array
    {
        $request = $this;
        return [
            'country_id' => $request['country_id'],
            'state_id' => $request['state_id'],
            'city_id' => $request['city_id'],
            'department_id' => $request['department_id'],
            'requirement_id' => $request['requirement_id'],
            'job_hiring_manager_id' => $request['job_hiring_manager_id'],
            'question_bank_id' => $request['question_bank_id'],
            'name' => $request['name'],
            'job_description' => $request['job_description'],
            'type' => $request['type'],
            'job_type' => $request['job_type'],
            'min_salary' => $request['min_salary'],
            'max_salary' => $request['max_salary'],
            'expiry_date' => $request['expiry_date'],
            'total_position' => $request['total_position'],
            'rating' => $request['rating'],
            'status' => $request['status'],
            'salary_deliver' => $request['salary_deliver'],
            'cover_image' => $request['cover_image'],
            'currency' => $request['currency'],
            'ats_threshold' => $request['ats_threshold'] ?? 0,
        ];
    }
}
