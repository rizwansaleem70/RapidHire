<?php

namespace App\Http\Services\Tenants;

use App\Contracts\Tenants\TestServiceContract;
use App\Exceptions\CustomException;
use App\Models\Tenants\Job;
use App\Models\Tenants\JobTestService;
use App\Models\Tenants\TestService;
use Illuminate\Support\Facades\Log;

/**
 * @var TestServiceService
 */
class TestServiceService implements TestServiceContract
{
    public TestService $model;
    protected Job $job;
    protected JobTestService $job_test_service;
    public function __construct()
    {
        $this->model = new TestService();
        $this->job = new Job();
        $this->job_test_service = new JobTestService();
    }
    public function index()
    {
        return $this->model->with(['tests'])->get();
    }
    public function show($id)
    {
        $model = $this->model->find($id);
        if (empty($model)) {
            throw new CustomException("Test Service Not Found!");
        }
        return $model;
    }

    public function store($data)
    {
        $model = new $this->model;
        $model['is_active'] = true;
        return $this->prepareData($model, $data, true);
    }

    public function update($data, $id)
    {
        $model = $this->model->find($id);
        if (empty($model)) {
            throw new CustomException("Test Service Record Not Found!");
        }
        return $this->prepareData($model, $data, false);
    }

    public function delete($id)
    {
        $location = $this->model->find($id);
        if (empty($location)) {
            throw new CustomException("Test Service Record Not Found!");
        }
        $location->delete();
        return true;
    }
    private function prepareData($model, $data, $new_record = false)
    {
        if (isset($data['name']) && $data['name']) {
            $model->name = $data['name'];
        }
        if (isset($data['base_url']) && $data['base_url']) {
            $model->base_url = $data['base_url'];
        }
        if (isset($data['api_key']) && $data['api_key']) {
            $model->api_key = $data['api_key'];
        }
        if (isset($data['secret_key']) && $data['secret_key']) {
            $model->secret_key = $data['secret_key'];
        }
        if (isset($data['is_active']) && $data['is_active']) {
            $model->is_active = $data['is_active'];
        }
        $model->save();
        return $model;
    }

    public function saveJobServiceTests($id, $service_tests)
    {
        $job = $this->job->find($id);
        if (empty($job)) {
            throw new CustomException("Job Record Not Found!");
        }
        foreach ($service_tests as $service_key => $tests) {
            foreach ($tests as $test_key => $test) {
                $exists = $this->job_test_service
                    ->where('job_id', $id)
                    ->where('test_service_id', $service_key)
                    ->where('test_id', $test)
                    ->first();
                if (empty($exists)) {
                    $this->job_test_service::create([
                        'job_id' => $id,
                        'test_service_id' => $service_key,
                        'test_id' => $test
                    ]);
                }
            }
            $exists_tests = $this->job_test_service->where('job_id', $id)
                ->where('test_service_id', $service_key)
                ->pluck('test_id')
                ->toArray();
            $not_taken = array_diff($exists_tests, $tests);
            $this->job_test_service
                ->where('job_id', $id)
                ->where('test_service_id', $service_key)
                ->whereIn('test_id', $not_taken)->delete();
        }
        return true;
    }

    public function getJobServiceTests($id)
    {
        $job = $this->job->find($id);
        if (empty($job)) {
            throw new CustomException("Job Record Not Found!");
        }
        $test_ids = $this->job_test_service->where('job_id', $id)->pluck('test_id')->toArray();
        return $test_ids;
    }
}
