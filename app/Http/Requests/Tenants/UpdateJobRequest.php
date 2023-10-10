<?php

namespace App\Http\Requests\Tenants;

use App\Abstracts\FormRequest;

class UpdateJobRequest extends FormRequest
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
            'name' => 'required|string',
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
            'name' => $request['name'],
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
