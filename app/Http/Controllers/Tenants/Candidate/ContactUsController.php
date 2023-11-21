<?php

namespace App\Http\Controllers\Tenants\Candidate;

use App\Contracts\Tenants\Candidates\ContactUContract;
use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;

class ContactUsController extends Controller
{
    public ContactUContract $contactUs;

    public function __construct(ContactUContract $contactUs)
    {
        $this->contactUs = $contactUs;
    }
    public function contact_us()
    {
        try {
            $data = $this->contactUs->contact_us();
            return view('candidates.contact-us', compact('data'));
        } catch (CustomException | \Exception $th) {
            return redirect()->back()->with('message', $th->getMessage());
        }
    }
}
