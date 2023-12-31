<?php

namespace App\Http\Services\Tenants;

use App\Contracts\Tenants\SocialMediaContract;
use App\Exceptions\CustomException;
use App\Models\Tenants\SocialMedia;
use App\Traits\ImageUpload;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

/**
 * @var SocialMediaService
 */
class SocialMediaService implements SocialMediaContract
{
    use ImageUpload;
    public SocialMedia $model;
    public function __construct()
    {
        $this->model = new SocialMedia();
    }

    public function index()
    {
        return $this->model->latest()->get();
    }

    /**
     * @throws CustomException
     */
    public function show($id)
    {
        $model = $this->model->find($id);
        return empty($model) ?? throw new CustomException("Social Media Not Found!");
    }

    /**
     * @throws CustomException
     */
    public function store($data)
    {
        $new_data = [];
        foreach ($data as $value) {
            $new_data[] = [
                'name' => $value['url'],
                'icon' => $value['icon'],
                'url' => $value['url'],
                'user_id' =>  $value['user_id'],
            ];
        }

        $model = new $this->model;
        return $this->prepareData($model, $new_data, true);
    }
    /**
     * @throws CustomException
     */
    public function update($data, $id)
    {
        $model = $this->model->find($id);
        if (empty($model)) throw new CustomException("Social Media Not Found!");
        return $this->prepareData($model, $data, false);
    }

    /**
     * @throws CustomException
     */
    public function delete($id): bool
    {
        $jobQualification = $this->model->find($id);
        if (empty($jobQualification)) {
            throw new CustomException("Social Media Not Found!");
        }
        $jobQualification->delete();
        return true;
    }
    private function prepareData($model, $data, $new_record = false)
    {
        $model->insert($data);
        return $model;
    }
}
