<?php

namespace App\Http\Requests\Tenants;

use App\Abstracts\FormRequest;

class UpdateLocationRequest extends FormRequest
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
            'latitude' => 'required',
            'longitude' => 'required',
        ];
    }

    public function prepareRequest():array
    {
        $request = $this;
        return [
            'name' => $request['name'],
            'latitude' => $request['latitude'],
            'longitude' => $request['longitude'],
        ];
    }
}
