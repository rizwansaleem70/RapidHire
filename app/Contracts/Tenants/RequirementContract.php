<?php

namespace App\Contracts\Tenants;

/**
* @var RequirementContract
*/
interface RequirementContract
{
    public function index();
    public function show($id);
    public function store($data);
    public function update($data,$id);
    public function delete($id);
}
