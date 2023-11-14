<?php

namespace App\Http\Services\Tenants;

use App\Contracts\Tenants\JobContract;
use App\Exceptions\CustomException;
use App\Models\JobHiringManager;
use App\Models\Tenants\Applicant;
use App\Models\Tenants\ApplicantQuestionAnswer;
use App\Models\Tenants\ApplicantRequirementAnswer;
use App\Models\Tenants\Department;
use App\Models\Tenants\Education;
use App\Models\Tenants\Experience;
use App\Models\Tenants\Job;
use App\Models\Tenants\JobATSScore;
use App\Models\Tenants\JobATSScoreParameter;
use App\Models\Tenants\JobQualification;
use App\Models\Tenants\JobQuestion;
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
    protected Education $modelEducation;

    protected JobATSScore $modelJobATSScore;

    protected JobATSScoreParameter $modelJobATSScoreParameter;

    private JobQualification $modelJobQualification;

    private JobRequirement $modelJobRequirement;
    private ApplicantRequirementAnswer $modelApplicantRequirementAnswer;
    private ApplicantQuestionAnswer $modelApplicantQuestionAnswer;

    public function __construct()
    {
        $this->modelUser = new User();
        $this->model = new Job();
        $this->departmentModel = new Department();
        $this->jobQuestionModel = new JobQuestion();
        $this->jobHiringManagerModel = new JobHiringManager();
        $this->modelApplicant = new Applicant();
        $this->modelExperience = new Experience();
        $this->modelEducation = new Education();
        $this->modelJobATSScore = new JobATSScore();
        $this->modelJobATSScoreParameter = new JobATSScoreParameter();
        $this->modelJobQualification = new JobQualification();
        $this->modelJobRequirement = new JobRequirement();
        $this->modelApplicantRequirementAnswer = new ApplicantRequirementAnswer();
        $this->modelApplicantQuestionAnswer = new ApplicantQuestionAnswer();
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
    public function show($id)
    {
        $model = $this->model->find($id);
        if (empty($model)) {
            throw new CustomException('Job Record Not Found!');
        }
        return $this->model->find($id);
    }
    public function ATS_Score($data, $job_id)
    {
        $modelJobATSScore = new $this->modelJobATSScore;

        return $this->prepareATSScoreData($modelJobATSScore, $job_id, $data, true);
    }

    public function job_qualification($data, $job_id)
    {
        $model = $this->model->find($job_id);
        if (empty($model)) {
            throw new CustomException('Job Record Not Found!');
        }
        foreach ($data as $value) {
            foreach ($value as $finalValue) {
                $qualification = $this->modelJobRequirement->with('requirement')->whereJobIdAndRequirementId($job_id, $finalValue['requirement_id'])->first();
                $this->modelJobQualification::create([
                    'job_id' => $job_id,
                    'requirement_id' => $finalValue['requirement_id'],
                    'operator' => $finalValue['operator'],
                    'value' => $finalValue['value'],
                    'is_required' => $finalValue['is_required'],
                    'name' => $qualification->requirement->name,
                    'input_type' => $qualification->requirement->input_type,
                    'option' => $qualification->requirement->option,
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
        $model->jobQuestionBank()->sync($data['question_bank_id']);
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

        $applicants = (clone $baseQuery)->when(isset($filter['status']), function ($q) use ($filter) {
            return $q->where('status', $filter['status']);
        })->with('user.experience')->paginate(10);
        $totalApplied = (clone $baseQuery)->where('status', 'applied')->count();
        $totalQualification = (clone $baseQuery)->where('status', 'qualification')->count();
        $totalTesting = (clone $baseQuery)->where('status', 'testing')->count();
        $totalInterview = (clone $baseQuery)->where('status', 'interview')->count();
        $totalOffer = (clone $baseQuery)->where('status', 'offer')->count();
        $totalRejected = (clone $baseQuery)->where('status', 'rejected')->count();
        $totalWithdraw = (clone $baseQuery)->where('status', 'withdraw')->count();

        return [
            'totalApplied' => $totalApplied,
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
    public function candidateAppliedJobs($user_id)
    {
        return $this->modelApplicant->where('user_id', $user_id)->with(['job'])->get();
    }

    public function jobApplicantProfileHeader($applicant_id)
    {
        $model = $this->modelApplicant->find($applicant_id);
        if (empty($model)) {
            throw new CustomException('Applicant Not Found!');
        }
        return $this->modelApplicant->whereId($applicant_id)->with(['user.country', 'user.state', 'user.city', 'user.experience'])->first();
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

    public function jobApplicantProfileStatus($filter, $applicant_id, $job_id)
    {
        $model = $this->modelApplicant->where('id', $applicant_id)->first();
        if (empty($model)) {
            throw new CustomException("Applicant Not Found!");
        }
        $model->status = $filter['status'];
        $model->save();
        return [
            'status' => $model->status,
        ];
    }

    public function jobApplicantQuestionAnswer($applicant_id, $job_id)
    {
        $modelApplicantRequirementAnswer = $this->modelApplicantRequirementAnswer->whereApplicantIdAndJobId($applicant_id, $job_id)->with('requirement')->get();
        $modelApplicantQuestionAnswer = $this->modelApplicantQuestionAnswer->whereApplicantIdAndJobId($applicant_id, $job_id)->with('questionBank')->get();
        if ($modelApplicantRequirementAnswer->count() == 0 || $modelApplicantQuestionAnswer->count() == 0) {
            throw new CustomException("Record Not Found!");
        }
        return [
            'data' => [
                'requirementAnswer' => $modelApplicantRequirementAnswer,
                'questionAnswer' => $modelApplicantQuestionAnswer,
            ]
        ];
    }

    public function profile($user_id)
    {
        $model = $this->modelUser->find($user_id);

        if (empty($model)) {
            throw new CustomException('User Not Found!');
        }
        return $this->modelUser->whereId($user_id)->with(['country', 'state', 'city', 'experience', 'applicant', 'education'])->first();
    }

    public function profileUpdate($data, $user_id)
    {
        $model = $this->modelUser->whereId($user_id)->first();
        if (empty($model)) {
            throw new CustomException('User Not Found!');
        }
        if (isset($data['country']) && $data['country']) {
            $model->country_id = $data['country'];
        }
        if (isset($data['state']) && $data['state']) {
            $model->state_id = $data['state'];
        }
        if (isset($data['city']) && $data['city']) {
            $model->city_id = $data['city'];
        }
        if (isset($data['first_name']) && $data['first_name']) {
            $model->first_name = $data['first_name'];
        }
        if (isset($data['last_name']) && $data['last_name']) {
            $model->last_name = $data['last_name'];
        }
        if (isset($data['address']) && $data['address']) {
            $model->address = $data['address'];
        }
        if (isset($data['phone']) && $data['phone']) {
            $model->phone = $data['phone'];
        }
        if (isset($data['gender']) && $data['gender']) {
            $model->gender = $data['gender'];
        }
        if (isset($data['is_active']) && $data['is_active']) {
            $model->is_active = $data['is_active'];
        }
        if (isset($data['facebook']) && $data['facebook']) {
            $model->facebook = $data['facebook'];
        }
        if (isset($data['linkedin']) && $data['linkedin']) {
            $model->linkedin = $data['linkedin'];
        }
        if (isset($data['twitter']) && $data['twitter']) {
            $model->twitter = $data['twitter'];
        }
        if (isset($data['instagram']) && $data['instagram']) {
            $model->instagram = $data['instagram'];
        }
        if (isset($data['pinterest']) && $data['pinterest']) {
            $model->pinterest = $data['pinterest'];
        }
        if (isset($data['youtube']) && $data['youtube']) {
            $model->youtube = $data['youtube'];
        }
        if (isset($data['bio']) && $data['bio']) {
            $model->bio = $data['bio'];
        }
        if (isset($data['current_salary']) && $data['current_salary']) {
            $model->current_salary = $data['current_salary'];
        }
        if (isset($data['salary_type']) && $data['salary_type']) {
            $model->salary_type = $data['salary_type'];
        }
        if (isset($data['skills']) && $data['skills']) {
            $model->skills = $data['skills'];
        }
        if (isset($data['language']) && $data['language']) {
            $model->language = $data['language'];
        }
        if (isset($data['introduction_video_url']) && $data['introduction_video_url']) {
            $model->introduction_video_url = $data['introduction_video_url'];
        }
        if (isset($data['avatar']) && $data['avatar']) {
            $model->avatar = $data['avatar'];
        }
        if (isset($data['resume_path']) && $data['resume_path']) {
            $model->resume_path = $data['resume_path'];
        }
        $model->save();
        foreach ($data['education'] as $value) {
            $modelEducation = new $this->modelEducation;
            $modelEducation->user_id = $model->id;
            $modelEducation->institute = $value['institute'];
            $modelEducation->field_of_study = $value['field_of_study'];
            $modelEducation->start_date = $value['start_date'];
            $modelEducation->end_date = $value['end_date'];
            $modelEducation->description = $value['description'];
            $modelEducation->is_present = $value['is_present'];
            $modelEducation->save();
        }
        foreach ($data['experience'] as $value) {
            $modelExperience = new $this->modelExperience;
            $modelExperience->user_id = $model->id;
            $modelExperience->position_title = $value['position_title'];
            $modelExperience->start_date = $value['start_date'];
            $modelExperience->end_date = $value['end_date'];
            $modelExperience->organization_name = $value['organization_name'];
            $modelExperience->is_present = $value['is_present'];
            $modelExperience->save();
        }
        return $model;
    }
}
