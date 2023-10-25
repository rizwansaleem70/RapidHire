<?php

namespace App\Contracts\Tenants;

/**
* @var SettingContract
*/
interface SettingContract
{
    public function index($type);
    public function store($data,$type);
}
