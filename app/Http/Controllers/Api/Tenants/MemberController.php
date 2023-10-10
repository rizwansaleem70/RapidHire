<?php

namespace App\Http\Controllers\Api\Tenants;

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

            DB::commit();
        } catch (CustomException $th) {
            DB::rollBack();
            return $this->failedResponse($th->getMessage());
        } catch (\Throwable $th) {
            DB::rollBack();
            Helper::logMessage("member/store", $request->input(), $th->getMessage());
            return $this->failedResponse('something went wrong!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
