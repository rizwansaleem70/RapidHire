<?php

namespace App\Http\Requests\Tenants\Candidate;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobApplyRequest extends FormRequest
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
            'resume_path' => 'required|max:2048',
            'cover_letter_path' => 'nullable|max:2048',
            'skills' => 'required',
            'source_detail' => 'nullable',
            'question.*.answer' => 'required',
            'requirement.*.answer' => 'required',
            'experience.*.organization_name' => 'nullable',
            'experience.*.position_title' => 'nullable',
            'experience.*.start_date' => 'nullable',
            'experience.*.end_date' => 'nullable',
            'experience.*.is_present' => 'nullable',
            // 'question.*.answer' => 'required',
            // 'requirement.*.answer' => 'required',
        ];
    }

    public function prepareRequest(): array
    {
        $request = $this;
        return [
            'resume_path' => $request['resume_path'],
            'job_id' => $request['job_id'],
            'cover_letter_path' => $request['cover_letter_path'],
            'skills' => $request['skills'],
            'source_detail' => $request['source_detail'],
            'question' => $request['question'],
            'requirement' => $request['requirement'],
            'experience' => $request['experience']
        ];
    }
}
