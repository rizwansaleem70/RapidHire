<?php

namespace App\Contracts\Tenants;

/**
* @var JobShortlistingContract
*/
interface JobShortlistingContract
{
    public function index();
    public function store($data);
    public function update($data,$id);
}
