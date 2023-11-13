<?php

namespace App\Http\Controllers\Api\Tenants;

use App\Contracts\Tenants\HomeContract;
use App\Exceptions\CustomException;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Tenants\CityResourceCollection;
use App\Http\Resources\Tenants\CountryResourceCollection;
use App\Http\Resources\Tenants\StateResourceCollection;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct(HomeContract $home)
    {
        $this->home = $home;
    }
    /**
     * Display a listing of the resource.
     */
    public function getAllCountry(): \Illuminate\Http\JsonResponse
    {
        try {
            $home = $this->home->getAllCountry();
            $home = new CountryResourceCollection($home);
            return $this->successResponse("Successfully Country Fetch", $home);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("Home index", 'getAllCountry', $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }
    public function getAllState(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $home = $this->home->getAllState($request);
            $home = new StateResourceCollection($home);
            return $this->successResponse("Successfully State Fetch", $home);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("home index", 'getAllState', $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }
    public function getAllStateCandidate(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $states = $this->home->getAllState($request);
            $view = view('candidates.states', compact('states'))->render();
            return $this->successResponse("Successfully State Fetch", $view);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("home index", 'getAllState', $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }
    public function getAllCity(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $home = $this->home->getAllCity($request);
            $home = new CityResourceCollection($home);
            return $this->successResponse("Successfully City Fetch", $home);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("home index", 'getAllCity', $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }
    public function getAllCityCandidate(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $cities = $this->home->getAllCity($request);
            $view = view('candidates.cities', compact('cities'))->render();
            return $this->successResponse("Successfully City Fetch", $view);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("home index", 'getAllCity', $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }
}
