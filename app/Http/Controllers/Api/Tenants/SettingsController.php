<?php

namespace App\Http\Controllers\Api\Tenants;

use App\Contracts\Tenants\SettingContract;
use App\Exceptions\CustomException;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenants\StoreSettingRequest;
use App\Http\Requests\Tenants\UpdateSettingRequest;
use App\Http\Resources\Tenants\SettingResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class SettingsController extends Controller

{
    public $setting;

    public function __construct(SettingContract $setting)
    {
        $this->setting = $setting;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $setting = $this->setting->index();
            $setting = new SettingResource($setting);
            return $this->successResponse("Successfully Fetch Record", $setting);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("setting index", 'none', $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSettingRequest $request)
    {
        try {
            DB::beginTransaction();
            $setting = $this->setting->store($request->prepareRequest());
            $setting = new SettingResource($setting);
            DB::commit();
            return $this->successResponse("Setting Added Successfully", $setting);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("setting index", $request->input(), $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //        try {
        //            $setting = $this->setting->show($id);
        //            $setting = new SettingResource($setting);
        //            return $this->successResponse( "Setting Found Successfully", $setting);
        //        } catch (CustomException $th) {
        //            return $this->failedResponse($th->getMessage());
        //        } catch (\Throwable $th) {
        //            Helper::logMessage("setting show", 'id ='.$id, $th->getMessage());
        //            return $this->failedResponse($th->getMessage());
        //        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSettingRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $setting = $this->setting->update($request->prepareRequest(), $id);
            $setting = new SettingResource($setting);
            DB::commit();
            return $this->successResponse("Setting Updated Successfully", $setting);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("setting update (id = )" . $id, $request->input(), $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $this->setting->delete($id);
            DB::commit();
            return $this->okResponse("Setting Deleted Successfully");
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("setting destroy", 'id = ' . $id, $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }
}
