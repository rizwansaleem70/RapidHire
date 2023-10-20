<?php

namespace App\Http\Services\Tenants;

use App\Contracts\Tenants\LogoContract;
use App\Exceptions\CustomException;

/**
* @var LogoService
*/
class LogoService implements LogoContract
{
    public $model;
    public function __construct()
    {
        $this->model = settings();
    }
    public function index()
    {
        return $this->model->group('logo')->all();
    }
    public function store($data)
    {
        $model = new $this->model;
        return $this->prepareData($model, $data, true);
    }
    private function prepareData($model, $data, $new_record = false)
    {
        if (isset($data['logo']) && $data['logo']) {
            $model->group('logo')->set(
                'logo', $data['logo'],
            );
        }
        return $model;
    }
}
