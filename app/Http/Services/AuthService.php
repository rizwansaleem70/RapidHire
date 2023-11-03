<?php

namespace App\Http\Services;

use App\Models\User;
use App\Helpers\Constant;
use App\Mail\OtpSendMail;
use Illuminate\Support\Str;
use App\Contracts\AuthContract;
use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        $user->assignRole(Constant::ROLE_USER);
        return $user;
    }

    public function login($data)
    {
        $user = $this->model->where('email', $data['email'])->first();

        if (!($this->model)->checkPassword($data['password'], $user->password))
            throw new CustomException("Invalid Credentials");

        return $user;
    }
    public function forgot($data)
    {
        $user = User::where('email', $data['email'])->first();
        if ($user) {
            $otp = Str::random(7);
            $mail = Mail::to($user->email)->send(new OtpSendMail($otp));
            dd($mail);
        }
        $model = new $this->model;
        $user = $this->prepareData($model, $data, false);

        return $user;
    }

    public function prepareData($model, $input, $new_record = false)
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
        if (isset($input['new_password']) && $input['new_password'] != '') {
            $model->password = bcrypt($input['new_password']);
        }

        $user = $model->save();
        return $model;
    }

    public function changePassword($data)
    {
        $model = $this->model->find(Auth::user()->id);
        if (!($this->model)->checkPassword($data['old_password'], $model->password))
            throw new CustomException("Invalid Credentials");
        return $this->prepareData($model, $data, false);
    }
    public function deleteProfile($data)
    {
        return $this->model->destroy(Auth::user()->id);
    }
}
