<?php

namespace App\Http\Services\Tenants;

use Carbon\Carbon;
use App\Models\User;
use App\Helpers\Constant;
use App\Models\Tenants\Job;
use App\Traits\ImageUpload;
use Illuminate\Support\Str;
use App\Models\Tenants\City;
use App\Models\Tenants\State;
use App\Models\Tenants\Country;
use App\Models\JobHiringManager;
use App\Models\Tenants\Applicant;
use App\Models\Tenants\Education;
use App\Models\Tenants\Department;
use App\Models\Tenants\Experience;
use Illuminate\Support\Facades\DB;
use App\Exceptions\CustomException;
use App\Models\Tenants\JobATSScore;
use App\Models\Tenants\JobQuestion;
use App\Models\Tenants\Requirement;
use App\Models\Tenants\QuestionBank;
use Illuminate\Support\Facades\Auth;
use App\Contracts\Tenants\JobContract;
use App\Models\Tenants\JobRequirement;
use App\Models\Tenants\JobQualification;
use App\Models\Tenants\JobATSScoreParameter;
use App\Models\Tenants\ApplicantQuestionAnswer;
use App\Models\Tenants\ApplicantRequirementAnswer;

/**
 * @var JobService
 */
class JobService implements JobContract
{
    use ImageUpload;

    public Job $model;
    public Country $modelCountry;
    public State $modelState;
    public City $modelCity;
    protected User $modelUser;
    private JobHiringManager $jobHiringManagerModel;
    private JobQuestion $jobQuestionModel;
    private Department $departmentModel;
    private Requirement $modelRequirement;
    private QuestionBank $modelQuestionBank;
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
        $this->modelCountry = new Country();
        $this->modelState = new State();
        $this->modelCity = new City();
        $this->modelQuestionBank = new QuestionBank();
        $this->departmentModel = new Department();
        $this->modelRequirement = new Requirement();
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


    public function showJobDetail($id)
    {
        $model = $this->modelApplicant->with(['job:id,name'])->find($id);
        if (empty($model)) {
            throw new CustomException('Applicant Record Not Found!');
        }
        return $model;
    }

    public function show($id)
    {
        $model = $this->model->find($id);
        if (empty($model)) {
            throw new CustomException('Job Record Not Found!');
        }
        $job = $this->model->where('id', $id)->with(['jobHiringManager:id,first_name,last_name', 'jobQuestionBank:id,input_type,question', 'jobRequirement.requirement:id,name,input_type,option', 'department:id,name', 'country:id,name', 'state:id,name', 'city:id,name'])->first();
        $hiringManagers =  $this->modelUser->whereHas('roles', function ($query) {
            $query->whereIn('id', [Constant::ROLE_INTERVIEWER, Constant::ROLE_RECRUITER]);
        })->latest()->get(['id', 'first_name', 'last_name']);
        $departments = $this->departmentModel->get(['id', 'name']);
        $requirements = $this->modelRequirement->get(['id', 'name', 'input_type', 'option']);
        $questionBanks = $this->modelQuestionBank->where('department_id', $job->department_id)->get(['id', 'input_type', 'question']);
        $countries = $this->modelCountry->get(['id', 'name']);
        $states = $this->modelState->where('country_id', $job->country_id)->get(['id', 'name']);
        $cities = $this->modelCity->where('state_id', $job->state_id)->get(['id', 'name']);
        return [
            'job' => $job,
            'hiringManagers' => $hiringManagers,
            'departments' => $departments,
            'requirements' => $requirements,
            'questionBanks' => $questionBanks,
            'countries' => $countries,
            'states' => $states,
            'cities' => $cities,
        ];
    }
    public function ATS_Score($data, $job_id)
    {

        return $this->prepareATSScoreData($job_id, $data, true);
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
        if (isset($data['ats_threshold']) && $data['ats_threshold']) {
            $model->ats_threshold = $data['ats_threshold'];
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

    public function atsFields($job_id, $forEdit = false)
    {
        $job = $this->model->with(['jobQualification' => function ($query) {
            $query->whereNotIn('input_type', ['text', 'textarea', 'file']);
        }])->find($job_id);

        if (empty($job)) {
            throw new CustomException('Job Not Found!');
        }

        $fields = [];
        foreach ($job->jobQualification as $job_qualification) {
            $fields[] = [
                'id' => $job_qualification->id,
                'job_requirement_id' => $job_qualification->requirement_id,
                'name' => $job_qualification->name,
                'input_type' => $job_qualification->input_type,
                'option' => $job_qualification->option,
                'value' => $job_qualification->value,
                'is_required' => $job_qualification->is_required,
                'operator' => $job_qualification->operator
            ];
        }

        return $fields;
    }


    public function jobAtsFie($job_id, $forEdit = false)
    {
        $job = $this->model->with(['jobQualification' => function ($query) {
            $query->whereNotIn('input_type', ['text', 'textarea', 'file']);
        }])->find($job_id);

        if (empty($job)) {
            throw new CustomException('Job Not Found!');
        }

        $fields = [];
        foreach ($job->jobQualification as $job_qualification) {
            $fields[] = [
                'id' => $job_qualification->id,
                'name' => $job_qualification->name,
                'input_type' => $job_qualification->input_type,
                'option' => $job_qualification->option
            ];
        }

        return $fields;
    }

    public function getAtsScore($job_id)
    {
        $job_qualifications = $this->atsFields($job_id);
        $fields = [];
        $ats = $this->modelJobATSScore->with(['JobATSScoreParameter'])
            ->whereJobId($job_id)
            ->where('attribute', 'states')
            ->first();

        $job = $this->model->select('country_id')->findorfail($job_id);

        $states = State::where('country_id', $job->country_id)->select('id', 'name')->get();


        $fields[] = [
            'id' => null,
            'name' => 'states',
            'input_type' => 'select',
            'option' => $states,
            'selected_weight' => $ats->weight,
            'parameters' => $ats->JobATSScoreParameter->map(function ($parameter) {
                return [
                    'id' => $parameter->id,
                    'parameter' => $parameter->parameter,
                    'value' => $parameter->value
                ];
            })
        ];

        foreach ($job_qualifications as $job_qualification) {


            $ats = $this->modelJobATSScore->with(['JobATSScoreParameter'])
                ->whereJobId($job_id)
                ->where('job_qualification_id', $job_qualification['id'])
                ->first();

            if (!$ats) continue;

            $options = explode(",", $job_qualification['option']);
            $options_data = [];
            foreach ($options as $option) {
                $options_data[] = [
                    'name' => $option
                ];
            }

            $fields[] = [
                'id' => $job_qualification['id'],
                'name' => $job_qualification['name'],
                'input_type' => $job_qualification['input_type'],
                'option' => $options_data,
                'selected_weight' => $ats->weight,
                'parameters' => $ats->JobATSScoreParameter->map(function ($parameter) {
                    return [
                        'id' => $parameter->id,
                        'parameter' => $parameter->parameter,
                        'value' => $parameter->value
                    ];
                })
            ];
        }
        return $fields;
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
        })
            ->with('user.experience')
            ->orderBy('ats', 'ASC')
            ->paginate(10);

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
        return $this->modelApplicant->where('user_id', $user_id)->with(['job:id,name,slug'])->get(['id', 'user_id', 'job_id', 'applied_date', 'skills', 'status']);
    }

