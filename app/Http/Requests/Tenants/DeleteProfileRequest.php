<?php

namespace App\Http\Requests\Tenants;


use App\Abstracts\FormRequest;

class DeleteProfileRequest extends FormRequest
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
            'password' => 'required',
        ];
    }

    public function prepareData():array
    {
        $data = $this;
        return [
            'password' => $data['password'],
        ];
    }
}
