<?php

namespace App\Http\Services\Tenants\Candidates;

use Carbon\Carbon;
use App\Models\User;
use App\Helpers\Constant;
use App\Models\Tenants\Job;
use App\Traits\ImageUpload;
use App\Models\Tenants\City;
use App\Models\Tenants\State;
use App\Models\Tenants\Country;
use App\Models\Tenants\Setting;
use App\Models\Tenants\Location;
use App\Models\Tenants\Applicant;
use App\Models\Tenants\Department;
use App\Models\Tenants\Experience;
use Illuminate\Support\Facades\DB;
use App\Exceptions\CustomException;
use App\Models\Tenants\JobATSScore;
use App\Models\Tenants\SocialMedia;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenants\JobExperience;
use App\Models\Tenants\JobQualification;
use App\Models\Tenants\Candidate\FavoriteJob;
use App\Models\Tenants\ApplicantQuestionAnswer;
use App\Contracts\Tenants\Candidates\JobContract;
use App\Models\Tenants\ApplicantRequirementAnswer;
use App\Notifications\JobAppliedNotification;

/**
 * @var JobService
 */
class JobService implements JobContract
{
    use ImageUpload;
    protected JobATSScore $atsScoreModel;
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
        $this->atsScoreModel = new JobATSScore();
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
        $query = $this->modelJob->query()->where('status', 'published')
            ->where('expiry_date', '>=', date('Y-m-d'))
            ->latest();
        $query->when($filter->name, function ($q, $name) {
            return $q->like('name', $name);
        })
            ->when($filter->department_id, function ($q, $department_id) {
                return $q->where('department_id', $department_id);
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

        $logo = settings()->group('logo')->get('logo');

        $jobs = $query->select('id', 'country_id', 'state_id', 'city_id', 'user_id', 'department_id', 'name', 'slug', 'type', 'job_type', 'min_salary', 'max_salary', 'total_position', 'salary_deliver', 'expiry_date')
            ->with('country:id,name', 'state:id,name', 'city:id,name')
            ->paginate(10);

        $totalJobs = $jobs->total();

        $country = $this->modelCountry->pluck('name', 'id');

        $states = $this->modelState->when($filter->country_id, function ($q, $country_id) {
            return $q->where('country_id', $country_id)->get(['id', 'name']);
        });

        $cities = $this->modelCity->when($filter->state_id, function ($q, $state_id) {
            return $q->where('state_id', $state_id)->get(['id', 'name']);
        });

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
            'states' => $states,
            'cities' => $cities,
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
        $job->update(['views' => $job['views'] + 1]);
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
        $job = $this->modelJob->where('slug', $slug)->first();
        if (!$job) {
            throw new CustomException("Job Record Not Found!");
        }
        $user = Auth::user();

        $countries = $this->modelCountry->pluck('name', 'id');

        $states = $this->modelState->when($user->country_id, function ($q, $country_id) {
            return $q->where('country_id', $country_id);
        })->get(['id', 'name']);

        $cities = $this->modelCity->when($user->state_id, function ($q, $state_id) {
            return $q->where('state_id', $state_id);
        })->get(['id', 'name']);

        $user = $this->modelUser->with(['country:id,name', 'state:id,name', 'city:id,name', 'experience'])
            ->find(Auth::user()->id);

        $logo = settings()->group('logo')->get('logo');

        $job = $this->modelJob
            ->with([
                'country',
                'state',
                'city',
                'jobQuestion.questionBank',
                'jobQualification.requirement',
                'jobRequirement'
            ])
            ->where('slug', $slug)->first();

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
        //Check if user has already applied

        $check = $this->modelApplicant->where('user_id', Auth::id())->find($data['job_id']);
        if ($check)
            throw new CustomException("You have already applied to this job");

        $modelApplicant = new $this->modelApplicant;
        $application = $this->prepareData($modelApplicant, $data, true);

        $application->user->notify(new JobAppliedNotification($application));
    }

    private function calculateAtsScore($data)
    {
        try {

            $score = 0;
            $meet_criteria = true;
            $job = $this->modelJob->find($data['job_id']);

            if ($data['country_id'] == $job->country_id) {
                $state = State::find($data['state_id']);
                if (!$state)
                    throw new CustomException("State not found!");
                $ats_state = $this->atsScoreModel->whereJobId($data['job_id'])->whereAttribute('states')->first();
                if ($ats_state) {
                    $parameter = $ats_state->JobATSScoreParameter()->where('parameter', $state->name)->first();
                    if ($parameter) {
                        $calc_score = $this->calculateAtsScoreWithParam($parameter->value, $ats_state->weight);

                        $score += $calc_score;
                    }
                }
            }

            \Log::debug("State = " . $score);


            if (isset($data['requirement']) && count($data['requirement']) > 0) {
                foreach ($data['requirement'] as $key => $job_requirement) {

                    $job_qualification = JobQualification::whereJobIdAndRequirementId($data['job_id'], $job_requirement['id'])
                        ->first();
                    if (!$job_qualification) continue;

                    //Check The qualification criteria
                    if (is_array($job_requirement['answer'])) continue;


                    $value = "'" . strtolower($job_qualification->value) . "'";
                    $answer = "'" . strtolower($job_requirement['answer']) . "'";


                    if (!($value . $job_qualification->operator . $answer))
                        $meet_criteria = false;


                    if ($meet_criteria) {
                        $ats_state = $this->atsScoreModel->whereJobId($data['job_id'])
                            ->whereJobQualificationId($job_qualification->id)
                            ->first();
                        if ($ats_state) {
                            $parameter = $ats_state->JobATSScoreParameter()
                                ->where('parameter', $job_requirement['answer'])
                                ->first();

                            if ($parameter) {
                                $calc_score = $this->calculateAtsScoreWithParam($parameter->value, $ats_state->weight);
                                \Log::debug($job_requirement['answer'] . " Score = " . $calc_score);
                                $score += $calc_score;
                            }
                        }
                    }
                }
            }

            return [
                'ats' => $meet_criteria ? $score : 0,
                'meet_criteria' => $meet_criteria
            ];

            //code...
        } catch (\Throwable $th) {
            throw $th;
        }
    }



    private function calculateAtsScoreWithParam($value, $weighage)
    {
        return (($value / 4) * ($weighage / 100)) * 100;
    }

    private function prepareData($modelApplicant, $data, $new_record = false)
    {
        try {

            //Does candidate meet the qualification criteria?
            $qualification = $this->calculateAtsScore($data);

            $job = $this->modelJob->find($data['job_id']);

            $status = Constant::APPLIED;
            if ($qualification['meet_criteria'] == true && $qualification['ats'] >= $job->ats_threshold)
                $status = Constant::INTERVIEW;
            elseif ($qualification['meet_criteria'] == true && $qualification['ats'] >= 0)
                $status = Constant::APPLIED;
            elseif ($qualification['meet_criteria'] == false)
                $status = Constant::REJECTED;


            $skill = json_decode($data['skills']);
            $valuesArray = array_map(function ($item) {
                return $item->value;
            }, $skill);

            $commaSeparatedValuesSkill = implode(',', $valuesArray);
            $user_id = Auth::user()->id;
            $modelApplicant->user_id = $user_id;
            $modelApplicant->job_id = $job->id;
            $modelApplicant->status = $status;
            $modelApplicant->ats = $qualification['ats'];
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
            sleep(1);
            $modelApplicant->cover_letter_path = $this->upload($data['cover_letter_path']);
            $modelApplicant->save();

            if (isset($data['experience']) && count($data['experience']) > 0) {
                foreach ($data['experience'] as $value) {
                    if ($value['organization_name'] && $value['position_title'] && $value['start_date']) {
                        $modelJobExperience = new $this->modelJobExperience;
                        $modelJobExperience->applicant_id = $modelApplicant->id;
                        $modelJobExperience->job_id = $data['job_id'];
                        $modelJobExperience->organization_name = $value['organization_name'];
                        $modelJobExperience->position_title = $value['position_title'];
                        $modelJobExperience->start_date = $value['start_date'];
                        $modelJobExperience->end_date = $value['end_date'];
                        $modelJobExperience->is_present = $value["is_present"] == 0 ? 0 : 1;
                        $modelJobExperience->save();
                    }
                }
            }

            if (isset($data['question']) && $data['question'] && count($data['question']) > 0) {
                foreach ($data['question'] as $question) {
                    $modelApplicantQuestionAnswer = new $this->modelApplicantQuestionAnswer;
                    $modelApplicantQuestionAnswer->applicant_id = $modelApplicant->id;
                    $modelApplicantQuestionAnswer->job_id = $data['job_id'];
                    $modelApplicantQuestionAnswer->question_bank_id = $question['id'];
                    $modelApplicantQuestionAnswer->answer = $question['answer'];
                    $modelApplicantQuestionAnswer->save();
                }
            }

            if (isset($data['requirement']) && $data['requirement'] && count(['requirement']) > 0) {
                foreach ($data['requirement'] as $requirement) {
                    if (isset($requirement['answer_type']) && $requirement['answer_type'] == 'checkbox') {
                        $requirement['answer'] = implode(',', $requirement['answer']);
                    }
                    if (isset($requirement['answer_type']) && $requirement['answer_type'] == 'file') {
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
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
