<?php

namespace App\Http\Services\Tenants\Candidates;

use App\Contracts\Tenants\Candidates\JobContract;
use App\Exceptions\CustomException;
use App\Models\Tenants\Application;
use App\Models\Tenants\Candidate\FavoriteJob;
use App\Models\Tenants\Department;
use App\Models\Tenants\Experience;
use App\Models\Tenants\Job;
use App\Models\Tenants\Location;
use App\Models\Tenants\Setting;
use App\Models\Tenants\SocialMedia;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
* @var JobService
*/
class JobService implements JobContract
{
    protected Job $modelJob;
    protected Location $modelLocation;
    protected Setting $modelSetting;
    protected SocialMedia $modelSocialMedia;
    protected Department $modelDepartment;
    protected Application $modelApplication;
    protected Experience $modelExperience;

    public function __construct()
    {
        $this->modelJob = new Job();
        $this->modelLocation = new Location();
        $this->modelSetting = new Setting();
        $this->modelSocialMedia = new SocialMedia();
        $this->modelDepartment = new Department();
        $this->modelApplication = new Application();
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
        $jobs = $query->with('location','favorite')->select('*',
            DB::raw('DATEDIFF(expiry_date, post_date) AS remaining_days')
        )->paginate(10);
        $location = $this->modelLocation->pluck('name','id');
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
        $job = $this->modelJob->with('location')->where('slug',$slug)->first();
        $related_jobs = $this->modelJob->with('location')
            ->where('department_id', $job->department_id)
            ->where('id', '<>', $job->id)
            ->select('*', DB::raw('DATEDIFF(expiry_date, post_date) AS remaining_days'))
            ->get();
        $remaining_days = Carbon::parse($job->post_date)->diffInDays(Carbon::parse($job->expiry_date));
        if (!$job){
            throw new CustomException("Job Record Not Found!");
        }
        return [
            'job' => $job,
            'remaining_days'=> $remaining_days,
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
        $job = $this->modelJob->with('location')->where('slug',$slug)->first();
        return [
            'job' => $job,
            'logo' => $logo,
            'user' => $user
        ];
    }

    public function jobApplyStore($data)
    {
        $model = new $this->model;
        return $this->prepareData($model, $data, true);
    }
    private function prepareData($model, $data, $new_record = false)
    {
        $model->user_id = Auth::user()->id;
        if (isset($data['location_id']) && $data['location_id']) {
            $model->location_id = $data['location_id'];
        }
        if (isset($data['total_position']) && $data['total_position']) {
            $model->total_position = $data['total_position'];
        }
        if (isset($data['department_id']) && $data['department_id']) {
            $model->department_id = $data['department_id'];
        }
        if (isset($data['name']) && $data['name']) {
            $model->name = $data['name'];
            $model->slug = $data['name'];
        }
        if (isset($data['job_description']) && $data['job_description']) {
            $model->job_description = $data['job_description'];
        }
        if (isset($data['type']) && $data['type']) {
            $model->type = $data['type'];
        }
        if (isset($data['job_type']) && $data['job_type']) {
            $model->job_type = $data['job_type'];
        }
        if ($new_record) {
            $model->post_date = Carbon::now();
        }
        if (isset($data['min_salary']) && $data['min_salary']) {
            $model->min_salary = $data['min_salary'];
        }
        if (isset($data['max_salary']) && $data['max_salary']) {
            $model->max_salary = $data['max_salary'];
        }
        if (isset($data['expiry_date']) && $data['expiry_date']) {
            $model->expiry_date = $data['expiry_date'];
        }
        if (isset($data['is_active']) && $data['is_active']) {
            $model->is_active = $data['is_active'];
        }
        if (isset($data['rating']) && $data['rating']) {
            $model->rating = $data['rating'];
        }
        if (isset($data['status']) && $data['status']) {
            $model->status = $data['status'];
        }
        if (isset($data['salary_deliver']) && $data['salary_deliver']) {
            $model->salary_deliver = $data['salary_deliver'];
        }
        if (isset($data['cover_image']) && $data['cover_image']) {
            $model->cover_image = $data['cover_image'];
        }

        $model->save();
        $model->jobQuestion()->sync($data['question_bank_id']);
        $model->jobHiringManager()->sync($data['job_hiring_manager_id']);
        $model->requirement()->sync($data['requirement_id']);
        return $model;
    }
    public function jobApplyStore($inputs)
    {
        // TODO: Implement jobApplyStore() method.
    }
}
