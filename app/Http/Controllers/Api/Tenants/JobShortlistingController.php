<?php

namespace App\Http\Controllers\Api\Tenants;

use App\Contracts\Tenants\JobShortlistingContract;
use App\Exceptions\CustomException;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenants\StoreJobShortlistingRequest;
use App\Http\Requests\Tenants\UpdateJobShortlistingRequest;
use App\Http\Resources\Tenants\JobShortlistingResource;
use App\Http\Resources\Tenants\JobShortlistingResourceCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobShortlistingController extends Controller
{
    public JobShortlistingContract $jobShortlisting;
    public function __construct(JobShortlistingContract $jobShortlisting)
    {
        $this->jobShortlisting = $jobShortlisting;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $jobShortlisting = $this->jobShortlisting->index();
            $jobShortlisting = new JobShortlistingResourceCollection($jobShortlisting);
            return $this->successResponse("Successfully", $jobShortlisting);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("jobShortlisting index", 'none', $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobShortlistingRequest $request)
    {
        try {
            DB::beginTransaction();
            $jobShortlisting = $this->jobShortlisting->store($request->prepareRequest());
            $jobShortlisting = new JobShortlistingResource($jobShortlisting);
            DB::commit();
            return $this->successResponse("Job Shortlisting Added Successfully", $jobShortlisting);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("jobShortlisting index", $request->input(), $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $jobShortlisting = $this->jobShortlisting->show($id);
            $jobShortlisting = new JobShortlistingResource($jobShortlisting);
            return $this->successResponse("Job Shortlisting Found Successfully", $jobShortlisting);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("jobShortlisting show", 'id =' . $id, $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobShortlistingRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $jobShortlisting = $this->jobShortlisting->update($request->prepareRequest(), $id);
            $jobShortlisting = new JobShortlistingResource($jobShortlisting);
            DB::commit();
            return $this->successResponse("Job Shortlisting Updated Successfully", $jobShortlisting);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("jobShortlisting update (id = )" . $id, $request->input(), $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }
}
