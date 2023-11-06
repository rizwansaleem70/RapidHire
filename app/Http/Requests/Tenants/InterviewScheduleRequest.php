<?php

namespace App\Http\Requests\Tenants;

use Illuminate\Foundation\Http\FormRequest;

class InterviewScheduleRequest extends FormRequest
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
            'interviewer_id' => 'required|exists:users,id',
            'applicant_id' => 'required|exists:applicants,id',
            'interview_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'interviewer_link' => 'required',
            'interviewee_link' => 'required'
        ];
    }

    public function prepareData(): array
    {
        $data = $this;
        return [
            'applicant_id' => $data['applicant_id'],
            'interviewer_id' => $data['interviewer_id'],
            'interview_date' => $data['interview_date'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'interviewer_link' => $data['interviewer_link'],
            'interviewee_link' => $data['interviewee_link'],
        ];
    }
}
