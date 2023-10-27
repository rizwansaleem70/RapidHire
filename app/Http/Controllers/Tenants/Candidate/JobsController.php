<?php

namespace App\Http\Controllers\Tenants\Candidate;

use App\Contracts\Tenants\Candidates\JobContract;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Models\Tenants\User\FavoriteJob;

class JobsController extends Controller
{
    public JobContract $job;

    public function __construct(JobContract $job)
    {
        $this->job = $job;
    }

    public function listing()
    {
        try {
            $data = $this->job->listing();
            return view('candidates.job.listing',compact('data'));
        } catch (\Exception $th) {
            return $this->failedResponse($th->getMessage());
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
        }
    }
}
