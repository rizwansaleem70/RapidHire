<?php

namespace App\Http\Services\Tenants;

use App\Contracts\Tenants\PermissionContract;
use App\Exceptions\CustomException;
use App\Models\Tenants\Permission;

/**
* @var PermissionService
*/
class PermissionService implements PermissionContract
{
    protected Permission $permissionModel;

    public function __construct(){
        $this->permissionModel = new Permission();
    }

    public function index()
    {
        return $this->permissionModel->latest()->get();
    }

    public function store($request)
    {
        return $this->prepareData($this->permissionModel,$request, true);
    }

    public function show($id)
    {
        $model = $this->permissionModel->find($id);
        if (empty($model)) {
            throw new CustomException("Permission Not Found!");
        }
        return $model;
    }

    public function update($request, $id)
    {
        $model = $this->permissionModel->find($id);
        if (empty($model)) {
            throw new CustomException("Permission Not Found!");
        }
        return $this->prepareData($model, $request, false);
    }

    public function destroy($id)
    {
        $model = $this->permissionModel->find($id);
        if (empty($model)) {
            throw new CustomException("Permission Not Found!");
        }
        $model->delete();
        return true;
    }
    private function prepareData( $model,$data, $new_record = false)
    {
        if (isset($data['name']) && $data['name']) {
            $model->name = $data['name'];
        }
        $model->save();
        return $model;
    }
}
