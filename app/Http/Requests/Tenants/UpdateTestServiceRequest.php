<?php

namespace App\Http\Requests\Tenants;


use App\Abstracts\FormRequest;

class UpdateTestServiceRequest extends FormRequest
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
            'name' => 'required|string',
            'base_url' => 'required',
            'api_key' => 'required',
            'secret_key' => 'required',
        ];
    }

    public function prepareRequest(): array
    {
        $request = $this;
        return [
            'name' => $request['name'],
            'base_url' => $request['base_url'],
            'api_key' => $request['api_key'],
            'secret_key' => $request['secret_key'],
        ];
    }
}
