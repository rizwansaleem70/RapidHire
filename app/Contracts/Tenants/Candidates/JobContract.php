<?php

namespace App\Contracts\Tenants\Candidates;

/**
* @var JobContract
*/
interface JobContract
{
    public function listing($filter);
    public function jobDetail($slug);
}
