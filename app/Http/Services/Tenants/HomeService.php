<?php

namespace App\Http\Services\Tenants;

use App\Contracts\Tenants\HomeContract;
use App\Models\Tenants\City;
use App\Models\Tenants\Country;
use App\Models\Tenants\State;

/**
* @var HomeService
*/
class HomeService implements HomeContract
{
    public Country $modelCountry;
    public State $modelState;
    public City $modelCity;

    public function __construct()
    {
        $this->modelCountry = new Country();
        $this->modelState = new State();
        $this->modelCity = new City();
    }

    public function getAllCountry()
    {
        return $this->modelCountry->latest()->get();

    }

    public function getAllState($request)
    {
        return $this->modelState->where('country_id',$request->country_id)->latest()->get();
    }

    public function getAllCity($request)
    {
        return $this->modelCity->where('state_id',$request->state_id)->latest()->get();

    }
}
