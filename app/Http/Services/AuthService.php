<?php

namespace App\Http\Services;

use App\Models\Tenants\Candidate\FavoriteJob;
use App\Models\User;
use App\Helpers\Constant;
use App\Mail\OtpSendMail;
use Illuminate\Support\Facades\Crypt;
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
    protected User $model;
    protected FavoriteJob $modelFavoriteJob;
    public function __construct()
    {
        $this->model = new User();
        $this->modelFavoriteJob = new FavoriteJob();
    }

    public function register($input)
    {
        $model = new $this->model;
        $user = $this->prepareData($model, $input, true);
        $user->assignRole(Constant::ROLE_USER);
        return $user;
    }

    public function login($input)
    {
        $user = $this->model->where('email', $input['email'])->first();

        if (!($this->model)->checkPassword($input['password'], $user->password))
            throw new CustomException("Invalid Credentials");

        return $user;
    }
    public function forgot($input)
    {
        $user = User::where('email', $input['email'])->first();
        if ($user) {
            $otp = Str::random(7);
            $mail = Mail::to($user->email)->send(new OtpSendMail($otp));
            dd($mail);
        }
        $model = new $this->model;
        $user = $this->prepareData($model, $input, false);

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

    public function changePassword($input,$user_id)
    {
        $model = $this->model->find($user_id);
        if (!($this->model)->checkPassword($input['old_password'], $model->password))
            throw new CustomException("Invalid Credentials");
        return $this->prepareData($model, $input, false);
    }
    public function deleteProfile($input,$user_id)
    {
        $model = $this->model->find($user_id);
        if (!($this->model)->checkPassword($input['password'], $model->password))
            throw new CustomException("Password Does Not Match");
        return $this->model->destroy($user_id);
    }
    public function favoriteJob()
    {
        return $this->modelFavoriteJob->whereUserId(Auth::user()->id)->with('job')->get();
    }
    public function dashboardAuthenticate($id)
    {
        $user = $this->model->whereId(Crypt::decrypt($id))->first();
        if (empty($user)) {
            throw new CustomException('Applicant Not Found!');
        }
        return $user;
    }

    public function logout($id)
    {
        $user = $this->model->whereId($id)->first();
        dd($user);
        if (empty($user)) {
            throw new CustomException('Candidate Not Found!');
        }
        return $user->tokens()->delete();
    }
}
