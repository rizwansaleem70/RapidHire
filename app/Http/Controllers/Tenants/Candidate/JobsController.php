<?php

namespace App\Http\Controllers\Tenants\Candidate;

use App\Contracts\Tenants\Candidates\JobContract;
use App\Exceptions\CustomException;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenants\Candidate\StoreJobApplyRequest;
use App\Http\Resources\Tenants\ApplicantJobResourceCollection;
use App\Http\Resources\Tenants\JobApplicantResourceCollection;
use App\Models\Tenants\Candidate\FavoriteJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobsController extends Controller
{
    public JobContract $job;

    public function __construct(JobContract $job)
    {
        $this->job = $job;
    }

    public function listing(Request $request)
    {
        try {
            $data = $this->job->listing($request);
            return view('candidates.job.listing', compact('data'));
        } catch (CustomException | \Exception $th) {
            return redirect()->back()->with('message', $th->getMessage());
        }
    }
    public function jobDetail($slug)
    {
        try {
            $data = $this->job->jobDetail($slug);
            return view('candidates.job.job_detail', compact('data'));
        } catch (CustomException | \Exception $th) {
            return redirect()->back()->with('message', $th->getMessage());
        }
    }
    public function jobApply($slug)
    {
        ini_set('memory_limit', '-1');
        try {
            $data = $this->job->jobApply($slug);
            return view('candidates.job.job_apply', compact('data'));
        } catch (CustomException | \Exception $th) {
            return redirect()->back()->with('message', $th->getMessage());
        }
    }
    public function jobApplyStore(StoreJobApplyRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->job->jobApplyStore($request->prepareRequest());
            DB::commit();
            return redirect()->route('candidates.thankyou');
            // return redirect()->route('candidate.home')->with('success', 'You have Successfully Apply on this Job');
        } catch (CustomException | \Exception $th) {
            return redirect()->back()->withInput()->with('message', $th->getMessage());
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
