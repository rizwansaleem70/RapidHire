<?php

namespace App\Contracts\Tenants;

/**
 * @var TestServiceContract
 */
interface TestServiceContract
{
    public function index();
    public function show($id);
    public function store($data);
    public function update($data, $id);
    public function delete($id);
    public function saveJobServiceTests($id, $service_tests);
    public function getJobServiceTests($id);
}
