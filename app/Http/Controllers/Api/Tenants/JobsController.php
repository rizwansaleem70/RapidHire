<?php

namespace App\Http\Controllers\Api\Tenants;

use App\Contracts\Tenants\JobContract;
use App\Exceptions\CustomException;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenants\Candidate\UpdateApplicantProfileRequest;
use App\Http\Requests\Tenants\StoreATS_ScoreRequest;
use App\Http\Requests\Tenants\StoreJobQualificationRequest;
use App\Http\Requests\Tenants\StoreJobRequest;
use App\Http\Requests\Tenants\UpdateJobRequest;
use App\Http\Resources\Tenants\AnswerResourceCollection;
use App\Http\Resources\Tenants\ApplicantJobResourceCollection;
use App\Http\Resources\Tenants\CandidateAppliedJobsResourceCollection;
use App\Http\Resources\Tenants\DepartmentCollection;
use App\Http\Resources\Tenants\Job;
use App\Http\Resources\Tenants\JobApplicantResourceCollection;
use App\Http\Resources\Tenants\JobCollection;
use App\Http\Resources\Tenants\ProfileHeaderResource;
use App\Http\Resources\Tenants\ProfileResource;
use App\Http\Resources\Tenants\RequirementResourceCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobsController extends Controller
{
    public $job;

    public function __construct(JobContract $job)
    {
        $this->job = $job;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $job = $this->job->index();
            $job = new JobCollection($job);
            return $this->successResponse("Successfully", $job);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("job index", 'none', $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobRequest $request)
    {
        try {
            DB::beginTransaction();
            $job = $this->job->store($request->prepareRequest());
            $job = new Job($job);
            DB::commit();
            return $this->successResponse("Job Added Successfully", $job);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("job index", $request->input(), $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function questionList(Request $request)
    {
        try {
            $job = $this->job->questionList($request);
            $job = new DepartmentCollection($job);
            return $this->successResponse("Department Records Found Successfully", $job);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("job show", $request->input(), $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }
    public function job_qualification(StoreJobQualificationRequest $request, $job_id)
    {
        try {
            DB::beginTransaction();
            $this->job->job_qualification($request, $job_id);
            DB::commit();
            return $this->okResponse("Job Qualification Records Save Successfully");
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("job_qualification",  $request->all(), $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }
    public function get_country_against_job($job_id)
    {
        try {
            $data = $this->job->get_country_against_job($job_id);
            return $this->successResponse("Jobs Country Found Successfully", $data);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("getJobApplicants", 'none', $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $job = $this->job->update($request->prepareRequest(), $id);
            $job = new Job($job);
            DB::commit();
            return $this->successResponse("Job Updated Successfully", $job);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("job update (id = )" . $id, $request->input(), $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $this->job->delete($id);
            DB::commit();
            return $this->okResponse("Job Deleted Successfully");
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("job destroy", 'id = ' . $id, $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    public function requirements($id)
    {
        try {
            $requirements = $this->job->requirements($id);
            $requirements = new RequirementResourceCollection($requirements);
            return $this->successResponse("Success", $requirements);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("job requirements", 'id = ' . $id, $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }
    public function getJobs(Request $request)
    {
        try {
            $data = $this->job->getApplicantJobs($request);
            $data = new ApplicantJobResourceCollection($data);
            return $this->successResponse("Jobs Listing", $data);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("getJobs Listing", 'none', $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    public function getJobApplicants(Request $request, $job_id)
    {
        try {
            $data = $this->job->getJobApplicant($request->all(), $job_id);
            $data = new JobApplicantResourceCollection($data['applicants'], $data);
            return $this->successResponse("Jobs Applicant Listing", $data);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("getJobApplicants", 'none', $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }
    public function candidateAppliedJobs($user_id)
    {
        try {
            $data = $this->job->candidateAppliedJobs($user_id);
            $data = new CandidateAppliedJobsResourceCollection($data);
            return $this->successResponse("Applied Jobs Listing", $data);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("getJobApplicants", 'none', $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }
    public function jobApplicantProfileStatus(Request $request, $applicant_id,$job_id)
    {
        try {
            $data = $this->job->jobApplicantProfileStatus($request,$applicant_id,$job_id);
            return $this->successResponse("Status Update Successfully", $data);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("getJobApplicants", 'none', $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }
    public function jobApplicantQuestionAnswer($applicant_id,$job_id)
    {
        try {
            $data = $this->job->jobApplicantQuestionAnswer($applicant_id,$job_id);
            $data = new AnswerResourceCollection($data);
            return $this->successResponse("Record Found Successfully", $data);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("getJobApplicants", 'none', $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }
    public function jobApplicantProfileHeader($applicant_id)
    {
        try {
            $data = $this->job->jobApplicantProfileHeader($applicant_id);
            $data = new ProfileHeaderResource($data);
            return $this->successResponse("Jobs Applicant Listing", $data);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("jobApplicantProfileHeader", 'none', $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }
    public function profile($user_id)
    {
        try {
            $data = $this->job->profile($user_id);
            $data = new ProfileResource($data);
            return $this->successResponse("Applicant Profile", $data);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("jobApplicantProfile", 'none', $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }
    public function profileUpdate(UpdateApplicantProfileRequest $request, $user_id)
    {
        try {
            DB::beginTransaction();
            $data = $this->job->profileUpdate($request->all(),$user_id);
            DB::commit();
            $data = new ProfileResource($data);
            return $this->successResponse("Profile Update", $data);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("jobApplicantProfile", 'none', $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }
    public function ATS_Score(StoreATS_ScoreRequest $request, $job_id): \Illuminate\Http\JsonResponse
    {
        try {
            DB::beginTransaction();
            $this->job->ATS_Score($request, $job_id);
            //            $data = new ATS_ScoreResource($data);
            DB::commit();
            return $this->okResponse("Jobs ATS Score Save Successfully");
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("ATS_Score", 'none', $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }
}
