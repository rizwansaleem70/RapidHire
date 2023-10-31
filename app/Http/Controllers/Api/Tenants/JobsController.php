<?php

namespace App\Http\Controllers\Api\Tenants;

use App\Contracts\Tenants\JobContract;
use App\Exceptions\CustomException;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenants\GetQuestionListRequest;
use App\Http\Requests\Tenants\StoreJobRequest;
use App\Http\Requests\Tenants\UpdateJobRequest;
use App\Http\Resources\Tenants\Department;
use App\Http\Resources\Tenants\DepartmentCollection;
use App\Http\Resources\Tenants\Job;
use App\Http\Resources\Tenants\JobCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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
            Helper::logMessage("job show", 'id =' . $id, $th->getMessage());
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
}
