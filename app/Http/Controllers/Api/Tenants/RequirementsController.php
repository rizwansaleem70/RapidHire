<?php

namespace App\Http\Controllers\Api\Tenants;

use App\Contracts\Tenants\RequirementContract;
use App\Exceptions\CustomException;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenants\StoreRequirementRequest;
use App\Http\Requests\Tenants\UpdateRequirementRequest;
use App\Http\Resources\Tenants\RequirementResource;
use App\Http\Resources\Tenants\RequirementResourceCollection;
use Illuminate\Support\Facades\DB;

class RequirementsController extends Controller
{
    public RequirementContract $requirement;
    public function __construct(RequirementContract $requirement)
    {
        $this->requirement = $requirement;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $requirement = $this->requirement->index();
            $requirement = new RequirementResourceCollection($requirement);
            return $this->successResponse("Successfully", $requirement);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("requirement index", 'none', $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequirementRequest $request)
    {
        try {
            DB::beginTransaction();
            $requirement = $this->requirement->store($request->prepareRequest());
            if ($requirement)
                $requirement = new RequirementResourceCollection($this->requirement->index());
            DB::commit();
            return $this->successResponse("Requirement Added Successfully", $requirement);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("requirement index", $request->input(), $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $requirement = $this->requirement->show($id);
            $requirement = new RequirementResource($requirement);
            return $this->successResponse("Requirement Found Successfully", $requirement);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("requirement show", 'id =' . $id, $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequirementRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $requirement = $this->requirement->update($request->prepareRequest(), $id);
            if ($requirement)
                $requirement = new RequirementResourceCollection($this->requirement->index());
            DB::commit();
            return $this->successResponse("Requirement Updated Successfully", $requirement);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("requirement update (id = )" . $id, $request->input(), $th->getMessage());
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
            $this->requirement->delete($id);
            DB::commit();
            return $this->okResponse("Requirement Deleted Successfully");
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("requirement destroy", 'id = ' . $id, $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }
}
