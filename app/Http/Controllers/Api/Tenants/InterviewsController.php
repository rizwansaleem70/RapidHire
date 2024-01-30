<?php

namespace App\Http\Controllers\Api\Tenants;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Http\Resources\Tenants\Department;
use App\Contracts\Tenants\InterviewContract;
use App\Http\Requests\Tenants\SendJobOfferRequest;
use App\Http\Resources\Tenants\DepartmentCollection;
use App\Http\Requests\Tenants\StoreDepartmentRequest;
use App\Http\Requests\Tenants\UpdateDepartmentRequest;
use App\Http\Requests\Tenants\InterviewScheduleRequest;
use App\Http\Requests\Tenants\SaveInterviewerFeedbackRequest;
use App\Http\Resources\Tenants\ScheduleInterviewResourceCollection;
use App\Http\Resources\Tenants\CandidateInterviewResourceCollection;

class InterviewsController extends Controller
{
    public InterviewContract $interview;

    public function __construct(InterviewContract $interview)
    {
        $this->interview = $interview;
    }
    /**
     * Display a listing of the resource.
     */
    public function index($applicant_id): \Illuminate\Http\JsonResponse
    {
        try {
            $interview = $this->interview->getScheduledInterviews($applicant_id);
            $interview = new CandidateInterviewResourceCollection($interview);
            return $this->successResponse("Successfully", $interview);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("department index", 'none', $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InterviewScheduleRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            DB::beginTransaction();
            $interview = $this->interview->setInterview($request->prepareData());
            DB::commit();
            if ($interview)
                $interview = new CandidateInterviewResourceCollection($this->interview->getScheduledInterviews($request->applicant_id));
            return $this->successResponse("Interview Scheduled Successfully", $interview);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("interview store", $request->input(), $th->getMessage());
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
            $this->interview->removeInterview($id);
            DB::commit();
            return $this->okResponse("Interview Deleted Successfully");
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("interview destroy", 'id = ' . $id, $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    public function scheduleInterview()
    {
        try {
            $interviews = $this->interview->scheduleInterview();
            $interviews = new ScheduleInterviewResourceCollection($interviews);
            return $this->successResponse("Success", $interviews);
        } catch (\Throwable $th) {
            Helper::logMessage("schedule_interview", "None", $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    public function saveInterviewerFeedback(SaveInterviewerFeedbackRequest $request)
    {
        try {
            $feedback = $this->interview->saveFeedback($request->prepareRequest());
            return $this->successResponse("Feedback saved successfully.");
        } catch (\Throwable $th) {
            Helper::logMessage("schedule_interview", "None", $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }


    public function sendJobOffer(SendJobOfferRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->interview->sendJobOffer($request->prepareData());
            DB::commit();
            return $this->successResponse('Job offer sent to the candidate.');
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage('job index', $request->input(), $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }
}
