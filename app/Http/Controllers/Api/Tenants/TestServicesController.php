<?php

namespace App\Http\Controllers\Api\Tenants;

use App\Contracts\Tenants\TestServiceContract;
use App\Exceptions\CustomException;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenants\StoreTestServiceRequest;
use App\Http\Requests\Tenants\UpdateTestServiceRequest;
use App\Http\Resources\Tenants\TestServiceResource;
use App\Http\Resources\Tenants\TestServiceResourceCollection;
use Illuminate\Support\Facades\DB;

class TestServicesController extends Controller
{
    public TestServiceContract $testService;

    public function __construct(TestServiceContract $testService)
    {
        $this->testService = $testService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $testService = $this->testService->index();
            $testService = new TestServiceResourceCollection($testService);
            return $this->successResponse("Successfully Fetch", $testService);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("testService index", 'none', $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTestServiceRequest $request)
    {
        try {
            DB::beginTransaction();
            $testService = $this->testService->store($request->prepareRequest());
            $testService = new TestServiceResource($testService);
            DB::commit();
            return $this->successResponse("Test Service Added Successfully", $testService);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("testService index", $request->input(), $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $testService = $this->testService->show($id);
            $testService = new TestServiceResource($testService);
            return $this->successResponse("Test Service Found Successfully", $testService);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("testService show", 'id =' . $id, $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTestServiceRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $testService = $this->testService->update($request->prepareRequest(), $id);
            $testService = new TestServiceResource($testService);
            DB::commit();
            return $this->successResponse("Test Service Updated Successfully", $testService);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("testService update (id = )" . $id, $request->input(), $th->getMessage());
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
            $this->testService->delete($id);
            DB::commit();
            return $this->okResponse("Test Service Deleted Successfully");
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("testService destroy", 'id = ' . $id, $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }
}
