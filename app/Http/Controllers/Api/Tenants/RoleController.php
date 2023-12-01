<?php

namespace App\Http\Controllers\Api\Tenants;

use App\Contracts\Tenants\RoleContract;
use App\Exceptions\CustomException;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenants\StoreRoleRequest;
use App\Http\Requests\Tenants\UpdateRoleRequest;
use App\Http\Resources\Tenants\RoleResource;
use App\Http\Resources\Tenants\RoleResourceCollection;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public RoleContract $role;
    public function __construct(RoleContract $role)
    {
        $this->role = $role;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = $this->role->index();
            $data = new RoleResourceCollection($data);
            return $this->successResponse("Successfully", $data);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("role index", 'none', $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $this->role->store($request->prepareRequest());
            if ($data)
                $data = new RoleResourceCollection($this->role->index());
            DB::commit();
            return $this->successResponse("Role Added Successfully", $data);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("role store", $request->input(), $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $data = $this->role->show($id);
            $data = new RoleResource($data);
            return $this->successResponse("Role Found Successfully", $data);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("role show", 'id =' . $id, $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $data = $this->role->update($request->prepareRequest(),$id);
            if ($data)
                $data = new RoleResourceCollection($this->role->index());
            DB::commit();
            return $this->successResponse("Role Update Successfully", $data);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("role store", $request->input(), $th->getMessage());
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
            $this->role->destroy($id);
            DB::commit();
            return $this->okResponse("Role Deleted Successfully");
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("role destroy", 'id = ' . $id, $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }
}
