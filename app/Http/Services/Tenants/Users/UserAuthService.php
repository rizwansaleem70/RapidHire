<?php

namespace App\Http\Services\Tenants\Users;

use App\Contracts\Tenants\Users\UserAuthContract;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * @var UserAuthService
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
        $user = $this->prepareData($model, $input, true);
        if ($user) {
            Notification::create([
                'user_id' => $user->id,
                'title' => 'Register',
                'message' => $user->first_name . " has registered on DevJeco"
            ]);
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
        if (isset($input['first_name']) && $input['first_name']) {
            $model->first_name = $input['first_name'];
        }
        if (isset($input['last_name']) && $input['last_name']) {
            $model->last_name = $input['last_name'];
        }
        if (isset($input['email']) && $input['email']) {
            $model->email = $input['email'];
        }

        if (isset($input['password']) && $input['password']) {
            $model->password = $input['password'];
        }

//        $model->country_id = 39;
        // $model->state_id =
        $model->save();
        return $model;
    }
}
