<?php

namespace App\Http\Services\Tenants;

use App\Contracts\Tenants\PermissionContract;
use App\Exceptions\CustomException;
use App\Models\Tenants\Permission;
use App\Models\Tenants\Role;
use App\Models\Tenants\RoleHasPermission;

/**
* @var PermissionService
*/
class PermissionService implements PermissionContract
{
    protected Permission $permissionModel;
    protected Role $roleModel;

    public function __construct(){
        $this->permissionModel = new Permission();
        $this->roleModel = new Role();

    }

    public function index()
    {
        return $this->permissionModel->latest()->get();
    }

    public function store($request)
    {
        $model = $this->roleModel->findorfail($request['role_id']);
        return $this->prepareData($model,$request, true);
    }

    public function show($id)
    {
        $model = $this->roleModel->findorfail($id);
        if (empty($model)) {
            throw new CustomException("Role and Permission Not Found!");
        }
        return [
            'role' => $model->name,
            'permission' => $model->permissions()->get(),
        ];

    }

    public function update($request, $id)
    {
        $model = $this->roleModel->findorfail($id);
        if (empty($model)) {
            throw new CustomException("Role and Permission Not Found!");
        }
        return $this->prepareData($model, $request, true);
    }

    public function destroy($id)
    {
        $model = $this->roleModel->findorfail($id);
        if (empty($model)) {
            throw new CustomException("Role and Permission Not Found!");
        }
        $model->syncPermissions();
        return true;
    }
    private function prepareData( $model,$data, $new_record = false)
    {
        $model->syncPermissions($data['permission_id']);
        return $model;
    }
}
