<?php

namespace App\Http\Services\Tenants;

use App\Contracts\Tenants\JobContract;
use App\Exceptions\CustomException;
use App\Models\JobHiringManager;
use App\Models\JobQuestion;
use App\Models\Tenants\Applicant;
use App\Models\Tenants\Department;
use App\Models\Tenants\Experience;
use App\Models\Tenants\Job;
use App\Models\Tenants\JobATSScore;
use App\Models\Tenants\JobATSScoreParameter;
use App\Models\Tenants\JobQualification;
use App\Models\Tenants\JobRequirement;
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

    public Job $model;

    protected User $modelUser;

    private JobHiringManager $jobHiringManagerModel;

    private JobQuestion $jobQuestionModel;

    private Department $departmentModel;

    protected Applicant $modelApplicant;

    protected Experience $modelExperience;

    protected JobATSScore $modelJobATSScore;

    protected JobATSScoreParameter $modelJobATSScoreParameter;

    private JobQualification $modelJobQualification;

    private JobRequirement $modelJobRequirement;

    public function __construct()
    {
        $this->modelUser = new User();
        $this->model = new Job();
        $this->departmentModel = new Department();
        $this->jobQuestionModel = new JobQuestion();
        $this->jobHiringManagerModel = new JobHiringManager();
        $this->modelApplicant = new Applicant();
        $this->modelExperience = new Experience();
        $this->modelJobATSScore = new JobATSScore();
        $this->modelJobATSScoreParameter = new JobATSScoreParameter();
        $this->modelJobQualification = new JobQualification();
        $this->modelJobRequirement = new JobRequirement();
    }

    public function index()
    {
        return $this->model->latest()->paginate(10);
    }

    public function questionList($query)
    {
        return $this->departmentModel->with('questionBank')->whereId($query->department_id)->get();
    }

    public function store($data)
    {
        $model = new $this->model;

        return $this->prepareData($model, $data, true);
    }

    public function ATS_Score($data, $job_id)
    {
        $modelJobATSScore = new $this->modelJobATSScore;

        return $this->prepareATSScoreData($modelJobATSScore, $job_id, $data, true);
    }

    public function job_qualification($data, $job_id)
    {
        $input = $data->input();
        $model = $this->model->with('jobQualification')->find($job_id);
        if (empty($model)) {
            throw new CustomException('Job Record Not Found!');
        }
        foreach ($input as $value) {
            foreach ($value as $finalValue) {
                $qualification = $this->modelJobRequirement->with('requirement')->whereJobIdAndRequirementId($job_id, $finalValue['requirement_id'])->first();
                $this->modelJobQualification::create([
                    'job_id' => $job_id,
                    'name' => $qualification->requirement->name,
                    'input_type' => $qualification->requirement->input_type,
                    'option' => $qualification->requirement->option,
                    'position' => $finalValue['position'],
                ]);
            }
        }

        return true;
    }

    public function update($data, $id)
    {
        $model = $this->model->find($id);
        if (empty($model)) {
            throw new CustomException('Job Record Not Found!');
        }

        return $this->prepareData($model, $data, false);
    }

    public function delete($id)
    {
        $job = $this->model->find($id);
        if (empty($job)) {
            throw new CustomException('Job Record Not Found!');
        }
        $job->delete();

        return true;
    }

    private function prepareData($model, $data, $new_record = false)
    {
        $model->user_id = Auth::user()->id;
        if (isset($data['country_id']) && $data['country_id']) {
            $model->country_id = $data['country_id'];
        }
        if (isset($data['state_id']) && $data['state_id']) {
            $model->state_id = $data['state_id'];
        }
        if (isset($data['city_id']) && $data['city_id']) {
            $model->city_id = $data['city_id'];
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

    public function requirements($id)
    {
        $job = $this->model->with('requirement')->find($id);
        if (empty($job)) {
            throw new CustomException('Job Not Found!');
        }

        return $job->requirement;
    }

    public function getApplicantJobs($data)
    {
        $query = $this->model->query()->latest();
        $jobs = $query->with('favorite')->select(
            '*',
            DB::raw('DATEDIFF(expiry_date, post_date) AS remaining_days')
        )
            ->withCount(['applicants'])
            ->paginate(10);

        return $jobs;
    }

    public function getJobApplicant($filter, $job_id)
    {
        $baseQuery = $this->modelApplicant->where('job_id', $job_id);

        $totalApplicant = $baseQuery->count();

        $applicants = (clone $baseQuery)->when($filter->status, function ($q, $status) {
            return $q->where('status', $status);
        })->with('user.experience')->paginate(10);

        $totalQualification = (clone $baseQuery)->where('status', 'qualification')->count();
        $totalTesting = (clone $baseQuery)->where('status', 'testing')->count();
        $totalInterview = (clone $baseQuery)->where('status', 'interview')->count();
        $totalOffer = (clone $baseQuery)->where('status', 'offer')->count();
        $totalRejected = (clone $baseQuery)->where('status', 'rejected')->count();
        $totalWithdraw = (clone $baseQuery)->where('status', 'withdraw')->count();

        return [
            'totalApplicant' => $totalApplicant,
            'totalQualification' => $totalQualification,
            'totalTesting' => $totalTesting,
            'totalInterview' => $totalInterview,
            'totalOffer' => $totalOffer,
            'totalRejected' => $totalRejected,
            'totalWithdraw' => $totalWithdraw,
            'applicants' => $applicants,
        ];
    }

    public function jobApplicantProfileHeader($user_id)
    {
        return $this->modelUser->with(['country', 'state', 'city'])->whereHas('applicant')->orWhereHas('experience')->find($user_id);
    }

    public function jobApplicantProfile($user_id)
    {
        return $this->modelUser->with(['applicant', 'experience'])->whereHas('applicant')->orWhereHas('experience')->find($user_id);
    }

    private function prepareATSScoreData($modelJobATSScore, $job_id, $data, bool $true)
    {
        $modelJobATSScore->job_id = $job_id;

        if (isset($data['attribute']) && $data['attribute']) {
            $modelJobATSScore->attribute = $data['attribute'];
        }
        if (isset($data['weight']) && $data['weight']) {
            $modelJobATSScore->weight = $data['weight'];
        }
        $modelJobATSScore->save();
        foreach ($data['data'] as $value) {
            $modelJobATSScoreParameter = new $this->modelJobATSScoreParameter;
            $modelJobATSScoreParameter->parameter = $value['parameter'];
            $modelJobATSScoreParameter->value = $value['value'];
            $modelJobATSScoreParameter->job_ATS_score_id = $modelJobATSScore->id;
            $modelJobATSScoreParameter->save();
        }

        return true;
    }

    public function get_country_against_job($id)
    {
        $model = $this->model->find($id);
        if (empty($model)) {
            throw new CustomException('Job Record Not Found!');
        }

        return $data = [
            'country_id' => $model->country_id,
        ];
    }
}
