<?php

namespace App\Http\Services\Tenants;

use App\Contracts\Tenants\TestServiceContract;
use App\Exceptions\CustomException;
use App\Models\Tenants\TestService;

/**
 * @var TestServiceService
 */
class TestServiceService implements TestServiceContract
{
    public TestService $model;
    public function __construct()
    {
        $this->model = new TestService();
    }
    public function index()
    {
        return $this->model->with(['tests'])->get();
    }
    public function show($id)
    {
        $model = $this->model->find($id);
        if (empty($model)) {
            throw new CustomException("Test Service Not Found!");
        }
        return $model;
    }

    public function store($data)
    {
        $model = new $this->model;
        $model['is_active'] = true;
        return $this->prepareData($model, $data, true);
    }

    public function update($data, $id)
    {
        $model = $this->model->find($id);
        if (empty($model)) {
            throw new CustomException("Test Service Record Not Found!");
        }
        return $this->prepareData($model, $data, false);
    }

    public function delete($id)
    {
        $location = $this->model->find($id);
        if (empty($location)) {
            throw new CustomException("Test Service Record Not Found!");
        }
        $location->delete();
        return true;
    }
    private function prepareData($model, $data, $new_record = false)
    {
        if (isset($data['name']) && $data['name']) {
            $model->name = $data['name'];
        }
        if (isset($data['base_url']) && $data['base_url']) {
            $model->base_url = $data['base_url'];
        }
        if (isset($data['api_key']) && $data['api_key']) {
            $model->api_key = $data['api_key'];
        }
        if (isset($data['secret_key']) && $data['secret_key']) {
            $model->secret_key = $data['secret_key'];
        }
        if (isset($data['is_active']) && $data['is_active']) {
            $model->is_active = $data['is_active'];
        }
        $model->save();
        return $model;
    }
}
