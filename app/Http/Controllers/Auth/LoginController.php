<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating candidates for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        logout as performLogout;
    }

    /**
     * Where to redirect candidates after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function authenticated(Request $request, $user)
    {
        if ($user->email_verified_at != null){
            return redirect()->route('candidate.home')->with('success', 'Logged in Successfully');
        }else{
            Auth::logout();
            return redirect()->route('candidate.home')->with('message', 'Please verify first.A fresh verification link has been sent to your email address.');
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('candidate.home')->with('success','Logged out Successfully');
    }
}
