<?php

namespace App\Http\Controllers\Api\Tenants;

use App\Contracts\Tenants\LocationContract;
use App\Exceptions\CustomException;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenants\StoreLocationRequest;
use App\Http\Requests\Tenants\UpdateLocationRequest;
use App\Http\Resources\Tenants\Location;
use App\Http\Resources\Tenants\LocationCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationsController extends Controller
{
    public $location;

    public function __construct(LocationContract $location)
    {
        $this->location = $location;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $location = $this->location->index();
            $location = new LocationCollection($location);
            return $this->successResponse("Successfully Fetch", $location);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("location index", 'none', $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLocationRequest $request)
    {
        try {
            DB::beginTransaction();
            $location = $this->location->store($request->prepareRequest());
            $location = new Location($location);
            DB::commit();
            return $this->successResponse("Location Added Successfully", $location);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("location index", $request->input(), $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $location = $this->location->show($id);
            $location = new Location($location);
            return $this->successResponse("Location Found Successfully", $location);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("location show", 'id =' . $id, $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocationRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $location = $this->location->update($request->prepareRequest(), $id);
            $location = new Location($location);
            DB::commit();
            return $this->successResponse("Location Updated Successfully", $location);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("location update (id = )" . $id, $request->input(), $th->getMessage());
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
            $this->location->delete($id);
            DB::commit();
            return $this->okResponse("Location Deleted Successfully");
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("location destroy", 'id = ' . $id, $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }
}
