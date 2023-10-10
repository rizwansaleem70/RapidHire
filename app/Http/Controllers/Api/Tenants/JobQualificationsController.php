<?php

namespace App\Http\Controllers\Api\Tenants;

use App\Contracts\Tenants\CategoryContract;
use App\Contracts\Tenants\JobQualificationContract;
use App\Exceptions\CustomException;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenants\StoreJobQualificationRequest;
use App\Http\Requests\Tenants\UpdateJobQualificationRequest;
use App\Http\Resources\Tenants\JobQualification;
use App\Http\Resources\Tenants\JobQualificationCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobQualificationsController extends Controller
{
    public JobQualificationContract $jobQualification;
    public function __construct(JobQualificationContract $jobQualification)
    {
        $this->jobQualification = $jobQualification;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $jobQualification = $this->jobQualification->index();
            $jobQualification = new JobQualificationCollection($jobQualification);
            return $this->successResponse("Successfully", $jobQualification);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("jobQualification index", 'none', $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobQualificationRequest $request)
    {
        try {
            DB::beginTransaction();
            $jobQualification = $this->jobQualification->store($request->prepareRequest());
            $jobQualification = new JobQualification($jobQualification);
            DB::commit();
            return $this->successResponse("Job Qualification Added Successfully", $jobQualification);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("jobQualification index", $request->input(), $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $jobQualification = $this->jobQualification->show($id);
            $jobQualification = new JobQualification($jobQualification);
            return $this->successResponse("Job Qualification Found Successfully", $jobQualification);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("jobQualification show", 'id =' . $id, $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobQualificationRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $jobQualification = $this->jobQualification->update($request->prepareRequest(), $id);
            $jobQualification = new JobQualification($jobQualification);
            DB::commit();
            return $this->successResponse("Job Qualification Updated Successfully", $jobQualification);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("jobQualification update (id = )" . $id, $request->input(), $th->getMessage());
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
            $this->jobQualification->delete($id);
            DB::commit();
            return $this->okResponse("Job Qualification Deleted Successfully");
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("jobQualification destroy", 'id = ' . $id, $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }
}
