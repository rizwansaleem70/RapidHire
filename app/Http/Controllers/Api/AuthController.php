<?php

namespace App\Http\Controllers\Api;

use App\Contracts\AuthContract;
use App\Exceptions\CustomException;
use App\Helpers\helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\Tenants\LoginRequest;
use App\Http\Requests\Tenants\RegisterRequest;
use App\Http\Resources\Tenants\LoginUserResponse;
use Illuminate\Support\Facades\DB;
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
            helper::logMessage("register", $request->input(), $th->getMessage());
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
            helper::logMessage("login", $request->input(), $th->getMessage());
            return $this->failedResponse("Something went wrong!");
        }
    }
    public function forgot(ForgotPasswordRequest $request){
        try {
            $user = $this->_auth->forgot($request->prepareRequest());
            $data = [
//                'token' => $user->createToken('API TOKEN')->plainTextToken,
                'user'=> $user,
            ];
            return $this->successResponse(true, "User Found Successfully", $data);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            helper::logMessage("login", $request->input(), $th->getMessage());
            return $this->failedResponse("Something went wrong!");
        }
    }
}