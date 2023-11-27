<?php

namespace App\Http\Services\Tenants;

use App\Helpers\Constant;
use App\Traits\ImageUpload;
//use App\Models\Tenants\Setting;
use App\Exceptions\CustomException;
use App\Contracts\Tenants\SettingContract;
use App\Http\Resources\Tenants\LogoResource;
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
    public function index()
    {
        $settings = [
            "logo" => $this->model->group(Constant::LOGO)->get("logo") ? asset($this->model->group(Constant::LOGO)->get("logo")) : "",
            "dashboard_logo" => $this->model->group(Constant::LOGO)->get("dashboard_logo") ? asset($this->model->group(Constant::LOGO)->get("dashboard_logo")):"",
            "primary_color" => $this->model->group(Constant::COLOR_SCHEME)->get("primary"),
            "secondary_color" => $this->model->group(Constant::COLOR_SCHEME)->get("secondary"),
            "name" => $this->model->group(Constant::ORGANIZATION)->get("name"),
            "phone" => $this->model->group(Constant::ORGANIZATION)->get("phone"),
            "website" => $this->model->group(Constant::ORGANIZATION)->get("website"),
            "candidate_reapply_days" => $this->model->group(Constant::CONFIGURATION)->get("candidate_reapply_days"),
            "company_contract_email" => $this->model->group(Constant::CONFIGURATION)->get("company_contract_email"),
            "default_email_signature" => $this->model->group(Constant::CONFIGURATION)->get("default_email_signature"),
            "company_title_about" => $this->model->group(Constant::CONFIGURATION)->get("company_title_about"),
            "job_description_about" => $this->model->group(Constant::CONFIGURATION)->get("job_description_about"),
            "currency" => $this->model->group(Constant::CONFIGURATION)->get("currency"),
            "title" => $this->model->group(Constant::CORE_VALUE)->get("title"),
            "icon" => $this->model->group(Constant::CORE_VALUE)->get("icon") ? asset($this->model->group(Constant::CORE_VALUE)->get("icon")) : "",
            "description" => $this->model->group(Constant::CORE_VALUE)->get("description"),
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
                 $model = $model->group('logo')->set([
                     'logo' => $data['logo'],
                     'dashboard_logo' => $data['dashboard_logo']
                 ]);
                break;
            case ('color-scheme'):
                 $model = $model->group('color-scheme')->set([
                     'primary' => $data['primary'],
                     'secondary' => $data['secondary'],
                 ]);
                break;
            case ('organization'):
                 $model = $model->group('organization')->set([
                     'name' => $data['name'],
                     'phone' => $data['phone'],
                     'website' => $data['website'],
                 ]);
                break;
            case ('configuration'):
                 $model = $model->group('configuration')->set([
                     'candidate_reapply_days' => $data['candidate_reapply_days'],
                     'company_contract_email' => $data['company_contract_email'],
                     'default_email_signature' => $data['default_email_signature'],
                     'company_title_about' => $data['company_title_about'],
                     'job_description_about' => $data['job_description_about'],
                     'currency' => $data['currency'],
                 ]);
                break;
            case ('core-value'):
                 $model = $model->group('core-value')->set([
                     'title' => $data['title'],
                     'icon' => $data['icon'],
                     'description' => $data['description'],
                 ]);
                break;
            default:
        }
        return $model;
    }
}
