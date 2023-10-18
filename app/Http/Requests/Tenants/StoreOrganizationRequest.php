<?php

namespace App\Http\Requests\Tenants;


use App\Abstracts\FormRequest;

class StoreOrganizationRequest extends FormRequest
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
            'phone' => 'required',
            'website' => 'required',
        ];
    }

    public function prepareRequest():array
    {
        $request = $this;
        return [
            'name' => $request['name'],
            'phone' => $request['phone'],
            'website' => $request['website'],
        ];
    }
}
