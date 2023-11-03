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
    public function requirements($id);
    public function getApplicantJobs($data);
    public function ATS_Score($data);
    public function getJobApplicant($filter,$job_id);
    public function jobApplicantProfileHeader($user_id);
    public function jobApplicantProfile($user_id);
}
