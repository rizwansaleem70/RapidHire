<?php

namespace App\Contracts\Tenants;

/**
* @var ColorSchemeContract
*/
interface ColorSchemeContract
{
    public function index();
    public function store($data);
}
