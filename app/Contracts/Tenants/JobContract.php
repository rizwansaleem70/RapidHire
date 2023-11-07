<?php

namespace App\Contracts\Tenants;

/**
 * @var JobContract
 */
interface JobContract
{
    public function index();
    public function questionList($query);
    public function store($data);
    public function update($data, $id);
    public function delete($id);
    public function get_country_against_job($id);
    public function requirements($id);
    public function getApplicantJobs($data);
    public function job_qualification($data, $job_id);
    public function getJobQualifications($job_id);
    public function ATS_Score($data, $job_id);
    public function getJobApplicant($filter, $job_id);
    public function jobApplicantProfileStatus($filter,$user_id,$job_id);
    public function jobApplicantQuestionAnswer($user_id,$job_id);
    public function jobApplicantProfileHeader($user_id);
    public function jobApplicantProfile($user_id);
}
