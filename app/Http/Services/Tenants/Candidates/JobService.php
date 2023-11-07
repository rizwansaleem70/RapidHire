<?php

namespace App\Http\Services\Tenants\Candidates;

use App\Contracts\Tenants\Candidates\JobContract;
use App\Exceptions\CustomException;
use App\Models\Tenants\Applicant;
use App\Models\Tenants\ApplicantQuestionAnswer;
use App\Models\Tenants\ApplicantRequirementAnswer;
use App\Models\Tenants\Country;
use App\Models\Tenants\Department;
use App\Models\Tenants\Experience;
use App\Models\Tenants\Job;
use App\Models\Tenants\Location;
use App\Models\Tenants\Setting;
use App\Models\Tenants\SocialMedia;
use App\Models\User;
use App\Traits\ImageUpload;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * @var JobService
 */
class JobService implements JobContract
{
    use ImageUpload;
    protected Job $modelJob;
    protected Country $modelCountry;
    protected Setting $modelSetting;
    protected SocialMedia $modelSocialMedia;
    protected Department $modelDepartment;
    protected Applicant $modelApplicant;
    protected Experience $modelExperience;
    private User $modelUser;
    private ApplicantQuestionAnswer $modelApplicantQuestionAnswer;
    private ApplicantRequirementAnswer $modelApplicantRequirementAnswer;

    public function __construct()
    {
        $this->modelUser = new User();
        $this->modelJob = new Job();
        $this->modelCountry = new Country();
        $this->modelSetting = new Setting();
        $this->modelSocialMedia = new SocialMedia();
        $this->modelDepartment = new Department();
        $this->modelApplicant = new Applicant();
        $this->modelExperience = new Experience();
        $this->modelApplicantQuestionAnswer = new ApplicantQuestionAnswer();
        $this->modelApplicantRequirementAnswer = new ApplicantRequirementAnswer();
    }

    public function listing($filter)
    {
        $query = $this->modelJob->query()->latest();
        $query->when($filter->name, function ($q, $name) {
            return $q->like('name', $name);
        })
            ->when($filter->country_id, function ($q, $country_id) {
                return $q->where('country_id', $country_id);
            })
            ->when($filter->state_id, function ($q, $state_id) {
                return $q->where('state_id', $state_id);
            })
            ->when($filter->city_id, function ($q, $city_id) {
                return $q->where('city_id', $city_id);
            })
            ->when($filter->job_type, function ($q, $job_type) {
                return $q->like('job_type', $job_type);
            })
            ->when($filter->type, function ($q, $type) {
                return $q->like('type', $type);
            })
            ->when($filter->min_salary, function ($q, $min_salary) {
                return $q->where('min_salary', '>=', $min_salary);
            })
            ->when($filter->max_salary, function ($q, $max_salary) {
                return $q->where('max_salary', '<=', $max_salary);
            })
            ->when($filter->min_salary && $filter->max_salary, function ($q) use ($filter) {
                return $q->whereBetween('min_salary', [$filter->min_salary, $filter->max_salary])
                    ->orWhereBetween('max_salary', [$filter->min_salary, $filter->max_salary]);
            });
        $totalJobs = $query->count();
        $jobs = $query->with( 'country','state','city','favorite')->select(
            '*',
            DB::raw('DATEDIFF(expiry_date, now()) AS remaining_days')
        )->paginate(10);
        $country = $this->modelCountry->pluck('name', 'id');
        $logo = settings()->group('logo')->get('logo');
        return [
            'jobs' => $jobs,
            'totalJobs' => $totalJobs,
            'country' => $country,
            'logo' => $logo
        ];
    }

