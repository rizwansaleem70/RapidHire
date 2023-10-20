<?php

namespace App\Http\Controllers\Api\Tenants;

use App\Contracts\Tenants\OrganizationContract;
use App\Exceptions\CustomException;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenants\StoreOrganizationRequest;
use App\Http\Requests\Tenants\UpdateOrganizationRequest;
use Illuminate\Support\Facades\DB;

class OrganizationsController extends Controller
{
    public OrganizationContract $organization;

    public function __construct(OrganizationContract $organization)
    {
        $this->organization = $organization;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $organization = $this->organization->index();
            return $this->successResponse("Successfully Fetch", $organization);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("organization index", 'none', $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrganizationRequest $request)
    {
        try {
            DB::beginTransaction();
            $organization = $this->organization->store($request->prepareRequest());
            if ($organization)
                $organization = $this->organization->index();
            DB::commit();
            return $this->successResponse("Organization Record Added Successfully", $organization);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("organization index", $request->input(), $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }
}
