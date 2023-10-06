<?php

namespace App\Http\Services\Tenants;

use App\Contracts\Tenants\LocationContract;
use App\Exceptions\CustomException;
use App\Models\Tenants\Location;

/**
* @var LocationService
*/
class LocationService implements LocationContract
{
    public Location $model;
    public function __construct()
    {
        $this->model = new Location();
    }
    public function index()
    {
        return $this->model->latest()->get();
    }
    public function show($id)
    {
        $model = $this->model->find($id);
        if (empty($model)) {
            throw new CustomException("Category Not Found!");
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
            throw new CustomException("Location Record Not Found!");
        }
        return $this->prepareData($model, $data, false);
    }

    public function delete($id)
    {
        $location = $this->model->find($id);
        if (empty($location)) {
            throw new CustomException("Location Record Not Found!");
        }
        $location->delete();
        return true;
    }
    private function prepareData($model, $data, $new_record = false)
    {
        if (isset($data['name']) && $data['name']) {
            $model->name = $data['name'];
        }
        if (isset($data['latitude']) && $data['latitude']) {
            $model->latitude = $data['latitude'];
        }
        if (isset($data['longitude']) && $data['longitude']) {
            $model->longitude = $data['longitude'];
        }
        $model->save();
        return $model;
    }
}
