<?php

namespace App\Http\Requests;


use App\Abstracts\FormRequest;

class ForgotPasswordRequest extends FormRequest
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
            'email' => 'required|email|exists:candidates,email',
        ];
    }
    public function prepareRequest(): array
    {
        $data = $this;
        return [
            'email' => $data['email'],
        ];
    }
}
