<?php

namespace Database\Seeders\tenant;

use App\Models\Tenants\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = ["jobs","applicants",'message','schedules','members','settings','faqs','invoices'];
        $actions = ["*","view","update","create","delete"];

        foreach ($modules as $mobule) {
            foreach ($actions as $value) {
                Permission::create(['name' => $mobule.'.'.$value]);
            }
        }
    }
}
