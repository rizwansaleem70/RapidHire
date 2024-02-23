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
use App\Http\Resources\Tenants\RoleHasPermissionResourceCollection;
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
            $data = collect($this->permission->index());
            $data = $data->map(function ($permission) {
                return [
                    "id" => $permission->id,
                    "name" => explode(".", $permission->name)[1],
                    "label" => $permission->label
                ];
            })->groupBy('label');

            $permissions = [];
            foreach ($data as $key => $d) {
                $permissions[] = [
                    'module' => $key,
                    'permissions' => $d
                ];
            }

            return $this->successResponse("Successfully", $permissions);
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
            $this->permission->store($request->prepareRequest());
            DB::commit();
            return $this->okResponse("Permission Assign Successfully");
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
            $data = new RoleHasPermissionResourceCollection($data['permission'], $data);
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
            $data = $this->permission->update($request->prepareRequest(), $id);
            DB::commit();
            return $this->okResponse("Permission assign Successfully", $data);
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
