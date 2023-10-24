<?php

namespace App\Http\Controllers\Api\Tenants;

use App\Contracts\Tenants\InterviewFeedbackContract;
use App\Exceptions\CustomException;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenants\StoreInterviewFeedbackRequest;
use App\Http\Requests\Tenants\UpdateInterviewFeedbackRequest;
use App\Http\Resources\Tenants\InterviewFeedbackResource;
use App\Http\Resources\Tenants\InterviewFeedbackResourceCollection;
use Illuminate\Support\Facades\DB;

class InterviewFeedbacksController extends Controller
{
    public InterviewFeedbackContract $interviewFeedback;

    public function __construct(InterviewFeedbackContract $interviewFeedback)
    {
        $this->interviewFeedback = $interviewFeedback;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $interviewFeedback = $this->interviewFeedback->index();
            $interviewFeedback = new InterviewFeedbackResourceCollection($interviewFeedback);
            return $this->successResponse("Successfully Fetch", $interviewFeedback);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("interviewFeedback index", 'none', $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInterviewFeedbackRequest $request)
    {
        try {
            DB::beginTransaction();
            $interviewFeedback = $this->interviewFeedback->store($request->prepareRequest());
            $interviewFeedback = new InterviewFeedbackResource($interviewFeedback);
            DB::commit();
            return $this->successResponse("Interview Feedback Added Successfully", $interviewFeedback);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("interviewFeedback index", $request->input(), $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $interviewFeedback = $this->interviewFeedback->show($id);
            $interviewFeedback = new InterviewFeedbackResource($interviewFeedback);
            return $this->successResponse("Interview Feedback Found Successfully", $interviewFeedback);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("interviewFeedback show", 'id =' . $id, $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInterviewFeedbackRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $interviewFeedback = $this->interviewFeedback->update($request->prepareRequest(), $id);
            $interviewFeedback = new InterviewFeedbackResource($interviewFeedback);
            DB::commit();
            return $this->successResponse("Interview Feedback Updated Successfully", $interviewFeedback);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("interviewFeedback update (id = )" . $id, $request->input(), $th->getMessage());
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
            $this->interviewFeedback->delete($id);
            DB::commit();
            return $this->okResponse("Interview Feedback Deleted Successfully");
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("interviewFeedback destroy", 'id = ' . $id, $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }
}
