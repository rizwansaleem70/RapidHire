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
    public $model;
    public function __construct()
    {
        $this->model = settings();
    }
    public function index()
    {
        return $this->model->group('organization')->all();
    }

    public function store($data)
    {
        $model = new $this->model;
        return $this->prepareData($model, $data, true);
    }
    private function prepareData($model, $data, $new_record = false)
    {
        if (isset($data['name']) && $data['name']) {
            $model->group('organization')->set(
                'name', $data['name'],
            );
        }
        if (isset($data['phone']) && $data['phone']) {
            $model->group('organization')->set(
                'phone', $data['phone'],
            );
        }
        if (isset($data['website']) && $data['website']) {
            $model->group('organization')->set(
                'website' , $data['website'],
            );
        }
        return $model;
    }
}
