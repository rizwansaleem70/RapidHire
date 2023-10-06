<?php

namespace App\Http\Services\Tenants;

use App\Contracts\Tenants\JobQualificationContract;
use App\Exceptions\CustomException;
use App\Models\Tenants\JobQualification;

/**
* @var JobQualificationService
*/
class JobQualificationService implements JobQualificationContract
{
    public JobQualification $model;
    public function __construct()
    {
        $this->model = new JobQualification();
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
        return empty($model) ? throw new CustomException("Job Qualification Not Found!") : $model;
    }

    /**
     * @throws CustomException
     */
    public function store($data)
    {
        $jobQualification = $this->model->where('name', $data['name'])->first();
        if ($jobQualification) {
            throw new CustomException("Job Qualification is already exist!");
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
        if (empty($model)) throw new CustomException("Job Qualification Not Found!");
        return $this->prepareData($model, $data, false);
    }

    /**
     * @throws CustomException
     */
    public function delete($id)
    {
        $jobQualification = $this->model->find($id);
        if (empty($jobQualification)) {
            throw new CustomException("Job Qualification Not Found!");
        }
        $jobQualification->delete();
        return true;
    }
    private function prepareData($model, $data, $new_record = false)
    {
        if (isset($data['name']) && $data['name']) {
            $model->name = $data['name'];
        }
        if (isset($data['type']) && $data['type']) {
            $model->type = $data['type'];
        }
        $model->save();
        return $model;
    }
}
