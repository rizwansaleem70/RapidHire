<?php

namespace App\Http\Requests\Tenants\Candidate;


use App\Abstracts\FormRequest;

class UpdateApplicantProfileRequest extends FormRequest
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
                "country" => "required|exists:countries,id",
                "state" => "required|exists:states,id",
                "city" => "required|exists:cities,id",
                "first_name" => "required",
                "last_name" => "required",
                "address" => "required",
                "phone" => "required|unique:users,phone,".$this->user_id,
                "gender" => "required",
                "is_active" => "nullable",
                "facebook" => "nullable",
                "linkedin" => "nullable",
                "twitter" => "nullable",
                "instagram" => "nullable",
                "pinterest" => "nullable",
                "youtube" => "nullable",
                "dob" => "required|before:today",
                "bio" => "nullable",
                "current_salary" => "required",
                "salary_currency" => "required",
                "salary_type" => "required|in:hourly,monthly,yearly",
                "skills" => "required",
                "language" => "required",
                "introduction_video_url" => "nullable",
                "avatar" => "required|max:2048",
                "resume_path" => "required|max:2048",
                "education.*.institute" => "required",
                "education.*.field_of_study" => "required",
                "education.*.start_date" => "required|date",
                "education.*.end_date" => "date|after:start_date",
                "education.*.description" => "nullable",
                "education.*.is_present" => "nullable",
                "experience.*.position_title" => "required",
                "experience.*.start_date" => "required|date",
                "experience.*.end_date" => "date|after:start_date",
                "experience.*.organization_name" => "nullable",
                "experience.*.is_present" => "nullable"
        ];
    }

    public function prepareRequest():array
    {
        $request = $this;
        return [
            'country' => $request['country'],
            'state' => $request['state'],
            'city' => $request['city'],
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'address' => $request['address'],
            'phone' => $request['phone'],
            'gender' => $request['gender'],
            'is_active' => $request['is_active'],
            'facebook' => $request['facebook'],
            'linkedin' => $request['linkedin'],
            'twitter' => $request['twitter'],
            'instagram' => $request['instagram'],
            'pinterest' => $request['pinterest'],
            'youtube' => $request['youtube'],
            'dob' => $request['dob'],
            'bio' => $request['bio'],
            'current_salary' => $request['current_salary'],
            'salary_type' => $request['salary_type'],
            'salary_currency' => $request['salary_currency'],
            'skills' => $request['skills'],
            'language' => $request['language'],
            'introduction_video_url' => $request['introduction_video_url'],
            'avatar' => $request['avatar'],
            'resume_path' => $request['resume_path'],
            'education' => $request['education'],
            'experience' => $request['experience'],
        ];
    }
}
