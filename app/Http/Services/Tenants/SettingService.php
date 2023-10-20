<?php

namespace App\Http\Services\Tenants;

use App\Contracts\Tenants\SettingContract;
use App\Exceptions\CustomException;
use App\Traits\ImageUpload;
use QCod\Settings\Setting\Setting;

/**
* @var SettingService
*/
class SettingService implements SettingContract
{
    public $model;
    public function __construct()
    {
        $this->model = settings();
    }
    public function index($type)
    {
        return $this->model->group($type)->all();
    }
    public function store($data,$type)
    {
        $model = new $this->model;
        return $this->prepareData($model, $data,$type, true);
    }
    private function prepareData($model, $data,$type, $new_record = false)
    {
        switch($type) {
            case('logo'):
                $model = $model->group('logo')->set('logo', $data['logo']);
                break;
            case('color-scheme'):
                $model = $model->group('color-scheme')->set([
                    'primary' => $data['primary'],
                    'secondary' => $data['secondary'],
                ]);
                break;
            case('organization'):
                $model = $model->group('organization')->set([
                    'name' => $data['name'],
                    'phone' => $data['phone'],
                    'website' => $data['website'],
                ]);
                break;
            default:
        }
        return $model;
    }
}
