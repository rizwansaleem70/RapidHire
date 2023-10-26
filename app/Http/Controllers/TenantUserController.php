<?php

namespace App\Http\Controllers;

use App\Models\TenantUser;
use App\Models\User;
use Illuminate\Http\Request;

class TenantUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('SuperAdmin.createuser');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:candidates'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => $request['password']
        ]);

        foreach ($request->assign_child as $per) {
            if ($per == 1) {
                $user->givePermissionTo('employee.view');
            }
            if ($per == 2) {
                $user->givePermissionTo('employee.edit');
            }
            if ($per == 3) {
                $user->givePermissionTo('employee.delete');
            }
            if ($per == 4) {
                $user->givePermissionTo('candidate.view');
            }
            if ($per == 5) {
                $user->givePermissionTo('candidate.edit');
            }
            if ($per == 6) {
                $user->givePermissionTo('candidate.delete');
            }
        }
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TenantUser $tenantUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TenantUser $tenantUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TenantUser $tenantUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TenantUser $tenantUser)
    {
        //
    }

    public function user()
    {
        $data = User::all();
        return view('SuperAdmin.user', compact('data'));
    }


}
