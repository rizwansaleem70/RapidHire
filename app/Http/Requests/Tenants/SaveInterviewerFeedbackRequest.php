<?php

namespace App\Http\Requests\Tenants;

use Illuminate\Foundation\Http\FormRequest;

class SaveInterviewerFeedbackRequest extends FormRequest
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
        $required_integer = 'required|integer|max:5|min:1';
        return [
            'interview_id' => 'required|exists:users,id',
            'language' => $required_integer,
            'behavior' => $required_integer,
            'speaking' => $required_integer,
            'listening' => $required_integer,
            'interviewer_feedback' => 'nullable',
        ];
    }

    public function prepareRequest()
    {
        $request = $this;
        return [
            'interview_id' => $request['interview_id'],
            'language' => $request['language'],
            'behavior' => $request['behavior'],
            'speaking' => $request['speaking'],
            'listening' => $request['listening'],
            'interviewer_feedback' => $request['interviewer_feedback'],
        ];
    }
}
