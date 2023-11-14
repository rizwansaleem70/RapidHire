<?php

namespace App\Http\Services\Tenants;

use App\Helpers\Constant;
use App\Traits\ImageUpload;
use App\Models\Tenants\Setting;
use App\Exceptions\CustomException;
use App\Contracts\Tenants\SettingContract;
use App\Http\Resources\Tenants\LogoResource;

/**
 * @var SettingService
 */
class SettingService implements SettingContract
{
    public $model;
    public function __construct()
    {
        $this->model = new Setting();
    }
    public function index()
    {
        $settings = [
            "logo" => asset($this->model::getValue(Constant::LOGO, "logo")),
            "primary_color" => $this->model::getValue(Constant::COLOR_SCHEME, "primary"),
            "secondary_color" => $this->model::getValue(Constant::COLOR_SCHEME, "secondary"),
            "name" => $this->model::getValue(Constant::ORGANIZATION, "name"),
            "phone" => $this->model::getValue(Constant::ORGANIZATION, "phone"),
            "website" => $this->model::getValue(Constant::ORGANIZATION, "website"),
            "candidate_reapply_days" => $this->model::getValue(Constant::CONFIGURATION, "candidate_reapply_days"),
            "company_contract_email" => $this->model::getValue(Constant::CONFIGURATION, "company_contract_email"),
            "default_email_signature" => $this->model::getValue(Constant::CONFIGURATION, "default_email_signature"),
            "company_title_about" => $this->model::getValue(Constant::CONFIGURATION, "company_title_about"),
            "job_description_about" => $this->model::getValue(Constant::CONFIGURATION, "job_description_about"),
        ];
        return $settings;
    }
    public function store($data, $type)
    {
        $model = new $this->model;
        return $this->prepareData($model, $data, $type, true);
    }

    private function prepareData($model, $data, $type, $new_record = false)
    {
        switch ($type) {
            case ('logo'):
                // $model = $model->group('logo')->set('logo', $data['logo']);
                break;
            case ('color-scheme'):
                // $model = $model->group('color-scheme')->set([
                //     'primary' => $data['primary'],
                //     'secondary' => $data['secondary'],
                // ]);
                break;
            case ('organization'):
                // $model = $model->group('organization')->set([
                //     'name' => $data['name'],
                //     'phone' => $data['phone'],
                //     'website' => $data['website'],
                // ]);
                break;
            case ('configuration'):
                // $model = $model->group('configuration')->set([
                //     'candidate_reapply_days' => $data['candidate_reapply_days'],
                //     'company_contract_email' => $data['company_contract_email'],
                //     'default_email_signature' => $data['default_email_signature'],
                //     'company_title_about' => $data['company_title_about'],
                //     'job_description_about' => $data['job_description_about'],
                // ]);
                break;
            case ('core-value'):
                // $model = $model->group('core-value')->set([
                //     'title' => $data['title'],
                //     'icon' => $data['icon'],
                //     'description' => $data['description'],
                // ]);
                break;
            default:
        }
        return $model;
    }
}
