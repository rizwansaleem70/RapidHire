<?php

namespace App\Helpers;

class Constant
{
    const LOGO = 'logo';
    const COLOR_SCHEME = 'color-scheme';
    const ORGANIZATION = 'organization';
    const CONFIGURATION = 'configuration';
    const CORE_VALUE = 'core-value';

    const ROLE_ADMIN = 1;
    const ROLE_INTERVIEWER = 2;
    const ROLE_RECRUITER = 3;
    const ROLE_USER = 4;

    //enum('applied','qualification','testing','interview','offer','hired','rejected','withdraw')
    const APPLIED = 'applied';
    const QUALIFICATION = 'qualification';
    const TESTING = 'testing';
    const INTERVIEW = 'interview';
    const OFFER = 'offer';
    const HIRED = 'hired';
    const REJECTED = 'rejected';
    const WITHDRAW = 'withdraw';

    const SLOT_AVAILABLE = 'AVAILABLE';
    const SLOT_BOOKED = 'BOOKED';
    const SLOT_CANCELLED = 'CANCELLED';
    const SLOT_PENDING = 'PENDING';
}
