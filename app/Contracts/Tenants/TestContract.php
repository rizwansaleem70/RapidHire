<?php

namespace App\Contracts\Tenants;

/**
 * @var TestContract
 */
interface TestContract
{
    public function index();
    public function show($id);
    public function store($data);
    public function update($data, $id);
    public function delete($id);
    public function getTestServices();
}
