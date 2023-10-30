<?php

namespace App\Http\Services\Tenants;

use App\Contracts\Tenants\RequirementContract;
use App\Exceptions\CustomException;
use App\Models\Requirement;

/**
* @var RequirementService
*/
class RequirementService implements RequirementContract
{
    public Requirement $model;
    public function __construct()
    {
        $this->model = new Requirement();
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
        return empty($model) ? throw new CustomException("Requirement Not Found!") : $model;
    }

    /**
     * @throws CustomException
     */
    public function store($data)
    {
        $model = new $this->model;
        return $this->prepareData($model, $data, true);
    }
    /**
     * @throws CustomException
     */
    public function update($data, $id)
    {
        $model = $this->model->find($id);
        if (empty($model)) throw new CustomException("Requirement Not Found!");
        return $this->prepareData($model, $data, false);
    }

    /**
     * @throws CustomException
     */
    public function delete($id)
    {
        $model = $this->model->find($id);
        if (empty($model)) {
            throw new CustomException("Requirement Not Found!");
        }
        $model->delete();
        return true;
    }
    private function prepareData($model, $data, $new_record = false)
    {
        if ($new_record){
            $model->insert($data);
        }
        else{
            if (isset($data['name']) && $data['name']) {
                $model->name = $data['name'];
            }
            if (isset($data['option']) && $data['option']) {
                $model->option = $data['option'];
            }
            $model->save();
        }
        return $model;
    }
}
