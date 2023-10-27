<?php

namespace App\Http\Controllers\Api\Tenants;

use App\Contracts\Tenants\QuestionBankContract;
use App\Exceptions\CustomException;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenants\StoreQuestionBankRequest;
use App\Http\Requests\Tenants\UpdateQuestionBankRequest;
use App\Http\Resources\Tenants\QuestionBankResource;
use App\Http\Resources\Tenants\QuestionBankResourceCollection;
use Illuminate\Support\Facades\DB;

class QuestionBanksController extends Controller
{
    public $questionBank;

    public function __construct(QuestionBankContract $questionBank)
    {
        $this->questionBank = $questionBank;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $questionBank = $this->questionBank->index();
            $questionBank = new QuestionBankResourceCollection($questionBank);
            return $this->successResponse("Successfully Fetch", $questionBank);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("questionBank index", 'none', $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionBankRequest $request)
    {
        try {
            DB::beginTransaction();
            $questionBank = $this->questionBank->store($request->prepareRequest());
            if ($questionBank)
                $questionBank = new QuestionBankResourceCollection($this->questionBank->index());
            DB::commit();
            return $this->successResponse("Question Added Successfully", $questionBank);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("questionBank index", $request->input(), $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $questionBank = $this->questionBank->show($id);
            $questionBank = new QuestionBankResource($questionBank);
            return $this->successResponse("Question Found Successfully", $questionBank);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("questionBank show", 'id =' . $id, $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuestionBankRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $questionBank = $this->questionBank->update($request->prepareRequest(), $id);
            $questionBank = new QuestionBankResource($questionBank);
            DB::commit();
            return $this->successResponse("Question Updated Successfully", $questionBank);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("questionBank update (id = )" . $id, $request->input(), $th->getMessage());
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
            $this->questionBank->delete($id);
            DB::commit();
            return $this->okResponse("Question Deleted Successfully");
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("questionBank destroy", 'id = ' . $id, $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }
}
