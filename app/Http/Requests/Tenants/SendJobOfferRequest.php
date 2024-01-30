<?php

namespace App\Http\Requests\Tenants;

use Illuminate\Foundation\Http\FormRequest;

class SendJobOfferRequest extends FormRequest
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
            'application_id' => 'required|exists:applicants,id',
            'job_offer_contract' => 'required|string'
        ];
    }

    public function prepareData()
    {
        $request = $this;
        return [
            'application_id' => $request['application_id'],
            'job_offer_contract' => $request['job_offer_contract']
        ];
    }
}
