<?php

namespace App\Http\Services\Tenants;

use App\Contracts\Tenants\JobRequirementContract;
use App\Exceptions\CustomException;
use App\Models\Tenants\JobRequirement;

/**
* @var JobRequirementService
*/
class JobRequirementService implements JobRequirementContract
{
    public JobRequirement $model;
    public function __construct()
    {
        $this->model = new JobRequirement();
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
        return empty($model) ? throw new CustomException("Job Requirement Not Found!") : $model;
    }

    /**
     * @throws CustomException
     */
    public function store($data)
    {
        $jobRequirement = $this->model->where('name', $data['name'])->first();
        if ($jobRequirement) {
            throw new CustomException("Job Requirement is already exist!");
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
        if (empty($model)) throw new CustomException("Job Requirement Not Found!");
        return $this->prepareData($model, $data, false);
    }

    /**
     * @throws CustomException
     */
    public function delete($id)
    {
        $jobRequirement = $this->model->find($id);
        if (empty($jobRequirement)) {
            throw new CustomException("Job Requirement Not Found!");
        }
        $jobRequirement->delete();
        return true;
    }
    private function prepareData($model, $data, $new_record = false)
    {
        if (isset($data['name']) && $data['name']) {
            $model->name = $data['name'];
        }
        if (isset($data['input_type']) && $data['input_type']) {
            $model->input_type = $data['input_type'];
        }
        if (isset($data['option']) && $data['option']) {
            $model->option = $data['option'];
        }
        $model->save();
        return $model;
    }
}
