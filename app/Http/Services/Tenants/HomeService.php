<?php

namespace App\Http\Services\Tenants;

use App\Contracts\Tenants\HomeContract;
use App\Helpers\Constant;
use App\Models\Notification;
use App\Models\Tenants\Applicant;
use App\Models\Tenants\Candidate\FavoriteJob;
use App\Models\Tenants\City;
use App\Models\Tenants\Country;
use App\Models\Tenants\Job;
use App\Models\Tenants\State;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/**
* @var HomeService
*/
class HomeService implements HomeContract
{
    public Country $modelCountry;
    public State $modelState;
    public City $modelCity;
    public Job $modelJob;
    public User $modelUser;
    public Applicant $modelApplicant;
    public FavoriteJob $modelFavoriteJob;

    public function __construct()
    {
        $this->modelCountry = new Country();
        $this->modelState = new State();
        $this->modelCity = new City();
        $this->modelJob = new Job();
        $this->modelApplicant = new Applicant();
        $this->modelUser = new User();
        $this->modelFavoriteJob = new FavoriteJob();
    }

    public function getAllCountry()
    {
        return $this->modelCountry->latest()->get();

    }

    public function getAllState($request)
    {
        return $this->modelState
            ->when($request->country_id, function ($q, $country_id) {
            return $q->where('country_id', $country_id);
        })->latest()->get();
    }

    public function getAllCity($request)
    {
        return $this->modelCity
            ->when($request->state_id, function ($q, $state_id) {
                return $q->where('state_id', $state_id);
            })->latest()->get();
    }

    public function getCandidateDashboardStats($user_id)
    {
        $totalAppliedJobs = $this->modelApplicant->whereUserId($user_id)->count();
        $totalSaveJobs = $this->modelFavoriteJob->whereUserId($user_id)->count();
        return [
            'totalSaveJobs' => $totalSaveJobs,
            'totalAppliedJobs' => $totalAppliedJobs,
            ];
    }

    public function getDashboardStats()
    {
        $totalJobs = $this->modelJob->count();
        $activeTotalJobs = $this->modelJob->where('status', 'published')->where('expiry_date', '>=',date('Y-m-d'))->count();
        $totalApplicant = $this->modelApplicant->count();
        $totalHired = $this->modelApplicant->where('status', 'hired')->count();
        $totalRejected = $this->modelApplicant->where('status', 'rejected')->count();
        $totalMember = $this->modelUser->whereHas('roles', function ($query) {
            $query->whereIn('id', [Constant::ROLE_INTERVIEWER, Constant::ROLE_RECRUITER]);
        })->count();
        $notifications = Notification::latest()->limit(10)->get(['id', 'message','created_at']);
            return [
                'totalJobs' => $totalJobs,
                'activeTotalJobs' => $activeTotalJobs,
                'totalApplicant' => $totalApplicant,
                'totalHired' => $totalHired,
                'totalRejected' => $totalRejected,
                'totalMember' => $totalMember,
                'notifications' => $notifications,
            ];
    }
}
