<?php

namespace App\Helpers;

class Constant
{
    const LOGO = 'logo';
    const COLOR_SCHEME = 'color-scheme';
    const ORGANIZATION = 'organization';
    const CONFIGURATION = 'configuration';
    const CORE_VALUE = 'core-value';

    const SUPER_ADMIN = 'SuperAdmin';
    const SUPER_ADMIN_ID = 1;
    const ADMIN = 'Admin';
    const ADMIN_ID = 2;
    const TENANT = 'Tenant';
    const TENANT_ID = 3;
    const SUB_ADMIN = 'SubAdmin';
    const SUB_ADMIN_ID = 3;

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
