<?php

namespace App\Http\Services\Tenants;

use App\Exceptions\CustomException;
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

    public function store($input)
    {
        $model = new $this->model;
        $member = $this->prepareData($model, $input,false);

        if ($member && $input['role_id'] != null && isset($input['status'])) {
            $member->assignRole($input['role_id']);
        }
        return $member;
    }

    public function prepareData($model, $data, $new_record = true)
    {
        if (isset($data['first_name']) && $data['first_name']) {
            $model->first_name = $data['first_name'];
        }
        if (isset($data['last_name']) && $data['last_name']) {
            $model->last_name = $data['last_name'];
        }
        if (isset($data['email']) && $data['email']) {
            $model->email = $data['email'];
        }
        if (isset($data['password']) && $data['password']) {
            $model->password = $data['password'];
        }
        if (isset($data['status']) && $data['status']) {
            $model->status = $data['status'];
        }
        $model->save();
        return $model;
    }
    public function show($id)
    {
        $model = $this->model->find($id);
        if (empty($model)) {
            throw new CustomException("Record Not Found!");
        }
        return $model->with('roles')->whereHas('roles', function ($query) {
            $query->whereIn('id', [Constant::ROLE_INTERVIEWER, Constant::ROLE_RECRUITER]);
        })->first(['id', 'first_name', 'last_name', 'email', 'status', 'created_at']);
    }

    public function update($request, $id)
    {
        $model = $this->model->find($id);
        if (empty($model)) {
            throw new CustomException("Record Not Found!");
        }
        $member = $this->prepareData($model, $request);
        if ($member && $request['role_id'] != null) {
            $member->syncRoles($request['role_id']);
        }
        return $member;
    }

    public function delete($id)
    {
    }
}
