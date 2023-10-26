<?php

namespace App\Http\Requests\Tenants;

use App\Abstracts\FormRequest as AbstractsFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class CreateMemberRequest extends AbstractsFormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:candidates',
            'role' => 'required',
            'status' => 'required|boolean',
            'password' => 'required|confirmed'
        ];
    }

    public function prepareData()
    {
        $data = $this;
        return [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'role' => $data['role'],
            'phone' => $data['phone'],
            'designation' => $data['designation'],
            'image' => $data['image'],
            'department_id' => $data['department_id'],
            'status' => (bool) $data['status'],
            'password' => bcrypt($data['password'])
        ];
    }
}
