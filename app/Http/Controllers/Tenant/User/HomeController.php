<?php

namespace App\Http\Controllers\Tenant\User;

use App\Http\Controllers\Controller;
use App\Models\Tenants\Department;
use App\Models\Tenants\Job;
use App\Models\Tenants\User\FavoriteJob;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('users.home',compact('departments'));
    }

    public function jobApply($id)
    {
        if(auth()->user())
        {
            $favJobs = FavoriteJob::where('user_id',auth()->user()->id)->get();
            $job = Job::findorfail($id);
            return view('users.apply',compact('job','favJobs'));
        }
        else
        {
            $job = Job::findorfail($id);
            return view('users.apply',compact('job'));
        }
    }

    public function about()
    {
        return view('users.about');
    }

    public function jobs()
    {
        if(auth()->user())
        {
            $favJobs = FavoriteJob::where('user_id',auth()->user()->id)->get();
            $jobs = Job::all();
            return view('users.jobs',compact('jobs','favJobs'));
        }
        else
        {
            $jobs = Job::all();
            return view('users.jobs',compact('jobs'));
        }
    }

    public function contact()
    {
        return view('users.contact');
    }

    public function submit()
    {
        return view('users.submit');
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
