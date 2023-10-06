<?php

namespace App\Http\Services\Tenants;

use App\Contracts\Tenants\DepartmentContract;
use App\Exceptions\CustomException;
use App\Models\Tenants\Department;

/**
* @var DepartmentService
*/
class DepartmentService implements DepartmentContract
{
    public Department $model;
    public function __construct()
    {
        $this->model = new Department();
    }

    public function index()
    {
        return $this->model->latest()->get();

    }

    /**
     * @throws CustomException
     */
    public function show($id)
    {
        $model = $this->model->find($id);
        if (empty($model)) {
            throw new CustomException("Department Not Found!");
        }
        return $model;
    }

    /**
     * @throws CustomException
     */
    public function store($data)
    {
        $department = $this->model->where('name', $data['name'])->count();
        if ($department > 0) {
            throw new CustomException("Department is already exist!");
        }
        $model = new $this->model;
        return $this->prepareData($model, $data, true);
    }

    /**
     * @throws CustomException
     */
    public function update($data, $id)
    {
        $model = $this->model->find($id);
        if (empty($model)) {
            throw new CustomException("Department Not Found!");
        }
        return $this->prepareData($model, $data, false);
    }

    /**
     * @throws CustomException
     */
    public function delete($id): bool
    {
        $department = $this->model->find($id);
        if (empty($department)) {
            throw new CustomException("Department Not Found!");
        }
        $department->delete();
        return true;
    }
    private function prepareData($model, $data, $new_record = false)
    {
        if (isset($data['name']) && $data['name']) {
            $model->name = $data['name'];
        }
        $model->save();
        return $model;
    }
}
