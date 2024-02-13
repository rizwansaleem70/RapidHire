<?php

namespace App\Http\Requests\Tenants;

use Illuminate\Foundation\Http\FormRequest;

class ValidationQuestionAssignToDepartmentRequest extends FormRequest
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
            'department_id.*' => 'required|exists:departments,id',
            'question_bank_id' => 'required|exists:question_banks,id',
        ];
    }

    public function prepareRequest(): array
    {
        $request = $this;
        return [
            'department_id' => $request['department_id'],
            'question_bank_id' => $request['question_bank_id'],
        ];
    }
}
