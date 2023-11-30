<?php

namespace App\Contracts;

/**
* @var RoleContract
*/
interface RoleContract
{
    public function index();
    public function store($request);
    public function show($id);
    public function update($request,$id);
    public function destroy($id);
}
