<?php

namespace App\Http\Controllers\Api\Tenants;

use App\Contracts\Tenants\SettingContract;
use App\Exceptions\CustomException;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenants\StoreSettingRequest;
use App\Http\Requests\Tenants\UpdateSettingRequest;
use App\Http\Resources\Tenants\DepartmentCollection;
use App\Http\Resources\Tenants\InterviewFeedbackResourceCollection;
use App\Http\Resources\Tenants\QuestionBankResourceCollection;
use App\Http\Resources\Tenants\RequirementResourceCollection;
use App\Http\Resources\Tenants\SettingResource;
use App\Http\Resources\Tenants\SettingResourceCollection;
use App\Http\Resources\Tenants\SocialMediaResourceCollection;
use App\Models\Tenants\Department;
use App\Models\Tenants\InterviewFeedback;
use App\Models\Tenants\QuestionBank;
use App\Models\Tenants\Requirement;
use App\Models\Tenants\SocialMedia;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller

{
    public SettingContract $setting;

    public function __construct(SettingContract $setting)
    {
        $this->setting = $setting;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $settings = $this->setting->index();
            $departments = Department::get();
            $requirements = Requirement::get();
            $question_bank = QuestionBank::with('department')->get();
            $social_media = SocialMedia::get();
            $interview_feedback = InterviewFeedback::get();
            return $this->successResponse("Successfully Fetch Record", [
                "settings" => $settings,
                "departments" => new DepartmentCollection($departments),
                "requirements" => new RequirementResourceCollection($requirements),
                "question_bank" => new QuestionBankResourceCollection($question_bank),
                "social_media" => new SocialMediaResourceCollection($social_media),
                "interview_feedback" => new InterviewFeedbackResourceCollection($interview_feedback)
            ]);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("setting index ", "", $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSettingRequest $request, $type)
    {
        try {
            DB::beginTransaction();
            $setting = $this->setting->store($request->prepareRequest(), $type);
            if ($setting)
                $setting = $this->setting->index($type);
            DB::commit();
            return $this->successResponse(ucfirst($type) . " Added Successfully", $setting);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("setting index", $request->input() . " " . $type, $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //        try {
        //            $setting = $this->setting->show($id);
        //            $setting = new SettingResource($setting);
        //            return $this->successResponse( "Setting Found Successfully", $setting);
        //        } catch (CustomException $th) {
        //            return $this->failedResponse($th->getMessage());
        //        } catch (\Throwable $th) {
        //            Helper::logMessage("setting show", 'id ='.$id, $th->getMessage());
        //            return $this->failedResponse($th->getMessage());
        //        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSettingRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $setting = $this->setting->update($request->prepareRequest(), $id);
            $setting = new SettingResource($setting);
            DB::commit();
            return $this->successResponse("Setting Updated Successfully", $setting);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("setting update (id = )" . $id, $request->input(), $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $this->setting->delete($id);
            DB::commit();
            return $this->okResponse("Setting Deleted Successfully");
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("setting destroy", 'id = ' . $id, $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }
}
