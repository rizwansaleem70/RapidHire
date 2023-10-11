<?php

namespace App\Http\Controllers\Api\Tenants;

use App\Contracts\Tenants\CategoryContract;
use App\Contracts\Tenants\JobRequirementContract;
use App\Exceptions\CustomException;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenants\StoreJobRequirementRequest;
use App\Http\Requests\Tenants\UpdateJobRequirementRequest;
use App\Http\Resources\Tenants\JobRequirementResource;
use App\Http\Resources\Tenants\JobRequirementResourceCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobRequirementController extends Controller
{
    public JobRequirementContract $jobRequirement;
    public function __construct(JobRequirementContract $jobRequirement)
    {
        $this->jobRequirement = $jobRequirement;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $jobRequirement = $this->jobRequirement->index();
            $jobRequirement = new JobRequirementResourceCollection($jobRequirement);
            return $this->successResponse("Successfully", $jobRequirement);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("jobRequirement index", 'none', $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobRequirementRequest $request)
    {
        try {
            DB::beginTransaction();
            $jobRequirement = $this->jobRequirement->store($request->prepareRequest());
            $jobRequirement = new JobRequirementResource($jobRequirement);
            DB::commit();
            return $this->successResponse("Job Requirement Added Successfully", $jobRequirement);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("jobRequirement index", $request->input(), $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $jobRequirement = $this->jobRequirement->show($id);
            $jobRequirement = new JobRequirementResource($jobRequirement);
            return $this->successResponse("Job Requirement Found Successfully", $jobRequirement);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("jobRequirement show", 'id =' . $id, $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobRequirementRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $jobRequirement = $this->jobRequirement->update($request->prepareRequest(), $id);
            $jobRequirement = new JobRequirementResource($jobRequirement);
            DB::commit();
            return $this->successResponse("Job Requirement Updated Successfully", $jobRequirement);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("jobRequirement update (id = )" . $id, $request->input(), $th->getMessage());
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
            $this->jobRequirement->delete($id);
            DB::commit();
            return $this->okResponse("Job Requirement Deleted Successfully");
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("jobRequirement destroy", 'id = ' . $id, $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }
}
