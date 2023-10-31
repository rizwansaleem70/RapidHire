<?php

namespace App\Http\Services\Tenants;

use App\Contracts\Tenants\JobContract;
use App\Exceptions\CustomException;
use App\Models\JobHiringManager;
use App\Models\JobQuestion;
use App\Models\Tenants\Department;
use App\Models\Tenants\Job;
use App\Models\Tenants\QuestionBank;
use App\Traits\ImageUpload;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
* @var JobService
*/
class JobService implements JobContract
{
    use ImageUpload;
    public Job $model;
    private JobHiringManager $jobHiringManagerModel;
    private JobQuestion $jobQuestionModel;
    private Department $departmentModel;

    public function __construct()
    {
        $this->model = new Job();
        $this->departmentModel = new Department();
        $this->jobQuestionModel = new JobQuestion();
        $this->jobHiringManagerModel = new JobHiringManager();
    }
    public function index()
    {
        return $this->model->latest()->get();
    }
    public function questionList($id)
    {
        return $this->departmentModel->with('questionBank')->whereId($id)->get();
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
            throw new CustomException("Job Record Not Found!");
        }
        return $this->prepareData($model, $data, false);
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
        if (isset($data['total_position']) && $data['total_position']) {
            $model->total_position = $data['total_position'];
        }
        if (isset($data['department_id']) && $data['department_id']) {
            $model->department_id = $data['department_id'];
        }
        if (isset($data['name']) && $data['name']) {
            $model->name = $data['name'];
            $model->slug = $data['name'];
        }
        if (isset($data['job_description']) && $data['job_description']) {
            $model->job_description = $data['job_description'];
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
        if (isset($data['cover_image']) && $data['cover_image']) {
            $model->cover_image = $data['cover_image'];
        }

        $model->save();
        $model->jobQuestion()->sync($data['question_bank_id']);
        $model->jobHiringManager()->sync($data['job_hiring_manager_id']);
        $model->requirement()->sync($data['requirement_id']);
        return $model;
    }
}
