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
    public function show($id);
    public function update($data, $id);
    public function delete($id);
    public function get_country_against_job($id);
    public function requirements($job_id);
    public function atsFields($job_id, $for_edit);
    public function getApplicantJobs($data);
    public function job_qualification($data, $job_id);
    // public function getJobQualifications($job_id);
    public function ATS_Score($data, $job_id);
    public function getJobApplicant($filter, $job_id);
    public function candidateAppliedJobs($user_id);
    public function jobApplicantProfileStatus($filter, $applicant_id, $job_id);
    public function jobApplicantQuestionAnswer($applicant_id, $job_id);
    public function jobApplicantProfileHeader($applicant_id);
    public function profile($user_id);
    public function profileUpdate($data, $user_id);
    public function getAtsScore($job_id);
    public function showJobDetail($job_id);
    public function jobStatus($data);
}
