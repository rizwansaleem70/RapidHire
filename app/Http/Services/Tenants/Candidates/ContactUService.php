<?php

namespace App\Http\Services\Tenants\Candidates;

use App\Contracts\Tenants\Candidates\ContactUContract;
use App\Models\Tenants\SocialMedia;

/**
* @var ContactUService
*/
class ContactUService implements ContactUContract
{
    protected SocialMedia $modelSocialMedia;

    public function __construct(){
        $this->modelSocialMedia = new SocialMedia();
    }

    public function contact_us()
    {
        return $this->modelSocialMedia->get();
    }
}