    public function jobDetail($slug)
    {
        $logo = settings()->group('logo')->get('logo');
        $website = settings()->group('organization')->get('website');
        $companyEmail = settings()->group('configuration')->get('company_contract_email');
        $company_title_about = settings()->group('configuration')->get('company_title_about');
        $socialMedia = $this->modelSocialMedia->orderBy('priority')->get();
        $job = $this->modelJob->with('country','state','city')->where('slug', $slug)->first();
        $related_jobs = $this->modelJob
            ->where('department_id', $job->department_id)
            ->where('id', '<>', $job->id)
            ->select('*', DB::raw('DATEDIFF(expiry_date, now()) AS remaining_days'))
            ->latest()->get();
        $remaining_days = Carbon::today()->diffInDays(Carbon::parse($job->expiry_date));
        if (!$job) {
            throw new CustomException("Job Record Not Found!");
        }
        return [
            'job' => $job,
            'remaining_days' => $remaining_days,
            'website' => $website,
            'companyEmail' => $companyEmail,
            'socialMedia' => $socialMedia,
            'company_title_about' => $company_title_about,
            'related_jobs' => $related_jobs,
            'logo' => $logo
        ];
    }

    public function jobApply($slug)
    {
        $user = $this->modelUser->with(['country','state','city'])->find(Auth::user()->id);
        $logo = settings()->group('logo')->get('logo');
        $job = $this->modelJob->with(['country','state','city','jobQuestion.questionBank' => function($query){
            return $query->where('input_type','text');
        },'jobQualification.requirement'=> function($query){
            return $query->where('input_type','text');
        },])->where('slug', $slug)->first();
        return [
            'job' => $job,
            'logo' => $logo,
            'user' => $user
        ];
    }

    public function jobApplyStore($data)
    {
        $modelApplicant = new $this->modelApplicant;
        return $this->prepareData($modelApplicant, $data, true);
    }
    private function prepareData($modelApplicant, $data, $new_record = false)
    {
        $skill = json_decode($data['skills']);
        $valuesArray = array_map(function($item) {
            return $item->value;
        }, $skill);
        $commaSeparatedValuesSkill = implode(',', $valuesArray);

        $user_id = Auth::user()->id;
        $modelApplicant->user_id = $user_id;
        $modelApplicant->job_id = $data['job_id'];
        $modelApplicant->status = 'applied';
        $modelApplicant->skills = $commaSeparatedValuesSkill;
        $modelApplicant->source_detail = $data['source_detail'];
        $modelApplicant->applied_date = date('Y-m-d');
        $modelApplicant->resume_path = $this->upload($data['resume_path']);
        $modelApplicant->cover_letter_path = $this->upload($data['cover_letter_path']);
        $modelApplicant->save();
        foreach ($data['data'] as $value) {
            $modelExperience = new $this->modelExperience;
            $modelExperience->user_id = $user_id;
            $modelExperience->organization_name = $value['organization_name'];
            $modelExperience->position_title = $value['position_title'];
            $modelExperience->start_date = $value['start_date'];
            $modelExperience->end_date = $value['end_date'];
            $modelExperience->is_present = isset($data['is_present']);
            $modelExperience->save();
        }
        if ($data['question']){
           foreach ($data['question'] as $question){
               $modelApplicantQuestionAnswer = new $this->modelApplicantQuestionAnswer;
               $modelApplicantQuestionAnswer->user_id = $user_id;
               $modelApplicantQuestionAnswer->job_id = $data['job_id'];
               $modelApplicantQuestionAnswer->question_bank_id = $question['id'];
               $modelApplicantQuestionAnswer->answer = $question['answer'];
               $modelApplicantQuestionAnswer->save();
           }
        }
        if ($data['requirement']){
            foreach ($data['requirement'] as $requirement){
                $modelApplicantRequirementAnswer = new $this->modelApplicantRequirementAnswer;
                $modelApplicantRequirementAnswer->user_id = $user_id;
                $modelApplicantRequirementAnswer->job_id = $data['job_id'];
                $modelApplicantRequirementAnswer->requirement_id = $requirement['id'];
                $modelApplicantRequirementAnswer->answer = $requirement['answer'];
                $modelApplicantRequirementAnswer->save();
            }
        }
        return $modelApplicant;
    }
}
