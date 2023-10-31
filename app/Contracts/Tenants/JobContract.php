<?php

namespace App\Contracts\Tenants;

/**
* @var JobContract
*/
interface JobContract
{
    public function index();
    public function questionList($query);
    public function store($data);
    public function update($data,$id);
    public function delete($id);
}
