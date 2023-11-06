<?php

namespace App\Contracts\Tenants;

/**
 * @var Tenants\InterviewContract
 */
interface InterviewContract
{
    public function setInterview($data);
    public function getScheduledInterviews($candidateId);
    public function removeInterview($id);
}
