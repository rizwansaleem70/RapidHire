<?php

namespace App\Http\Controllers\Tenants\Candidate;

use App\Contracts\Tenants\Candidates\JobContract;
use App\Http\Controllers\Controller;

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
}
