<?php

namespace App\Contracts\Tenants;

/**
 * @var Tenants\MemberContractContract
 */
interface MemberContract
{
    public function index($role = 'Member');
    public function store($input);
    public function update($input, $id);
    public function delete($id);
}
