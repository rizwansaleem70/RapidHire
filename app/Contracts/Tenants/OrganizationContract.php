<?php

namespace App\Contracts\Tenants;

/**
* @var OrganizationContract
*/
interface OrganizationContract
{
    public function index();
    public function store($data);
    public function update($data,$id);
}
