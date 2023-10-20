<?php

namespace App\Http\Requests\Tenants;

use App\Abstracts\FormRequest;

class StoreColorSchemeRequest extends FormRequest
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
            'primary' => 'required',
            'secondary' => 'required',
        ];
    }

    public function prepareRequest():array
    {
        $request = $this;
        return [
            'primary' => $request['primary'],
            'secondary' => $request['secondary'],
        ];
    }
}
