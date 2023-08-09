<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tenant = Tenant::create([
            'name' => $request->name,
            'id'=> (Tenant::count())+1,
        ]);
        $tenant->domains()->create(['domain' => $request->domain . '.localhost']);

        $tenant->givePermissionTo('employee.view');
//        foreach ($request->assign_child as $per) {
//            if ($per == 1) {
//                $tenant->givePermissionTo('employee.view');
//            }
//            if ($per == 2) {
//                $tenant->givePermissionTo('employee.edit');
//            }
//            if ($per == 3) {
//                $tenant->givePermissionTo('employee.delete');
//            }
//            if ($per == 4) {
//                $tenant->givePermissionTo('candidate.view');
//            }
//            if ($per == 5) {
//                $tenant->givePermissionTo('candidate.edit');
//            }
//            if ($per == 6) {
//                $tenant->givePermissionTo('candidate.delete');
//            }
//        }
        return redirect()->route('tenant.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
