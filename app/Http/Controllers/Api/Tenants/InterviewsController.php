<?php

namespace App\Http\Controllers\Api\Tenants;

use App\Contracts\Tenants\InterviewContract;
use App\Exceptions\CustomException;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenants\InterviewScheduleRequest;
use App\Http\Requests\Tenants\StoreDepartmentRequest;
use App\Http\Requests\Tenants\UpdateDepartmentRequest;
use App\Http\Resources\Tenants\CandidateInterviewResourceCollection;
use App\Http\Resources\Tenants\Department;
use App\Http\Resources\Tenants\DepartmentCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
}
