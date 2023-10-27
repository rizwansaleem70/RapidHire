<?php

namespace App\Http\Controllers\Tenants\Candidate;

use App\Contracts\Tenants\Candidates\HomeContract;
use App\Http\Controllers\Controller;
use App\Models\Tenants\Department;
use App\Models\Tenants\Job;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public HomeContract $home;

    public function __construct(HomeContract $home)
    {
        $this->home = $home;
    }

    public function home()
    {
        try {
            $home = $this->home->index();
            return view('candidates.home',compact('home'));
        } catch (\Exception $th) {
            return $this->failedResponse($th->getMessage());
        }
    }
}
