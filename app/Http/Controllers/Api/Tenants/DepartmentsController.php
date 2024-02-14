<?php

namespace App\Http\Controllers\Api\Tenants;

use App\Contracts\Tenants\DepartmentContract;
use App\Exceptions\CustomException;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenants\StoreDepartmentRequest;
use App\Http\Requests\Tenants\UpdateDepartmentRequest;
use App\Http\Resources\Tenants\Department;
use App\Http\Resources\Tenants\DepartmentCollection;
use App\Http\Resources\Tenants\DepartmentResource;
use App\Http\Resources\Tenants\DepartmentResourceCollection;
use Illuminate\Support\Facades\DB;

class DepartmentsController extends Controller
{
    public DepartmentContract $department;

    public function __construct(DepartmentContract $department)
    {
        $this->department = $department;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        try {
            $department = $this->department->index();
            $department = new DepartmentResourceCollection($department);
            return $this->successResponse("Successfully", $department);
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
    public function store(StoreDepartmentRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            DB::beginTransaction();
            $department = $this->department->store($request->prepareRequest());
            if ($department)
                $department = new DepartmentResourceCollection($this->department->index());
            DB::commit();
            return $this->successResponse("Department Added Successfully", $department);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("department index", $request->input(), $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): \Illuminate\Http\JsonResponse
    {
        try {
            $department = $this->department->show($id);
            $department = new DepartmentResource($department);
            return $this->successResponse("Department Found Successfully", $department);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("department show", 'id =' . $id, $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartmentRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $department = $this->department->update($request->prepareRequest(), $id);
            if ($department)
                $department = new DepartmentResourceCollection($this->department->index());
            DB::commit();
            return $this->successResponse("Department Updated Successfully", $department);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("department update (id = )" . $id, $request->input(), $th->getMessage());
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
            $this->department->delete($id);
            DB::commit();
            return $this->okResponse("Department Deleted Successfully");
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("department destroy", 'id = ' . $id, $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }
}
