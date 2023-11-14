<?php

namespace App\Http\Controllers\Api\Tenants;

use App\Helpers\Helper;
use App\Helpers\Constant;
use App\Models\Tenants\Job;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\Tenants\Applicant;
use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Contracts\Tenants\HomeContract;
use App\Http\Resources\Tenants\CityResourceCollection;
use App\Http\Resources\Tenants\StateResourceCollection;
use App\Http\Resources\Tenants\CountryResourceCollection;

class HomeController extends Controller
{
    public $home;
    public function __construct(HomeContract $home)
    {
        $this->home = $home;
    }


    public function getDashboardStats()
    {
        $jobs = Job::count();
        $hired = Applicant::where('status', 'hired')->count();
        $rejected = Applicant::where('status', 'rejected')->count();
        $positions = Job::sum('total_position');

        $notifications = Notification::select('id', 'message')->get();

        return $this->successResponse('OK', [
            'jobs' => $jobs,
            'hired' => $hired,
            'rejected' => $rejected,
            'positions' => $positions,
            'notifications' => $notifications
        ]);
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
