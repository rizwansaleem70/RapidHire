<?php

namespace App\Contracts;

/**
* @var CategoryContract
*/
interface CategoryContract
{
    public function index();
    public function show($id);
    public function parentCategories();
    public function store($data);
    public function update($data,$id);
    public function delete($id);
}
