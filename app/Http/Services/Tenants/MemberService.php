<?php

namespace App\Http\Services\Tenants;

use App\Models\User;
use App\Helpers\Constant;
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

    public function index($role = null)
    {
        return $this->model->whereHas('roles', function ($query) use ($role) {
            $query->whereIn('id', [Constant::ROLE_INTERVIEWER, Constant::ROLE_RECRUITER]);
        })->select('id', 'first_name', 'last_name', 'email', 'status', 'created_at')->latest()->get();
    }

    public function store($data)
    {
        $model = new $this->model;
        $member = $this->prepareData($model, $data);

        if ($member && $data['role_id'] != null && isset($data['status'])) {
            $member->assignRole($data['role_id']);
        }

        return $member;
    }

    public function prepareData($model, $input, $new_record = true)
    {
        if ($input['first_name'] != null && isset($input['first_name'])) {
            $model->first_name = $input['first_name'];
        }

        if ($input['last_name'] != null && isset($input['last_name'])) {
            $model->last_name = $input['last_name'];
        }

        if ($input['email'] != null && isset($input['email'])) {
            $model->email = $input['email'];
        }

        if ($input['password'] != null && isset($input['password'])) {
            $model->password = $input['password'];
        }

        if ($input['status'] != null && isset($input['status'])) {
            $model->status = $input['status'];
        }

        $model->save();

        return $model;
    }

    public function update($data, $id)
    {
    }

    public function delete($id)
    {
    }
}
