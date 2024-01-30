<?php

namespace App\Http\Controllers\Api\Tenants;

use App\Contracts\Tenants\ImageUploadContract;
use App\Exceptions\CustomException;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenants\StoreImageUploadRequest;
use App\Http\Resources\Tenants\ImageUploadResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImageUploadsController extends Controller
{
    public $imageUpload;

    public function __construct(ImageUploadContract $imageUpload)
    {
        $this->imageUpload = $imageUpload;
    }
    public function store(StoreImageUploadRequest $request)
    {
        try {
            DB::beginTransaction();
            $imageUpload = $this->imageUpload->store($request->prepareRequest());
            DB::commit();
            return $this->successResponse("File Upload Successfully", $imageUpload);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("ImageUpload index", $request->input(), $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }
}
