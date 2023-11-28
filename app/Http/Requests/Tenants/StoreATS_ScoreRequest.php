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
            'attribute' => 'required|string',
            'weight' => 'required',
            'data.*.parameter' => 'required',
            'data.*.value' => 'required',
        ];
    }

    public function prepareRequest():array
    {
        $request = $this;
        return [
            'attribute' => $request['attribute'],
            'weight' => $request['weight'],
            'job_requirement_id' => $request['job_requirement_id'],
            'data' => $request['data'],
        ];
    }
}
