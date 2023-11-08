<?php

namespace App\Http\Services\Tenants;

use App\Contracts\Tenants\InterviewContract;
use App\Models\Tenants\CandidateInterviews;
use App\Exceptions\CustomException;

/**
 * @var Tenants\InterviewService
 */
class InterviewService implements InterviewContract
{
    public CandidateInterviews $model;
    public function __construct()
    {
        $this->model = new CandidateInterviews();
    }

    public function setInterview($data)
    {
        $model = new $this->model();
        $interview = $this->prepareDate($model, $data);
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

    public function getScheduledInterviews($candidate_id)
    {
        $model = $this->model->find($candidate_id);
        if (empty($model)) {
            throw new CustomException('Candidate Not Found!');
        }
        return $this->model->where('applicant_id', $candidate_id)->latest()->get();
    }

    public function removeInterview($id)
    {
        $interview = $this->model->find($id);
        $interview->delete();

        return true;
    }
}
