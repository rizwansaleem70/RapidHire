<?php

namespace App\Http\Services\Tenants;

use App\Contracts\Tenants\CategoryContract;
use App\Exceptions\CustomException;
use App\Models\Category;

/**
* @var CategoryService
*/
class CategoryService implements CategoryContract
{
    public Category $model;
    public function __construct()
    {
        $this->model = new Category();
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
        $category = $this->model->where('name', $data['name'])->count();
        if ($category > 0) {
            throw new CustomException("Category is already exist!");
        }
        $model = new $this->model;
        return $this->prepareData($model, $data, true);
    }

    public function update($data, $id)
    {
        $model = $this->model->find($id);
        if (empty($model)) {
            throw new CustomException("Category Not Found!");
        }
        return $this->prepareData($model, $data, false);
    }

    public function delete($id)
    {
        $category = $this->model->with('child')->find($id);
        if (empty($category)) {
            throw new CustomException("Category Not Found!");
        }
        if ($category->child()->count() <= 0) throw new CustomException("This category belongs has some child categories. so, cannot remove it.");
        $category->delete();
        return true;
    }
    public function parentCategories()
    {

        return $this->model->with(['project' => function ($query) {
            $query->latest();
        }])->get();
    }
    private function prepareData($model, $data, $new_record = false)
    {
        if (isset($data['name']) && $data['name']) {
            $model->name = $data['name'];
        }
        if (isset($data['parent_id']) && $data['parent_id']) {
            $model->parent_id = $data['parent_id'];
        }
        $model->save();
        return $model;
    }
}
