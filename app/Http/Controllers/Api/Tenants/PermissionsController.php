<?php

namespace App\Http\Controllers\Api\Tenants;

use App\Contracts\Tenants\PermissionContract;
use App\Exceptions\CustomException;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenants\StorePermissionRequest;
use App\Http\Requests\Tenants\UpdatePermissionRequest;
use App\Http\Resources\Tenants\PermissionResource;
use App\Http\Resources\Tenants\PermissionResourceCollection;
use Illuminate\Support\Facades\DB;

class PermissionsController extends Controller
{

    public PermissionContract $permission;
    public function __construct(PermissionContract $permission)
    {
        $this->permission = $permission;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = $this->permission->index();
            $data = new PermissionResourceCollection($data);
            return $this->successResponse("Successfully", $data);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("permission index", 'none', $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $this->permission->store($request->prepareRequest());
            if ($data)
                $data = new PermissionResourceCollection($this->permission->index());
            DB::commit();
            return $this->successResponse("Permission Added Successfully", $data);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("permission store", $request->input(), $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $data = $this->permission->show($id);
            $data = new PermissionResource($data);
            return $this->successResponse("Permission Found Successfully", $data);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("permission show", 'id =' . $id, $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $data = $this->permission->update($request->prepareRequest(),$id);
            if ($data)
                $data = new PermissionResourceCollection($this->permission->index());
            DB::commit();
            return $this->successResponse("Permission Update Successfully", $data);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("permission store", $request->input(), $th->getMessage());
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
            $this->permission->destroy($id);
            DB::commit();
            return $this->okResponse("Permission Deleted Successfully");
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("permission destroy", 'id = ' . $id, $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }
}
