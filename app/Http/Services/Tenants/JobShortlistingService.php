<?php

namespace App\Http\Services\Tenants;

use App\Contracts\Tenants\JobShortlistingContract;
use App\Exceptions\CustomException;
use App\Models\Tenants\JobShortlisting;

/**
* @var JobShortlistingService
*/
class JobShortlistingService implements JobShortlistingContract
{
    public JobShortlisting $model;
    public function __construct()
    {
        $this->model = new JobShortlisting();
    }

    public function index()
    {
        return $this->model->latest()->get();
    }
    public function store($data)
    {
        return $this->prepareData(null,$data, true);
    }
    /**
     * @throws CustomException
     */
    public function update($data, $id)
    {
        $model = $this->model->find($id);
        if (empty($model)) throw new CustomException("Job Shortlisting Record Not Found!");
        return $this->prepareData($model, $data, false);
    }

    private function prepareData($model,$data, $new_record = false)
    {
        foreach ($data['test_id'] as $value)
            {
                $model = $new_record ? new $this->model : $model;
                $model->job_id = $data['job_id'];
                $model->test_service_id = $data['test_service_id'];
                $model->test_id = $value;
                $model->save();

            }
        return $model;
    }
}
