<?php

namespace App\Http\Requests\Tenants;


use App\Abstracts\FormRequest;

class UpdateJobRequirementRequest extends FormRequest
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
            'name' => 'required',
            'input_type' => 'required',
            'option' => 'required',
        ];
    }

    public function prepareRequest(): array
    {
        $request = $this;
        return [
            'name' => $request['name'],
            'input_type' => $request['input_type'],
            'option' => $request['option'],
        ];
    }
}
