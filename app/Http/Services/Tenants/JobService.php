<?php

namespace App\Http\Services\Tenants;

use App\Contracts\Tenants\JobContract;
use App\Exceptions\CustomException;
use App\Models\Tenants\Job;
use App\Traits\ImageUpload;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

/**
* @var JobService
*/
class JobService implements JobContract
{
    use ImageUpload;
    public $model;
    public function __construct()
    {
        $this->model = new Job();
    }
    public function index()
    {
        $job = $this->model->latest()->get();
        return $job;
    }
    public function show($id)
    {
        $job = $this->model->find($id);
        return $job;
    }

    public function store($data)
    {
        $model = new $this->model;
        $job = $this->prepareData($model, $data, true);
        return $job;
    }

    public function update($data, $id)
    {
        $model = $this->model->find($id);
        if (empty($model)) {
            throw new CustomException("Job Record Not Found!");
        }
        $job = $this->prepareData($model, $data, false);
        return $job;
    }

    public function delete($id)
    {
        $job = $this->model->find($id);
        if (empty($job)) {
            throw new CustomException("Job Record Not Found!");
        }
        $job->delete();
        return true;
    }
    private function prepareData($model, $data, $new_record = false)
    {
        $model->user_id = Auth::user()->id;
        if (isset($data['location_id']) && $data['location_id']) {
            $model->location_id = $data['location_id'];
        }
        if (isset($data['category_id']) && $data['category_id']) {
            $model->category_id = $data['category_id'];
        }
        if (isset($data['name']) && $data['name']) {
            $model->name = $data['name'];
        }
        if (isset($data['type']) && $data['type']) {
            $model->type = $data['type'];
        }
        if (isset($data['job_type']) && $data['job_type']) {
            $model->job_type = $data['job_type'];
        }
        if ($new_record) {
            $model->post_date = Carbon::now();
        }
        if (isset($data['min_salary']) && $data['min_salary']) {
            $model->min_salary = $data['min_salary'];
        }
        if (isset($data['max_salary']) && $data['max_salary']) {
            $model->max_salary = $data['max_salary'];
        }
        if (isset($data['expiry_date']) && $data['expiry_date']) {
            $model->expiry_date = $data['expiry_date'];
        }
        if (isset($data['is_active']) && $data['is_active']) {
            $model->is_active = $data['is_active'];
        }
        if (isset($data['rating']) && $data['rating']) {
            $model->rating = $data['rating'];
        }
        if (isset($data['status']) && $data['status']) {
            $model->status = $data['status'];
        }
        if (isset($data['salary_deliver']) && $data['salary_deliver']) {
            $model->salary_deliver = $data['salary_deliver'];
        }
        if (isset($data['image']) && $data['image']) {
            $image_path = $this->upload($data['image']);
            $model->image = $image_path;
        }
        $model->save();
        return $model;
    }
}
