<?php

namespace App\Http\Requests\Tenants;
use App\Abstracts\FormRequest;

class StorePermissionRequest extends FormRequest
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
            'role_id' => 'required|exists:roles,id',
            'permission_id.*' => 'required|exists:permissions,id',
        ];
    }
    public function prepareRequest(): array
    {
        $request = $this;
        return [
            'role_id' => $request['role_id'],
            'permission_id' => $request['permission_id'],
        ];
    }
}
