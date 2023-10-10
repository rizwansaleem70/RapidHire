<?php

namespace App\Contracts\Tenants;

/**
* @var SettingContract
*/
interface SettingContract
{
    public function index();
    public function store($data);
    public function update($data,$id);
    public function delete($id);
}
