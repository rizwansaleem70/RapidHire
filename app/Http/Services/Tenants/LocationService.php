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
    public $model;
    public function __construct()
    {
        $this->model = new Location();
    }
    public function index()
    {
        $location = $this->model->latest()->get();
        return $location;
    }
    public function show($id)
    {
        $location = $this->model->find($id);
        return $location;
    }

    public function store($data)
    {
        $model = new $this->model;
        $location = $this->prepareData($model, $data, true);
        return $location;
    }

    public function update($data, $id)
    {
        $model = $this->model->find($id);
        if (empty($model)) {
            throw new CustomException("Location Record Not Found!");
        }
        $location = $this->prepareData($model, $data, false);
        return $location;
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
