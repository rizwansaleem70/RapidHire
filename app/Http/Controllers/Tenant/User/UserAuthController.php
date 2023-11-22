<?php

namespace App\Http\Controllers\Tenant\User;

use App\Http\Controllers\Controller;
use App\Contracts\Tenants\Users\UserAuthContract;
use App\Http\Requests\Tenants\Users\CandidateRegisterRequest;
use App\Http\Requests\Tenants\Users\CandidateLoginRequest;
use App\Http\Requests\Tenants\Users\ResetPasswordRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public UserAuthContract $user;

    public function __construct(UserAuthContract $user)
    {
        $this->user = $user;
    }
    public function signup()
    {
        return view('candidates.auth.signup');
    }

    public function register(CandidateRegisterRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = $this->user->register($request->prepareData());
            if($user == true){
                DB::commit();
                session()->flash('success', 'You have Successfully Registered');
                return redirect()->route('tenant-user-home');
            }
            else{
                DB::rollBack();
                session()->flash('message', 'Please Add Valid Credentials, Try Again');
                return view('candidates.auth.login');
            }
        } catch (\Exception $th) {
            DB::rollBack();
            return $this->failedResponse($th->getMessage());
        }
    }

    public function loginPage()
    {
        return view('candidates.auth.login');
    }

    public function login(CandidateLoginRequest $request)
    {
        try {
            $user=$this->user->login($request->prepareData());
            if($user == true){
                session()->flash('success', 'You have Successfully Login');
                return redirect()->route('tenant-user-home');
                return view('candidates.home');
            }
            else{
                session()->flash('message', 'Invalid Credentials, Try Again');
                return view('candidates.auth.login');
            }
        } catch (\Exception $th) {
            return $this->failedResponse($th->getMessage());
        }
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        Auth::logout();
        session()->flash('success', 'You have Successfully Logout');
        return redirect()->route('tenant-user-home');
    }

    public function resetPasswordPage()
    {
        return view('candidates.auth.reset-password');
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $new = $request->prepareData();
        return view('candidates.auth.reset-password-message');
    }

}
