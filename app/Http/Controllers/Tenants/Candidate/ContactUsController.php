<?php

namespace App\Http\Controllers\Tenants\Candidate;

use App\Contracts\Tenants\Candidates\ContactUContract;
use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenants\StoreContactUsRequest;
use Illuminate\Http\Request;

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
    public function contactUsStore(Request $request)
    {
        try {
            $data = $this->contactUsStore($request->prepare());
            return view('candidates.contact-us', compact('data'));
        } catch (CustomException | \Exception $th) {
            return redirect()->back()->with('message', $th->getMessage());
        }
    }
}
