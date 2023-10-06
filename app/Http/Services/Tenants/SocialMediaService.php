<?php

namespace App\Http\Services\Tenants;

use App\Contracts\Tenants\SocialMediaContract;
use App\Exceptions\CustomException;
use App\Models\Tenants\SocialMedia;
use App\Traits\ImageUpload;
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
        return empty($model) ? throw new CustomException("Social Media Not Found!") : $model;
    }

    /**
     * @throws CustomException
     */
    public function store($data)
    {
        $jobQualification = $this->model->where('name', ucfirst($data['name']))->first();
        if ($jobQualification) {
            throw new CustomException("Social Media is already exist!");
        }
        $jobQualification = $this->model->where('user_id', Auth::user()->id)->where('priority',$data['priority'])->first();
        if ($jobQualification) {
            throw new CustomException("This priority is already assigned to another social media record.");
        }
        $model = new $this->model;
        return $this->prepareData($model, $data, true);
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
        $model->user_id = Auth::user()->id;

        if (isset($data['name']) && $data['name']) {
            $model->name = $data['name'];
        }
        if (isset($data['icon']) && $data['icon']) {
            $model->icon = $this->upload($data['icon']);
        }
        if (isset($data['url']) && $data['url']) {
            $model->url = $data['url'];
        }
        if (isset($data['priority']) && $data['priority']) {
            $model->priority = $data['priority'];
        }
        $model->save();
        return $model;
    }
}
