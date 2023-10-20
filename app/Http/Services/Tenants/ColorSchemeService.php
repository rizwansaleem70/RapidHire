<?php

namespace App\Http\Services\Tenants;

use App\Contracts\Tenants\ColorSchemeContract;

/**
* @var ColorSchemeService
*/
class ColorSchemeService implements ColorSchemeContract
{
    public $model;
    public function __construct()
    {
        $this->model = settings();
    }
    public function index()
    {
        return $this->model->group('color_scheme')->all();
    }
    public function store($data)
    {
        $model = new $this->model;
        return $this->prepareData($model, $data, true);
    }
    private function prepareData($model, $data, $new_record = false)
    {
        if (isset($data['primary']) && $data['primary']) {
            $model->group('color_scheme')->set(
                'primary', $data['primary'],
            );
        }
        if (isset($data['secondary']) && $data['secondary']) {
            $model->group('color_scheme')->set(
                'secondary', $data['secondary'],
            );
        }
        return $model;
    }
}
