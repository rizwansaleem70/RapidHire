<?php

namespace App\Http\Requests\Tenants;

use App\Abstracts\FormRequest;

class RegisterRequest extends FormRequest
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
            'package_id' => 'nullable',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:tenants,email',
            'phone' => 'required|unique:tenants,phone',
            'bank_name' => 'required',
            'account_number' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'address' => 'required',
            'logo' => 'nullable',
            'about' => 'nullable',
            'website' => 'required',
            'industry' => 'required',
            'company_size' => 'required',
            'headquarter' => 'required',
            'is_verified' => 'nullable|boolean',
            'is_actively_recruiting' => 'nullable|boolean',
            'domain' => 'required|string|unique:domains,domain',
        ];
    }

    public function prepareData()
    {
        $data = $this;
        return [
            'package_id' => $data['package_id'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'bank_name' => $data['bank_name'],
            'account_number' => $data['account_number'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'address' => $data['address'],
            'logo' => $data['logo'],
            'about' => $data['about'],
            'website' => $data['website'],
            'industry' => $data['industry'],
            'company_size' => $data['company_size'],
            'headquarter' => $data['headquarter'],
            'is_verified' => $data['is_verified'],
            'is_actively_recruiting' => $data['is_actively_recruiting'],
            'domain' => $data['domain'],
        ];
    }
}
