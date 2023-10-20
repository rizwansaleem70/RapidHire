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
        switch($type) {
            case('logo'):
                $request = [
                    'logo' => 'required',
                ];
                break;
            case('color-scheme'):
                $request = [
                    'primary' => 'required',
                    'secondary' => 'required',
                ];
                break;
            case('organization'):
                $request = [
                    'name' => 'required',
                    'phone' => 'required',
                    'website' => 'required',
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
        switch($type) {
            case('logo'):
                $prepareRequest = [
                    'logo' => $request['logo'],
                ];
                break;
            case('color-scheme'):
                $prepareRequest = [
                    'primary' => $request['primary'],
                    'secondary' => $request['secondary'],
                ];
                break;
            case('organization'):
                $prepareRequest = [
                    'name' => $request['name'],
                    'phone' => $request['phone'],
                    'website' => $request['website'],
                ];
                break;
            default:
        }
        return $prepareRequest;
    }
}
