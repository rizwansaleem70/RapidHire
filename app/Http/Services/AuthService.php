<?php

namespace App\Http\Services;

use App\Contracts\AuthContract;
use App\Exceptions\CustomException;
use App\Models\User;

/**
 * @var AuthService
 */
class AuthService implements AuthContract
{
    protected $model;
    public function __construct()
    {
        $this->model = new User();
    }

    public function register($data)
    {
        $model = new $this->model;
        $user = $this->prepareData($model, $data, true);
        return $user;
    }

    public function login($data)
    {
        $user = $this->model->where('email', $data['email'])->first();

        if (!($this->model)->checkPassword($data['password'], $user->password))
            throw new CustomException("Invalid Credentials");

        return $user;
    }

    public function prepareData($model, $input)
    {

        if (isset($input['name']) && $input['name'] != '') {
            $model->name = $input['name'];
        }

        if (isset($input['email']) && $input['email'] != '') {
            $model->email = $input['email'];
        }

        if (isset($input['password']) && $input['password'] != '') {
            $model->password = $input['password'];
        }

        $user = $model->save();
        return $model;
    }
}
