<?php

namespace App\Http\Services\Tenants;

use App\Models\User;
use App\Contracts\Tenants\MemberContract;
use App\Contracts\Tenants\MemberContractContract;

/**
 * @var Tenants/MemberService
 */
class MemberService implements MemberContract
{
    public $model;
    public function __construct()
    {
        $this->model = new User;
    }

    public function index($role = 'Member')
    {
        return $this->model->whereHas('roles', function ($role) {
            $role->where('name', 'Member');
        })->get();
    }

    public function store($data)
    {
    }

    public function update($data, $id)
    {
    }

    public function delete($id)
    {
    }
}
