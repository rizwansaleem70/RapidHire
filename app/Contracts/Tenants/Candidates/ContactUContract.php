<?php

namespace App\Contracts\Tenants\Candidates;

/**
* @var ContactUContract
*/
interface ContactUContract
{
    public function contact_us();
    public function contactUsStore($request);
}
