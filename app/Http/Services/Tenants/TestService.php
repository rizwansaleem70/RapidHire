<?php

namespace App\Http\Services\Tenants;

use App\Contracts\Tenants\TestContract;
use App\Exceptions\CustomException;
use App\Models\Tenants\Test;

/**
* @var TestService
*/
class TestService implements TestContract
{
    public Test $model;
    public function __construct()
    {
        $this->model = new Test();
    }
    public function index()
    {
        return $this->model->latest()->get();
    }
    public function show($id)
    {
        $model = $this->model->find($id);
        if (empty($model)) {
            throw new CustomException("Test Not Found!");
        }
        return $model;
    }

    public function store($data)
    {
        $model = new $this->model;
        return $this->prepareData($model, $data, true);
    }

    public function update($data, $id)
    {
        $model = $this->model->find($id);
        if (empty($model)) {
            throw new CustomException("Test Record Not Found!");
        }
        return $this->prepareData($model, $data, false);
    }

    public function delete($id)
    {
        $location = $this->model->find($id);
        if (empty($location)) {
            throw new CustomException("Test Record Not Found!");
        }
        $location->delete();
        return true;
    }
    private function prepareData($model, $data, $new_record = false)
    {
        if (isset($data['name']) && $data['name']) {
            $model->name = $data['name'];
        }
        if (isset($data['test_service_id']) && $data['test_service_id']) {
            $model->test_service_id = $data['test_service_id'];
        }

        $model->save();
        return $model;
    }
}
