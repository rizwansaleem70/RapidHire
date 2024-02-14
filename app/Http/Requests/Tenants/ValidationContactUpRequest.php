<?php

namespace App\Http\Requests\Tenants;

use App\Abstracts\FormRequest;


class ValidationContactUpRequest extends FormRequest
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
            'email' => 'required|email',
            'subject' => 'required',
            'massage' => 'required',
        ];
    }

    public function prepareRequest(): array
    {
        $request = $this;
        return [
            'name' => $request['name'],
            'email' => $request['email'],
            'subject' => $request['subject'],
            'massage' => $request['massage'],
        ];
    }
}
