<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Stancl\Tenancy\Database\Models\Domain;
use App\Models\User;
use DataTables;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return "home";
        return view('home');
    }

    public function admin()
    {
        return view('SuperAdmin.index');
    }

    public function tenant(request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('domains') // Replace 'your_table' with the name of your main table
                ->join('tenants', 'domains.tenant_id', '=', 'tenants.id') // Adjust the join condition based on your actual foreign key column
                ->select('domains.id', 'tenants.name', 'domains.domain', 'tenants.data');
            //return $data;
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                    return $btn;
                })
                ->addColumn('tenant_name', function ($row) {
                    return json_decode($row->data)->name;
                })
                ->addColumn('tenant_db', function ($row) {
                    return json_decode($row->data)->tenancy_db_name;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.tenants.index');
        // $data = Domain::all();
        // $tenant= Tenant::all();
        // return view('admin.tenants.index', compact(['data','tenant']));
    }
}
