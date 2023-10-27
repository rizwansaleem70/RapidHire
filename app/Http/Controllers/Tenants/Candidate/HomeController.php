<?php

namespace App\Http\Controllers\Tenants\Candidate;

use App\Contracts\Tenants\Candidates\HomeContract;
use App\Models\Tenants\User\FavoriteJob;
use App\Http\Controllers\Controller;
use App\Models\Tenants\Department;
use Symfony\Component\HttpFoundation\Request;
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

    public function jobs()
    {
        if(auth()->user())
        {
            $favJobs = FavoriteJob::where('user_id',auth()->user()->id)->get();
            $jobs = Job::all();
            return view('candidates.jobs',compact('jobs'));
        }
        else
        {
            $jobs = Job::all();
            return view('candidates.jobs',compact('jobs'));
        }
    }

    public function like(Request $request)
    {
        $user_id = auth()->user()->id;
        $job_id = $request->job_id;

        $row = FavoriteJob::where('user_id', $user_id)
                ->where('job_id', $job_id)
                ->first();

        if ($row) {
            $row->update(['is_active' => $request->is_active]);
        } else {
            $new = new FavoriteJob();
            $new->user_id = $user_id;
            $new->job_id = $job_id;
            $new->is_active = $request->is_active;
            $new->save();
        }
    }

    public function dislike(Request $request)
    {
        $user_id = auth()->user()->id;
        $job_id = $request->job_id;

        $row = FavoriteJob::where('user_id', $user_id)
                ->where('job_id', $job_id)
                ->first();

        if ($row) {
            $row->delete();
        } else {
        }
    }


}
