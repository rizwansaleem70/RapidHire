<?php

namespace App\Http\Services\Tenants\Users;
use App\Contracts\Tenants\Users\UserAuthContract;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/**
* @var Tenants/Users/UserAuthService
*/
class UserAuthService implements UserAuthContract
{
    protected $model;
    public function __construct()
    {
        $this->model = new User();
    }

    public function register($input)
    {
        $model = new $this->model;
        $user = $this->prepareData($model, $input,true);
        if($user){
        Auth::attempt($input);
        return true;
        }
    }

    public function login($data)
    {
        if (Auth::attempt($data)) {
            return true;
        }
    }

    public function prepareData($model, $input, $new_record = false)
    {
        if (isset($input['email']) && $input['email']) {
            $model->email = $input['email'];
        }

        if (isset($input['password']) && $input['password']) {
            $model->password = $input['password'];
        }
        $model->save();
        return $model;
    }
}
