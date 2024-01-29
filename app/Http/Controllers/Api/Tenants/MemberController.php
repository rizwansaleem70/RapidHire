<?php

namespace App\Http\Controllers\Api\Tenants;

use App\Http\Requests\Tenants\UpdateMemberRequest;
use App\Http\Resources\Tenants\MemberResource;
use App\Models\User;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Contracts\Tenants\MemberContract;
use App\Http\Requests\Tenants\CreateMemberRequest;

class MemberController extends Controller
{
    public $member;
    function __construct(MemberContract $member)
    {
        $this->member = $member;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $members = $this->member->index($request->role);
            return $this->successResponse("Success", $members);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateMemberRequest $request)
    {
        try {
            DB::beginTransaction();
            $member = $this->member->store($request->prepareData());
            DB::commit();
            return $this->successResponse("Member added successfully.");
        } catch (CustomException $th) {
            DB::rollBack();
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            DB::rollBack();
            Helper::logMessage("member/store", $request->input(), $th->getMessage());
            return $this->failedResponse('something went wrong!');
        }
    }
    public function show(string $id)
    {
        try {
            $data = $this->member->show($id);
            $data = new MemberResource($data);
            return $this->successResponse("Member Found Successfully", $data);
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("Member show", 'id =' . $id, $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMemberRequest $request, $id)
    {
        try {
            $this->member->update($request->prepareData(),$id);
            return $this->okResponse("Member Updated Successfully");
        } catch (CustomException $th) {
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            Helper::logMessage("Member show", 'id =' . $id, $th->getMessage());
            return $this->failedResponse($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
