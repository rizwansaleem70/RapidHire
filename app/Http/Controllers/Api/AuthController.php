<?php

namespace App\Http\Controllers\Api;

use App\Contracts\AuthContract;
use App\Exceptions\CustomException;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\Tenants\ChangePasswordRequest;
use App\Http\Requests\Tenants\DeleteProfileRequest;
use App\Http\Requests\Tenants\LoginRequest;
use App\Http\Requests\Tenants\RegisterRequest;
use App\Http\Resources\Tenants\FavoriteJobResourceCollection;
use App\Http\Resources\Tenants\LoginUserResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public $_auth;
    function __construct(AuthContract $auth)
    {
        $this->_auth = $auth;
    }

    public function register(RegisterRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = $this->_auth->register($request->prepareData());
            $data = [
                'token' => $user->createToken(Str::random(10))->plainTextToken,
                'user' => new LoginUserResponse($user),
            ];
            DB::commit();
            return $this->successResponse("User Registered Successfully", $data);
        } catch (\Throwable $th) {
            DB::rollBack();
            Helper::logMessage("register", $request->input(), $th->getMessage());
            return $this->failedResponse("Something went wrong!");
        }
    }


    public function login(LoginRequest $request)
    {
        try {
            $user = $this->_auth->login($request->prepareData());
            $data = [
                'token' => $user->createToken(Str::random(10))->plainTextToken,
                'user' => new LoginUserResponse($user),
            ];
            return $this->successResponse("User Login Successfully", $data);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("login", $request->input(), $th->getMessage());
            return $this->failedResponse("Something went wrong!");
        }
    }
    public function forgot(ForgotPasswordRequest $request)
    {
        try {
            $user = $this->_auth->forgot($request->prepareRequest());
            $data = [
                //                'token' => $user->createToken('API TOKEN')->plainTextToken,
                'user' => $user,
            ];
            return $this->successResponse(true, "User Found Successfully", $data);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("login", $request->input(), $th->getMessage());
            return $this->failedResponse("Something went wrong!");
        }
    }
    public function changePassword(ChangePasswordRequest $request,$user_id)
    {
        try {
            $user = $this->_auth->changePassword($request->prepareData(),$user_id);
            $data = [
                'token' => $user->createToken(Str::random(10))->plainTextToken,
                'user' => new LoginUserResponse($user),
            ];
            return $this->successResponse("Password change Successfully", $data);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            helper::logMessage("Change password", $request->input(), $th->getMessage());
            return $this->failedResponse("Something went wrong!");
        }
    }
    public function logout(Request $request)
    {
        try {
            auth()->user()->tokens()->delete();
            return redirect()->route('tenant-user-logout')->with('success', 'You have Successfully Logout');
//            return $this->okResponse("User Logout Successfully");
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            helper::logMessage("Logout", "Logout", $th->getMessage());
            return $this->failedResponse("Something went wrong!");
        }
    }
    public function favoriteJob()
    {
        try {
            $favoriteJob = $this->_auth->favoriteJob();
            $data = new FavoriteJobResourceCollection($favoriteJob);
            return $this->successResponse("Favorite Job Fetch Successfully",$data);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            helper::logMessage("favorite Job", "favorite Job", $th->getMessage());
            return $this->failedResponse("Something went wrong!");
        }
    }
    public function deleteProfile(DeleteProfileRequest $request,$user_id)
    {
        try {
            $this->_auth->deleteProfile($request->all(),$user_id);
            return $this->okResponse("User Delete Successfully");
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            helper::logMessage("delete Profile user id = ".auth()->user()->id, "Delete Profile", $th->getMessage());
            return $this->failedResponse("Something went wrong!");
        }
    }
    public function dashboard()
    {
        try {
            $data = [
                'id' => Crypt::encrypt(Auth::user()->id),
            ];
            return $this->successResponse("User ID Fetch Successfully",$data);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            helper::logMessage("dashboard", "dashboard", $th->getMessage());
            return $this->failedResponse("Something went wrong!");
        }
    }
    public function dashboardAuthenticate(Request $request)
    {
        try {
            $user = $this->_auth->dashboardAuthenticate($request->id);
            $data = [
                'token' => $user->createToken(Str::random(10))->plainTextToken,
                'user' => new LoginUserResponse($user),
            ];
            return $this->successResponse("User Login Successfully", $data);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            helper::logMessage("dashboardAuthenticate", "dashboardAuthenticate", $th->getMessage());
            return $this->failedResponse("Something went wrong!");
        }
    }

}
