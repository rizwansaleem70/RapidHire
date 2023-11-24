<?php

namespace App\Contracts\Tenants;

/**
* @var HomeContract
*/
interface HomeContract
{
    public function getCandidateDashboardStats($user_id);
    public function getAllCountry();
    public function getAllState($request);
    public function getAllCity($request);
}
