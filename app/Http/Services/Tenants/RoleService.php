<?php

namespace App\Http\Services\Tenants;

use App\Contracts\RoleContract;
use App\Exceptions\CustomException;
use App\Helpers\Constant;
use App\Models\Tenants\Role;

/**
* @var RoleService
*/
class RoleService implements RoleContract
{
    protected Role $roleModel;

    public function __construct(){
        $this->roleModel = new Role();
    }

    public function index()
    {
        return $this->roleModel->latest()->get();
    }

    public function store($request)
    {
        return $this->prepareData($this->roleModel,$request, true);
    }

    public function show($id)
    {
        $model = $this->roleModel->find($id);
        if (empty($model)) {
            throw new CustomException("Role Not Found!");
        }
        return $model;
    }

    public function update($request, $id)
    {
        $model = $this->roleModel->find($id);
        if (empty($model)) {
            throw new CustomException("Role Not Found!");
        }
        if (in_array($model->id, [Constant::SUPER_ADMIN_ID, Constant::ADMIN_ID, Constant::TENANT_ID, Constant::SUB_ADMIN_ID])) {
            throw new CustomException("This role is not Editable.");
        }
        return $this->prepareData($model, $request, false);
    }

    public function destroy($id)
    {
        $model = $this->roleModel->find($id);
        if (empty($model)) {
            throw new CustomException("Role Not Found!");
        }
        if (in_array($model->id, [Constant::SUPER_ADMIN_ID, Constant::ADMIN_ID, Constant::TENANT_ID, Constant::SUB_ADMIN_ID])) {
            throw new CustomException("This Role is not Delete Able.");
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
