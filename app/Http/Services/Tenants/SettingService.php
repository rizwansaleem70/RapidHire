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
    use ImageUpload;
    public Setting $model;
    public function __construct()
    {
        $this->model = new Setting();
    }
    public function index()
    {
        return $this->model->latest()->get();
    }
    public function show($id)
    {
        $model = $this->model->find($id);
        if (empty($model)) {
            throw new CustomException("Setting Record Not Found!");
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
            throw new CustomException("Job Record Not Found!");
        }
        return $this->prepareData($model, $data, false);
    }

    public function delete($id)
    {
        $setting = $this->model->find($id);
        if (empty($setting)) {
            throw new CustomException("Job Record Not Found!");
        }
        $setting->delete();
        return true;
    }
    private function prepareData($model, $data, $new_record = false)
    {
        if (isset($data['name']) && $data['name']) {
            $model->name = $data['name'];
        }
        if (isset($data['val']) && $data['val']) {
            $model->val = $data['val'];
        }
        if (isset($data['group']) && $data['group']) {
            $model->group = $data['group'];
        }
        $model->save();
        return $model;
    }
}
