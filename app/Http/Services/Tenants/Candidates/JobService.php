<?php

namespace App\Http\Services\Tenants\Candidates;

use App\Contracts\Tenants\Candidates\JobContract;
use App\Exceptions\CustomException;
use App\Models\Tenants\Applicant;
use App\Models\Tenants\ApplicantQuestionAnswer;
use App\Models\Tenants\ApplicantRequirementAnswer;
use App\Models\Tenants\Candidate\FavoriteJob;
use App\Models\Tenants\City;
use App\Models\Tenants\Country;
use App\Models\Tenants\Department;
use App\Models\Tenants\Experience;
use App\Models\Tenants\Job;
use App\Models\Tenants\JobExperience;
use App\Models\Tenants\Location;
use App\Models\Tenants\Setting;
use App\Models\Tenants\SocialMedia;
use App\Models\Tenants\State;
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
    protected JobExperience $modelJobExperience;
    private User $modelUser;
    private ApplicantQuestionAnswer $modelApplicantQuestionAnswer;
    private ApplicantRequirementAnswer $modelApplicantRequirementAnswer;
    private State $modelState;
    private City $modelCity;
    public FavoriteJob $modelFavoriteJob;

    public function __construct()
    {
        $this->modelUser = new User();
        $this->modelFavoriteJob = new FavoriteJob();
        $this->modelJob = new Job();
        $this->modelCountry = new Country();
        $this->modelState = new State();
        $this->modelCity = new City();
        $this->modelSetting = new Setting();
        $this->modelSocialMedia = new SocialMedia();
        $this->modelDepartment = new Department();
        $this->modelApplicant = new Applicant();
        $this->modelExperience = new Experience();
        $this->modelJobExperience = new JobExperience();
        $this->modelApplicantQuestionAnswer = new ApplicantQuestionAnswer();
        $this->modelApplicantRequirementAnswer = new ApplicantRequirementAnswer();
    }

    public function listing($filter)
    {
        $query = $this->modelJob->query()->where('status', 'published')->where('expiry_date', '>=',date('Y-m-d'))->latest();
        $query->when($filter->name, function ($q, $name) {
            return $q->like('name', $name);
        })
            ->when($filter->department_id, function ($q, $department_id) {
                return $q->where('department_id', $department_id);
            })
            ->when($filter->country_id, function ($q, $country_id) {
                return $q->where('country_id', $country_id);
            })
            ->when($filter->state_id && $filter->state_id != 'Select', function ($q, $state_id) {
                return $q->where('state_id', $state_id);
            })
            ->when($filter->city_id && $filter->city_id != 'Select', function ($q, $city_id) {
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
        // dd($query->toSql());
        $country = $this->modelCountry->pluck('name', 'id');
        $logo = settings()->group('logo')->get('logo');
        $totalJobs = $query->count();
        $jobs = $query->with('country:id,name', 'state:id,name', 'city:id,name')->paginate(10);
        $jobs->transform(function ($job) {
            $job->remaining_days = today()->diffInDays($job->expiry_date, false);
            return $job;
        });
        if (Auth::check()) {
            $favoriteJobIds = $this->modelFavoriteJob
                ->whereUserId(Auth::id())
                ->pluck('job_id');

            $jobs->transform(function ($job) use ($favoriteJobIds) {
                $job->is_favorite = $favoriteJobIds->contains($job->id);
                return $job;
            });
        }
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
        $socialMedia = $this->modelSocialMedia->get();
        $job = $this->modelJob->with('country', 'state', 'city')->where('slug', $slug)->first();
        if (!$job) {
            throw new CustomException("Job Record Not Found!");
        }
        $job->update(['views'=>$job['views']+1]);
        $related_jobs = $this->modelJob
            ->where('department_id', $job->department_id)
            ->where('id', '<>', $job->id)
            ->select('*', DB::raw('DATEDIFF(expiry_date, now()) AS remaining_days'))
            ->latest()->get();
        $remaining_days = Carbon::today()->diffInDays(Carbon::parse($job->expiry_date));
        if (Auth::check()) {
            $isFavorite = $this->modelFavoriteJob
                ->whereUserId(Auth::id())
                ->whereJobId($job->id)
                ->exists();

            // Add the favorite flag to the job object
            $job->is_favorite = $isFavorite;
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
        DB::enableQueryLog();
        $job = $this->modelJob->where('slug', $slug)->first();
        if (!$job) {
            throw new CustomException("Job Record Not Found!");
        }
        $user = Auth::user();
        $countries = $this->modelCountry->pluck('name', 'id');
        $states = $this->modelState->when($user->country_id, function ($q, $country_id) {
        return $q->where('country_id', $country_id);
            })->get(['id','name']);
        $cities = $this->modelCity->when($user->state_id, function ($q, $state_id) {
            return $q->where('state_id', $state_id);
        })->get(['id','name']);
        $user = $this->modelUser->with(['country:id,name', 'state:id,name', 'city:id,name', 'experience'])->find(Auth::user()->id);
        $logo = settings()->group('logo')->get('logo');
        $job = $this->modelJob->with(['country', 'state', 'city', 'jobQuestion.questionBank','jobQualification.requirement','jobRequirement'])->where('slug', $slug)->first();
        return [
            'countries' => $countries,
            'states' => $states,
            'cities' => $cities,
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
        $valuesArray = array_map(function ($item) {
            return $item->value;
        }, $skill);
        $commaSeparatedValuesSkill = implode(',', $valuesArray);
        $user_id = Auth::user()->id;
        $modelApplicant->user_id = $user_id;
        $modelApplicant->job_id = $data['job_id'];
        $modelApplicant->status = 'applied';
        $modelApplicant->skills = $commaSeparatedValuesSkill;
        $modelApplicant->source_detail = $data['source_detail'];
        $modelApplicant->first_name = $data['first_name'];
        $modelApplicant->last_name = $data['last_name'];
        $modelApplicant->phone = $data['phone'];
        $modelApplicant->address = $data['address'];
        $modelApplicant->gender = $data['gender'];
        $modelApplicant->country_id = $data['country_id'];
        $modelApplicant->state_id = $data['state_id'];
        $modelApplicant->city_id = $data['city_id'];
        $modelApplicant->applied_date = date('Y-m-d');
        $modelApplicant->job_resume_path = $this->upload($data['resume_path']);
        $modelApplicant->cover_letter_path = $this->upload($data['cover_letter_path']);
        $modelApplicant->save();
        foreach ($data['experience'] as $value) {
            if ($value['organization_name'] && $value['position_title'] && $value['start_date']){
                $modelJobExperience = new $this->modelJobExperience;
                $modelJobExperience->applicant_id = $modelApplicant->id;
                $modelJobExperience->job_id = $data['job_id'];
                $modelJobExperience->organization_name = $value['organization_name'];
                $modelJobExperience->position_title = $value['position_title'];
                $modelJobExperience->start_date = $value['start_date'];
                $modelJobExperience->end_date = $value['end_date'];
                $modelJobExperience->is_present = isset($data['is_present']);
                $modelJobExperience->save();
            }
        }
        if ($data['question']) {
            foreach ($data['question'] as $question) {
                $modelApplicantQuestionAnswer = new $this->modelApplicantQuestionAnswer;
                $modelApplicantQuestionAnswer->applicant_id = $modelApplicant->id;
                $modelApplicantQuestionAnswer->job_id = $data['job_id'];
                $modelApplicantQuestionAnswer->question_bank_id = $question['id'];
                $modelApplicantQuestionAnswer->answer = $question['answer'];
                $modelApplicantQuestionAnswer->save();
            }
        }
        if ($data['requirement']) {
            foreach ($data['requirement'] as $requirement) {
                if (isset($requirement['answer_type']) && $requirement['answer_type'] == 'checkbox'){
                    $requirement['answer'] = implode(',', $requirement['answer']);
                }
                if (isset($requirement['answer_type']) && $requirement['answer_type'] == 'file'){
                    $requirement['answer'] = $this->upload($requirement['answer']);
                }
                $modelApplicantRequirementAnswer = new $this->modelApplicantRequirementAnswer;
                $modelApplicantRequirementAnswer->applicant_id = $modelApplicant->id;
                $modelApplicantRequirementAnswer->job_id = $data['job_id'];
                $modelApplicantRequirementAnswer->requirement_id = $requirement['id'];
                $modelApplicantRequirementAnswer->job_requirement_id = $requirement['job_requirement_id'];
                $modelApplicantRequirementAnswer->answer = $requirement['answer'];
                $modelApplicantRequirementAnswer->save();
            }
        }
        return $modelApplicant;
    }
}
