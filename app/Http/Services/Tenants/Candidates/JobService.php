<?php

namespace App\Http\Services\Tenants\Candidates;

use App\Contracts\Tenants\Candidates\JobContract;
use App\Exceptions\CustomException;
use App\Models\Tenants\Applicant;
use App\Models\Tenants\Department;
use App\Models\Tenants\Experience;
use App\Models\Tenants\Job;
use App\Models\Tenants\Location;
use App\Models\Tenants\Setting;
use App\Models\Tenants\SocialMedia;
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
    protected Location $modelLocation;
    protected Setting $modelSetting;
    protected SocialMedia $modelSocialMedia;
    protected Department $modelDepartment;
    protected Applicant $modelApplicant;
    protected Experience $modelExperience;

    public function __construct()
    {
        $this->modelJob = new Job();
        $this->modelLocation = new Location();
        $this->modelSetting = new Setting();
        $this->modelSocialMedia = new SocialMedia();
        $this->modelDepartment = new Department();
        $this->modelApplicant = new Applicant();
        $this->modelExperience = new Experience();
    }

    public function listing($filter)
    {
        $query = $this->modelJob->query()->latest();
        $query->when($filter->name, function ($q, $name) {
            return $q->like('name', $name);
        })
            ->when($filter->location_id, function ($q, $location_id) {
                return $q->where('location_id', $location_id);
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
        $jobs = $query->with('location', 'favorite')->select(
            '*',
            DB::raw('DATEDIFF(expiry_date, post_date) AS remaining_days')
        )->paginate(10);
        $location = $this->modelLocation->pluck('name', 'id');
        $logo = settings()->group('logo')->get('logo');
        return [
            'jobs' => $jobs,
            'totalJobs' => $totalJobs,
            'location' => $location,
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
        $job = $this->modelJob->with('location')->where('slug', $slug)->first();
        $related_jobs = $this->modelJob->with('location')
            ->where('department_id', $job->department_id)
            ->where('id', '<>', $job->id)
            ->select('*', DB::raw('DATEDIFF(expiry_date, post_date) AS remaining_days'))
            ->get();
        $remaining_days = Carbon::parse($job->post_date)->diffInDays(Carbon::parse($job->expiry_date));
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
        $user = Auth::user();
        $logo = settings()->group('logo')->get('logo');
        $job = $this->modelJob->with('location')->where('slug', $slug)->first();
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

    public function getApplicantJobs($data)
    {
        $query = $this->modelJob->query()->latest();
        $jobs = $query->with('location', 'favorite')->select(
            '*',
            DB::raw('DATEDIFF(expiry_date, post_date) AS remaining_days')
        )
            ->withCount(['applicants'])
            ->paginate(10);
        return $jobs;
    }

    private function prepareData($modelApplicant, $data, $new_record = false)
    {
        $user_id = Auth::user()->id;
        $modelApplicant->user_id = $user_id;
        $modelApplicant->job_id = $data['job_id'];
        $modelApplicant->status = 'applied';
        $modelApplicant->applied_date = date('Y-m-d');
        $modelApplicant->resume_path = $this->upload($data['resume_path']);
        $modelApplicant->cover_letter_path = $this->upload($data['cover_letter_path']);
        $modelApplicant->save();
        foreach ($data['data'] as $value) {
            $modelExperience = new $this->modelExperience;
            $modelExperience->user_id = $user_id;
            $modelExperience->organization_name = $value['organization_name'];
            $modelExperience->position_title = $value['position_title'];
            $modelExperience->source_detail = $data['source_detail'];
            $modelExperience->start_date = $value['start_date'];
            $modelExperience->end_date = $value['end_date'];
            $modelExperience->is_present = $value['is_present'] ? true : false;
            $modelExperience->save();
        }
        return $modelApplicant;
    }
}
