<?php

namespace App\Http\Controllers\Api\Tenants;

use App\Contracts\Tenants\CategoryContract;
use App\Exceptions\CustomException;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenants\StoreCategoryRequest;
use App\Http\Requests\Tenants\UpdateCategoryRequest;
use App\Http\Resources\Tenants\Category;
use App\Http\Resources\Tenants\CategoryCollection;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $category;

    public function __construct(CategoryContract $category)
    {
        $this->category = $category;
    }
    public function index()
    {
        try {
            $category = $this->category->index();
            $category = new CategoryCollection($category);
            return $this->successResponse("Successfully", $category);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("category index", 'none', $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            DB::beginTransaction();
            $category = $this->category->store($request->prepareRequest());
            $category = new Category($category);
            DB::commit();
            return $this->successResponse("Category Added Successfully", $category);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("category index", $request->input(), $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $category = $this->category->show($id);
            $category = new Category($category);
            return $this->successResponse("Category Found Successfully", $category);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("category show", 'id =' . $id, $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $category = $this->category->update($request->prepareRequest(), $id);
            $category = new Category($category);
            DB::commit();
            return $this->successResponse("Category Updated Successfully", $category);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("category update (id = )" . $id, $request->input(), $th->getMessage());
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
            $this->category->delete($id);
            DB::commit();
            return $this->okResponse("Category Deleted Successfully");
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("category destroy", 'id = ' . $id, $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }
}
