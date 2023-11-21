<?php

namespace App\Http\Services\Tenants\Candidates;

use App\Contracts\Tenants\Candidates\HomeContract;
use App\Models\Tenants\Department;
use App\Models\Tenants\Job;
use App\Models\User;

/**
* @var HomeService
*/
class HomeService implements HomeContract
{

    protected User $modelUser;
    protected Department $modelDepartment;
    protected Job $modelJob;
    public function __construct()
    {
        $this->modelUser = new User();
        $this->modelDepartment = new Department();
        $this->modelJob = new Job();
    }

    public function index()
    {
        $departments = $this->modelDepartment->withCount(['job' => function ($query) {
                        $query->where('status', 'published')->where('expiry_date', '>',date('Y-m-d'));
                    }])->get();
        $jobs = $this->modelJob->where('status', 'published')->where('expiry_date', '>',date('Y-m-d'))->orderBy('views', 'desc')->limit(6)->get();
        return [
            'departments' => $departments,
            'jobs' => $jobs,
            ];
    }
}
