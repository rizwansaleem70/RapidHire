<?php

namespace App\Http\Controllers\Api\Tenants;

use App\Contracts\Tenants\SocialMediaContract;
use App\Exceptions\CustomException;
use App\Helpers\helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenants\StoreSocialMediaRequest;
use App\Http\Requests\Tenants\UpdateSocialMediaRequest;
use App\Http\Resources\Tenants\SocialMedia;
use App\Http\Resources\Tenants\SocialMediaCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SocialMediasController extends Controller
{
    public SocialMediaContract $socialMedia;
    public function __construct( SocialMediaContract $socialMedia)
    {
        $this->socialMedia = $socialMedia;

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $socialMedia = $this->socialMedia->index();
            $socialMedia = new SocialMediaCollection($socialMedia);
            return $this->successResponse( "Successfully", $socialMedia);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            helper::logMessage("socialMedia index", 'none', $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSocialMediaRequest $request)
    {
        try {
            DB::beginTransaction();
            $socialMedia = $this->socialMedia->store($request->prepareRequest());
            $socialMedia = new SocialMedia($socialMedia);
            DB::commit();
            return $this->successResponse("Social Media Added Successfully",$socialMedia);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            helper::logMessage("socialMedia index", $request->input(), $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $socialMedia = $this->socialMedia->show($id);
            $socialMedia = new SocialMedia($socialMedia);
            return $this->successResponse( "Social Media Found Successfully", $socialMedia);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            helper::logMessage("socialMedia show", 'id ='.$id, $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSocialMediaRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $socialMedia = $this->socialMedia->update($request->prepareRequest(), $id);
            $socialMedia = new SocialMedia($socialMedia);
            DB::commit();
            return $this->successResponse("Social Media Updated Successfully",$socialMedia);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            helper::logMessage("socialMedia update (id = )".$id, $request->input(), $th->getMessage());
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
            $this->socialMedia->delete($id);
            DB::commit();
            return $this->okResponse("Social Media Deleted Successfully");
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            helper::logMessage("socialMedia destroy", 'id = '.$id , $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }
}
