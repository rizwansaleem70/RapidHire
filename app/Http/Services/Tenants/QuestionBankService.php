<?php

namespace App\Http\Services\Tenants;

use App\Contracts\Tenants\QuestionBankContract;
use App\Exceptions\CustomException;
use App\Models\Tenants\QuestionBank;

/**
* @var QuestionBankService
*/
class QuestionBankService implements QuestionBankContract
{
    public QuestionBank $model;
    public function __construct()
    {
        $this->model = new QuestionBank();
    }
    public function index()
    {
        return $this->model->latest()->get();
    }
    public function show($id)
    {
        $model = $this->model->find($id);
        if (empty($model)) {
            throw new CustomException("Category Not Found!");
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
            throw new CustomException("Question Record Not Found!");
        }
        return $this->prepareData($model, $data, false);
    }

    public function delete($id)
    {
        $location = $this->model->find($id);
        if (empty($location)) {
            throw new CustomException("Question Record Not Found!");
        }
        $location->delete();
        return true;
    }
    private function prepareData($model, $data, $new_record = false)
    {
        $model->insert($data);
        return $model;
    }
}
