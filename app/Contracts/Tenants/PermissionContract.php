<?php

namespace App\Contracts\Tenants;

/**
* @var PermissionContract
*/
interface PermissionContract
{
    public function index();
    public function store($request);
    public function show($id);
    public function update($request,$id);
    public function destroy($id);
}
