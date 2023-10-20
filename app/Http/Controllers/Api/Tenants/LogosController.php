<?php

namespace App\Http\Controllers\Api\Tenants;

use App\Contracts\Tenants\LogoContract;
use App\Exceptions\CustomException;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenants\StoreLogoRequest;
use Illuminate\Support\Facades\DB;

class LogosController extends Controller
{
    public LogoContract $logo;

    public function __construct(LogoContract $logo)
    {
        $this->logo = $logo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $logo = $this->logo->index();
            return $this->successResponse("Successfully Fetch Data", $logo);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("logo index", 'none', $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLogoRequest $request)
    {
        try {
            DB::beginTransaction();
            $logo = $this->logo->store($request->prepareRequest());
            if ($logo)
                $logo = $this->logo->index();
            DB::commit();
            return $this->successResponse("Logo Save Successfully", $logo);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("logo index", $request->input(), $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

}
