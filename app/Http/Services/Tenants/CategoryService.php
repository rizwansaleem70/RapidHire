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
    public $model;
    public function __construct()
    {
        $this->model = new Category();
    }

    public function index()
    {
        $category = $this->model->latest()->get();
        return $category;
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
        $category = $this->prepareData($model, $data, true);
        return $category;
    }

    public function update($data, $id)
    {
//        $category = $this->model->where('name', $data['name'])->count();
//        if ($category > 0) {
//            throw new CustomException("This Category Name is already exist!");
//        }
        $model = $this->model->find($id);
        if (empty($model)) {
            throw new CustomException("Category Not Found!");
        }
        $category = $this->prepareData($model, $data, false);
        return $category;
    }

    public function delete($id)
    {
        $category = $this->model->with('child')->find($id);
        if (empty($category)) {
            throw new CustomException("Category Not Found!");
        }
        if ($category->child()->count() <= 0) {
            throw new CustomException("This category belongs has some child categories. so, cannot remove it.");
        }
        $category->delete();
        return true;
    }
    public function parentCategories()
    {

        $category = $this->model->with(['project' => function ($query) {
            $query->latest();
        }])->get();
        return $category;
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
