<?php

namespace App\Http\Requests\Tenants;


use App\Abstracts\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'old_password' => 'required',
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function prepareData():array
    {
        $data = $this;
        return [
            'old_password' => $data['old_password'],
            'new_password' => $data['new_password']
        ];
    }
}
