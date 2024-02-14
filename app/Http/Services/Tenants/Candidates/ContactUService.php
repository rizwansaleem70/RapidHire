<?php

namespace App\Http\Services\Tenants\Candidates;

use App\Models\Tenants\SocialMedia;
use Illuminate\Support\Facades\Mail;
use App\Contracts\Tenants\Candidates\ContactUContract;
use App\Mail\ContactUsCandidateMail;
use App\Mail\ContactUsTenantMail;

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
    public function contactUsStore($request)
    {
        Mail::to($request['email'])->send(new ContactUsCandidateMail($request['name']));
        Mail::to('bd@devjeco.com')->send(new ContactUsTenantMail($request));
    }
}
