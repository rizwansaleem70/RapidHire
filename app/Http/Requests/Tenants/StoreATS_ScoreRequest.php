<?php

namespace App\Http\Requests\Tenants;


use App\Abstracts\FormRequest;

class StoreATS_ScoreRequest extends FormRequest
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
            'job_id' => 'required',
            'ats' => 'required',
        ];
    }

    public function prepareRequest(): array
    {
        $request = $this;
        return [
            'job_id' => $request['job_id'],
            'ats' => $request['ats']
        ];
    }
}