    public function jobApplicantProfileHeader($applicant_id)
    {
        $model = $this->modelApplicant->find($applicant_id);
        if (empty($model)) {
            throw new CustomException('Applicant Not Found!');
        }
        return $this->modelApplicant->whereId($applicant_id)
            ->with([
                'user:id,email,dob,bio,avatar',
                'jobExperience:applicant_id,id,position_title,start_date,end_date,organization_name,is_present',
                'country:id,name,currency',
                'state:id,name',
                'city:id,name',
            ])->first(['id', 'user_id', 'job_id', 'country_id', 'state_id', 'city_id', 'ats', 'first_name', 'last_name', 'phone', 'address', 'gender', 'status', 'skills', 'applied_date', 'source_detail', 'job_resume_path', 'cover_letter_path']);
    }


    private function prepareATSScoreData($job_id, $data, bool $true)
    {
        $scores = $this->modelJobATSScore->where('job_id', $job_id)->pluck('id')->toArray();
        JobATSScoreParameter::whereIn('job_ATS_score_id', $scores)->delete();
        $this->modelJobATSScore->where('job_id', $job_id)->delete();


        foreach ($data['ats'] as $ats) {
            $modelJobATSScore = new $this->modelJobATSScore;
            $modelJobATSScore->job_qualification_id = is_string($ats['attribute']) ? null : $ats['attribute'];
            $modelJobATSScore->attribute = $ats['attribute'];
            $modelJobATSScore->weight = $ats['weight'];
            $modelJobATSScore->job_id = $job_id;
            $modelJobATSScore->save();

            foreach ($ats['data'] as $value) {
                $modelJobATSScoreParameter = new $this->modelJobATSScoreParameter;
                $modelJobATSScoreParameter->parameter = $value['parameter'];
                $modelJobATSScoreParameter->value = $value['value'];
                $modelJobATSScoreParameter->job_ATS_score_id = $modelJobATSScore->id;
                $modelJobATSScoreParameter->save();
            }
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
        if (isset($data['salary_currency']) && $data['salary_currency']) {
            $model->salary_currency = $data['salary_currency'];
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

    public function jobStatus($data)
    {
        $job = $this->model->find($data['job_id']);
        $job->status = $data['status'];
        $job->save();
        return $job;
    }
}
