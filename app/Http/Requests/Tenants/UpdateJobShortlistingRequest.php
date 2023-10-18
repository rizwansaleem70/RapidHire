<?php

namespace App\Http\Requests\Tenants;


use App\Abstracts\FormRequest;

class UpdateJobShortlistingRequest extends FormRequest
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
            'job_id' => 'required|exists:jobs,id',
            'test_service_id' => 'required|exists:test_services,id',
            'test_id.*' => 'required|exists:tests,id',
        ];
    }

    public function prepareRequest(): array
    {
        $request = $this;
        return [
            'job_id' => $request['job_id'],
            'test_service_id' => $request['test_service_id'],
            'test_id' => $request['test_id'],
        ];
    }
}
