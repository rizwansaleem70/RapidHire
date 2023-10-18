<?php

namespace App\Http\Services\Tenants;

use App\Contracts\Tenants\OrganizationContract;
use App\Exceptions\CustomException;
use App\Models\Tenants\Organization;

/**
* @var OrganizationService
*/
class OrganizationService implements OrganizationContract
{
    public Organization $model;
    public function __construct()
    {
        $this->model = new Organization();
    }
    public function index()
    {
        return $this->model->latest()->get();
    }
    public function show($id)
    {
        $model = $this->model->find($id);
        if (empty($model)) {
            throw new CustomException("Organization record Not Found!");
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
            throw new CustomException("Organization Record Not Found!");
        }
        return $this->prepareData($model, $data, false);
    }

    public function delete($id)
    {
        $location = $this->model->find($id);
        if (empty($location)) {
            throw new CustomException("Organization Record Not Found!");
        }
        $location->delete();
        return true;
    }
    private function prepareData($model, $data, $new_record = false)
    {
        if (isset($data['name']) && $data['name']) {
            $model->name = $data['name'];
        }
        if (isset($data['phone']) && $data['phone']) {
            $model->phone = $data['phone'];
        }
        if (isset($data['website']) && $data['website']) {
            $model->website = $data['website'];
        }
        $model->save();
        return $model;
    }
}
