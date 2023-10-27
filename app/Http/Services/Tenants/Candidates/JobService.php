<?php

namespace App\Http\Services\Tenants\Candidates;

use App\Contracts\Tenants\Candidates\JobContract;
use App\Models\Tenants\Job;
use App\Models\Tenants\User\FavoriteJob;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
* @var JobService
*/
class JobService implements JobContract
{
    protected Job $modelJob;
    public function __construct()
    {
        $this->modelJob = new Job();
    }

    public function listing()
    {
        if(auth()->user())
        {
            $favJobs = FavoriteJob::where('user_id',auth()->user()->id)->get();
            $jobs = $this->modelJob->select('*',
                DB::raw('DATEDIFF(expiry_date, post_date) AS remaining_days')
            )->paginate(10);
            return [
                'jobs' => $jobs,
                'favJobs' => $favJobs,
            ];
        }
        else
        {
            $jobs = $this->modelJob->select('*',
                DB::raw('DATEDIFF(expiry_date, post_date) AS remaining_days')
            )->paginate(10);
            return [
                'jobs' => $jobs,
            ];
        }
    }
}
