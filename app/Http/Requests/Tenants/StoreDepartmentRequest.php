<?php

namespace App\Http\Requests\Tenants;

Use App\Abstracts\FormRequest;
/**
 */
class StoreDepartmentRequest extends FormRequest
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
            'data.*.name' => 'required',
        ];
    }

    public function prepareRequest(): array
    {
        $request = $this;
        return $request['data'];
    }
}
