<?php

namespace App\Contracts\Tenants;

/**
 * @var Tenants\InterviewContract
 */
interface InterviewContract
{
    public function setInterview($data);
    public function getScheduledInterviews($applicant_id);
    public function removeInterview($id);
    public function sendJobOffer($data);
    public function scheduleInterview();
    public function saveFeedback($data);
}
