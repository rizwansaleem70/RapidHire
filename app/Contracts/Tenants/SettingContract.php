<?php

namespace App\Contracts\Tenants;

/**
 * @var SettingContract
 */
interface SettingContract
{
    public function index();
    public function store($data, $type);
    public function questionAssignToDepartment($data);
}
