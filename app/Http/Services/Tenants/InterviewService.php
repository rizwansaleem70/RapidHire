<?php

namespace App\Http\Services\Tenants;

use App\Contracts\Tenants\InterviewContract;
use App\Models\Tenants\CandidateInterviews;
use App\Exceptions\CustomException;
use App\Models\Notification;
use App\Models\TimeSlot;
use Illuminate\Support\Facades\Auth;

/**
 * @var Tenants\InterviewService
 */
class InterviewService implements InterviewContract
{
    public CandidateInterviews $model;
    public TimeSlot $modelTimeSlot;
    public function __construct()
    {
        $this->model = new CandidateInterviews();
        $this->modelTimeSlot = new TimeSlot();
    }

    public function setInterview($data)
    {
        $model = new $this->model();
        $interview = $this->prepareDate($model, $data);
        Notification::create([
            'user_id' => Auth::id(),
            'title' => 'interview',
            'message' => 'Your interview has been scheduled'
        ]);
        return $interview;
    }

    public function prepareDate($model, $data)
    {
        if (isset($data['applicant_id']) && $data['applicant_id'] != null)
            $model->applicant_id = $data['applicant_id'];

        if (isset($data['interviewer_id']) && $data['interviewer_id'] != null)
            $model->interviewer_id = $data['interviewer_id'];

        if (isset($data['interview_date']) && $data['interview_date'] != null)
            $model->interview_date = $data['interview_date'];

        if (isset($data['start_time']) && $data['start_time'] != null)
            $model->start_time = $data['start_time'];

        if (isset($data['end_time']) && $data['end_time'] != null)
            $model->end_time = $data['end_time'];

        if (isset($data['interviewer_link']) && $data['interviewer_link'] != null)
            $model->interviewer_link = $data['interviewer_link'];

        if (isset($data['interviewee_link']) && $data['interviewee_link'] != null)
            $model->interviewee_link = $data['interviewee_link'];

        $model->save();

        return $model;
    }

    public function getScheduledInterviews($applicant_id)
    {
        $model = $this->model->where('applicant_id', $applicant_id)->count();
        if ($model == 0) {
            throw new CustomException('Applicant Not Found!');
        }
        return $this->model->where('applicant_id', $applicant_id)->latest()->get();
    }

    public function checkForTimeSlot($time_slot_id)
    {
        $model = $this->model->where('time_slot_id', $time_slot_id)->count();
        if ($model > 0) {
            throw new CustomException('This slot is already reserved with some other candidate');
        }
        return true;
    }

    public function removeInterview($id)
    {
        $interview = $this->model->find($id);
        $interview->delete();

        return true;
    }

    public function scheduleInterview()
    {
        $interviews = $this->model->with('applicant.user:id,first_name,last_name')->get();
        return $interviews;
    }
}
