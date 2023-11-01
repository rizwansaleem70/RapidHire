<?php

namespace App\Http\Controllers\Api\Tenants;

use App\Contracts\Tenants\TestContract;
use App\Exceptions\CustomException;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenants\StoreTestRequest;
use App\Http\Requests\Tenants\UpdateTestRequest;
use App\Http\Resources\Tenants\TestResource;
use App\Http\Resources\Tenants\TestResourceCollection;
use Illuminate\Support\Facades\DB;

class TestsController extends Controller
{
    public TestContract $test;

    public function __construct(TestContract $test)
    {
        $this->test = $test;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $test = $this->test->index();
            $test = new TestResourceCollection($test);
            return $this->successResponse("Successfully Fetch", $test);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("test index", 'none', $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTestRequest $request)
    {
        try {
            DB::beginTransaction();
            $test = $this->test->store($request->prepareRequest());
            $test = new TestResource($test);
            DB::commit();
            return $this->successResponse("Test Added Successfully", $test);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("test index", $request->input(), $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $test = $this->test->show($id);
            $test = new TestResource($test);
            return $this->successResponse("Test Found Successfully", $test);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("test show", 'id =' . $id, $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTestRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $test = $this->test->update($request->prepareRequest(), $id);
            $test = new TestResource($test);
            DB::commit();
            return $this->successResponse("Test Updated Successfully", $test);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("test update (id = )" . $id, $request->input(), $th->getMessage());
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
            $this->test->delete($id);
            DB::commit();
            return $this->okResponse("Test Deleted Successfully");
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("test destroy", 'id = ' . $id, $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }


    public function getTestServices()
    {
        try {
            $services = $this->test->getTestServices();
            return $this->successResponse("Test services list", $services);
        } catch (\Throwable $th) {
            Helper::logMessage("test services", 'id = ', $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }
}
