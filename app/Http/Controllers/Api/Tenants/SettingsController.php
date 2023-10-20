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

class SettingsController extends Controller

{
    public SettingContract $setting;

    public function __construct(SettingContract $setting)
    {
        $this->setting = $setting;
    }
    /**
     * Display a listing of the resource.
     */
    public function index($type)
    {
        try {
            $setting = $this->setting->index($type);
//            $setting = new SettingResource($setting);
            return $this->successResponse("Successfully Fetch Record", $setting);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("setting index ", $type, $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSettingRequest $request,$type)
    {
        try {
            DB::beginTransaction();
            $setting = $this->setting->store($request->prepareRequest(),$type);
            if ($setting)
                $setting = $this->setting->index($type);
            DB::commit();
            return $this->successResponse(ucfirst($type) ." Added Successfully", $setting);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("setting index", $request->input(). " " .$type, $th->getMessage());
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
