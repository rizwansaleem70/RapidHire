<?php

namespace App\Http\Requests\Tenants;

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
            'location_id' => 'required|exists:locations,id',
            'category_id' => 'required|exists:categories,id',
            'department_id' => 'required|exists:departments,id',
            'job_hiring_manager_id.*' => 'required|exists:users,id',
            'question_bank_id.*' => 'required|exists:question_banks,id',
            'name' => 'required|string',
            'job_description' => 'required|string',
            'type' => 'required|in:contract,full-time,temporary,part-time',
            'job_type' => 'required|in:onSite,remote,hybrid',
            'min_salary' => 'required',
            'max_salary' => 'nullable',
            'expiry_date' => 'nullable',
            'is_active' => 'required|boolean',
            'rating' => 'nullable',
            'status' => 'required|in:published,draft',
            'salary_deliver' => 'required|in:monthly,yearly',
            'image' => 'nullable',
        ];
    }

    public function prepareRequest():array
    {
        $request = $this;
        return [
            'location_id' => $request['location_id'],
            'category_id' => $request['category_id'],
            'department_id' => $request['department_id'],
            'job_hiring_manager_id' => $request['job_hiring_manager_id'],
            'question_bank_id' => $request['question_bank_id'],
            'name' => $request['name'],
            'job_description' => $request['job_description'],
            'type' => $request['type'],
            'job_type' => $request['job_type'],
            'min_salary' => $request['min_salary'],
            'max_salary' => $request['max_salary'],
            'expiry_date' => $request['expiry_date'],
            'is_active' => $request['is_active'],
            'rating' => $request['rating'],
            'status' => $request['status'],
            'salary_deliver' => $request['salary_deliver'],
            'image' => $request['image'],
        ];
    }
}
