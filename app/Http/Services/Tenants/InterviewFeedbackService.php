<?php

namespace App\Http\Services\Tenants;

use App\Contracts\Tenants\InterviewFeedbackContract;
use App\Exceptions\CustomException;
use App\Models\Tenants\InterviewFeedback;

/**
* @var InterviewFeedbackService
*/
class InterviewFeedbackService implements InterviewFeedbackContract
{
    public InterviewFeedback $model;
    public function __construct()
    {
        $this->model = new InterviewFeedback();
    }
    public function index()
    {
        return $this->model->latest()->get();
    }
    public function show($id)
    {
        $model = $this->model->find($id);
        if (empty($model)) {
            throw new CustomException("Interview Feedback Not Found!");
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
            throw new CustomException("Interview Feedback Record Not Found!");
        }
        return $this->prepareData($model, $data, false);
    }

    public function delete($id)
    {
        $location = $this->model->find($id);
        if (empty($location)) {
            throw new CustomException("Interview Feedback Record Not Found!");
        }
        $location->delete();
        return true;
    }
    private function prepareData($model, $data, $new_record = false)
    {
        if (isset($data['name']) && $data['name']) {
            $model->name = $data['name'];
        }
        $model->save();
        return $model;
    }
}
