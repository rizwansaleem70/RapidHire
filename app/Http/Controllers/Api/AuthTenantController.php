<?php

namespace App\Http\Controllers\Api;

use App\Contracts\AuthTenantContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthTenantRegisterRequest;
use App\Http\Resources\AuthTenantRegisterResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Helpers\helper;
class AuthTenantController extends Controller
{
    public $_auth;
    function __construct(AuthTenantContract $auth)
    {
        $this->_auth = $auth;
    }
    public function register(AuthTenantRegisterRequest $request)
    {
        try {
//            DB::beginTransaction();
            $this->_auth->register($request->prepareData());
//            DB::commit();
            return $this->okResponse("Tenant Registered Successfully");
        } catch (\Throwable $th) {
            DB::rollBack();
            helper::logMessage("register", $request->input(), $th->getMessage());
            return $this->failedResponse("Something went wrong!");
        }
    }
}
