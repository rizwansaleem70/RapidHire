<?php

namespace App\Contracts\Tenants;

/**
 * @var Tenants\MemberContractContract
 */
interface MemberContract
{
    public function index($role = null);
    public function store($input);
    public function show($id);
    public function update($request, $id);
    public function delete($id);
}
