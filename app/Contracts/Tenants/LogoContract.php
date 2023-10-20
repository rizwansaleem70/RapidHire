<?php

namespace App\Contracts\Tenants;

/**
* @var LogoContract
*/
interface LogoContract
{
    public function index();
    public function store($data);
}
