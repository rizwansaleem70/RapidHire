<?php

namespace App\Http\Services\Tenants;

use App\Contracts\Tenants\HomeContract;
use App\Models\Tenants\Applicant;
use App\Models\Tenants\Candidate\FavoriteJob;
use App\Models\Tenants\City;
use App\Models\Tenants\Country;
use App\Models\Tenants\Job;
use App\Models\Tenants\State;
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
    public Applicant $modelApplicant;
    public FavoriteJob $modelFavoriteJob;

    public function __construct()
    {
        $this->modelCountry = new Country();
        $this->modelState = new State();
        $this->modelCity = new City();
        $this->modelJob = new Job();
        $this->modelApplicant = new Applicant();
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
}
