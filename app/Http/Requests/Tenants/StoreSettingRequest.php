<?php

namespace App\Http\Requests\Tenants;


use App\Abstracts\FormRequest;

class StoreSettingRequest extends FormRequest
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
        $type = $this->route()->parameters['type'];
        switch ($type) {
            case ('logo'):
                $request = [
                    'logo' => 'required',
                    'dashboard_logo' => 'required',
                ];
                break;
            case ('color-scheme'):
                $request = [
                    'primary' => 'required',
                    'secondary' => 'required',
                ];
                break;
            case ('organization'):
                $request = [
                    'name' => 'required',
                    'phone' => 'required',
                    'website' => 'required',
                ];
                break;
            case ('configuration'):
                $request = [
                    'candidate_reapply_days' => 'required',
                    'company_contract_email' => 'required',
                    'default_email_signature' => 'required',
                    'company_title_about' => 'required',
                    'job_description_about' => 'required',
                    'currency' => 'required',
                ];
                break;
            case ('core-value'):
                $request = [
                    'title' => 'required',
                    'icon' => 'required',
                    'description' => 'required'
                ];
                break;
            default:
        }
        return $request;
    }

    public function prepareRequest(): array
    {
        $request = $this;
        $type = $this->route()->parameters['type'];
        switch ($type) {
            case ('logo'):
                $prepareRequest = [
                    'logo' => $request['logo'],
                    'dashboard_logo' => $request['dashboard_logo'],
                ];
                break;
            case ('color-scheme'):
                $prepareRequest = [
                    'primary' => $request['primary'],
                    'secondary' => $request['secondary'],
                ];
                break;
            case ('organization'):
                $prepareRequest = [
                    'name' => $request['name'],
                    'phone' => $request['phone'],
                    'website' => $request['website'],
                ];
                break;
            case ('configuration'):
                $prepareRequest = [
                    'candidate_reapply_days' => $request['candidate_reapply_days'],
                    'company_contract_email' => $request['company_contract_email'],
                    'default_email_signature' => $request['default_email_signature'],
                    'company_title_about' => $request['company_title_about'],
                    'job_description_about' => $request['job_description_about'],
                    'currency' => $request['currency'],
                ];
                break;
            case ('core-value'):
                $prepareRequest = [
                    'title' => $request['title'],
                    'icon' => $request['icon'],
                    'description' => $request['description'],
                ];
                break;
            default:
        }
        return $prepareRequest;
    }
}
