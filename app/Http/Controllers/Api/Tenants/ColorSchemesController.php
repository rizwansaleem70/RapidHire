<?php

namespace App\Http\Controllers\Api\Tenants;

use App\Contracts\Tenants\ColorSchemeContract;
use App\Exceptions\CustomException;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenants\StoreColorSchemeRequest;
use Illuminate\Support\Facades\DB;

class ColorSchemesController extends Controller
{
    public ColorSchemeContract $colorScheme;

    public function __construct(ColorSchemeContract $colorScheme)
    {
        $this->colorScheme = $colorScheme;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $colorScheme = $this->colorScheme->index();
            return $this->successResponse("Successfully Fetch Data", $colorScheme);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("colorScheme index", 'none', $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreColorSchemeRequest $request)
    {
        try {
            DB::beginTransaction();
            $colorScheme = $this->colorScheme->store($request->prepareRequest());
            if ($colorScheme)
                $colorScheme = $this->colorScheme->index();
            DB::commit();
            return $this->successResponse("Color Scheme Save Successfully", $colorScheme);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("colorScheme index", $request->input(), $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }
}
